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
}