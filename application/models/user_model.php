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

		$this->db->select_max('id');
		$query = $this->db->get('users')->first_row('array');
		return $query['id'];
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
	
	function set_profile_pic($id_user,$name_photo_nueva=NULL)//$name_photo_nueva sale de la galeria de fotos
	{
		$img_galeria = LOCAL_GALLERY.$name_photo_nueva;
		file_put_contents(LOCAL_USER_PROFILE_IMAGE.$name_photo_nueva, file_get_contents($img_galeria));//MUEVE LA IMAGEN A PROFILE
		
		$data = array
				(
				'image_profile' => $name_photo_nueva
				);
	
		$this->db->where('id', $id_user);
		$this->db->update('users', $data);
		
/*
	$data = array(
		'image_profile' => $id_video_nuevo
	);

$this->db->where('id', $id_user);
$this->db->update('users', $data);
	 
*/
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
				'bio' => $profile['bio'],
				'dreams' => $profile['dreams'],
				'hobbies' => $profile['hobbies'],
				'sex' => $profile['sex'],
				'age' => $profile['age'],
				'height' => $profile['height'],
				'color_skin' => $profile['color_skin'] ,
				'color_eye' => $profile['color_eye'] ,
				'color_hair' => $profile['color_hair'],
				'build'=> $profile['build'] 
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

	function verify_openid($openid)
	{
		$this->db->select('google_login_token, id');
		$this->db->from('users');
		$this->db->where('google_login_token', $openid);
		$query = $this->db->get();
		
		$data = array();

		if($query->num_rows == 0)
		{
			$data['exists'] = 0;
		}
		else
		{
			$user = $query->result_array();
			$user = $user['0'];
			
			$data['exists'] = 1;
			$data['id'] = $user['id'];
		}

		return $data;
	}

	function create($openid, $google_data)
	{
		$data = array(
			'google_login_token' => $openid,
			'email' => $google_data['contact/email']
			);

		$this->db->insert('users', $data);

		//Retornar el id del usuario
		$this->db->select_max('id');
		$query = $this->db->get('users')->first_row('array');
	
		return $query['id'];
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