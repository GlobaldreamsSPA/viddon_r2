<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Casting extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('pagination');
	}

	public function list_castings()
	{
		
		$castings = array(
					$casting1 = array(
						'title' => 'Titulo Largo del Casting',
						'cant_applies' => '50',
						'image_casting' => APPPATH.'/../img/dummy/casting_image.jpeg',
						'entity_logo' => APPPATH.'/../img/dummy/canal13.png',
						'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
						'requirements' => 'Proactivos, con hambre de fama, mayores de 18',
						'category' => 'Reality',
						'entity_name' => 'Canal 13',
						'start' => '12/09/12',
						'end' => '12/10/12',
						'time_left' => '10 horas'
					),
					$casting2 = array(
						'title' => 'Titulo Largo del Casting',
						'cant_applies' => '50',
						'image_casting' => APPPATH.'/../img/dummy/casting_image.jpeg',
						'entity_logo' => APPPATH.'/../img/dummy/canal13.png',
						'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
						'requirements' => 'Proactivos, con hambre de fama, mayores de 18',
						'category' => 'Reality',
						'entity_name' => 'Canal 13',
						'start' => '12/09/12',
						'end' => '12/10/12',
						'time_left' => '10 horas'
					)
			);
		
		
		$config['base_url'] = HOME.'/casting/list_castings';
		$config['total_rows'] = 2;
		$config['per_page'] = 5;
		$config['uri_segment'] = 3;

		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$data['results'] = $castings;
		$data['links'] = $this->pagination->create_links();

		$args['data'] = $data;
		$args['content']='castings/list_view';
		$this->load->view('template',$args);
	}
}