<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library(array('upload', 'image_lib'));
		$this->load->helper(array('url', 'file', 'form'));
		
		//Modelitos xD
		$this->load->model('user_model');
		$this->load->model('applies_model');
		$this->load->model('videos_model');
		$this->load->model('skills_model');
		$this->load->model('castings_model');
		
	}

	public function index($id = NULL)
	{
		$args = array();
		$public = FALSE;

		if($this->session->userdata('id') === FALSE || ($id != NULL && $id != $this->session->userdata('id')))
			$public = TRUE;
		else
		{
			$id = $this->session->userdata('id');
			$public = FALSE;
		}

		$args = $this->user_model->select($id);
		$args['public'] = $public;
		$args["tags"] = $this->skills_model->get_user_skills($id);
		$args["user"] = $this->user_model->welcome_name($id);
		
		if(isset($_POST["url_ytb"]))
		{
			$query_string = array();
			
			//Insertar estos datos
			parse_str(parse_url($_POST["url_ytb"], PHP_URL_QUERY), $query_string);

			$video_to_save = array(
				'title' => $_POST["name_ytb"],
				'link' => $query_string["v"],
				'type' => 'youtube',
				'description' => $_POST["description_ytb"],
				'user_id' => $id
				);

			$this->videos_model->insert($video_to_save);
			if(isset($_POST["from_gallery"]) && ($_POST['from_gallery'] == 'yes')) redirect(HOME.'/user/video_gallery/');
		}
		
		//Si el usuario tiene un video, setear los elementos siguientes, si no, no.
		if($this->videos_model->verify_videos($id) != 0)
		{
			$id_main_vid = $this->user_model->get_main_video_id($id);
			if(!is_null($id_main_vid) && ($video = $this->videos_model->get_main_video($id_main_vid)))
			{
				//$video = $this->videos_model->get_main_video($id_main_vid); //saca el video principal
				$args['video_ID']=$video["link"];
				$args["video_title"] = $video["title"];
				$args["video_description"] = $video["description"];
			}else
			{
				$video = $this->videos_model->get_video($id); //saca el primer video registrado
				$args['video_ID']=$video["video_id"];
				$args["video_title"] = $video["video_title"];
				$args["video_description"] = $video["video_description"];
			}
			
			
			$JSON = file_get_contents("https://gdata.youtube.com/feeds/api/videos/{$args['video_ID']}?v=2&alt=json");
			$JSON_Data = json_decode($JSON);
			$JSON_Data_entry = $JSON_Data->{'entry'};
			
			$args["views"] = "0";
			$args["dislikes"] = "0";
			$args["likes"] = "0";
		}
		else//si no tiene videos, seteo lo que se necesite
		{
				
		}
		$args["content"]="applicants/applicants_template";
		$inner_args["applicant_content"]="applicants/user_profile";
		$args["inner_args"]=$inner_args;
		//El usuario hace click en postular al concurso

		if($this->videos_model->verify_videos($id) != 1)
		{
			$args["postulation_flag"]=false;
			$args["postulation_message"]="Necesitas Tener Videos para poder postular";
		}
		else {
			$args["postulation_flag"]=true;
		}

		//El usuario hace click en borrar video

		if($this->input->post("del-video"))
		{
			//Primero rescatar el id del usuario de la sesion
			$user_id = $this->session->userdata('id');
			$youtube_video_id = $this->input->post("del-video");
			$video_id = $this->videos_model->get_video_id($youtube_video_id);

			$del_video = TRUE;
			
			//Ahora verificar que el video pertenezca al usuario
			if(!$this->videos_model->verify_user_video($youtube_video_id, $user_id))
			{
				$args["delete_video_message"] = "El Video que intentas borrar no te pertenece. Intenta nuevamente desde tu Perfil";
				$del_video = FALSE;
			}

			//Ahora verificar que el usuario no haya postulado al concurso con ese video
			if($this->applies_model->verify_video_apply($video_id, $user_id) === FALSE)
			{
				$args["delete_video_message"] = "Ya haz postulado a un casting activo con este video. No puedes borrarlo";
				$del_video = FALSE;
			}

			//Si success flag sigue verdadero, se procede a borrar el video
			if($del_video === TRUE)
			{
				$this->videos_model->delete($video_id);
				$args["delete_video_message"] = "Tu video ha sido borrado exitosamente";
			}

		}

		$args["user_id"] = $this->session->userdata('id');
		$this->load->view('template',$args);
	}

	public function video_gallery($ope=NULL,$id_video_objetivo=NULL)
	{
		$args = array();
		$public = FALSE;
		$id_user = NULL;
		
		if($this->session->userdata('id') === FALSE || ($id_user != NULL && $id_user != $this->session->userdata('id')))
			$public = TRUE;
		else
		{
			$id = $this->session->userdata('id');
			$public = FALSE;
		}

		$args = $this->user_model->select($id);
		$args['public'] = $public;
		$args["tags"] = $this->skills_model->get_user_skills($id);
		$args["user"] = $this->user_model->welcome_name($id);
		
		if($this->videos_model->verify_videos($id) != 1)
		{
			$args["postulation_flag"]=false;
			$args["postulation_message"]="Necesitas Tener Videos para poder postular";
		}
		else {
			$args["postulation_flag"]=true;
		}
		
		//AHORA OBTENGO LOS ELEMENTOS NECESARIOS PARA LA GALERIA
		$args['videos'] = $this->videos_model->get_videos_by_user($this->session->userdata('id'));
		$args['id_main_video'] =$this->user_model->get_main_video_id($this->session->userdata('id'));
		
		$args["content"]="applicants/applicants_template";
		$inner_args["applicant_content"]="applicants/video_gallery";
		$args["inner_args"]=$inner_args;
		
		$args["user_id"] = $this->session->userdata('id');
		
		if(!is_null($ope))
		{
			switch($ope){
				case 1://HACER MAIN
					if(!is_null($id_video_objetivo) && !is_null($args["user_id"]) && is_numeric($id_video_objetivo))
					{
						$this->user_model->set_main_video($args["user_id"],$id_video_objetivo);
						redirect(HOME."/user/video_gallery");			
					}
					break;
				case 2://ELIMINAR
					if(!is_null($id_video_objetivo) && !is_null($args["user_id"]) && is_numeric($id_video_objetivo))
					{
						if($args['id_main_video'] == $id_video_objetivo)
							$this->user_model->set_main_video($args["user_id"]);
						$this->videos_model->delete($id_video_objetivo);	
						redirect(HOME."/user/video_gallery");		
					}
					break;
			} 
		}
		
		
		$this->load->view('template',$args);
	}
	
	public function login()
	{
		require_once OPENID;
		$openid = new LightOpenID(HOME);
		
		if ($openid->mode) {
		    if ($openid->mode == 'cancel')
		    {
		    	//Esto es cuando el usuario cancela la autorizacion de login con google
		        redirect(HOME);
		    }

		    elseif($openid->validate())
		    {
		     	//Ya que el usuario se encuentra logeado, se almacenan los datos en la BD.

		        $data = $openid->getAttributes();

				$user_openid = array();
				$user_email = $data['contact/email'];

				if(isset($data['namePerson']))
					$user_name = $data['namePerson'];
				else
					$user_name = "";

				parse_str(parse_url($openid->identity, PHP_URL_QUERY), $user_openid);

				$result = $this->user_model->verify_openid($user_openid['id']);
				
				//Verificar que existe el usuario
				if($result['exists'] == 1)
				{
					//Si el usuario existe se guardan datos en la sesion y se redirige al index del usuario
					$new_session_data = array(
						'id' => $result['id'],
						'email' => $user_email,
						'name' => $user_name,
						'type' => 1
						);

					$this->session->set_userdata($new_session_data);
					redirect(HOME.'/user/index');
				}
				else
				{
					//Si el usuario no existe, crea el usuario, guarda el openid y retorna el id.
					$id_user = $this->user_model->create($user_openid['id'], $data);

					//Guardar ID del usuario en ls session
					$new_session_data = array(
						'id' => $id_user,
						'email' => $user_email,
						'name' => $user_name,
						'type' => 1
						);

					$this->session->set_userdata($new_session_data);
					redirect(HOME.'/user/edit/');
				}

		    }
		    else
		    {
		    	//Esto es cuando el usuario cancela la autorizacion de login con google
		    	redirect(HOME);
		    }
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect(HOME);
	}
	
	public function edit($user_id=null)
	{
		$this->load->library('form_validation');

		if($this->session->userdata('id') === FALSE)
			redirect(HOME);
		else
		{
			//Setear mensajes
			$this->form_validation->set_message('required', 
				'Ups! Todavia te falta este dato. Es muy importante para definirte como ganador(a) del concurso :)');

			//Setear reglas
			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('bio', 'Bio', 'required');
			$this->form_validation->set_rules('hobbies', 'Hobbies', 'required');
			$this->form_validation->set_rules('dreams', 'Dreams', 'required');
			if(!(isset($user_id) && !(is_numeric($user_id))))
				$this->form_validation->set_rules('image', 'Image', 'callback_check_upload');

			if ($this->form_validation->run() == FALSE)
			{
				//No paso todas las validaciones
			}
			
			else
			{
				//Guardar los datos de usuario
				$profile['id'] = $this->session->userdata('id');
				$profile['name'] = $this->input->post('name');
				$profile['bio'] = $this->input->post('bio');
				$profile['hobbies'] = $this->input->post('hobbies');
				$profile['dreams'] = $this->input->post('dreams');
				$profile['skills']  = $this->input->post('skills');
				$profile['sex'] = intval($this->input->post('sex'));
				$profile['age'] = $this->input->post('age');
				$profile['height'] = intval($this->input->post('height'));
				$profile['color_skin'] = $this->input->post('skin-color');
				$profile['color_eye'] = intval($this->input->post('eyes-color'));
				$profile['color_hair'] = $this->input->post('hair-color');
				$profile['build'] = $this->input->post('build');
				
				//ingresar los datos a la base de datos
				$this->user_model->update($profile);
				
				//Ahora linkear las habilidades del usuario
				$this->skills_model->link_skills($profile);

				//Por ultimo subir la foto
				if($this->check_upload('') == TRUE)
					$this->_upload_image($profile['id']);

				if($this->check_upload('') == TRUE && (isset($user_id) && is_numeric($user_id)))
					$this->_upload_image($profile['id']);


				//redirect(HOME.'/user');
			}

			//Talentos del usuario
			
			$skills = $this->skills_model->get_skills();
			
			//Edad del usuario
			$age = array();

			for($i=100; $i>=1; $i--)
			{
				$age[$i] = $i;
			}
			
			for($i=250; $i>=50; $i--)
			{
				$height[$i] = $i;
			}


			$skin= array(0=>"Blanca",1=>"Morena", 2 =>"Negra");
			$eyes= array(0=>"Verde",1=>"Azul", 2 =>"Gris",3=>"Casta&ntilde;o",4=>"Ambar",5=>"Pardos");
			$hair= array(0=>"Casta&ntilde;o",1=>"Negro", 2 =>"Rubio",3=>"Blanco",4=>"Gris",5=>"Colorin",6=>"Otros");
			
			$args = array(
				'skills' => $skills,
				'age' => $age,
				'height' => $height,
				'eyes' => $eyes,
				'skin' => $skin,
				'hair' => $hair
				);
				
			$args["content"]="applicants/applicants_template";
			$inner_args["applicant_content"]="applicants/new";
			$args["inner_args"]=$inner_args;

			$args["postulation_flag"] = false;
			$args["postulation_message"] = "Necesitas Tener Videos para poder postular";


			if(isset($user_id) && is_numeric($user_id))
			{
				$id = $this->session->userdata('id');
				$temp= array();
				$args = array_merge ( $args, $temp);
		
				if($this->videos_model->verify_videos($id) == 1)
					$args["postulation_flag"]=true;
				
				$args["user_id"] = $this->session->userdata('id');
						
				$args["update_values"]=$this->user_model->select($user_id);
				$args["update_user_skills"]= $this->skills_model->get_user_skills_id($user_id);

			}
			

			//Cargar el formulario(sino se ve desde área publica)
			$args['public'] = FALSE;
			$this->load->view('template', $args);
		}
	}

	private function _upload_image($id)
	{
		$images_path = realpath(APPPATH.UPLOAD_DIR);
		
		//obtener la extension del archivo
		$type = explode('/', $_FILES['image_profile']['type']);
		
		$filename = $id. '.' .$type[1];
		
		$config = array(
			'allowed_types' => 'jpg|jpeg|gif|png',
			'upload_path' => $images_path,
			'file_name' => $filename,
			'overwrite' => TRUE,
			'max_size' => 2048,
			'remove_spaces' =>TRUE
		);
		
		//actualizar la imagen del usuario en la bd
		$this->db->where('id', $id);
		$this->db->set('image_profile',$filename);
		$this->db->update('users');
		
		$this->upload->initialize($config);
		
		if(!$this->upload->do_upload('image_profile'))
		{
			print_r($this->upload->display_errors());
		}
		
		//ahora ajustar la imagen
		$image = $this->upload->data('image_profile');

		$config = array(
			'image_library' => 'gd2',
			'source_image' => $image['full_path'],
			'new_image' => realpath(APPPATH.IMAGES_DIR),
			'maintain_ratio' => TRUE,
			'width' => '230',
			'height' => '230'
		);
		
		$this->image_lib->initialize($config);
		$this->image_lib->resize();
	}

	function active_casting_list($id = NULL)
	{
		$id = $this->session->userdata('id');
		$public = FALSE;
		
		$args = $this->user_model->select($id);
		$args["content"]="applicants/applicants_template";
		$inner_args["applicant_content"]="applicants/active_casting_list";
		$args["inner_args"]=$inner_args;
		$args['public'] = $public;
			
		if($this->input->post("del-apply"))
		{
			$this->applies_model->delete($this->input->post("del-apply"));
		}
		
		$castings_id = $this->applies_model->get_applicant_applies($id);
		
		$apply_id_dictionary= array();
		
		

		if($castings_id != 0)
		{
			foreach ($castings_id as $temp) {
				$apply_id_dictionary[$temp['casting_id']]=$temp["id"];
			}
			$args['castings'] = $this->castings_model->get_castings_especific($castings_id,array("0"));
			
			$args["tags"]=	$this->skills_model->get_skills();

			foreach($args['castings'] as &$casting)
			{
			
				if(isset($casting["skills"]))
				{
					$tags_id= explode('-', $casting["skills"]);
					unset($tags_id[count($tags_id)-1]);
					$tags_id_temp=array();
					foreach ($tags_id as $tag) {
						array_push($tags_id_temp, $args["tags"][$tag]);
					}
					$casting["tags"]=$tags_id_temp;
				}
				$casting["apply_id"]=$apply_id_dictionary[$casting["id"]];
			}			
		}
		


		
		if($this->videos_model->verify_videos($id) != 1)
		{
			$args["postulation_flag"]=false;
			$args["postulation_message"]="Necesitas Tener Videos para poder postular";
		}
		else {
			$args["postulation_flag"]=true;
		}
		
		$args["user_id"] = $this->session->userdata('id');
		
		

		$this->load->view('template', $args);
		
	}

	function results_casting($id = NULL)
	{
		$id = $this->session->userdata('id');
		$public = FALSE;

		$args = $this->user_model->select($id);
		$args["content"]="applicants/applicants_template";
		$inner_args["applicant_content"]="applicants/results_casting_list";
		$args["inner_args"]=$inner_args;
		$args['public'] = $public;
		
		$castings_id = $this->applies_model->get_applicant_applies($id);
		
		$apply_status_dictionary=array("0"=>"Pendiente","1"=>"Aceptado","2"=>"Rechazado");
		
		$apply_id_dictionary= array();
			
		

		if($castings_id != 0)
		{
			foreach ($castings_id as $temp) {
				$apply_id_dictionary[$temp['casting_id']]=$apply_status_dictionary[$temp["state"]];
			}
			$args['castings'] = $this->castings_model->get_castings_especific($castings_id,array("1","2"));
						
			foreach($args['castings'] as &$casting)
			{						
				$casting["apply_status"]=$apply_id_dictionary[$casting["id"]];
			}			
		}
		
		
		
		if($this->videos_model->verify_videos($id) != 1)
		{
			$args["postulation_flag"]=false;
			$args["postulation_message"]="Necesitas Tener Videos para poder postular";
		}
		else {
			$args["postulation_flag"]=true;
		}
		
		$args["user_id"] = $this->session->userdata('id');
		
		

		$this->load->view('template', $args);
		
	}

	function check_upload($image)
	{
		if($_FILES['image_profile']['error'] == 4)
		{
			$this->form_validation->set_message('check_upload', 'Ups, deber subir un archivo antes de continuar.');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
}
