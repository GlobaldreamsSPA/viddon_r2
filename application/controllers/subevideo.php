<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subevideo extends CI_Controller
{
	public function __construct()
	{
        parent::__construct();
		//$this->load->library(array('session','Youtube','Google_oauth'));
		$this->load->library('session');
        $this->load->helper(array('url','oauth','form','file'));
	}
	public function index($p=NULL)
	{		
		$oauth_TOKEN = "1/djnKkGT7RtoDfZ69094D_YnWjJyiTZTse82lYJ7vhac";
		$oauth_TOKEN_SECRET = "gFts5fWFUM7IfRgsAf7PTxzo";
		
		
		
		$args = array();
		$args['error'] = '';
		$this->load->view('upload_form',$args);

	}
	
	public function subir_video()
	{
		$config['upload_path'] = 'temp/videos/';
		//$config['allowed_types'] = 'avi|flv|wmv|mov|mpeg4|mpegps|3gpp|webm'; //formatos soportados por youtube
		$config['allowed_types'] = 'avi|flv|wmv|mov|mpeg4|mp4|3gpp|webm'; //formatos mime compatibles
		$config['overwrite'] = FALSE;
        $config['remove_spaces'] = TRUE;
		$config['max_size'] = '10240';//10 MB
		
		//$video_name = $date.$_FILES['video']['name'];
        //$config['file_name'] = $video_name;
		
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if (!$this->upload->do_upload()) 
		{
			$error = array('error' => $this->upload->display_errors());
			$this->load->view('upload_form', $error);
		} 
		else 
		{
			$data = array('upload_data' => $this->upload->data());
			$path_temporal = $config['upload_path'].$_FILES['userfile']['name'];
			
			//realiza la subida a youtube//
			$resultado_subida_youtube = $this->direct_upload($path_temporal,$_FILES['userfile']['type']);
			
			$xml = new SimpleXMLElement($resultado_subida_youtube);
			
			$temp = array();
			$temp = explode(":",$xml->id);
			echo "<br />".$temp[(sizeof($temp) - 1)];
									
			//falta realizar el registro de la subida en la base de datos, utilizando la información obtenida al ejecutar direct_upload.
			//elimina el video de la carpeta temporal
			unlink("./".$path_temporal);
			
			//carga el mensaje de exito en la vista
			$this->load->view('upload_success', $data);
		}
	}	
	
	//CALL THIS METHOD FIRST BY GOING TO
	//www.your_url.com/index.php/request_youtube
	public function request_youtube()
	{
		$params['key'] = 'development.viddon.com';
		$params['secret'] = 'R7mM_TxYhzbM5XG1RhOVNq7x';
		$params['algorithm'] = 'HMAC-SHA1';
		
		$this->load->library('google_oauth', $params);
		$data = $this->google_oauth->get_request_token(site_url('subevideo/access_youtube'));
		$this->session->set_userdata('token_secret', $data['token_secret']);
		redirect($data['redirect']); 
	}
	
	//This method will be redirected to automatically
	//once the user approves access of your application
	public function access_youtube()
	{
		$params['key'] = 'development.viddon.com';
		$params['secret'] = 'R7mM_TxYhzbM5XG1RhOVNq7x';
		$params['algorithm'] = 'HMAC-SHA1';
		
		$this->load->library('google_oauth', $params);
		
		$oauth = $this->google_oauth->get_access_token(false, $this->session->userdata('token_secret'));
		
		$this->session->set_userdata('oauth_token', $oauth['oauth_token']);
		$this->session->set_userdata('oauth_token_secret', $oauth['oauth_token_secret']);
		var_dump(htmlentities($oauth['oauth_token']));
		var_dump($oauth['oauth_token']);
		var_dump($oauth['oauth_token_secret']);
	}
	
	//This method can be called without having
	//done the oauth steps
	public function youtube_no_auth()
	{
		$params['apikey'] = 'AI39si4Eb8UYv17A5Rih0NCb-pkJR2ay0nYlkBC0mBjeHdhhIrzio8eL8Ct1SDEjFVUDdAguRFmLTnIrqSSvP9MXBZHiE_pNFw';
		
		$this->load->library('youtube', $params);
		echo $this->youtube->getKeywordVideoFeed('pac man');
	}
	
	//This method can be called after you executed
	//the oauth steps
	public function youtube_auth()
	{
		$params['apikey'] = 'AI39si4Eb8UYv17A5Rih0NCb-pkJR2ay0nYlkBC0mBjeHdhhIrzio8eL8Ct1SDEjFVUDdAguRFmLTnIrqSSvP9MXBZHiE_pNFw';
		$params['oauth']['key'] = 'development.viddon.com';
		$params['oauth']['secret'] = 'R7mM_TxYhzbM5XG1RhOVNq7x';
		$params['oauth']['algorithm'] = 'HMAC-SHA1';
		$params['oauth']['access_token'] = array('oauth_token'=>urlencode($this->session->userdata('oauth_token')),
												 'oauth_token_secret'=>urlencode($this->session->userdata('oauth_token_secret')));
		
		$this->load->library('youtube', $params);
		echo $this->youtube->getUserUploads();
	}
	
	public function direct_upload($videoPath,$videoType)
	{
		
		$oauth_TOKEN = "1/djnKkGT7RtoDfZ69094D_YnWjJyiTZTse82lYJ7vhac";
		$oauth_TOKEN_SECRET = "gFts5fWFUM7IfRgsAf7PTxzo";
		//$videoPath ='img/video03.wmv';
		//$videoType = 'video/x-ms-wmv'; //This is the mime type of the video ex: 'video/3gpp'
		
		$params['apikey'] = 'AI39si4Eb8UYv17A5Rih0NCb-pkJR2ay0nYlkBC0mBjeHdhhIrzio8eL8Ct1SDEjFVUDdAguRFmLTnIrqSSvP9MXBZHiE_pNFw';
		$params['oauth']['key'] = 'development.viddon.com';
		$params['oauth']['secret'] = 'R7mM_TxYhzbM5XG1RhOVNq7x';
		$params['oauth']['algorithm'] = 'HMAC-SHA1';
		//$params['oauth']['access_token'] = array('oauth_token'=>urlencode($this->session->userdata('oauth_token')),'oauth_token_secret'=>urlencode($this->session->userdata('oauth_token_secret')));
		$params['oauth']['access_token'] = array('oauth_token'=>urlencode($oauth_TOKEN),'oauth_token_secret'=>urlencode($oauth_TOKEN_SECRET));
		$this->load->library('youtube', $params);		
		$metadata = '<entry xmlns="http://www.w3.org/2005/Atom" xmlns:media="http://search.yahoo.com/mrss/" xmlns:yt="http://gdata.youtube.com/schemas/2007"><media:group><media:title type="plain">Test Direct Upload</media:title><media:description type="plain">Test Direct Uploading.</media:description><media:category scheme="http://gdata.youtube.com/schemas/2007/categories.cat">People</media:category><media:keywords>test</media:keywords></media:group></entry>';
		return $this->youtube->directUpload($videoPath, $videoType, $metadata);
	}
}

/* End of file example.php */
/* Location: ./application/controllers/example.php */	