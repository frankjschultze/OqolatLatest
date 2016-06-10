<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Analytics extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
   $this->load->model('analytics_model');
 }
 
 function index()
 {
   
   		$session=$this->authenticate();
   		$role_id= $session['user_role_id'];
 		$role_name= $session['user_role_name'];
		$id= $session['id'];
		$user_name= $session['username'];
		$data['role_id']=$role_id;
		$data['role_name']=$role_name;
		$data['user_id']=$id;
		$data['user_name']=$user_name;
		$data['title']="Analytics";
		$data["link_val1"]="deactive";
		$data["link_val2"]="active";
		if(($role_id!=5) && ($role_id!=2))
		{
   			echo '<span style="color: #888; font-weight: bold;">Sorry you dont have permission</span>';
			//header("location:". base_url()."home/logout");
		}
		else
		{
   			$this->load->view('Roles/Common/header', $data);
			$this->load->view('Roles/Analytics/analytic_home', $data);
			$this->load->view('Roles/Common/footer', $data);
		}
  
 }
 public function authenticate()
 {
   if(!($this->session->userdata('logged_in')))
   {
     //If no session, redirect to login page
     redirect('users/login', 'refresh');
     die();
    // $this->load->view();
   }
   else 
   {
   	   return $this->session->userdata('logged_in');
   }	
 }
function curl_request($action, $postfields = array(), $ref = "") 
 {
 	$absolute_path = realpath('./');
 	$timeout = 20;
 	$useragent = 'Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.2) Gecko/20100115 Firefox/3.6';
 	$referer = (empty($ref))  ? $action : $ref;
 	$ch = curl_init();
 	curl_setopt($ch, CURLOPT_URL, $action);
 	if (!empty($postfields)) {
 		curl_setopt($ch, CURLOPT_POST, true);
 		curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
 	}
 	curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
 	curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
 	curl_setopt($ch, CURLOPT_REFERER, $referer);
 	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 	// these two lines will keep the cookies to get you logged
 	curl_setopt($ch, CURLOPT_COOKIEJAR, $absolute_path."/prj_cookie.txt");
 	curl_setopt($ch, CURLOPT_COOKIEFILE, $absolute_path."/prj_cookie.txt");
 	curl_setopt($ch, CURLOPT_HEADER, 0);
 	$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
 	$contents = curl_exec($ch);
 	curl_close($ch);
 	$data = array($contents, $status);
 	return $data;
 } 
function DOM_Parser($url)
{
    $contents =$this->curl_request($url);
	$dom = new DOMDocument();
	$dom->loadHTML($contents[0]);
	$table = $dom->getElementsByTagName('table')->item(0);
	$content=array();
	foreach($table->getElementsByTagName('tr') as $tr)
	{
		if($tr->getElementsByTagName('td')->item(1) && $tr->getElementsByTagName('td')->item(1)->nodeValue!='Parent Directory')
		{
			array_push($content,str_replace('/','',$tr->getElementsByTagName('td')->item(1)->nodeValue));
		}
	}
	return $content;
	
} 
public function audio_generator()
{
	
	if($this->input->post('station'))
	{
		$details=$this->analytics_model->get_radio_station_details($this->input->post('station'));
		$url=$details[0]['url'];
	}    
	if($this->input->post('month'))$url=$url."/".$this->input->post('month');
	if($this->input->post('day'))$url=$url."/".$this->input->post('day');
	echo json_encode($this->DOM_Parser($url));
}
public function audio_download($station,$month,$day,$file)
{
	$session=$this->authenticate();
	if(!($this->analytics_model->check_station_subscription($session['id'],$station)))
	{
		die("You dont have enough permission to download");
	}
	$details=$this->analytics_model->get_radio_station_details($station);
	$url=$details[0]['url']."/".$month."/".$day."/".$file;
	$mime=get_headers($url);
	print_r($mime);
	header("Content-Disposition: attachment; filename=$file;");
	header($mime[8]);
	header($mime[6]);
	$file=fopen($url,'r');
	fpassthru($file);
}
public function real_time_audio()
{
	
	if($this->session->userdata('logged_in'))
	{
		$this->authenticate();
		$session_data = $this->session->userdata('logged_in');
		$role_id= $session_data['user_role_id'];
		$role_name= $session_data['user_role_name'];
			
		$id= $session_data['id'];
		$user_name= $session_data['username'];
			
		$data['role_id']=$role_id;
		$data['role_name']=$role_name;
		$data['user_id']=$id;
		$data['user_name']=$user_name;
		$data['title']="Analytics";
		$data["link_val1"]="deactive";
		$data["link_val2"]="active";
		$data["radio"]= $this->analytics_model->get_radio_stations($id);
		if(($role_id!=5) && ($role_id!=2))
		{
			echo '<span style="color: #888; font-weight: bold;">Sorry you dont have permission</span>';
			//header("location:". base_url()."home/logout");
		}
		else
		{
		    $this->load->view('Roles/Common/header', $data);
			$this->load->view('Roles/Analytics/real_time_audio', $data);
			$this->load->view('Roles/Common/footer', $data);
		}
	}
	else
	{
		//If no session, redirect to login page
		redirect('users/login', 'refresh');
		// $this->load->view();
	}
}

}
?>