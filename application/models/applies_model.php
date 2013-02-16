<?php

class Applies_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function get_applies_cant($casting_id)
    {
    	$this->db->where('casting_id', $casting_id);
    	$this->db->from('applies');
    	return $this->db->count_all_results();
    }
	
	function get_applicant_applies($applicant_id)
    {
    	$this->db->select('casting_id');
    	$this->db->where('user_id', $applicant_id);
    	$query= $this->db->get('applies');
    	
		if($query->num_rows == 0)
			return 0;
		else
			return $query->result_array();
		
    }

    function verify_apply($user_id, $casting_id)
	{
		$this->db->where('user_id', $user_id);
		$this->db->where('casting_id', $casting_id);
		$query = $this->db->get('applies');

		//Si el usuario no ha postulado retorna 1
		if($query->num_rows == 0)
			return 0;
		else
			return 1;
	}

	function verify_video_apply($video_id, $user_id)
	{
		$this->db->select('castings.*');
		$this->db->from('castings');
		$this->db->join('applies', 'applies.casting_id = castings.id');
		$this->db->join('videos_applies', 'videos_applies.apply_id = applies.id');
		$this->db->where('videos_applies.video_id', $video_id);
		$this->db->where('applies.user_id', $user_id);
		$this->db->group_by('castings.id');
		$query = $this->db->get();

		//Verificar que este video no este ingresado en una postulacion activa
		foreach($query->result_array() as $casting) {
			if($casting['active'] == 1)
			{
				return FALSE;
			}
		}
		return TRUE;
	}

	function apply($user_id, $casting_id)
	{
		//Verificar que el usuario no postule dos veces
		$this->db->select('id');
		$this->db->from('applies');
		$this->db->where('user_id', $user_id);
		$this->db->where('casting_id', $casting_id);
		$query = $this->db->get();

		if($query->num_rows() == 0)
		{
			//Crear postulacion (apply)
			$apply = array(
					'description' => '',
					'user_id' => $user_id,
					'casting_id' => $casting_id
				);

			$this->db->insert('applies', $apply);

			//Obtener el max id de apply
			$this->db->select_max('id');
			$apply_result = $this->db->get('applies')->first_row('array');

			//Ahora buscar el id del primer video del usuario
			$this->db->select_min('id');
			$this->db->where('user_id', $user_id);
			$videos_result = $this->db->get('videos')->first_row('array');

			//Ahora crear el videos_applies
			$videos_applies = array(
					'apply_id' => $apply_result['id'],
					'video_id' => $videos_result['id']
				);

			$this->db->insert('videos_applies', $videos_applies);

			return TRUE;
		}
		else
			return FALSE;
	}
}