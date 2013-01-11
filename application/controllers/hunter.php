<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hunter extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url', 'file', 'form'));
	}

	function index()
	{
		$args["content"]='hunter_profile';
		$this->load->view('template',$args);
	}
}