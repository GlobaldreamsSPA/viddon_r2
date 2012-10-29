<?php

class Videos_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
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
}