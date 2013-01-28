<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hunter extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url', 'file', 'form'));
		$this->load->model(array('hunter_model', 'castings_model'));
	}

	function index()
	{
		$args['content']='castings/hunter_profile';
		$this->load->view('template',$args);
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
	     $args['content'] = 'castings/login_hunter';
		 $this->load->view('template', $args);
	   }
	   else
	   {
	   	 $args['castings'] = $this->castings_model->get_castings()
	   	 $args['user_data'] = $this->session->userdata('logged_in');
	     $args['content'] = 'castings/hunter_profile';
		 $this->load->view('template', $args);
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
	     $this->form_validation->set_message('check_database', 'Email o contraseña inválidos');
	     return FALSE;
	   }
	}

	function publish()
	{
		$args['content']='castings/publish_view';
		$this->load->view('template', $args);
	}
	
	function casting_list()
	{
		$args['content']='castings/list_view';
		$this->load->view('template', $args);	
	}
}