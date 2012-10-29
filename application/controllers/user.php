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
		$args = array();
		$args['username']="pedrito";
		$args['name']= "PEDRO PEDRITO PEDREZ";
		$args['image_profile'] = "14.jpeg";
		$args['tags']= array("Hip-Hop","Metal","Animacion");
		$args["bio"]="Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nullam id dolor id nibh ultricies vehicula.
					Maecenas sed diam eget risus varius blandit sit amet non magna. Donec id elit non mi porta gravida at eget metus. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.";
		$args["hobbie"]="Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nullam id dolor id nibh ultricies vehicula.
					Maecenas sed diam eget risus varius blandit sit amet non magna. Donec id elit non mi porta gravida at eget metus. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.";
		$args["dream"]="Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nullam id dolor id nibh ultricies vehicula.
					Maecenas sed diam eget risus varius blandit sit amet non magna. Donec id elit non mi porta gravida at eget metus. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.";
		
		
		
		
		$args["video_title"]="Super Titulo";
		$args["video_description"]="Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nullam id dolor id nibh ultricies vehicula.
					Maecenas sed diam eget risus varius blandit sit amet non magna. Donec id elit non mi porta gravida at eget metus. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.";		
		#$args["video_ID"]="oHg5SJYRHA0";
	
		$args["content"]="user_profile";
		$this->load->view('template',$args);

		//El usuario hace click en postular al concurso

		if($this->input->post())
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
		if($this->input->post())
		{
			//Guardar los datos de usuario
			$data['name'] = $this->input->post('name');
			$data['bio'] = $this->input->post('bio');
			$data['hobbies'] = $this->input->post('hobbies');
			$data['dreams'] = $this->input->post('dreams');
			$data['image_profile'] = "hola.jpg";
			
			//ingresar los datos a la base de datos y obtener el id de usuario
			$id = $this->user_model->insert($data);

			var_dump($this->_upload_image($id));
		}

		//Talentos del usuario
		$skills = $this->skills_model->get_skills();
		
		//Edad del usuario
		$age = array();

		for($i=1; $i<=100; $i++)
		{
			$age[$i] = $i;
		}

		$args = array(
			'skills' => $skills,
			'age' => $age
			);

		//Cargar el formulario
		$args['content']="new";
		//Cargar el formulario
		$this->load->view('template', $args);
	}

	private function _upload_image($id)
	{
		$images_path = realpath(APPPATH.UPLOAD_DIR);
		
		//obtener la extension del archivo
		$type = explode('/', $_FILES['image']['type']);
		
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
		
		if(!$this->upload->do_upload('image'))
		{
			return $this->upload->display_errors();
		}
		
		//ahora ajustar la imagen
		$image = $this->upload->data();

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
}

