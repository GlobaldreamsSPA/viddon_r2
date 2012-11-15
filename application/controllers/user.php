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
	}

	public function index()
	{
		
		if($this->session->userdata('id') === FALSE)
			redirect(HOME);
		else
			$id = $this->session->userdata('id');

		$casting_id = 1;
		
		$args = $this->user_model->select($id);
		$args["tags"] = $this->skills_model->get_user_skills($id);
		$args["user"] = $this->user_model->welcome_name($id);
		
		if(isset($_POST["id_cw"]) && $_POST["id_cw"]!="0" )
		{
			//Insertar estos datos
			$video_to_save = array(
				'title' => $_POST["name_cw"],
				'link' => $_POST["id_cw"],
				'type' => 'youtube',
				'description' => $_POST["description_cw"],
				'user_id' => $id
				);

			$this->videos_model->insert($video_to_save);
		}
		elseif(isset($_POST["url_ytb"]) && $_POST["id_cw"]!="")
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
		}
		
		//Si el usuario tiene un video, setear los elementos siguientes, si no, no.
		if($this->videos_model->verify_videos($id) != 0)
		{
			$video = $this->videos_model->get_video($id);

			$args['video_ID']=$video["video_id"];
			$args["video_title"] = $video["video_title"];
			$args["video_description"] = $video["video_description"];
			
			
			$JSON = file_get_contents("https://gdata.youtube.com/feeds/api/videos/{$video["video_id"]}?v=2&alt=json");
			$JSON_Data = json_decode($JSON);
			$JSON_Data_entry = $JSON_Data->{'entry'};
			
			
			if(!is_null($JSON_Data->{'entry'}) && array_key_exists('yt$statistics', $JSON_Data->{'entry'}))
			{
				$args["views"] = $JSON_Data->{'entry'}->{'yt$statistics'}->{'viewCount'};
				$args["dislikes"] = $JSON_Data->{'entry'}->{'yt$rating'}->{'numDislikes'};
				$args["likes"] = $JSON_Data->{'entry'}->{'yt$rating'}->{'numLikes'};
			}
			else
			{
				$args["views"] = "0";
				$args["dislikes"] = "0";
				$args["likes"] = "0";
			}
					
		}
	
		$args["content"]="user_profile";
		$args["success_flag"]=false;
		

		//El usuario hace click en postular al concurso

		if($this->input->post("validate"))
		{
			
			$result = $this->applies_model->apply($id, $casting_id);

			if($result == 1)
				$args["success_flag"]=true;
		}
		
		if($this->videos_model->verify_videos($id) == 1)
		{
			if($this->applies_model->verify_apply($id, $casting_id) == 1)
			{
				$args["postulation_flag"]=false;
				$args["postulation_message"]="Ya estas inscrito en el Concurso";
			}
			else
				$args["postulation_flag"]=true;
		}
		else 
		{
			$args["postulation_flag"]=false;
			$args["postulation_message"]="Necesitas Tener Videos para poder postular";
		}

		$args["user_id"]= $this->session->userdata('id');
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
						'name' => $user_name
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
						'name' => $user_name
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
				$profile['skills1'] = $this->input->post('skills1');
				$profile['skills2'] = $this->input->post('skills2');
				$profile['skills3'] = $this->input->post('skills3');
				$profile['sex'] = intval($this->input->post('sex'));
				$profile['age'] = $this->input->post('age');
				
				//ingresar los datos a la base de datos
				$this->user_model->update($profile);
				
				//Ahora linkear las habilidades del usuario
				$this->skills_model->link_skills($profile);

				//Por ultimo subir la foto
				if($this->check_upload('') == TRUE)
					$this->_upload_image($profile['id']);

				if($this->check_upload('') == TRUE && (isset($user_id) && is_numeric($user_id)))
					$this->_upload_image($profile['id']);


				redirect(HOME.'/user');
			}

			//Talentos del usuario
			
			$skills = $this->skills_model->get_skills();
			$skills['0'] = 'Ninguno';
			
			//Edad del usuario
			$age = array();

			for($i=100; $i>=1; $i--)
			{
				$age[$i] = $i;
			}

			$args = array(
				'content' => 'new',
				'skills' => $skills,
				'age' => $age
				);

			if(isset($user_id) && is_numeric($user_id))
			{
				$args["update_values"]=$this->user_model->select($user_id);
				$args["update_user_skills"]= $this->skills_model->get_user_skills_id($user_id);

			}
			

			//Cargar el formulario
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
