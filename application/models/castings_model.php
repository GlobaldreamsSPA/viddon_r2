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
    }

    function get_castings($hunter_id)
    {
    	$this->db->select('image');
    }
}