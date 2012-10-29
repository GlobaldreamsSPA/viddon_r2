<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
	}

	public function index()
	{
		$args = array();
		$args['username']="pedrito";
		
		$args["video_list"]=array(array("Avicii - Levels","tenz01ic1D8"),array("Flo Rida - Wild Ones ft. Sia","5jWF0Yaxf2g"),
		array("MGMT - Kids","fe4EK4HSPkI"),array("MGMT - Electric Feel","MmZexg8sxyk"),array("Kid Cudi - Pursuit Of Happiness ft. MGMT","7xzU9Qqdqww"),
		array("Kid Cudi vs. Crookers - Day 'n' Night","WSWrepLjTKc"),array("Chico Trujillo-Loca","ZwtcyXl5y9c"),
		array("Chico Trujillo Gran Pecador","g0zMiRftVY4"),array("Iron Maiden - Dance Of Death - En Vivo!","GoBok1xd93M"));
		$args['content']='home_page';
		$this->load->view('template',$args);
	}

}
