<?php

class Videos_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function insert($data)
    {
    	//Primero verificar que el video no exista
    	$this->db->select('id');
    	$this->db->from('videos');
    	$this->db->where('link', $data['link']);

    	$result = $this->db->get();

    	if($result->num_rows() == 0)
			$this->db->insert('videos', $data);
		else
		{
			$video = $result->first_row('array');
			$data['id'] = $video['id'];

			$this->db->where('id', $data['id']);
			$this->db->update('videos', $data);
		}
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
		$result["video_id"]=$query['link'];
		$result["video_title"] = $query['title'];
		$result["video_description"] = $query['description'];

		return $result;
	}

	function get_videos($page, $cant)
	{
		$query = $this->db->get('videos', $cant, ($page-1)*$cant);

		$result = array();

		foreach ($query->result_array() as $value) 
		{
			$result[] = array($value['title'], $value['link']);
		}

		return $result;
	}

	function count()
	{
		return $this->db->count_all_results('videos');
	}

	function get_all_videos()
	{
		$query = $this->db->get('videos');
		$result["video_id"]=$query['video_id'];
		$result["video_title"] = $query['title'];
		$result["video_description"] = $query['description'];

		return $result;
	}
}