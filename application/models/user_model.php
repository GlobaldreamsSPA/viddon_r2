<?php

class User_model extends CI_Model
{
    function __construct() 
    {
        parent::__construct();
    }

	function insert($data)
	{
		$this->db->insert('users',$data);
		
		$this->db->select('id');
		$this->db->select_max('id');
		$query = $this->db->get('users')->first_row('array');
		
		//Ahora guardar la imagen y hacer un resize
		return $query['id'];
	}
}