<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');

		//Modelos
		$this->load->model(array('videos_model', 'user_model', 'hunter_model', 'castings_model','applies_model'));
	}

	public function index()
	{

		$args = array();
		$video_list = $this->videos_model->get_videos(1, 8);
		$args["video_list"] = array();
		$args["castings"] = $this->castings_model->get_castings(NULL, 8, 1, NULL);
		
		foreach ($video_list as $video_data)
		{
			$user_data = $this->user_model->select($video_data["2"]);
			array_push($video_data, $user_data["name"], $user_data["image_profile"]);
			array_push($args["video_list"], $video_data);
		}
    
		$args["content"] = "home/home_view";
		$args["inner_args"] = NULL;
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
		$args["chunks"]=ceil($this->castings_model->count_all(NULL)/9);
		$args["casting_list"]= $this->castings_model->get_castings(NULL, 9, $page, TRUE);
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

	public function casting_detail($id)
	{
		if(is_numeric($id))
		{
			$args["casting"] = $this->castings_model->get_full_casting($id);
			$args["casting"]["applies"] = $this->applies_model->get_applies_cant($id);
		}

		$args["castings"] = $this->castings_model->get_castings(NULL, 8, 1, NULL);
		$args["content"] = "home/casting_detail";
		$args["inner_args"] = NULL;
		$args["tags"] = array("reality show","danza","actuaci&oacuten","m&uacutesica","canto");
		$this->load->view('template', $args);
	}
}