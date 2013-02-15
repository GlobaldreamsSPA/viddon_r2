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

    function _routes($casting)
    {
        $casting['logo'] = HOME.HUNTER_PROFILE_IMAGE.$casting['logo'];
        $casting['image'] = HOME.CASTINGS_PATH.$casting['image'];
        
        return $casting;
    }

    function _days($casting)
    {
        $end_date = date_create($casting['end_date']);
        $today = new DateTime(date('Y-m-d'));
        $interval = $this->date_diff($today->format('Y-m-d'), $end_date->format('Y-m-d'));
        $casting['days'] = $interval;
        log_message('info','End_date:'.$end_date->format('Y-m-d').' today:'.$today->format('Y-m-d').' Days:'.$casting['days']);
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
        $casting = $this->_routes($casting);

        //Buscar datos del hunter: department
        $this->db->select('department');
        $this->db->from('entities');
        $this->db->where('id', $casting['entity_id']);
        $result = $this->db->get();
        $hunter = $result->first_row('array');
        $casting['department'] = $hunter['department'];
        return $casting;
    }

    function get_castings($hunter_id=NULL, $cant=NULL, $page=NULL, $all=NULL)
    {
    	$this->db->select('id, title, logo, image, end_date, status');
        
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
            $casting = $this->_routes($casting);
        }

        return $results;
    }

    function date_diff($start, $end="NOW")
    {
        $ts1 = strtotime($start);
        $ts2 = strtotime($end);

        $seconds_diff = $ts2 - $ts1;

        return floor($seconds_diff/3600/24);
    }
}