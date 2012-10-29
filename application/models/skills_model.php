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