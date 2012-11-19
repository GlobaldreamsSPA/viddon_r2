<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Videos extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('videos_model');
		$this->load->model('applies_model');
	}
}