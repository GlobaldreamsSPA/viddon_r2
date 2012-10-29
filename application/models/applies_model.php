<?php

class Applies_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
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

	function apply($user_id, $casting_id)
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
		$videos_result = $this->db->get('videos')->first_row('array');

		//Ahora crear el videos_applies
		$videos_applies = array(
				'apply_id' => $apply_result['id'],
				'video_id' => $videos_result['id']
			);

		$this->db->insert('videos_applies', $videos_applies);

		return 1;

	}
}