<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library(array('upload', 'image_lib'));
		$this->load->helper(array('url', 'file', 'form'));
		
		$this->load->model('user_model');
		$this->load->model('applies_model');
		$this->load->model('videos_model');
		$this->load->model('skills_model');
		$this->load->model('castings_model');
		$this->load->model('photos_model');
		$this->load->model('comment_model');
		$this->load->model('likes_model');

		$this->load->model('education_model');

		parse_str( $_SERVER['QUERY_STRING'], $_REQUEST );
        $CI = & get_instance();
		$CI->config->load("facebook",TRUE);
		$config = $CI->config->item('facebook');
		$this->load->library('Facebook', $config);

	}


	public function fb_login(){
        // Try to get the user's id on Facebook
        $userId = $this->facebook->getUser();
 
        // If user is not yet authenticated, the id will be zero
        if($userId == 0){
            // Generate a login url
			$url = $this->facebook->getLoginUrl(array('scope'=>'email,user_location,user_hometown,user_education_history,user_birthday,user_relationships,user_religion_politics,user_about_me,user_likes','redirect_uri' => 'http://www.development.viddon.com/viddon_r2/user/fb_login/'));
			redirect($url);
		} else {
            // Get user's data and print it
            $fb_id = $this->facebook->api('/me?fields=id');
            $fb_id=$fb_id["id"];

            if($this->user_model->verifyfb_id($fb_id) == 0)
            {
            	$fb_data = $this->facebook->api('/me');
            	$user_id = $this->user_model->insert($fb_data);
            	if(isset($fb_data['education']))
					foreach ($fb_data['education'] as $education_institution) 
					    $this->education_model->insert($user_id,$education_institution);

				$likes = $this->facebook->api('/me/likes');
				foreach ($likes['data'] as $like) 
					$this->likes_model->insert($user_id,$like);

			
				$parts = array();
				
				$url_photo = "https://graph.facebook.com/".$fb_data['id']."/picture?type=large";
				$temporal = parse_url($url_photo);
				
				$img_name = $user_id."_1.jpeg";
				$img = LOCAL_GALLERY.$img_name;
				$parts = explode("/", $temporal['path']);
				
				
				file_put_contents($img,file_get_contents($url_photo));//GUARDA LA IMAGEN
			
				$photo_to_save = array(
					'name' => $img_name,
					'description' => 'foto perfil facebook',
					'user_id' => $user_id
					);
				
				$id_profile_photo = $this->photos_model->insert($photo_to_save);//INSERTA REGISTRO EN BASE DE DATOS , TABLA "photos"
			
				$this->user_model->update_profile_image($id_profile_photo,$user_id);

				$new_session_data = array(
						'id' => $user_id,
						'email' => $fb_data['email'],
						'name' => $fb_data['first_name'],
						'last_name' => $fb_data['last_name'],
						'type' => 1
						);

				$this->session->set_userdata($new_session_data);
				redirect(HOME."/user");

            }
            else
            {
				$user_id = $this->user_model->verifyfb_id($fb_id);	
				$user_id = $user_id[0]["id"];


				$user_data = $this->user_model->select($user_id);
				$new_session_data = array(
					'id' => $user_id,
					'email' => $user_data['email'],
					'name' => $user_data['name'],
					'last_name' => $user_data['last_name'],
					'type' => 1
				);

				$this->session->set_userdata($new_session_data);

				redirect(HOME."/user");


            }
			
        }

    }

	public function comments()
	{
		/* Datos devueltos:
		0: El usuario no esta loggeado. 
		1: El usuario ha escrito el mismo comentario mas de una vez el mismo dia.
		2: El comentario fue ingresado exitosamente.*/

		$comment = $this->input->post('comment');
		if(strcmp($this->session->userdata('id'),'') == 0)
		{
			echo 0;
		}
		else
		{
			$user_id = $this->session->userdata('id');
			$result = $this->comment_model->insert_comment($user_id, $comment);
			if ($result == 2)
			{
				echo 2;
			}
		}
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
		if(!is_null($args['image_profile']))
			$args['image_profile_name'] = $this->photos_model->get_name($args['image_profile']);
		else
			$args['image_profile_name'] = null;

		$args['public'] = $public;
		$args["tags"] = $this->skills_model->get_user_skills($id);
		$args["user"] = $this->user_model->welcome_name($id);
		$args["photos"] = $this->photos_model->get_photos($id);
		
		//PROCESA SUBIDA DE VIDEO A GALERIA
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
		
		
		
		//PROCESA SUBIDA DE FOTO A GALERIA
		if(isset($_POST["url_photo"]))
		{
			$ultimo_indicador = $this->photos_model->get_last_indicator($id);
			
			$parts = array();
			
			$temporal = parse_url($_POST["url_photo"]);
			
			$url = $_POST["url_photo"];
			$img_name = $id."_".($ultimo_indicador+1).".jpeg";
			$img = LOCAL_GALLERY.$img_name;
			$parts = explode("/", $temporal['path']);
			
			
			file_put_contents($img,file_get_contents($url));//GUARDA LA IMAGEN
		
			$photo_to_save = array(
				'name' => $img_name,
				'description' => $_POST["description"],
				'user_id' => $id
				);
			
			$this->photos_model->insert($photo_to_save);//INSERTA REGISTRO EN BASE DE DATOS , TABLA "photos"
			if(isset($_POST["from_gallery"]) && ($_POST['from_gallery'] == 'yes')) redirect(HOME.'/user/photo_gallery/');
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


		$args["user_id"] = $this->session->userdata('id');
		$this->load->view('template',$args);
	}

	public function photo_gallery($page=1,$ope=NULL,$id_photo_objetivo=NULL) //TODO: TERMINAR
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
		if(!is_null($args['image_profile']))
			$args['image_profile_name'] = $this->photos_model->get_name($args['image_profile']);
		else
			$args['image_profile_name'] = null;

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
		$args['videos'] = $this->videos_model->get_videos_by_user($this->session->userdata('id'),$page);
		$args['image_profile'] =$this->user_model->get_image_profile($this->session->userdata('id'));
		$args['page']=$page;
		$args["chunks"]=ceil($this->videos_model->count_videos_by_user($this->session->userdata('id'))/8);	
		
		
		$args["content"]="applicants/applicants_template";
		$inner_args["applicant_content"]="applicants/photo_gallery";
		$args["inner_args"]=$inner_args;
		$args["auxiliar"] = TRUE;
		$args["user_id"] = $this->session->userdata('id');
		
		
		//SACA LAS FOTOS DE LA GALERIA DE ESTE USUARIO
		$args["photos"] = $this->photos_model->get_photos($args["user_id"]);
		
		
		if(!is_null($ope))
		{
			
			switch($ope){
				case 1://HACER FOTO DE PERFIL
					if(!is_null($id_photo_objetivo) && !is_null($args["user_id"]) && is_numeric($id_photo_objetivo))
					{
						$this->user_model->update_profile_image($id_photo_objetivo,$args["user_id"]);

						redirect(HOME."/user/photo_gallery");			
					}
					break;
				case 2://ELIMINAR
					if(!is_null($id_photo_objetivo) && !is_null($args["user_id"]) && is_numeric($id_photo_objetivo))
					{
						if($args['image_profile'] == $id_photo_objetivo)//si borro la foto del perfil
						{
							$this->photos_model->purgar(0,$id_photo_objetivo);//se purga(unlink) la foto de la carpeta profile
							$this->user_model->set_profile_pic($args["user_id"]);//se setea NULL image_profile en users
						}else
						{
							$this->photos_model->purgar(0,$id_photo_objetivo);//se purga(unlink) la foto de la carpeta gallery
						}
						
						$this->photos_model->delete($id_photo_objetivo);	
						redirect(HOME."/user/photo_gallery");		
					}
					break;
			} 
		}
		
		
		$this->load->view('template',$args);
	}


	public function video_gallery($page=1,$ope=NULL,$id_video_objetivo=NULL)
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
		if(!is_null($args['image_profile']))
			$args['image_profile_name'] = $this->photos_model->get_name($args['image_profile']);
		else
			$args['image_profile_name'] = null;

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
		$args['videos'] = $this->videos_model->get_videos_by_user($this->session->userdata('id'),$page);
		$args['id_main_video'] =$this->user_model->get_main_video_id($this->session->userdata('id'));
		$args['page']=$page;
		$args["chunks"]=ceil($this->videos_model->count_videos_by_user($this->session->userdata('id'))/8);	
		
		
		$args["content"]="applicants/applicants_template";
		$inner_args["applicant_content"]="applicants/video_gallery";
		$args["inner_args"]=$inner_args;
		$args["auxiliar"] = TRUE;
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
				$profile['sex'] = $this->input->post('sex');
				$profile['age'] = $this->input->post('age');
				$profile['height'] = $this->input->post('height');
				$profile['color_skin'] = $this->input->post('color_skin');
				$profile['color_eye'] = $this->input->post('color_eyes');
				$profile['color_hair'] = $this->input->post('color_hair');
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


				redirect(HOME.'/user');
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

			$sex= array(0=>"Femenino", 1 =>"Masculino");
			$skin= array(0=>"Blanca",1=>"Morena", 2 =>"Negra");
			$eyes= array(0=>"Verde",1=>"Azul", 2 =>"Gris",3=>"Casta&ntilde;o",4=>"Ambar",5=>"Pardos");
			$hair= array(0=>"Casta&ntilde;o",1=>"Negro", 2 =>"Rubio",3=>"Blanco",4=>"Gris",5=>"Colorin",6=>"Otros");
			$build= array(0=>"Delgado",1=>"Normal",2=>"Grueso",3=>"Atletico");
			
			$args = array(
				'skills' => $skills,
				'age' => $age,
				'height' => $height,
				'eyes' => $eyes,
				'skin' => $skin,
				'hair' => $hair,
				'sex'  => $sex,
				'build' => $build
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
		if(!is_null($args['image_profile']))
			$args['image_profile_name'] = $this->photos_model->get_name($args['image_profile']);
		else
			$args['image_profile_name'] = null;

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
		if(!is_null($args['image_profile']))
			$args['image_profile_name'] = $this->photos_model->get_name($args['image_profile']);
		else
			$args['image_profile_name'] = null;
		
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
