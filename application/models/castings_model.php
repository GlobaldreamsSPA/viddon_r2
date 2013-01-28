<?php

class Castings_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function get_castings($hunter_id)
    {
    	$this->db->select('image');
    }
}