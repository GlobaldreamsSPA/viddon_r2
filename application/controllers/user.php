<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library(array('upload', 'image_lib', 'form_validation'));
		$this->load->helper(array('url', 'file', 'form'));
		
		//Modelitos xD
		$this->load->model('user_model');
		$this->load->model('applies_model');
		$this->load->model('videos_model');
		$this->load->model('skills_model');
	}

	public function index()
	{
		$id = '1';

		$args = $this->user_model->select($id);
		$args['tags'] = $this->skills_model->get_user_skills($id);
		$video = $this->videos_model->get_video($id);
		
		$args['video_ID']=$video["video_id"];
		$args["video_title"] = $video["video_title"];
		$args["video_description"] = $video["video_description"];
		
		if(isset($_POST["id_cw"]) && $_POST["id_cw"]!="0" )
		{
			$args["video_ID"]=$_POST["id_cw"];
		}
		elseif(isset($_POST["url_ytb"]) && $_POST["id_cw"]!="")
		{
			$query_string = array();
			
			parse_str(parse_url($_POST["url_ytb"], PHP_URL_QUERY), $query_string);

			$args["video_ID"]=$query_string["v"];
		}
		
		#$args["video_ID"]="oHg5SJYRHA0";
	
		$args["content"]="user_profile";
		$this->load->view('template',$args);

		//El usuario hace click en postular al concurso

		if($this->input->post("validate"))
		{
			//Obtener el Id del usuario a traves de la sesion
			$user_id = 1;

			//Obtener el id del casting/concurso
			$casting_id = 1;

			//Verificar que el usuario tenga un video grabado
			if($this->videos_model->verify_videos($user_id) == 1)
			{
				//Verificar que el usuario no haya postulado dos veces
				if($this->applies_model->verify_apply($user_id, $casting_id) == 1)
					echo "El usuario ya ha postulado antes";
				else
				{
					//Hacer que el usuario postule con el primer video que posee
					$result = $this->applies_model->apply($user_id, $casting_id);

					if($result == 1)
					{
						echo "Postulacion exitosa";
					}
				}
			}
			else
			{
				echo "El usuario no posee videos";
			}
		}
	}
	
	public function edit()
	{

		//Setear mensajes
		$this->form_validation->set_message('required', 
				'Ups! Todavia te falta este dato. Es muy importante para definirte como ganador(a) del concurso :)');

		//Setear reglas
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('bio', 'Bio', 'required');
		$this->form_validation->set_rules('hobbies', 'Hobbies', 'required');
		$this->form_validation->set_rules('dreams', 'Dreams', 'required');
		$this->form_validation->set_rules('image', 'Image', 'callback_check_upload');

		if ($this->form_validation->run() == FALSE)
		{
			//No paso todas las validaciones
		}
		else
		{
			//Guardar los datos de usuario
			$profile['name'] = $this->input->post('name');
			$profile['bio'] = $this->input->post('bio');
			$profile['hobbies'] = $this->input->post('hobbies');
			$profile['dreams'] = $this->input->post('dreams');
			$profile['skills1'] = $this->input->post('skills1');
			$profile['skills2'] = $this->input->post('skills2');
			$profile['skills3'] = $this->input->post('skills3');
			$profile['sex'] = $this->input->post('sex');
			$profile['age'] = $this->input->post('age');
			
			//ingresar los datos a la base de datos y obtener el id de usuario
			//$id = $this->user_model->insert($profile);

			$profile['id'] = '13';
			//Ahora linkear las habilidades del usuario
			//$this->skills_model->link_skills($profile);

			//Por ultimo subir la foto
			$this->_upload_image(13);

			echo "Datos ingresados exitosamente";
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

		//Cargar el formulario
		$this->load->view('template', $args);
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