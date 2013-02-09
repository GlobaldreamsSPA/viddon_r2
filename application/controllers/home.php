<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');

		//Modelos
		$this->load->model('videos_model');
		$this->load->model('user_model');
		$this->load->model('hunter_model');
	}

	public function index()
	{

		$args= array();
		
		$video_list = $this->videos_model->get_videos(1, 8);
		
		$args["video_list"]=array();
		
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
			array_push($video_data,$user_data["name"],$user_data["image_profile"]);
			array_push($args["video_list"], $video_data);
		}
    
		$args["content"]="home/home_view";
		$args["inner_args"]=NULL;
		$this->load->view('template',$args);
	}

	public function video_list($page = 1)
	{
		$args = array();

		$video_list = $this->videos_model->get_videos($page, 9);
		
		$args["video_list"]=array();
		
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
			array_push($video_data,$user_data["name"],$user_data["image_profile"]);
			array_push($args["video_list"], $video_data);
		}
    
		
		
		$args["chunks"]=ceil($this->videos_model->count() / 9);
		$args["page"]=$page;
		$args['content']='home/video_list';		
		$args["inner_args"]=NULL;
		
		$this->load->view('template',$args);
	}

	public function casting_list($page = 1)
	{
		$args = array();

		$casting_list = array(array("mini_banner_c1"),array("mini_banner_c1"),array("mini_banner_c1"),array("mini_banner_c1")
		,array("mini_banner_c1"),array("mini_banner_c1"),array("mini_banner_c1"),array("mini_banner_c1"),array("mini_banner_c1")
		,array("mini_banner_c1"),array("mini_banner_c1"),array("mini_banner_c1"),array("mini_banner_c1"),array("mini_banner_c1")
		,array("mini_banner_c1"),array("mini_banner_c1"));
		
		$args["casting_list"]=array();
		
		foreach ($casting_list as $casting_data)
		{
			$hunter_data= array("hunter_1","canal_13");
			array_push($casting_data,$hunter_data["1"],$hunter_data["0"]);
			array_push($args["casting_list"], $casting_data);
		}
		
		$args["chunks"]=ceil(count($casting_list) / 9);
		$args["casting_list"]= array_slice($args["casting_list"],9*($page-1),9*$page);
		$args["page"]=$page;
		$args['content']='home/castings_list';	
		$args["inner_args"]=NULL;
		
		$this->load->view('template',$args);
	}

	public function login_hunter()
	{
		$this->load->helper('form');
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

	public function terms()
	{
		$args['content'] = 'home/terms';		
		$args["inner_args"]=NULL;
		$this->load->view('template',$args);
	}

	public function casting_detail()
	{
		$args["content"]="home/casting_detail";
		$args["inner_args"]=NULL;
		$args["tags"]=array("reality show","danza","actuaci&oacuten","m&uacutesica","canto");
		$this->load->view('template',$args);
	}
}