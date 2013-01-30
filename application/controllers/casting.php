<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Casting extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('pagination');
	}


	public function casting_detail()
	{
		$args["content"]="casting_detail";
		$args["tags"]=array("reality show","danza","actuaci&oacuten","m&uacutesica","canto");
		$this->load->view('template',$args);
	}
}