<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
	}

	public function index($page = 1)
	{
		$args = array();
		$args['username']="pedrito";

		$array_videos = array(array("Avicii - Levels","tenz01ic1D8"),array("Flo Rida - Wild Ones ft. Sia","5jWF0Yaxf2g"),
		array("MGMT - Kids","fe4EK4HSPkI"),array("MGMT - Electric Feel","MmZexg8sxyk"),array("Kid Cudi - Pursuit Of Happiness ft. MGMT","7xzU9Qqdqww"),
		array("Kid Cudi vs. Crookers - Day 'n' Night","WSWrepLjTKc"),array("Chico Trujillo-Loca","ZwtcyXl5y9c"),
		array("Chico Trujillo Gran Pecador","g0zMiRftVY4"),array("Iron Maiden - Dance Of Death - En Vivo!","GoBok1xd93M"),
		array("Avicii - Levels","tenz01ic1D8"),array("Flo Rida - Wild Ones ft. Sia","5jWF0Yaxf2g"),
		array("MGMT - Kids","fe4EK4HSPkI"),array("MGMT - Electric Feel","MmZexg8sxyk"),array("Kid Cudi - Pursuit Of Happiness ft. MGMT","7xzU9Qqdqww"),
		array("Kid Cudi vs. Crookers - Day 'n' Night","WSWrepLjTKc"),array("Chico Trujillo-Loca","ZwtcyXl5y9c"),
		array("Chico Trujillo","g0zMiRftVY4"),array("Iron Maiden - Dance Of Death - En Vivo!","GoBok1xd93M"),
		array("Avicii - Levels","tenz01ic1D8"),array("Flo Rida - Wild Ones ft. Sia","5jWF0Yaxf2g"),
		array("MGMT - Kids","fe4EK4HSPkI"),array("MGMT - Electric Feel","MmZexg8sxyk"),array("Kid Cudi - Pursuit Of Happiness ft. MGMT","7xzU9Qqdqww"),
		array("Kid Cudi vs. Crookers - Day 'n' Night","WSWrepLjTKc"),array("Chico Trujillo-Loca","ZwtcyXl5y9c"),
		array("Chico Trujillo","g0zMiRftVY4"),array("Iron Maiden - Dance Of Death - En Vivo!","GoBok1xd93M"));
		
		$video_list= array_slice($array_videos, 9*($page-1), 9);
		
		$args["video_list"]=array();
		
		foreach ($video_list as $video_data)
		{
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
			array_push($args["video_list"], $video_data);
		}
    
		
		
		$args["chunks"]=ceil(count($array_videos) / 9);
		$args["page"]=$page;
		$args['content']='home_page';
		
		$this->load->view('template',$args);
	}

}
