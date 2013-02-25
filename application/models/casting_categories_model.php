<?php

class Casting_categories_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

	
    function get_casting_categories_cant()
    {
    	$this->db->from('castings_categories');
    	return $this->db->count_all_results();
    }
	
	/**
	 * Saca todo de las categorias
	 */
	function get_casting_categories()
    {
    	$this->db->select('id,name');
    	$query= $this->db->get('castings_categories');
    	
		$result = array();

		foreach ($query->result_array() as $item)
		{
			$result[$item['id']] = $item['name'];
		}
		return $result;
		
    }
}