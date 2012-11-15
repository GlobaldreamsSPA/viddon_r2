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
		//Primero borrar todas las habilidades linkeadas del usuario anteriormente existentes
		$this->db->delete('users_skills', array('user_id' => $profile['id']));


		if($profile['skills1'] != 0)
		{
			$data = array(
					'user_id' => $profile['id'],
					'skill_id' => $profile['skills1']
				);

			//Verificar que el par no exista en la BD
			$this->db->select('user_id, skill_id');
			$this->db->from('users_skills');
			$this->db->where('user_id', $data['user_id']);
			$this->db->where('skill_id', $data['skill_id']);

			$result = $this->db->get();

			if($result->num_rows() == 0)
				$this->db->insert('users_skills',$data);
		}

		if($profile['skills2'] != 0)
		{
			$data = array(
					'user_id' => $profile['id'],
					'skill_id' => $profile['skills2']
				);

			//Verificar que el par no exista en la BD
			$this->db->select('user_id, skill_id');
			$this->db->from('users_skills');
			$this->db->where('user_id', $data['user_id']);
			$this->db->where('skill_id', $data['skill_id']);

			$result = $this->db->get();

			if($result->num_rows() == 0)
				$this->db->insert('users_skills',$data);
		}

		if($profile['skills3'] != 0)
		{
			$data = array(
					'user_id' => $profile['id'],
					'skill_id' => $profile['skills3']
				);

			//Verificar que el par no exista en la BD
			$this->db->select('user_id, skill_id');
			$this->db->from('users_skills');
			$this->db->where('user_id', $data['user_id']);
			$this->db->where('skill_id', $data['skill_id']);

			$result = $this->db->get();

			if($result->num_rows() == 0)
				$this->db->insert('users_skills',$data);
		}

	}
}