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
}