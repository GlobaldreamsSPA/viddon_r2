<?php

class Skills_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function get_skills()
	{
		$this->db->select('id, name');
		$query = $this->db->get('skills');

		$result = array();

		foreach ($query->result_array() as $item)
		{
			$result[$item['id']] = $item['name'];
		}

		return $result;
	}

	function get_user_skills($id)
	{
		$this->db->select('skills.name');
		$this->db->from('skills');
		$this->db->join('users_skills', 'users_skills.skill_id = skills.id');
		$this->db->join('users', 'users.id = users_skills.user_id');
		$this->db->where('users.id', $id);
		$query = $this->db->get();

		$result = array();

		foreach ($query->result_array() as $item)
		{
			$result[] = $item['name'];
		}

		return $result; 
	}

	function link_skills($profile)
	{
		if($profile['skills1'] != 0)
		{
			$data = array(
					'user_id' => $profile['id'],
					'skill_id' => $profile['skills1']
				);

			$this->db->insert('users_skills',$data);
		}

		if($profile['skills2'] != 0)
		{
			$data = array(
					'user_id' => $profile['id'],
					'skill_id' => $profile['skills2']
				);

			$this->db->insert('users_skills',$data);
		}

		if($profile['skills3'] != 0)
		{
			$data = array(
					'user_id' => $profile['id'],
					'skill_id' => $profile['skills3']
				);

			$this->db->insert('users_skills',$data);
		}

	}
}