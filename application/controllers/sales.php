<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
session_start();
//we need to call PHP's session object to access it through CI
class Sales extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> model('sales_model');
	}

	function index() {
		if ($this -> session -> userdata('logged_in')) {
			$this -> authenticate();
			$session_data = $this -> session -> userdata('logged_in');
			$role_id = $session_data['user_role_id'];
			$role_name = $session_data['user_role_name'];

			$id = $session_data['id'];
			$user_name = $session_data['username'];
			$data['nav']="0"; //direct sales->client access
			$data['role_id'] = $role_id;
			$data['role_name'] = $role_name;
			$data['user_id'] = $id;
			$data['user_name'] = $user_name;
			$data['title'] = "Sales";
			$data["link_val1"] = "deactive";
			$data["link_val2"] = "active";
			if (($role_id != 3) && ($role_id != 2)) {
				echo '<span style="color: #888; font-weight: bold;">Sorry you dont have permission</span>';
				//header("location:". base_url()."home/logout");
			} else {
				$this -> load -> view('Roles/Common/header', $data);
				$this -> load -> view('Roles/Sales/sales_home', $data);
				$this -> load -> view('Roles/Common/footer', $data);
			}
		} else {
			//If no session, redirect to login page
			redirect('users/login', 'refresh');
			// $this->load->view();
		}
	}

	public function authenticate() {
		if (!($this -> session -> userdata('logged_in'))) {
			//If no session, redirect to login page
			redirect('users/login', 'refresh');
			// $this->load->view();
		}
	}

	public function sales_view($page, $data) {
		$this -> authenticate();
		$session_data = $this -> session -> userdata('logged_in');
		$role_id = $session_data['user_role_id'];
		$role_name = $session_data['user_role_name'];

		$id = $session_data['id'];
		$user_name = $session_data['username'];
		$data['nav'] = "0";
		$data['role_id'] = $role_id;
		$data['role_name'] = $role_name;
		$data['user_id'] = $id;
		$data['user_name'] = $user_name;
		$data['title'] = "Clients Data:$page";
		//if (($role_id != 3) && ($role_id != 2)) 
		if (($role_id != 3) && ($role_id != 2)) 
		{
			echo '<span style="color: #888; font-weight: bold;">Sorry you dont have permission</span>';
			//header("location:". base_url()."home/logout");
		} elseif ($role_id == 2) {

			$data["link_val1"] = "deactive";
			$data["link_val2"] = "active";
			$data["link_val3"] = "deactive";
			$data["link_val4"] = "deactive";
			$data["link_val5"] = "deactive";
			$this -> load -> view('admin/header', $data);
			$this -> load -> view('Roles/Sales/' . $page, $data);
			$this -> load -> view('admin/footer', $data);
		} else {
			$data["link_val1"] = "deactive";
			$data["link_val2"] = "active";
			$this -> load -> view('Roles/Common/header', $data);
			$this -> load -> view('Roles/Sales/' . $page, $data);
			$this -> load -> view('Roles/Common/footer', $data);
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
				$data["nav"] =  "tfc";
				$this -> load -> view('admin/header', $data);
				$this -> load -> view('Roles/Sales/' . $page, $data);
				$this -> load -> view('admin/footer', $data);
				} else {
					$data["link_val1"] = "deactive";
					$data["link_val2"] = "active";
					$data["nav"] =  "tfc";
					$this -> load -> view('Roles/Common/header', $data);
					$this -> load -> view('Roles/Sales/' . $page, $data);
					$this -> load -> view('Roles/Common/footer', $data);
				}
	}

	public function add_clients($slug=FALSE) {
		$this -> authenticate();
		if($slug=="tfc") {
			//Load traffic
			$data['products'] = $this -> sales_model -> get_products_list();
			$data['accounts'] = $this -> sales_model -> get_acctmanager_list();
			$data['campaigns']= $this -> sales_model -> get_campaign_list();
			$data['audience'] = $this -> sales_model -> get_audience_list();
			$data['type']=$this -> sales_model -> get_clients_type();
			$page = "add_clients"; 
			$data['title']="Traffic";
			$this -> traffic_view($page, $data);
			
		}
		else
		{
			echo 'Sorry You don\'t have permission';
			/* Hide add clients from sales view
			$page = "add_clients";
			$data['title']="Add clients";
			$this -> sales_view($page, $data);*/
			
		}

	}

	public function create_client() {
		$this -> authenticate();
		$ins = $this -> sales_model -> create_client();
		echo $ins;
	}

	public function manage_clients($slug=FALSE) {
		$this->authenticate();
		$page = "manage_clients";
		$data['result'] = $this -> sales_model -> get_clients_data();
		$data['type'] = $this-> sales_model -> get_clients_type();
		$data['products'] = $this-> sales_model -> get_products_list();
		$data['campaign']= $this -> sales_model -> get_campaign_list();
		$data['audience']= $this -> sales_model -> get_audience_list();
		$data['acctmanager']= $this -> sales_model -> get_acctmanager_list();
		$session_data = $this -> session -> userdata('logged_in');
		$id = $session_data['id'];
		$table="client_data";
		$data['table_view'] = $this->sales_model->get_table_view($id, $table);
		if ($slug=="tfc") {
			//Load traffic manage clients
			$data['title']="Traffic";
			$this -> traffic_view($page, $data);
		}
		else
		{
			$this -> sales_view($page,$data);
		}

	}
	public function client_change_status()
	{
		$this-> authenticate();
		$cid=$this->input->post('client_id');
		$status=$this -> input -> post('status');
		$change_status=$this->sales_model->change_client_status($cid, $status);
		echo $change_status;
	}
	public function client_update()
	{
		$this -> authenticate();
		$upd=$this -> sales_model -> update_client_data();
		echo $upd;
	}
	public function client_delete_selected()
	{
		$this-> authenticate();
		$cid=$this->input->post('client_id');
		$del=$this->sales_model->delete_clients_data_selected($cid);
		echo $del;
		
	}
	public function client_type($slug=False)
	{
		$page = "client_type";
		$data['result']=$this -> sales_model -> get_clients_type();
		if($slug=="tfc")
		{
			//Load traffic clients type
			$data['title']="Traffic";
			$this -> traffic_view($page, $data);
		}
		else {
			$data['title']="Clients Type";
			$this -> sales_view($page, $data);
		}
		
	}
	public function add_new_type()
	{
		$this -> authenticate();
		$ins=$this->sales_model->insert_client_type();
		echo $ins;
	}
	public function delete_client_type()
	{
		$this->authenticate();
		$rid = $this -> input -> post('rid');
		$del="Insufficient privilage";
		if($rid>3)
			$del=$this->sales_model->delete_client_type($rid);
		echo $del;
	}
	public function advertiser_update()
	{
		$this->authenticate();
		$upd=$this -> sales_model -> update_client_advertiser();
		echo $upd;
	}
	public function account_update()
	{
		$this->authenticate();
		$upd=$this -> sales_model -> update_account();
		echo $upd;
	}
	public function delete_product()
	{
		$this->authenticate();
		$pid = $this -> input -> post('pid');
		$del=$this->sales_model->delete_product($pid);
		if(!$del)
			$del="Insufficient privilage";
		echo $del;
	}
	public function delete_audience()
	{
		$this->authenticate();
		$aid = $this -> input -> post('aid');
		$del=$this->sales_model->delete_audience($aid);
		if(!$del)
			$del="Insufficient privilage";
		echo $del;
	}
	public function add_new_product()
	{
		$this -> authenticate();
		$ins=$this->sales_model->insert_product();
		echo $ins;
	}
	public function add_new_manager()
	{
		$this -> authenticate();
		$ins=$this->sales_model->insert_manager();
		echo $ins;
	}
	public function add_new_campaign()
	{
		$this -> authenticate();
		$ins=$this->sales_model->insert_campaign();
		echo $ins;
	}
	public function add_new_audience()
	{
		$this -> authenticate();
		$ins=$this->sales_model->insert_audience();
		echo $ins;
	}
	public function delete_manager()
	{
		$this->authenticate();
		$mid = $this -> input -> post('mid');
		$del=$this->sales_model->delete_manager($mid);
		if(!$del)
			$del="Insufficient privilage";
		echo $del;
	}
	public function delete_campaign()
	{
		$this->authenticate();
		$cid = $this -> input -> post('cid');
		$del=$this->sales_model->delete_campaign($cid);
		if(!$del)
			$del="Insufficient privilage";
		echo $del;
	}
}
?>