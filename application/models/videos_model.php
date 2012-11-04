<?php

class Videos_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function insert($data)
    {
    	$this->db->insert('videos', $data);
    }


    //Verifica que el usuario tenga al menos un video
    function verify_videos($user_id)
	{
		$this->db->select('id');
		$this->db->where('user_id', $user_id);
		$query = $this->db->get('videos');

		//Retorna 0 si no tiene videos
		if($query->num_rows == 0)
			return 0;
		else
			return 1;
	}

	//Retorna los datos del primer video que pertenece al usuario
	function get_video($id_user)
	{
		$this->db->where('user_id', $id_user);
		$query = $this->db->get('videos')->first_row('array');
		$result["video_id"]=$query['video_id'];
		$result["video_title"] = $query['title'];
		$result["video_description"] = $query['description'];

		return $result;
	}
}