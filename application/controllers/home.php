<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url', 'form'));

		//Modelos
		$this->load->model(array('videos_model','contact_model','photos_model','user_model', 'hunter_model', 'castings_model','applies_model','skills_model','casting_categories_model','custom_options_model','custom_questions_model', 'custom_answers_model'));
	
	}

	public function index($page=1)
	{

		$args = array();
		
		$args["get_uri"] ="";
		
		if(isset($_GET['search_terms']))
		{
			$args["get_uri"] = "/?search_terms=".str_replace(' ', '+', $_GET['search_terms']);

			$video_list = $this->videos_model->search_videos($_GET['search_terms'], $page, 9);
			
			$args["chunks"]=ceil($this->videos_model->count_search_videos($_GET['search_terms']) / 9);
		}
		else
		{
			$video_list = $this->videos_model->get_videos($page, 9);
			$args["chunks"]=ceil($this->videos_model->count() / 9);


		}

		$args["video_list"] = array();
		
		foreach ($video_list as $video_data)
		{
			/*
			$JSON = file_get_contents("https://gdata.youtube.com/feeds/api/videos/{$video_data[1]}?v=2&alt=json");
			$JSON_Data = json_decode($JSON);
							
			if(array_key_exists('yt$statistics', $JSON_Data->{'entry'}))
			{
				$views = $JSON_Data->{'entry'}->{'yt$statistics'}->{'viewCount'};
				$dislikes = $JSON_Data->{'entry'}->{'yt$rating'}->{'numDislikes'};
				$likes = $JSON_Data->{'entry'}->{'yt$rating'}->{'numLikes'};
			}
			else
			{
				$views = "0";
				$dislikes = "0";
				$likes = "0";
			}
			array_push($video_data, $views, $dislikes,$likes);
			*/
			$user_data= $this->user_model->select($video_data["2"]);
			if($user_data['image_profile']!=0)
				$user_data['image_profile'] = $this->photos_model->get_name($user_data['image_profile']);

			array_push($video_data,$user_data["name"],$user_data["image_profile"], $user_data["last_name"]);
			array_push($args["video_list"], $video_data);
		}
    
		
		$args["tags"]=	$this->skills_model->get_skills();
		
		
		$args["page"]=$page;
		$args["castings"] = $this->castings_model->get_castings(NULL, 2, 1);
		
		
    
		$args["content"] = "home/home_view";
		$args["inner_args"] = NULL;
		$this->load->view('template',$args);
	}


	public function casting_list($page = 1,$actual_categories = -2)//el actual es un string de categorias
	{
		$args = array();
		
		$args["actual_categories_url"] = $actual_categories;

		if($actual_categories!=-2)
		{			
			$args["actual_categories"] = explode("_",$actual_categories);//PARAMETROS FILTRO URL
			$args["chunks"]=ceil($this->castings_model->count_castings(NULL,0,$args["actual_categories"])/9);						
			$args["casting_list"]= $this->castings_model->get_castings(NULL, 9, $page, 0, $args["actual_categories"]);
		}else
		{
			$args["chunks"]=ceil($this->castings_model->count_castings(NULL,0)/9);			
			$args["actual_categories"] = $actual_categories;			
				
			$args["casting_list"]= $this->castings_model->get_castings(NULL, 9, $page, 0, NULL);		
		}		
		
		$args["categories_cant"] = $this->casting_categories_model->get_casting_categories_cant();//cuantas categorias
		$args["categories"] = $this->casting_categories_model->get_casting_categories();//carga la lista de categorias
		
	
		$temp[-1]= "--  Seleccionar Todos  --";
		$temp[-2]= "--     Vaciar Campo    --";
		
		$args["categories"] = $temp + $args["categories"];
		
		$args["page"]=$page;

		$args['content']='home/castings_list';
		$args["inner_args"]=NULL;
		
		$this->load->view('template',$args);
	}

	public function login_hunter()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_message('required', 'Este campo es obligatorio');
		$this->form_validation->set_message('valid_email', 'Este campo debe ser un correo v&aacute;lido');

		$this->form_validation->set_rules('contact_name', 'Nombre', 'required|xss_clean');
		$this->form_validation->set_rules('contact_email', 'Correo', 'required|xss_clean|valid_email');
		$this->form_validation->set_rules('contact_message', 'Mensaje', 'required|xss_clean');

		if($this->form_validation->run() != FALSE)
		{
			$data= array();
			$data["nombre"] =$_POST["contact_name"];
			$data["email"] =$_POST["contact_email"];
			$data["mensaje"] =$_POST["contact_message"];

			$this->contact_model->insert($data);

			$args["flag"]=true;

			
		}

		$args['content'] = 'home/login_hunter';
		$args['inner_args'] = NULL;
		$this->load->view('template',$args);
	}

	public function what_is()
	{
		$args['content'] = 'home/what_is';		
		$args["inner_args"]=NULL;
		$this->load->view('template',$args);
	}


	public function video()
	{
		if(isset($_GET['id']))
		{
			$args['id_video'] = $_GET['id'];		
			$args['name'] = $_GET['name'];		
			$args['description'] = $_GET['description'];
			$args['username'] = $_GET['username'];	
			$args['userlastname'] = $_GET['userlastname'];		
			$args['image'] = $_GET['image'];	
			$args['iduser'] = $_GET['iduser'];		
	


			$this->load->view('home/video_modal',$args);
		}
	}

	public function terms()
	{
		$args['content'] = 'home/terms';		
		$args["inner_args"]=NULL;
		$this->load->view('template',$args);
	}

	public function casting_detail($id)
	{
		if(is_numeric($id))
		{
			$args["casting"] = $this->castings_model->get_full_casting($id);
			$args["casting"]["applies"] = $this->applies_model->get_applies_cant($id);
			
			//carga las preguntas custom de este casting
			$custom_questions = $this->custom_questions_model->getQuestionsBy($id);
			$custom_options = array();

			for($i =0; $i < count($custom_questions); $i++)
			{
				$custom_options[$i] = array('id' => $custom_questions[$i]['id'], 'type' => $custom_questions[$i]['type'], 'text' => $custom_questions[$i]['text'], 'options' => array());
				$opciones = $this->custom_options_model->getOptionsByQuestion($custom_questions[$i]['id']);

				if((!$opciones == 0))
				{
					//hay opciones
					foreach ($opciones as $option) {
						$custom_options[$i]['options'][] = array('id' => $option['id'], 'option' => $option['option']);	
					}
				}
			}

			$args['custom_options'] = $custom_options;
		}

		
		if($this->session->userdata('msj'))
		{
			$args["postulation_message"]=$this->session->userdata('msj');		
			$this->session->unset_userdata('msj');
		}
		
		$gender_interpreter= array("Ambos","Masculino","Femenino");		
		$args["castings"] = $this->castings_model->get_castings(NULL, 2, 1);
		if(isset($args["casting"]['sex']))
			$args["casting"]['sex'] = $gender_interpreter[$args["casting"]['sex']]; 

		if(isset($args["casting"]["skills"]))
		{
			$args["tags"]=	$this->skills_model->get_skills();
			$tags_id= explode('-', $args["casting"]["skills"]);
			$tags_id_temp=array();
			foreach ($tags_id as $tag) {
				array_push($tags_id_temp, $args["tags"][$tag]);
			}
			$args["tags"]=$tags_id_temp;
		}
		
		$args["content"]="home/casting_detail";
		$args["inner_args"]=NULL;

		$this->load->view('template',$args);
	}

	public function apply_casting($id_casting)
	{
		if($this->session->userdata('id'))
		{
			if($this->session->userdata('type'))
			{
				if($this->castings_model->check_status_active($id_casting))			
				{
					if ($this->videos_model->verify_videos($this->session->userdata('id')) != 0) 
					{
						$apply_id = $this->applies_model->apply($this->session->userdata('id'), $id_casting);

						if($apply_id !== FALSE)
						{
							$postulation_message = "Postulaci&oacute;n Exitosa.";
							
							//Ahora guardas las preguntas custom
							foreach($this->input->post() as $post_data_name => $post_data_answ)
							{
								$data = explode("_", $post_data_name);

								if(strcmp($data[1], "text") == 0 || strcmp($data[1], "select") == 0)
								{
									if(strcmp($post_data_answ, "") != 0)
									{
										$answers['custom_questions_id'] = $data[3];
										$answers['answer'] = $post_data_answ;
									}
									$this->custom_answers_model->save($answers, $apply_id);
								}
								if(strcmp($data[1], "multiselect") == 0)
								{
									$answers['custom_questions_id'] = $data[3];
									$answers['answer'] = "";
									
									foreach ($post_data_answ as $answ) {
										if(strcmp($answ,"") != 0)
											$answers['answer'] = $answers['answer'].$answ.",";
									}
									
									$answers['answer'] = substr($answers['answer'], 0, -2);
									$this->custom_answers_model->save($answers, $apply_id);
								}
							}
						}
						else
							$postulation_message = "Ya Postulaste a este Casting.";
					}
					else
						$postulation_message = "No tienes un video para poder postular.";
				}
				else
					$postulation_message = "Casting no activo";
			}
			else
				$postulation_message = "No eres un postulante.";
				
		}
		else 
			$postulation_message = "Debes iniciar sesi&oacute;n";	
		
		$this->session->set_userdata('msj', $postulation_message);
		redirect(HOME."/home/casting_detail/".$id_casting);
	}
}