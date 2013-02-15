<?php

class Castings_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function insert($casting)
    {
      $this->db->insert('castings',$casting);
      return $this->db->insert_id();
    }

    function _routes($casting, $full_image = FALSE)
    {
        $casting['logo'] = HOME.HUNTER_PROFILE_IMAGE.$this->_get_hunter_logo($casting['entity_id']);
        
        if($full_image == TRUE)
            $casting['full_image'] = HOME.CASTINGS_FULL_PATH.$casting['image'];
        $casting['image'] = HOME.CASTINGS_PATH.$casting['image'];
        
        return $casting;
    }

    function _days($casting)
    {
        $end_date = date_create($casting['end_date']);
        $today = new DateTime(date('Y-m-d'));
        $interval = $this->date_diff($today->format('Y-m-d'), $end_date->format('Y-m-d'));
        $casting['days'] = $interval;
        if($interval < 0)
            $casting['days'] = 0;
        return $casting;
    }

    function insert_image($casting_id, $filename)
    {
        $data = array('image' => $filename);
        $this->db->where('id', $casting_id);
        $this->db->update('castings', $data);
    }

    function count_all($hunter_id=NULL)
    {
        if(is_null($hunter_id))
            return intval($this->db->count_all('castings'));
        else
        {
            $this->db->select('id');
            $this->db->where('id', $hunter_id);
            $this->db->from('castings');
            return intval($this->db->count_all_results());
        }
    }

    function get_full_casting($id)
    {
        $this->db->select('*');
        $this->db->where('id', $id);
        $this->db->from('castings');
        $result = $this->db->get();
        $casting = $result->first_row('array');
        
        //Almacenar los dias que quedan
        $casting = $this->_days($casting);

        //Entregar las rutas de las imagenes
        $casting = $this->_routes($casting, TRUE);

        //Buscar datos del hunter: department
        $this->db->select('department');
        $this->db->from('entities');
        $this->db->where('id', $casting['entity_id']);
        $result = $this->db->get();
        $hunter = $result->first_row('array');
        $casting['department'] = $hunter['department'];
        $casting['status'] = $this->_get_status($casting);
        return $casting;
    }

    function get_castings($hunter_id=NULL, $cant=NULL, $page=NULL, $all=NULL)
    {
    	$this->db->select('id, title, image, end_date, status, entity_id');
        
        if(!is_null($hunter_id))
            $this->db->where('entity_id', $hunter_id);

        if(!is_null($page) && !is_null($cant))
            $query = $this->db->get('castings', $cant, ($page-1)*$cant);
        else
            $query = $this->db->get('castings');

        $results = $query->result_array();

        foreach($results as &$casting)
        {
            //Almacenar los dias que quedan
            $casting = $this->_days($casting);

            //Entregar las rutas de las imagenes
            $casting = $this->_routes($casting ,TRUE);

            //Entregar estado del casting
            $casting['status'] = $this->_get_status($casting);
        }

        return $results;
    }


    function get_castings_especific($ids)
    {
    	$this->db->select('id, title, logo, image, end_date, status');
        
        foreach ($ids as $id_casting) {
            $this->db->where('id', $id_casting);
        }
            
        
        $results = $query->result_array();

        return $results;
    }


    function date_diff($start, $end="NOW")
    {
        $ts1 = strtotime($start);
        $ts2 = strtotime($end);

        $seconds_diff = $ts2 - $ts1;

        return floor($seconds_diff/3600/24);
    }

    private function _get_hunter_logo($hunter_id)
    {
        $this->db->select('logo');
        $this->db->from('entities');
        $this->db->where('id', $hunter_id);
        $query = $this->db->get();
        $query = $query->first_row('array');
        return $query['logo'];
    }

    function _get_status($casting)
    {
        if($casting['days'] == 0)
            return 'En Revisión';
        else
        {
            switch($casting['status'])
            {
                case '0':
                    $casting['status'] = 'Activo';
                    break;
                case '1':
                    $casting['status'] = 'En Revisión';
                    break;
                case '2':
                    $casting['status'] = 'Finalizado';
                    break;
            }
        }
        return $casting['status'];
    }
}