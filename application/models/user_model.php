<?php

class User_model extends CI_Model
{
    function __construct() 
    {
        parent::__construct();
    }

	function insert($profile)
	{

		$data = array(
				'name' => $profile['name'],
				'bio' => $profile['bio'],
				'dreams' => $profile['dreams'],
				'hobbies' => $profile['hobbies'],
				'sex' => $profile['sex'],
				'age' => $profile['age']
			);

		$this->db->insert('users', $data);
		$this->db->select('id');
		$this->db->select_max('id');
		$query = $this->db->get('users')->first_row('array');
		return $query['id'];
	}

	function select($id)
	{
		$profile = array();

		//Rescatar los datos de la tabla usuario
		$this->db->select('name, image_profile, bio, hobbies, dreams');
		$this->db->from('users');
		$this->db->where('id', $id);
		$query = $this->db->get()->first_row('array');

		return $query;
	}
}