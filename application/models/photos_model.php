<?php

class Photos_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function insert($photo)
    {
      $this->db->insert('photos',$photo);
      return $this->db->insert_id();
    }
	function delete($photo_id)
    {
    	$this->db->delete('photos', array('id' => $photo_id));
		
    }

	
	function update($photo)
    {
    	//var_dump("$casting");
    	$data = array(
				'name' => $photo['name'],
				'description' => $photo['description']
			);

		$this->db->where('id', $photo['id']);
		$this->db->update('photos', $data);
    }

    function get_photos($user_id=NULL)
    {
    	$this->db->select('*');
		if(!is_null($user_id))
			$this->db->where('user_id', $user_id);
		$query = $this->db->get('photos');
		
        $results = $query->result_array();
        return $results;
    }
	
	function get_name($id)
	{
		$this->db->select('name');
		$this->db->from('photos');
		$this->db->where('id',$id);
		$query = $this->db->get()->first_row('array');
		return $query['name'];
    	
	}
    
}