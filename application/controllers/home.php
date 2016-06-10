<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Home extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
   $this->load->model('user_model');
 }
 
 function index()
 {
   if($this->session->userdata('logged_in'))
   {
   		$session_data = $this->session->userdata('logged_in');
		$role_id= $session_data['user_role_id'];
 		$role_name= $session_data['user_role_name'];
					
		$id= $session_data['id'];
		$user_name= $session_data['username'];
					
		$data['role_id']=$role_id;
		$data['role_name']=$role_name;
		$data['user_id']=$id;
		$data['user_name']=$user_name;
	 	$data['title'] = 'dashboard';
     	$this->load->view('users/dashboard', $data);
   }
   else
   {
     //If no session, redirect to login page
     	redirect('users/login', 'refresh');
    // $this->load->view();
   }
 }
 
 function logout()
 {
 	echo '<span styleSession ending..';
  	$this->session->unset_userdata('logged_in');
   	session_destroy();
 	redirect('home', 'refresh');
 }
 
 public function graph_generator()
 {
 	$x=$this->user_model->graph_data();
 	$p=array();
 	array_push($p,array('account manager','sales'));
 	foreach($x as $key=>$value)
 	{
 		array_push($p,array_values($value));
 	}
 	echo json_encode($p,JSON_NUMERIC_CHECK);
 }
 
}
 
?>