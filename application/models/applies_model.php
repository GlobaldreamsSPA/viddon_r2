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
    	$this->db->select('id,casting_id,state');
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
	
	function get_castings_applies($casting_id,$page,$state,$cant=5)
	{
		$this->db->select('user_id,id,state');
    	$this->db->where('casting_id', $casting_id);
		
	    if($state!=3)
    		$this->db->where('state', $state);
    	if(!is_null($page))
    		$query = $this->db->get('applies', $cant, ($page-1)*$cant);
		else
		   	$query = $this->db->get('applies');
		
		if($query->num_rows == 0)
			return 0;
		else
			return $query->result_array();
		
	}
	
	function get_filtered_user_applies_by($filtered_ids,$casting_id,$sex=NULL, $eyes_color=NULL, $hair_color=NULL, $build=NULL, $skin_color=NULL, $height_range=NULL, $age_range=NULL,$page=NULL,$cant=5){
		$this->db->select("A.user_id,A.id,A.state");
		$this->db->from('applies AS A');
		$this->db->join('users AS U', 'A.user_id = U.id', 'INNER');
    	$this->db->where('A.casting_id', $casting_id);
		/*
		 * WHERE casting_id=2 
		 * AND (sex=0 OR sex=1)  
		 * AND (color_eye=1 OR color_eye=2 ...) 
		 * AND (color_hair=1 OR color_hair=2 ...) 
		 * AND (build=0
		 * AND (skin_color=2
		 * AND (height_range>
		 * AND (age_range=;
		 * AND (A.user_id=278 OR A.user_id=245)
		*/
		$physical_where = "";
		$first = TRUE;
		
		//SERSO
		if(!is_null($sex) && $sex!=-2) //genera la condicion where ( sex = N or sex = P) y la adjunta a string
		{
			$flag = FALSE;
			if(!$first) $physical_where = $physical_where." AND ("; //espacio y AND
			else 
			{
				$physical_where = $physical_where."("; //espacio y AND
				$first = FALSE;
			}
			
			foreach ($sex as $sexi) 
			{
				if($flag)
					$physical_where=$physical_where." OR ";
				$physical_where = $physical_where." sex=".$sexi;
				$flag =TRUE;
			}
			$physical_where=$physical_where.")";//cierra paréntesis de sexo
		}
		
		//COLOR DE OJOS
		if(!is_null($eyes_color) && $eyes_color!=-2){
			
			$flag = FALSE;
			if(!$first) $physical_where = $physical_where." AND ("; //espacio y AND
			else 
			{
				$physical_where = $physical_where."("; //espacio y AND
				$first = FALSE;
			}
			
			
			foreach ($eyes_color as $ojo) 
			{
				if($flag)
					$physical_where=$physical_where." OR ";
				$physical_where = $physical_where." color_eye=".$ojo;
				$flag =TRUE;
			}
			$physical_where=$physical_where.")";//cierra paréntesis de sexo
		}
		
		//COLOR DE PELO
		if(!is_null($hair_color)&& $hair_color!=-2){
			$flag = FALSE;
			
			if(!$first) $physical_where = $physical_where." AND ("; //espacio y AND
			else 
			{
				$physical_where = $physical_where."("; //espacio y AND
				$first = FALSE;
			}
			
			foreach ($hair_color as $pelo) 
			{
				if($flag)
					$physical_where=$physical_where." OR ";
				$physical_where = $physical_where." color_hair=".$pelo;
				$flag =TRUE;
			}
			$physical_where=$physical_where.")";//cierra paréntesis de sexo
		}
		
		//CONTEXTURA
		if(!is_null($build)&& $build!=-2){
			$flag = FALSE;
			
			if(!$first) $physical_where = $physical_where." AND ("; //espacio y AND
			else 
			{
				$physical_where = $physical_where."("; //espacio y AND
				$first = FALSE;
			}
			
			foreach ($build as $cuerpo) 
			{
				if($flag)
					$physical_where=$physical_where." OR ";
				$physical_where = $physical_where." build=".$cuerpo;
				$flag =TRUE;
			}
			$physical_where=$physical_where.")";//cierra paréntesis de sexo
		}
		
		//COLOR DE PIEL
		if(!is_null($skin_color)&& $skin_color!=-2){
			$flag = FALSE;
			
			if(!$first) $physical_where = $physical_where." AND ("; //espacio y AND
			else 
			{
				$physical_where = $physical_where."("; //espacio y AND
				$first = FALSE;
			}
			
			foreach ($skin_color as $piel) 
			{
				if($flag)
					$physical_where=$physical_where." OR ";
				$physical_where = $physical_where." color_skin=".$piel;
				$flag =TRUE;
			}
			$physical_where=$physical_where.")";//cierra paréntesis de sexo
		}
		 
		 $height_list = array(0=>"150",1=>"150-160",2=>"170-180",3=>"180-190",4=>"190-200",5=>"200");
		 $age_list= array(0=>"10",1=>"10-15",2=>"15-20",3=>"20-25",4=>"25-30",5=>"30-35",6=>"35-40",7=>"40");	

		
		
		//ALTURA
		if(!is_null($height_range)&& $height_range!=-2){
			$rango_variable = array();
			$flag = FALSE;
			
			if(!$first) $physical_where = $physical_where." AND ("; //espacio y AND
			else 
			{
				$physical_where = $physical_where."("; //espacio y AND
				$first = FALSE;
			}
			
			foreach ($height_range as $altura) 
			{
				if($flag)
					$physical_where=$physical_where." OR ";
				switch($altura)//dependiendo de la clave seleccionada
				{
					case 0://si es la primera
						$rango_variable=array(0=>0,1=>$height_list[$altura]);//hace que sea desde 0 a el valor inicial
						break;
					case (sizeof($height_list)-1)://si es la ultima
						$rango_variable=array(0=>$height_list[$altura],1=>300);//hace que sea desde el valor maximo a 200
						break;
					default://si es de los internos lo separa tal cual
						$rango_variable=explode("-", $height_list[$altura]);
						break;
				}
				$physical_where = $physical_where." height BETWEEN ".$rango_variable[0]." AND ".$rango_variable[1];
				$flag =TRUE;
			}
			$physical_where=$physical_where.")";//cierra paréntesis de sexo	
		}
		
		//EDAD
		if(!is_null($age_range)&& $age_range!=-2){
			$rango_variable = array();
			$flag = FALSE;
			
			if(!$first) $physical_where = $physical_where." AND ("; //espacio y AND
			else 
			{
				$physical_where = $physical_where."("; //espacio y AND
				$first = FALSE;
			}
			
			foreach ($age_range as $edad) 
			{
				if($flag)
					$physical_where=$physical_where." OR ";
				switch($edad)//dependiendo de la clave seleccionada
				{
					case 0://si es la primera
						$rango_variable=array(0=>0,1=>$age_list[$edad]);//hace que sea desde 0 a el valor inicial
						break;
					case (sizeof($age_list)-1)://si es la ultima
						$rango_variable=array(0=>$age_list[$edad],1=>200);//hace que sea desde el valor maximo a 200
						break;
					default://si es de los internos lo separa tal cual
						$rango_variable=explode("-", $age_list[$edad]);
						break;
				}
				$physical_where = $physical_where." FLOOR(DATEDIFF(CURDATE(),STR_TO_DATE(U.birth_date,'%Y-%m-%d'))/365) BETWEEN ".$rango_variable[0]." AND ".$rango_variable[1];
				$flag =TRUE;
			}
			$physical_where=$physical_where.")";//cierra paréntesis de sexo
		}

		//agrego el where para cada id de usuario
		$flag = FALSE;
		$users_where = "(";
		foreach ($filtered_ids as $user_id) 
		{
			if($flag)
				$users_where=$users_where." OR ";
			$users_where = $users_where." A.user_id	= ".$user_id;
			$flag =TRUE;
		}
		$users_where=$users_where.")";
		
		if($first) $final_where = $users_where;
		else $final_where = $physical_where." AND ".$users_where;
		

		$this->db->where($final_where,NULL,FALSE);//se agrega a la consulta		

		if(!is_null($page)){
			$this->db->limit($cant,($page-1)*$cant);
		}
		
		$query = $this->db->get();
		if($query->num_rows == 0)
			return 0;
		else
			return $query->result_array();
	}
	
	function get_filtered_user_applies_by_word($filtered_ids,$casting_id,$words=NULL,$page=NULL,$cant=5){
		$this->db->select('A.user_id,A.id,A.state');
		$this->db->from('applies AS A');
		$this->db->join('users AS U', 'A.user_id = U.id', 'INNER');
    	$this->db->where('A.casting_id', $casting_id);
		/*
		 * WHERE casting_id=2 
		 *(name LIKE '%carlos%') OR (name LIKE '%patricio%');
		 */
		$where = "";
		$first = TRUE;
		//WHERE DE NOMBRES O PALABRAS
		if(!is_null($words) && $words!="_n")
		{
			$flag = FALSE;
			if(!$first) $where = $where." AND ("; //espacio y AND
			else 
			{
				$where = $where."("; // abre parentesis
				$first = FALSE;
			}
			
			foreach ($words as $palabra) 
			{
				if($flag)
					$where=$where." OR ";
				$where = $where." name LIKE '%".$palabra."%'";
				$flag =TRUE;
			}
			$where=$where.")";//cierra paréntesis de palabra
		}
		//agrego el where para cada id de usuario
		$flag = FALSE;
		$users_where = "(";
		foreach ($filtered_ids as $user_id) 
		{
			if($flag)
				$users_where=$users_where." OR ";
			$users_where = $users_where." A.user_id	= ".$user_id;
			$flag =TRUE;
		}
		$users_where=$users_where.")";
		
		if($first) $final_where = $users_where;
		else $final_where = $where." AND ".$users_where;
		
		$this->db->where($final_where,NULL,FALSE);//se agrega a la consulta
		
		

		if(!is_null($page)){
			$this->db->limit($cant,($page-1)*$cant);
		}
		
		$query = $this->db->get();
		if($query->num_rows == 0)
			return 0;
		else
			return $query->result_array();
	}
	
	
	function get_short_user_applies($casting_id,$state=NULL) //para sacar la información utilizada en casting_details
	{
		$this->db->select('user_id');
    	$this->db->where('casting_id', $casting_id);
		
    	if(is_null($state))
    	{
    		$this->db->where('state',0); //evita aceptados y rechazados
    		$query = $this->db->get('applies',5);		
    	}
   		else
   		{
   			$this->db->where('state',$state);
   			$query = $this->db->get('applies',5);
   		}
		   	
		if($query->num_rows == 0)
			return 0;
		else
			return $query->result_array();
		
	}
	
	
	function count_casting_applies($casting_id,$state)
 	{
 		$this->db->select('id');
 	   	$this->db->where('casting_id', $casting_id);
 		
 		if($state != 3)
 	   		$this->db->where('state', $state);
 	 	
 	 	$query = $this->db->get('applies');
 	 	
 	 	return $query->num_rows;
	}
	
	/**
	 * @desc Verifica el estado de cada "apply" de un respectivo casting y retorna "true" si cada "apply" tiene estado distinto de 0.
	 * Retorna -1 si no recibe parametros
	 * */
	function verify_castings_applies_status($parametro)//se verifica si le paso el ID o un array de applies
	{
		if(is_array($parametro))
		{
			//es array, lo analizadirectamente
			$todos = $parametro;		
		}
		else
		{
			//Saca los applies del id_casting(parametro) recibido
			$todos = $this->get_castings_applies($parametro);	
		}
		
		//los revisa y si algun(status) es 0 retorna FALSO
		foreach ($todos as $apply) 
		{
			if($apply['state'] == 0)
			{
				return FALSE;
			}
		}
		//si no se salio => todos los "state" son distintos de 0
		return true;		
	}
	
	function get_castings_applies_selected($casting_id)
	{
		$this->db->select('user_id,observation');
    	$this->db->where('casting_id', $casting_id);
		$this->db->where('state', 1);	
		$query = $this->db->get('applies');
		
		if($query->num_rows == 0)
			return 0;
		else
			return $query->result_array();
		
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
					'observation' => '',
					'user_id' => $user_id,
					'casting_id' => $casting_id
				);

			$this->db->insert('applies', $apply);

			//Obtener el max id de apply
			$this->db->select_max('id');
			$apply_result = $this->db->get('applies')->first_row('array');

			
			$this->db->select('id_main_video');
			$this->db->where('id', $user_id);
			$main_id_result = $this->db->get('users')->first_row('array'); //obtiene id_main_video
			if(!is_null($main_id_result['id_main_video']))//si no es null
			{
				$videos_result = array("id" => $main_id_result['id_main_video']);
			}
			else
			{
				//sino buscar el id del primer video del usuario
				$this->db->select_min('id');
				$this->db->where('user_id', $user_id);
				$videos_result = $this->db->get('videos')->first_row('array');
					
			}
			
			//Ahora crear el videos_applies
			$videos_applies = array(
					'apply_id' => $apply_result['id'],
					'video_id' => $videos_result['id']
				);

			$this->db->insert('videos_applies', $videos_applies);

			return $apply_result['id'];
		}
		else
			return FALSE;
	}

	function delete($apply_id)
    {
    	$this->db->delete('videos_applies', array('apply_id' => $apply_id));		
    	$this->db->delete('applies', array('id' => $apply_id));
    }
	
	function set_accepted($apply_id,$observation)
	{
		$data = array(
               'state' => 1,
               'observation' => $observation
            );

		$this->db->where('id', $apply_id);
		$this->db->update('applies', $data); 
	}

	function set_rejected($apply_id)
	{
		$data = array(
               'state' =>2,
               'observation' => NULL			   
            );

		$this->db->where('id', $apply_id);
		$this->db->update('applies', $data); 
	}

}