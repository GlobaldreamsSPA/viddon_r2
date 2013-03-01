<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hunter extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url', 'file', 'form'));
		$this->load->model(array('hunter_model', 'castings_model', 'casting_categories_model', 'user_model', 'applies_model', 'videos_model','skills_model'));
		$this->load->library(array('upload', 'image_lib', 'form_validation'));
		
	}
	
	function index()
	{
		if($this->session->userdata('logged_in'))
		{
			
			$hunter_id = $this->session->userdata('logged_in');
		 	$hunter_id= $hunter_id['id'];
			
			$args["castings_dash"]= $this->_dashboard($hunter_id);
	
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
					$flag = FALSE;
					foreach ($this->input->post('skills') as $skill) {
						if($flag)
							$casting['skills']=$casting['skills']."-";//le pego el guion
						$casting['skills'] = $casting['skills'].$skill;
						$flag =TRUE;
					}
					//var_dump($casting['skills']);
					
					
					$casting['category'] = $this->input->post('category');
					//convierto la "categoria a su id correspondiente"
					$casting['category'] = $this->casting_categories_model->get_id_by_name($casting['category']);
					//var_dump($casting['category']);
					
					
					$casting['eyes-color'] = $this->input->post('eyes-color');
					$casting['hair-color'] = $this->input->post('hair-color');
					$casting['skin-color'] = $this->input->post('skin-color');
					$casting['height'] = $this->input->post('height');
					$casting['age'] = $this->input->post('age');
					$casting['sex'] = $this->input->post('optionsRadios');
					$casting['entity_id'] = $hunter_id;

					$casting_id = $this->castings_model->insert($casting);

					//Por ultimo subir la foto
					$form_file_name = 'logo';
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
	
	function casting_list($page=1,$casting_state=0)
	{
		if($this->session->userdata('logged_in'))
		{
			$hunter_id = $this->session->userdata('logged_in');
		 	$hunter_id = $hunter_id['id'];
			
			
			$args["casting_state"] = $casting_state;
			$args["chunks"]=ceil($this->castings_model->count_castings($hunter_id,$casting_state)/5);						
			$args["castings"]= $this->castings_model->get_castings($hunter_id, 5, $page, $casting_state);
			
			$args["status"]=array(0=>"Activo",1=>"Revisi&oacute;n",2=>"Finalizado",3=>"Todos");
			$args["page"]=$page;
			
			$args["casting_state"]=$casting_state;
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
	
	function edit_casting($id=NULL)
	{
		if($this->session->userdata('logged_in'))
		{
			$hunter_id = $this->session->userdata('logged_in');
		 	$hunter_id= $hunter_id['id'];
	   	 	$args['user_data'] = $this->session->userdata('logged_in');
			$args["skills"]= $this->skills_model->get_skills();		
			
			$args['categories'] = $this->casting_categories_model->get_casting_categories();
			$args["content"]="castings/hunter_template";
			$inner_args["hunter_content"]= "castings/edit_hunter_casting";
			$args["inner_args"]= $inner_args;
			
			//$args["update_values"]=$this->castings_model->select($id);
			$args['update_values'] = $this->castings_model->get_full_casting($id);
			$args['actual_category'] = $this->casting_categories_model->get_name($args['update_values']['category']);
			$args['actual_skills'] = explode("-",$args['update_values']['skills']);
						
			
			//--------------------------------------->
			//Setear mensajes
			$this->form_validation->set_message('required', 
				'Te falta este dato, es importante para tus postulantes');

			//Setear reglas
			$this->form_validation->set_rules('title', 'Title', 'required');
			$this->form_validation->set_rules('description', 'Description', 'required');
			$this->form_validation->set_rules('requirements', 'Requirements', 'required');
			$this->form_validation->set_rules('image', 'Image', 'callback_check_upload');

			//$this->form_validation->set_rules('logo', 'Logo', 'callback_check_upload');
			
			 
			 /*
			if(!(isset($hunter_id) && !(is_numeric($hunter_id))))
			
			$this->form_validation->set_rules('logo', 'Logo', 'callback_check_upload');
			 */

			//_____________________________________________________________________________________________ 
			if ($this->form_validation->run())
			{
			
				if($this->input->post())
				{
					var_dump($_POST);
					//Guardar los datos a la BD
					$casting['id'] = $id;
					$casting['title'] = $this->input->post('title');
					$casting['start_date'] = $this->input->post('start-date');
					$casting['end_date'] = $this->input->post('end-date');
					$casting['description'] = $this->input->post('description');
					$casting['requirements'] = $this->input->post('requirements');
					
					$casting['skills'] = "";
					$flag = FALSE;
					foreach ($this->input->post('skills') as $skill) {
						if($flag)
							$casting['skills']=$casting['skills']."-";//le pego el guion
						$casting['skills'] = $casting['skills'].$skill;
						$flag =TRUE;
					}
					
					
					$casting['category'] = $this->input->post('category');
					//convierto la "categoria a su id correspondiente"
					$casting['category'] = $this->casting_categories_model->get_id_by_name($casting['category']);
					$casting['eyes-color'] = $this->input->post('eyes-color');
					$casting['hair-color'] = $this->input->post('hair-color');
					$casting['skin-color'] = $this->input->post('skin-color');
					$casting['height'] = $this->input->post('height');
					$casting['age'] = $this->input->post('age');
					$casting['sex'] = $this->input->post('optionsRadios');
					$casting['entity_id'] = $hunter_id;


					//var_dump($casting);
					//UPDATE
					$this->castings_model->update($casting);

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
					
					$filename = $this->_upload_image($id, $images, $form_file_name);

					$this->castings_model->insert_image($id, $filename);
					//redirect(HOME.'/hunter/edit_casting/'.$id);
					redirect(HOME.'/hunter/casting_detail/'.$id);
				}			 
			 
			
			}
			
			//------------------------------>
			$this->load->view('template', $args);	
		}
		else
			redirect(HOME);
	}

	function applicants_list($id=NULL,$page=1,$applies_state=0,$filter_categories=NULL)
	{
		if($this->session->userdata('logged_in') && isset($id))
		{
		
			$args["id_casting"]=$id;
	   	 	$args['user_data'] = $this->session->userdata('logged_in');

			$args["content"]="castings/hunter_template";
			$inner_args["hunter_content"]="castings/applicants_list";
			$args["inner_args"]=$inner_args;
			$args["skills"]= $this->skills_model->get_skills();

			$temp[0]= "Limpiar";
 	 		$temp[-1]= "Todos";
 	 		$args["skills"] = $temp + $args["skills"];

			$temp = $this->castings_model->get_full_casting($id);
			$args["name_casting"]= $temp["title"];
			
			
			
			$args["status"]=array(0=>"Sin Revisar",1=>"Aceptados",2=>"Rechazados",3=>"Todos");
			
			if(!is_null($filter_categories))
			{
				$args["filter_categories_url"] = $filter_categories;			
				$args["filter_categories"] = explode("_",$filter_categories);//PARAMETROS FILTRO URL
				$id_applicants= $this->applies_model->get_castings_applies($id,null,$applies_state);
				
				if($id_applicants !=0)				
				{
					$args["chunks"]=ceil($this->skills_model->count_filter_user_categories($id_applicants,$args["filter_categories"])/5);	
					$id_applicants=$this->skills_model->filter_user_categories($id_applicants,$args["filter_categories"],$page);
				}
				else
					$args["chunks"]=0;
					
			}
			else
			{
				$args["filter_categories_url"] = NULL;
				$args["filter_categories"] = NULL;
				$id_applicants= $this->applies_model->get_castings_applies($id,$page,$applies_state);
				$args["chunks"]=ceil($this->applies_model->count_casting_applies($id,$applies_state)/5);					
			}

			$args["page"]=$page;
			$args["applies_state"]=$applies_state;
			
			if($id_applicants!= 0)
			{
				//define si se puede finalizar el casting o no(toma el array anterior como parametro)
				
				$args["allowed_to_finalize"] = $this->applies_model->verify_castings_applies_status($id_applicants);
				
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
			$temp = $this->castings_model->get_full_casting($id);
			$args["name_casting"]= $temp["title"];
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
			
			
			$args["update_values"]=$this->hunter_model->select($hunter_id);
			
			
			
			//--------------------------------------->
			//Setear mensajes
			$this->form_validation->set_message('required', 
				'Te falta este dato, es importante para tus postulantes');

			//Setear reglas
			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required');
			$this->form_validation->set_rules('address', 'Address', 'required');
			$this->form_validation->set_rules('about_us', 'About_us', 'required');
			$this->form_validation->set_rules('we_look_for', 'We_look_for', 'required');
			//$this->form_validation->set_rules('logo', 'Logo', 'callback_check_upload');
			
			 
			 /*
			if(!(isset($hunter_id) && !(is_numeric($hunter_id))))
			
			$this->form_validation->set_rules('logo', 'Logo', 'callback_check_upload');
			 */

			if ($this->form_validation->run() == FALSE)
			{
				//No paso todas las validaciones
			}
			
			else
			{
				//Guardar los datos de hunter
				$profile['id'] = $hunter_id;
				$profile['name'] = $this->input->post('name');
				$profile['email'] = $this->input->post('email');
				$profile['address'] = $this->input->post('address');
				$profile['about_us'] = $this->input->post('about_us');
				$profile['we_look_for']  = $this->input->post('we_look_for');
				//$profile['logo']  = $this->input->post('logo');

				//print_r($profile);
				//ingresar los datos a la base de datos
				$this->hunter_model->update($profile);

				//Por ultimo subir la foto
				if($this->check_upload('') == TRUE)
					$this->_upload_image_hunter($profile['id'],$profile['logo']);

				if($this->check_upload('') == TRUE && (isset($hunter_id) && is_numeric($hunter_id)))
					$this->_upload_image_hunter($profile['id'],$profile['logo']);


				redirect(HOME.'/hunter/edit');
			}
			
			//------------------------------>
			$this->load->view('template', $args);	
		}
		else
			redirect(HOME);
	}

	function check_upload($image)
	{
		if($_FILES['logo']['error'] == 4)
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
	
	private function _upload_image_hunter($id)
	{
		$images_path = realpath(APPPATH.UPLOAD_DIR);
		//$images_path = realpath(APPPATH.HUNTER_PROFILE_IMAGE);
		
		//obtener la extension del archivo
		$type = explode('/', $_FILES['logo']['type']);
		
		$filename = "hunter_".$id. '.' .$type[1];
		
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
		$this->db->set('logo',$filename);
		$this->db->update('entities');
		
		$this->upload->initialize($config);
		
		if(!$this->upload->do_upload('logo'))
		{
			print_r($this->upload->display_errors());
		}
		
		//ahora ajustar la imagen
		$image = $this->upload->data('logo');

		$config = array(
			'image_library' => 'gd2',
			'source_image' => $image['full_path'],
			'new_image' => realpath(APPPATH.HUNTER_UPLOAD_IMAGE),
			'maintain_ratio' => TRUE,
			'width' => '230',
			'height' => '230'
		);
		
		$this->image_lib->initialize($config);
		$this->image_lib->resize();
	}

	private function _dashboard($hunter_id)
	{
	   	
		 	$castings = $this->castings_model->get_castings($hunter_id,4,1,0);	   	 			
			$numberc_review = 8 - count($castings);
						
			if($numberc_review == 4 && count($this->castings_model->get_castings($hunter_id,$numberc_review,1,1)) < 4)
			{
				$numberc_active = 8 - count($this->castings_model->get_castings($hunter_id,$numberc_review,1,1));
				$castings = $this->castings_model->get_castings($hunter_id,$numberc_active,1,0);	   	 
			}
			
		
			
			$castings = array_merge($castings,$this->castings_model->get_castings($hunter_id,$numberc_review,1,1));
			
			
			
	   	 	foreach ($castings as &$casting) {
	   	 		$casting['applies'] = $this->applies_model->get_applies_cant($casting['id']);
				
				if($casting["applies"] <= $casting["max_applies"])
					$casting['target_applies'] = round($casting["applies"]/$casting["max_applies"],2) * 100;
				else 
					$casting['target_applies'] = 100;
								
				if($casting['applies'] != 0)
					$casting['reviewed'] = round(($casting['applies'] - $this->applies_model->count_casting_applies($casting['id'],0))/$casting['applies'],2)*100;
				else 
					$casting['reviewed']= 0;				
				
				$casting['target_applies_color'] = $this->_color_bar($casting['target_applies']);
				$casting['reviewed_color'] = $this->_color_bar($casting['reviewed']);
				
				
	   	 	}	   
 		return $castings;
	}	

	private function _color_bar($percent)
	{
		
		$return = "";
		switch (TRUE) {
			case (in_array($percent, range(0,20))):
				
				$return= "bar-danger";
				break;
			
			case (in_array($percent, range(21,80))):
				
				$return= "bar-warning";
				break;
				
			case (in_array($percent, range(81,100))):
				
				$return= "bar-success";
				break;
			default:
				
				break;
		}
		return $return;
	}

}