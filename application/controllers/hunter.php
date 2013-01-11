<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hunter extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url', 'file', 'form'));
	}

	function index()
	{
		$args["content"]='castings/hunter_profile';
		$this->load->view('template',$args);
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