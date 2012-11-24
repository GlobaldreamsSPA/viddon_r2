<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');

		//Modelos
		$this->load->model('videos_model');
		$this->load->model('user_model');
	}

	public function index($page = 1)
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
		$args['content']='home_page';
		
		$this->load->view('template',$args);
	}

	public what_is()
	{
		
	}

}
