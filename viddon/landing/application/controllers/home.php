<?php

class Home extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('email');
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
	}

	function index()
	{
		//Definir los mensajes de error
		$divInic = '<div id="bottom">';
		$divFin = '</div>';

		$this->form_validation->set_message('required',
			$divInic.'Ups! Parece que todavía no haz ingresado un e-mail. Intenta nuevamente :)'.$divFin);
		$this->form_validation->set_message('valid_email', 
			$divInic.'Ups! Parece que el e-mail ingresado no es válido. Intenta nuevamente :)'.$divFin);


		$this->form_validation->set_rules('email', 'Email','trim|required|valid_email|callback_check_email');

		if ($this->form_validation->run() == FALSE)
		{
			$data['success'] = "";
			$this->load->view('home', $data);
		}
		else
		{
			//Ingresar email a la base de datos
			$this->email->insert_profile(array('email' => $this->input->post('email')));

			//Enviar mensaje de exito al usuario
			$data['success'] = 
				$divInic."<p>Felicitaciones. Ya estás dentro \o/. Te contactaremos a la brevedad. Gracias por inscribirte ;)</p>".$divFin;
			$this->load->view('home', $data);
		}
	}

	function check_email($email)
	{
		$divInic = '<div id="bottom">';
		$divFin = '</div>';

		if($this->email->is_unique($email) == FALSE)
		{
			$this->form_validation->set_message('check_email', 
				$divInic.':O El e-mail que ingresaste ya se encuentra en nuestros registros. Intenta nuevamente.'.$divFin);
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
}
