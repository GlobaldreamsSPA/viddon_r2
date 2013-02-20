<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hunter extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url', 'file', 'form'));
		$this->load->model(array('hunter_model', 'castings_model', 'user_model', 'applies_model', 'videos_model','skills_model'));
		$this->load->library(array('upload', 'image_lib', 'form_validation'));
	}

	function index()
	{
		if($this->session->userdata('logged_in'))
		{
			$hunter_id = $this->session->userdata('logged_in');
		 	$hunter_id= $hunter_id['id'];
	   	 	$args['castings'] = $this->castings_model->get_castings($hunter_id);
	   	 	$args['user_data'] = $this->session->userdata('logged_in');
			$args["content"]="castings/hunter_template";
			$inner_args["hunter_content"]="castings/hunter_profile";
			$args["inner_args"]=$inner_args;
			$this->load->view('template',$args);
		}
		else
			redirect(HOME);
	}

	function verifylogin()
 	{
	   //This method will have the credentials validation
	   $this->load->library('form_validation');

	   $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');
	   $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');
	   $this->form_validation->set_message('required', 'El campo es obligatorio');

	   if($this->form_validation->run() == FALSE)
	   {
			$args["content"]="castings/hunter_template";
			$inner_args["hunter_content"]="castings/login_hunter";
			$args["inner_args"]=$inner_args;
			
			$this->load->view('template', $args);
	   }
	   else
	   {
		   redirect(HOME."/hunter");
	   }
    }

	function check_database($password)
	{
	   $email = $this->input->post('email');
	   $result = $this->hunter_model->login($email, $password);

	   if($result)
	   {
	   		$result['type'] = 'hunter';
	   		$this->session->set_userdata('logged_in', $result);
	   		return TRUE;
	   }
	   else
	   {
	     $this->form_validation->set_message('check_database', 'Email o contrase&ntildea inv&aacutelidos');
	     return FALSE;
	   }
	}

	function publish()
	{
		if($this->session->userdata('logged_in'))
		{
			$hunter_id = $this->session->userdata('logged_in');
		 	$hunter_id= $hunter_id['id'];
	   	 	$args['castings'] = $this->castings_model->get_castings($hunter_id);
	   	 	$args['user_data'] = $this->session->userdata('logged_in');
			$args["skills"]=	$skills = $this->skills_model->get_skills();
			
	   	 	//Setear mensajes
			$this->form_validation->set_message('required', 
				'Este dato es requerido para publicar el casting.');

			//Setear reglas
			$this->form_validation->set_rules('title', 'Title', 'required');
			$this->form_validation->set_rules('description', 'Description', 'required');
			$this->form_validation->set_rules('requirements', 'Requirements', 'required');
			$this->form_validation->set_rules('image', 'Image', 'callback_check_upload');

			if ($this->form_validation->run() == FALSE)
			{
				//No paso todas las validaciones
			}
			
			else
			{
				if($this->input->post())
				{
					//Guardar los datos a la BD
					$casting['title'] = $this->input->post('title');
					$casting['start_date'] = $this->input->post('start-date');
					$casting['end_date'] = $this->input->post('end-date');
					$casting['description'] = $this->input->post('description');
					$casting['requirements'] = $this->input->post('requirements');
					
					$casting['skills'] = "";
					
					foreach ($this->input->post('skills') as $skill) {
						$casting['skills'] = $casting['skills'].$skill."-";
					}
					$casting['category'] = $this->input->post('category');
					$casting['eyes-color'] = $this->input->post('eyes-color');
					$casting['hair-color'] = $this->input->post('hair-color');
					$casting['skin-color'] = $this->input->post('skin-color');
					$casting['height'] = $this->input->post('height');
					$casting['age'] = $this->input->post('age');
					$casting['sex'] = $this->input->post('optionsRadios');
					$casting['entity_id'] = $hunter_id;

					$casting_id = $this->castings_model->insert($casting);

					//Por ultimo subir la foto
					$form_file_name = 'casting_image';
					$images = array(
						array(
							'path' => realpath(APPPATH.'..'.CASTINGS_PATH),
							'width'=> 230,
							'height' => 230
						),
						array(
							'path' => realpath(APPPATH.'..'.CASTINGS_FULL_PATH),
							'width'=> 600,
							'height' => 300
						)
					);

					$filename = $this->_upload_image($casting_id, $images, $form_file_name);

					$this->castings_model->insert_image($casting_id, $filename);
					redirect('hunter/casting_list');
				}
			}

			$args["content"]="castings/hunter_template";
			$inner_args["hunter_content"]="castings/publish_view";
			$args["inner_args"]=$inner_args;
			
			$this->load->view('template', $args);

		}
		else
			redirect(HOME);
	}
	
	function casting_list()
	{
		if($this->session->userdata('logged_in'))
		{
			$hunter_id = $this->session->userdata('logged_in');
		 	$hunter_id = $hunter_id['id'];
	   	 	$args['castings'] = $this->castings_model->get_castings($hunter_id, NULL, NULL, NULL);
	   	 	
	   	 	//Rescatar las personas que postularon a cada uno de los castings
	   	 	foreach ($args['castings'] as &$casting) {
	   	 		$casting['applies'] = $this->applies_model->get_applies_cant($casting['id']);
	   	 	}

	   	 	$args['user_data'] = $this->session->userdata('logged_in');
			$args["content"]="castings/hunter_template";
			$inner_args["hunter_content"]="castings/list_view";
			$args["inner_args"]=$inner_args;
			
			$this->load->view('template', $args);
		}
		else
			redirect(HOME);
	}
	
	public function logout()
	{
		$this->session->sess_destroy();
		redirect(HOME);
	}

	function casting_detail($id=NULL)
	{
		
		
		
		if($this->session->userdata('logged_in') && isset($id))
		{
			$hunter_id = $this->session->userdata('logged_in');
		 	$hunter_id = $hunter_id['id'];
			$args["casting"] = $this->castings_model->get_full_casting($id);
			$args["casting"]["applies"] = $this->applies_model->get_applies_cant($id);
			
			if(isset($args["casting"]["skills"]))
			{
				$args["tags"]=	$this->skills_model->get_skills();			
				$tags_id= explode('-', $args["casting"]["skills"]);
				unset($tags_id[count($tags_id)-1]);
				$tags_id_temp=array();
				foreach ($tags_id as $tag) {
					array_push($tags_id_temp, $args["tags"][$tag]);
				}
				$args["tags"]=$tags_id_temp;
			}
			
			$args['user_data'] = $this->session->userdata('logged_in');
			$args["content"]="castings/hunter_template";
			$inner_args["hunter_content"]="castings/hunter_casting_detail";
			$args["inner_args"]=$inner_args;
			$this->load->view('template', $args);
		}
		else
			redirect(HOME);

	}
	
	function applicants_list($id=NULL)
	{
		if($this->session->userdata('logged_in') && isset($id))
		{
		
			$args["id_casting"]=$id;
	   	 	$args['user_data'] = $this->session->userdata('logged_in');
			$args["content"]="castings/hunter_template";
			$inner_args["hunter_content"]="castings/applicants_list";
			$args["inner_args"]=$inner_args;
			$args["skills"]= $this->skills_model->get_skills();
			
			$id_applicants= $this->applies_model->get_castings_applies($id);
						
			if($id_applicants!= 0)
			{
				$args["applicants"]=array();
				
				foreach($id_applicants as $id)
				{
					$applicant_info=$this->user_model->select_applicant($id['user_id']);
					$video_info= $this->videos_model->get_video_applicant($id['user_id']);
					$applicant_info["apply_id"]= $id["id"]; 
					$applicant_info["apply_state"]= $id["state"];
					$applicant_info['tags'] = $this->skills_model->get_user_skills($id['user_id']);
					$applicant_info['video_id'] =array_pop($video_info);
					array_push($args["applicants"],$applicant_info);
				}				
			}
			$this->load->view('template', $args);	
		}
		else
			redirect(HOME);

	}
	
	function accept_apply($apply_id,$casting_id)
	{
		if($this->session->userdata('logged_in'))
		{
			$this->applies_model->set_accepted($apply_id,$this->input->post('observation'));
			redirect(HOME."/hunter/applicants_list/".$casting_id);
		}
		else
			redirect(HOME);	
	}
	
	function reject_apply($apply_id,$casting_id)
	{
		if($this->session->userdata('logged_in'))
		{
			$this->applies_model->set_rejected($apply_id);
			redirect(HOME."/hunter/applicants_list/".$casting_id);
		}
		else
			redirect(HOME);	
	}
	
	function accepted_list($id)
	{
		if($this->session->userdata('logged_in')&& isset($id))
		{
			$args['user_data'] = $this->session->userdata('logged_in');
			$args["content"]="castings/hunter_template";
			$inner_args["hunter_content"]="castings/accepted_list";
			$args["inner_args"]=$inner_args;
			
			$id_applicants= $this->applies_model->get_castings_applies_selected($id);
			$args["id_casting"]= $id;
			$args["mailto_all"]="";
			if($id_applicants!= 0)
			{
				$args["applicants"]=array();
				
				foreach($id_applicants as $id)
				{
					$applicant_info=$this->user_model->select_applicant($id['user_id']);
					$applicant_info["observation"]=$id["observation"];
					array_push($args["applicants"],$applicant_info);
					$args["mailto_all"]=$args["mailto_all"].$applicant_info["email"].";";
				}				
			}
		
			$this->load->view('template', $args);	
		}
		else
			redirect(HOME);
	}

	function finalize_casting($id_casting)
	{
		if($this->session->userdata('logged_in'))
		{
			$this->castings_model->finalize_casting($id_casting);	
			redirect(HOME."/hunter/casting_list");
		}
		else
			redirect(HOME);
	}

	function edit()
	{
		if($this->session->userdata('logged_in'))
		{
			$hunter_id = $this->session->userdata('logged_in');
		 	$hunter_id= $hunter_id['id'];
	   	 	$args['castings'] = $this->castings_model->get_castings($hunter_id);
	   	 	$args['user_data'] = $this->session->userdata('logged_in');
			$args["content"]="castings/hunter_template";
			$inner_args["hunter_content"]="castings/hunter_edit";
			$args["inner_args"]=$inner_args;
			
			$this->load->view('template', $args);	
		}
		else
			redirect(HOME);
	}

	function check_upload($image)
	{
		if($_FILES['casting_image']['error'] == 4)
		{
			$this->form_validation->set_message('check_upload', 'Ups, deber subir un archivo antes de continuar.');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	private function _resize_image($images_path, $form_file_name, $width, $height)
	{
		$image = $this->upload->data($form_file_name);

		$config = array(
			'image_library' => 'gd2',
			'source_image' => $image['full_path'],
			'new_image' => $images_path,
			'maintain_ratio' => TRUE,
			'width' => $width,
			'height' => $height
		);
		
		$this->image_lib->initialize($config);
		$this->image_lib->resize();
	}

	private function _upload_image($id, $images, $form_file_name)
	{
		$upload_path = realpath(APPPATH.UPLOAD_DIR);
		
		//obtener la extension del archivo
		$type = explode('/', $_FILES[$form_file_name]['type']);
		
		$filename = $id. '.' .$type[1];
		
		$config = array(
			'allowed_types' => 'jpg|jpeg|gif|png',
			'upload_path' => $upload_path,
			'file_name' => $filename,
			'overwrite' => TRUE,
			'max_size' => 2048,
			'remove_spaces' =>TRUE
		);
		
		$this->upload->initialize($config);
		
		if(!$this->upload->do_upload($form_file_name))
		{
			print_r($this->upload->display_errors());
		}

		//ahora ajustar la imagen de lista
		foreach($images as $image)
		{
			$this->_resize_image($image['path'], $form_file_name, $image['width'], $image['height']);
		}
		
		unlink(realpath(APPPATH.UPLOAD_DIR.'/'.$filename));

		return $filename;
	}
}