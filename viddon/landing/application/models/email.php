<?php

class Email extends CI_Model
{
    function __construct() 
    {
        parent::__construct();
    }

    function insert_profile($profile)
    {
    	$data = $this->db->insert('email',$profile);
    	return $data;
    }

    function is_unique($email)
    {
    	$query = $this->db->get_where('email', array('email' => $email));

    	$result = $query->result_array();

    	if(empty($result) == TRUE)
    	{
    		return TRUE;
    	}

    	if(strcmp($result[0]['email'], $email) == 0)
    		return FALSE;
    	else
    		return TRUE;
    }
}
