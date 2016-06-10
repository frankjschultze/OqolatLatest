<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Traffic extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
   $this->load->model('traffic_model');
 }
 
 function index()
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
		$data['title']="Traffic";
		$data["link_val1"]="deactive";
		$data["link_val2"]="active";
		if(($role_id!=4) && ($role_id!=2))
		{
   			echo '<span style="color: #888; font-weight: bold;">Sorry you dont have permission</span>';
			//header("location:". base_url()."home/logout");
		}
		else
		{
   			$this->load->view('Roles/Common/header', $data);
			$this->load->view('Roles/Traffic/traffic_home', $data);
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
 public function authenticate()
 {
   if(!($this->session->userdata('logged_in')))
 	{
     //If no session, redirect to login page
     redirect('users/login', 'refresh');
    // $this->load->view();
   }
 }
 public function traffic_view($page, $data)
	{
		$this -> authenticate();
			$session_data = $this -> session -> userdata('logged_in');
			$role_id = $session_data['user_role_id'];
			$role_name = $session_data['user_role_name'];

			$id = $session_data['id'];
			$user_name = $session_data['username'];
			$data["nav"] =  "tfc";
			$data['role_id'] = $role_id;
			$data['role_name'] = $role_name;
			$data['user_id'] = $id;
			$data['user_name'] = $user_name;
			$data['title'] = "Traffic:$page";
			if (($role_id != 4) && ($role_id != 2)) {
				echo '<span style="color: #888; font-weight: bold;">Sorry you dont have permission</span>';
			//header("location:". base_url()."home/logout");
			} elseif ($role_id == 2) {

				$data["link_val1"] = "deactive";
				$data["link_val2"] = "deactive";
				$data["link_val3"] = "active";
				$data["link_val4"] = "deactive";
				$data["link_val5"] = "deactive";
				$this -> load -> view('admin/header', $data);
				$this -> load -> view('Roles/Traffic/' . $page, $data);
				$this -> load -> view('admin/footer', $data);
				} else {
					$data["link_val1"] = "deactive";
					$data["link_val2"] = "active";
					
					$this -> load -> view('Roles/Common/header', $data);
					$this -> load -> view('Roles/Traffic/' . $page, $data);
					$this -> load -> view('Roles/Common/footer', $data);
				}
	}
 public function add_contracts($slug=FALSE)
 {
 	$page = "add_contracts"; 
	$data['title']="Contracts";
	$data['platform']=$this -> traffic_model-> get_platform_list();
	$data['type']=$this -> traffic_model -> get_type_list();
	$data['clients']=$this -> traffic_model -> get_clients_list();
	$data['contracts']=$this -> traffic_model -> get_contract_list();
	$data['products']=$this -> traffic_model -> get_products_list();
	$data['acctmanager']= $this -> traffic_model -> get_acctmanager_list();
	$this -> traffic_view($page, $data);
 }
 public function add_new_platform($slug=FALSE)
 {
 	$this -> authenticate();
	$ins=$this->traffic_model->insert_platform();
	echo $ins;
 }
 public function delete_platform()
 {
 	$this->authenticate();
	$pfm = $this -> input -> post('pfm');
	$del=$this->traffic_model->delete_platform($pfm);
	if(!$del)
		$del="Insufficient privilage";
	echo $del;
 }
 public function add_new_type($slug=FALSE)
 {
	$this -> authenticate();
	$ins=$this->traffic_model->insert_type();
	echo $ins;
 }
 public function delete_type()
 {
 	$this->authenticate();
	$tid = $this -> input -> post('tid');
	$del=$this->traffic_model->delete_type($tid);
	if(!$del)
		$del="Insufficient privilage";
	echo $del;
 }
 public function create_contract() {
		$this -> authenticate();
		$ins = $this -> traffic_model -> create_contract();
		echo $ins;
	}
 public function create_contractline() {
		$this -> authenticate();
		$ins = $this -> traffic_model -> create_contractline();
		echo $ins;
	}
 public function manage_contracts()
 {
 	$page = "manage_contracts"; 
	$data['title']="Contracts";
	$data['platform']=$this -> traffic_model-> get_platform_list();
	$data['linetype']=$this -> traffic_model -> get_type_list();
	$data['clients']=$this -> traffic_model -> get_clients_list();
	$data['contracts']=$this -> traffic_model -> get_contract_products_list();
	$data['products']=$this -> traffic_model -> get_products_list();
	$data['acctmanager']= $this -> traffic_model -> get_acctmanager_list();
	
	$session_data = $this -> session -> userdata('logged_in');
	$id = $session_data['id'];
	$table="contracts_data";
	$data['table_view'] = $this->traffic_model->get_table_view($id, $table);
	$this -> traffic_view($page, $data);
 }
 public function contract_delete_selected()
 {
	$this-> authenticate();
	$cid=$this->input->post('contract_id');
	$del=$this->traffic_model->delete_contracts_data_selected($cid);
	echo $del;
 }
 public function contract_change_status()
 {
	$this-> authenticate();
	$cid=$this->input->post('contract_id');
	$status=$this -> input -> post('status');
	$change_status=$this->traffic_model->change_contract_status($cid, $status);
	echo $change_status;
 }
 public function contract_update()
 {
	$this -> authenticate();
	$upd = $this -> traffic_model -> update_contract_data();
	echo $upd;
 }
 public function client_update()
 {
	$this -> authenticate();
	$upd = $this -> traffic_model -> update_client_data();
	echo $upd;
 }
 public function get_contract_line()
 {
	$this -> authenticate();
	$data['contract_line'] = $this -> traffic_model -> get_contract_line();
	$contract_line=json_encode($data['contract_line']);
	echo $contract_line;
 }
 
 public function contractline_delete_selected()
 {
	$this-> authenticate();
	$cid=$this->input->post('line_id');
	$del=$this->traffic_model->delete_contracts_line_selected($cid);
	echo ($del);
 }
 public function contractline_delete_update_total()
 {
	$this-> authenticate();
	$cid=$this->input->post('line_id');
	$del=$this->traffic_model->delete_contracts_line_update_total($cid);
	echo json_encode($del);
 }
 
 public function get_contract_line_unique()
 {
	$this -> authenticate();
	$data['contract_line'] = $this -> traffic_model -> get_contract_line_unique();
	$contract_line=json_encode($data['contract_line']);
	echo $contract_line;
 }
 public function update_contract_line()
 {
 	$this -> authenticate();
	$upd = $this -> traffic_model -> update_contract_line();
	echo $upd;
 }
 public function get_client_type()
 {
 	$this->authenticate();
	$data['result']= $this->traffic_model->client_type();
	echo json_encode($data['result']);
 }
 public function insert_new_contract_line()
 {
 	$this -> authenticate();
	$ins = $this -> traffic_model -> create_contractline();
	echo $ins;
 }
 public function contract_lines()
 {
 	$this->load->helper('form');
	$this->load->library('form_validation');
 	$search=$this -> input -> post('search');
	
 	$page = "contract_lines"; 
	$data['title']="Contract Lines";
	$data['platform']=$this -> traffic_model-> get_platform_list();
	$data['linetype']=$this -> traffic_model -> get_type_list();
	if($search)
	{
			$data['contract_line']=$this->traffic_model->get_contract_line_search($search);
		
	}
	else {
			$data['contract_line']=$this->traffic_model->get_contract_line('slug');
	}
	$this -> traffic_view($page, $data);
	
 }
 
}
 
?>