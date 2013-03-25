<?php

class User_model extends CI_Model
{
    function __construct() 
    {
        parent::__construct();
    }

	function get_main_video_id($id_user)
	{
		$this->db->select('id_main_video');
		$this->db->where('id', $id_user);
		$query = $this->db->get('users')->first_row('array');
		return $query['id_main_video'];
	}
		
		
	function has_main_video($id_user)
	{
		if($this->get_main_video_id($id_user) == NULL)
		{
			return false;
		}else return true;
	}
	
	function set_main_video($id_user,$id_video_nuevo=NULL)
	{
			$data = array(
				'id_main_video' => $id_video_nuevo
			);

		$this->db->where('id', $id_user);
		$this->db->update('users', $data);
	}

	
	function get_image_profile($user_id)
	{
		$this->db->select('image_profile');
		$this->db->where('id', $user_id);
		$query = $this->db->get('users')->first_row('array');
		return $query['image_profile'];
	}
	
	function update($profile)
	{
		$data = array(
				'name' => $profile['name'],
				'email' => $profile['email'],
				'last_name' => $profile['last_name'],
				'bio' => $profile['bio']
			);

		$this->db->where('id', $profile['id']);
		$this->db->update('users', $data);
	}

	function select($id)
	{
		//Rescatar los datos de la tabla usuario
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('id', $id);
		$query = $this->db->get()->first_row('array');

		return $query;
	}

	function select_applicant($id)
	{
		//Rescatar los datos de la tabla usuario
		$this->db->select('id, name, email, image_profile, bio');
		$this->db->from('users');
		$this->db->where('id', $id);
		$query = $this->db->get()->first_row('array');

		return $query;
	}

	function verifyfb_id($id_fb)
	{
		$this->db->select('id_fb, id');
		$this->db->from('users');
		$this->db->where('id_fb', $id_fb);
		$query = $this->db->get();
		
		if($query->num_rows == 0)
			return 0;

		else
			return $query->result_array();
		

		
	}

	function insert($fb_data)
	{
		$data = array(
			'id_fb' => $fb_data['id'],
			'name' => $fb_data['first_name'],
			'last_name' => $fb_data['last_name'],
			'email' => $fb_data['email'],
			'sex' => $fb_data['gender'],
			'facebook_profile_url' => $fb_data['link'],
			'birth_date' => $fb_data['birthday'],
			'location_language' => $fb_data['locale']
			);

		if(isset($fb_data['religion']))
       		$data["religion"]=$fb_data['religion']; 
   		
   		if(isset($fb_data['political']))
        	$data["political"]=$fb_data['political']; 

    	if(isset($fb_data['bio']))
        	$data["bio"] = $fb_data['bio']; 

	    if(isset($fb_data['hometown']))
	     	$data["hometown"] = $fb_data['hometown']['name']; 

	    if(isset($fb_data['location']))
	      	$data["location"] = $fb_data['location']['name']; 

	    if(isset($fb_data['relationship_status']))
        	$data["relationship_status"] = $fb_data['relationship_status']; 

	
		$this->db->insert('users', $data);

		return $this->db->insert_id();
	}

	function update_profile_image($id_photo,$id_user)
	{
		$data = array(
				'image_profile' => $id_photo
		);

		$this->db->where('id', $id_user);
		$this->db->update('users', $data);
	}

	
	function welcome_name($id_user)
	{
		$result = $this->select($id_user);

		if($result["name"] != NULL)
			return $result["name"];
		if($result["email"] != NULL)
			return $result["email"];
		
		return 'Usuario';
	}
}