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

    function insert_image($casting_id, $filename)
    {
        $data = array('image' => $filename);
        $this->db->where('id', $casting_id);
        $this->db->update('castings', $data);
    }

    function get_all_castings()
    {
        
    }

    function get_castings($hunter_id)
    {
    	$this->db->select('id, title, logo, image, end_date, status');
        $this->db->from('castings');
        $this->db->where('entity_id', $hunter_id);
        $query = $this->db->get();
        $results = $query->result_array();

        foreach($results as &$casting)
        {
            //Almacenar los dias que quedan
            $end_date = date_create($casting['end_date']);
            $today = new DateTime(date('Y-m-d'));
            $interval = date_diff($today, $end_date);
            $casting['days'] = $interval->format('%d');

            //Entregar las rutas de las imagenes
            $casting['logo'] = HOME.HUNTER_PROFILE_IMAGE.$casting['logo'];
            $casting['image'] = HOME.CASTINGS_PATH.$casting['image'];
        }

        return $results;
    }
}