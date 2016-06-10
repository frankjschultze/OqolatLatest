<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Admin extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
   $this->authenticate();
   $this->load->model('admin_model');
   $this->load->model('sales_model');
   $this->load->model('analytics_model');
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
		$data['title']="Admin";
		$data["link_val1"]="deactive";
		$data["link_val2"]="deactive";
		$data["link_val3"]="deactive";
		$data["link_val4"]="deactive";
		$data["link_val5"]="active";
		if($role_id!=2)
		{
   			echo '<span style="color: #888; font-weight: bold;">Sorry you dont have permission</span>';
		//header("location:". base_url()."home/logout");
		}
		else
		{
   			$this->load->view('admin/header', $data);
			$this->load->view('admin/admin_home', $data);
			$this->load->view('admin/footer', $data);
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
 public function user_data()
 {
 	$this-> authenticate();
 	$session_data = $this->session->userdata('logged_in');
	$role_id= $session_data['user_role_id'];
 	$role_name= $session_data['user_role_name'];
					
	$id= $session_data['id'];
	$user_name= $session_data['username'];
	$data['role_id']=$role_id;
	$data['role_name']=$role_name;
	$data['user_id']=$id;
	$data['user_name']=$user_name;
	$data["link_val1"]="deactive";
	$data["link_val2"]="deactive";
	$data["link_val3"]="deactive";
	$data["link_val4"]="deactive";
	$data["link_val5"]="active";
	$table="user_data";
 	$data['title'] = 'User data';
	$data['table_view'] = $this->admin_model->get_table_view($id, $table);
	$data['result']=$this->admin_model->get_users_data();
	$data['roles']=$this->admin_model->get_roles_details();
	$data['stations']=$this->analytics_model->get_radio_stations();
	if($role_id!=2)
	{
   		echo '<span style="color: #888; font-weight: bold;">Sorry you dont have permission</span>';
		//header("location:". base_url()."home/logout");
	}
	else
	{
		$this->load->view('admin/header', $data);
 		$this->load->view('admin/user_data',$data);
		$this->load->view('admin/footer', $data);
	}
 }
 public function user_update()
 {
 	//echo 'success';
	$this-> authenticate();
	$role=$this -> input -> post('role_id');
	$user_id = $this -> input -> post('user_id');
	$stations=$this->input->post('stations');
	$upd=$this->admin_model->update_users_data();
	/* subscribe to radio stations */
	$this->analytics_model->subscribe_to_stations($user_id,$stations);	
	if($upd)
	{
		if($role>2)
		{
			$this -> admin_model -> activate_user($user_id, $role);
		}
	}
	echo $upd;
 }
 public function user_change_status()
 {
 	$this-> authenticate();
	$uid=$this->input->post('user_id');
	$status=$this -> input -> post('status');
	$del=$this->admin_model->change_user_status($uid, $status);
	echo $del;
 }
public function user_delete_selected()
 {
 	$this-> authenticate();
	$uid=$this->input->post('user_id');
	$del=$this->admin_model->delete_users_data_selected($uid);
	echo $del;
 }
 public function user_role($parm=FALSE)
 {
 	$this -> authenticate();
	$session_data = $this->session->userdata('logged_in');
	$role_id= $session_data['user_role_id'];
 	$role_name= $session_data['user_role_name'];
    $id= $session_data['id'];
	$user_name= $session_data['username'];
	$data['role_id']=$role_id;
	$data['role_name']=$role_name;
	$data['user_id']=$id;
	$data['user_name']=$user_name;
	$data["link_val1"]="deactive";
	$data["link_val2"]="deactive";
	$data["link_val3"]="deactive";
	$data["link_val4"]="deactive";
	$data["link_val5"]="active";
	$data['title'] = 'User roles';
	$data['result']=$this->admin_model->get_users_roles();
	if($role_id!=2)
	{
   		echo '<span style="color: #888; font-weight: bold;">Sorry you dont have permission</span>';
		//header("location:". base_url()."home/logout");
	}
	else
	{
		$this->load->view('admin/header', $data);
		$this -> load -> view('admin/user_role', $data);
		$this->load->view('admin/footer', $data);
	}
	
 }
 public function add_new_role()
 {
 	$this -> authenticate();
	$ins=$this->admin_model->insert_user_role();
	echo $ins;
 } 
 public function sales()
 {
 	$session_data = $this->session->userdata('logged_in');
	$role_id= $session_data['user_role_id'];
 	$role_name= $session_data['user_role_name'];
					
	$id= $session_data['id'];
	$user_name= $session_data['username'];
	$data['nav']=0;			
	$data['role_id']=$role_id;
	$data['role_name']=$role_name;
	$data['user_id']=$id;
	$data['user_name']=$user_name;
	$data['title']="Admin Sales";
	$data["link_val1"]="deactive";
	$data["link_val2"]="active";
	$data["link_val3"]="deactive";
	$data["link_val4"]="deactive";
	$data["link_val5"]="deactive";
	$this->load->view('admin/header', $data);
	$this->load->view('Roles/Sales/sales_home', $data);
	$this->load->view('admin/footer', $data);
 }
 public function traffic()
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
	$data['title']="Admin Traffic";
	$data["link_val1"]="deactive";
	$data["link_val2"]="deactive";
	$data["link_val3"]="active";
	$data["link_val4"]="deactive";
	$data["link_val5"]="deactive";
	$this->load->view('admin/header', $data);
	$this->load->view('Roles/Traffic/traffic_home', $data);
	$this->load->view('admin/footer', $data);
 }
 public function analytics()
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
	$data['title']="Admin Analytics";
	$data["link_val1"]="dective";
	$data["link_val2"]="deactive";
	$data["link_val3"]="deactive";
	$data["link_val4"]="active";
	$data["link_val5"]="deactive";
	$this->load->view('admin/header', $data);
	$this->load->view('Roles/Analytics/analytic_home', $data);
	$this->load->view('admin/footer', $data);
 }
 
 public function dashboard()
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
			$data['title']="Dashboard";
			$data["link_val1"]="active";
			$data["link_val2"]="deactive";
			if($role_id==2)
			{
				$data["link_val1"]="active";
				$data["link_val2"]="deactive";
				$data["link_val3"]="deactive";
				$data["link_val4"]="deactive";
				$data["link_val5"]="deactive";
   				$this->load->view('admin/header', $data);
				$this->load->view('users/dashboard', $data);
				$this->load->view('admin/footer', $data);
			}
			else
			{
   				$this->load->view('Roles/Common/header', $data);
				$this->load->view('users/dashboard', $data);
				$this->load->view('Roles/Common/footer', $data);
			}
		}
	public function delete_user_role()
	{
		$this->authenticate();
		$del="Insufficient privilage";
		$rid = $this -> input -> post('rid');
		if($rid>5)
			$del=$this->admin_model->delete_user_role($rid);
		echo $del;
	}
	public function platform()
	{
		$this-> authenticate();
 		$session_data = $this->session->userdata('logged_in');
		$role_id= $session_data['user_role_id'];
 		$role_name= $session_data['user_role_name'];
					
		$id= $session_data['id'];
		$user_name= $session_data['username'];
					
		$data['role_id']=$role_id;
		$data['role_name']=$role_name;
		$data['user_id']=$id;
		$data['user_name']=$user_name;
		$data["link_val1"]="deactive";
		$data["link_val2"]="deactive";
		$data["link_val3"]="deactive";
		$data["link_val4"]="deactive";
		$data["link_val5"]="active";
 		$data['title'] = 'Admin:Platform';
		$data['platform']=$this -> admin_model-> get_platform_list();
		if($role_id!=2)
		{
   			echo '<span style="color: #888; font-weight: bold;">Sorry you dont have permission</span>';
		//header("location:". base_url()."home/logout");
		}
		else
		{
			$this->load->view('admin/header', $data);
 			$this->load->view('admin/platform',$data);
			$this->load->view('admin/footer', $data);
		}
	}
	public function contract_line_type()
	{
		$this-> authenticate();
 		$session_data = $this->session->userdata('logged_in');
		$role_id= $session_data['user_role_id'];
 		$role_name= $session_data['user_role_name'];
					
		$id= $session_data['id'];
		$user_name= $session_data['username'];
					
		$data['role_id']=$role_id;
		$data['role_name']=$role_name;
		$data['user_id']=$id;
		$data['user_name']=$user_name;
		$data["link_val1"]="deactive";
		$data["link_val2"]="deactive";
		$data["link_val3"]="deactive";
		$data["link_val4"]="deactive";
		$data["link_val5"]="active";
 		$data['title'] = 'Admin: Contract Line Type';
		$data['linetype']=$this -> admin_model-> get_type_list();
		if($role_id!=2)
		{
   			echo '<span style="color: #888; font-weight: bold;">Sorry you dont have permission</span>';
		//header("location:". base_url()."home/logout");
		}
		else
		{
			$this->load->view('admin/header', $data);
 			$this->load->view('admin/contract_line_type',$data);
			$this->load->view('admin/footer', $data);
		}
	}
	public function punch_data()
	{
		$this-> authenticate();
 		$session_data = $this->session->userdata('logged_in');
		$role_id= $session_data['user_role_id'];
 		$role_name= $session_data['user_role_name'];
					
		$id= $session_data['id'];
		$user_name= $session_data['username'];
					
		$data['role_id']=$role_id;
		$data['role_name']=$role_name;
		$data['user_id']=$id;
		$data['user_name']=$user_name;
		$data["link_val1"]="deactive";
		$data["link_val2"]="deactive";
		$data["link_val3"]="deactive";
		$data["link_val4"]="deactive";
		$data["link_val5"]="active";
 		$data['title'] = 'Admin: Data';
		$data['products'] = $this -> sales_model -> get_products_list();
		$data['accounts'] = $this -> sales_model -> get_acctmanager_list();
		$data['campaigns']= $this -> sales_model -> get_campaign_list();
		$data['audience'] = $this -> sales_model -> get_audience_list();
		$data['type']=$this -> sales_model -> get_clients_type();
		if($role_id!=2)
		{
   			echo '<span style="color: #888; font-weight: bold;">Sorry you dont have permission</span>';
		//header("location:". base_url()."home/logout");
		}
		else
		{
			$this->load->view('admin/header', $data);
 			$this->load->view('admin/punch_data',$data);
			$this->load->view('admin/footer', $data);
		}
	}
	public function manage_stations()
	{
		$this-> authenticate();
		$session_data = $this->session->userdata('logged_in');
		$role_id= $session_data['user_role_id'];
		$role_name= $session_data['user_role_name'];
		$id= $session_data['id'];
		$user_name= $session_data['username'];
		$data["link_val1"]="deactive";
		$data["link_val2"]="deactive";	
		$data["link_val3"]="deactive";
		$data["link_val4"]="deactive";
		$data["link_val5"]="active";
		$data['title'] = 'Admin: Data';
		$data['role_id']=$role_id;
		$data['role_name']=$role_name;
		$data['user_id']=$id;
		$data['user_name']=$user_name;
		$data['stations']=$this->analytics_model->get_radio_stations();
		$this->load->view('admin/header', $data);
 	    $this->load->view('admin/manage_stations',$data);
	    $this->load->view('admin/footer', $data);
	}
	public function add_station()
	{
		$this->analytics_model->add_radio_station($this->input->post('station'),$this->input->post('url'));
	}
	public function get_stations()
	{
		echo json_encode($this->analytics_model->get_radio_stations($this->input->post('id')));
		
	}
	public function get_station_datatable()
	{
		$info=array();
		$x=$this->analytics_model->get_radio_stations();
		foreach($x as $key=>$value)
		{
			unset($value['status']);
			array_unshift($value,"<input type='checkbox' class='station_id' value='".$value['id']."'/>");
			array_push($value,"<a class=\"edit ml10\" href=\"javascript:void(0)\" onclick=\"modal_populate(".$value['id'].")\" data-toggle=\"modal\" data-target=\"#editModal\" title=\"Edit\"><i class=\"glyphicon glyphicon-edit\"></i></a>");
			array_push($info,array_values($value));
			
		}
		$data=array(
			         'draw'=>1,	
				      'recordsTotal'=>23,
				      'recordsFiltered'=>23,
				      'data'=>$info
		           );
	    echo json_encode($data);
		
	}
	public function delete_station()
	{
		$station=$this->input->post('station');
		foreach ($station as $key=>$value)
		{
			$this->analytics_model->delete_station($value);
		}	
	}
	public function edit_station()
	{
		$data=array('name'=>$this->input->post('name'),'url'=>$this->input->post('url'));
		$id=$this->input->post('id');
		$this->analytics_model->edit_radio_station($data,$id);
	}
	public function get_station_details()
	{
		echo json_encode($this->analytics_model->get_radio_station_details($this->input->post('id')));
	}
	public function graph_generator()
	{
		$x=$this->admin_model->account_manager_sales($this->input->post('month'),$this->input->post('year'));
		$p=array();
		array_push($p,array('account manager','sales'));
		foreach($x as $key=>$value)
		{
			array_push($p,array_values($value));
		}
		echo json_encode($p,JSON_NUMERIC_CHECK);
	}
	public function dashboard_graph_generator()
	{
		$x=$this->admin_model->graph_data();
		$p=array('sales'=>array(),'time'=>array());
		array_push($p['sales'],array('account manager','sales'));
		foreach($x['sales'] as $key=>$value)
		{
			array_push($p['sales'],array_values($value));
		}
		$p['time']=$x['time'];
		echo json_encode($p,JSON_NUMERIC_CHECK);
	}
	public function save_graph()
	{
		$this->admin_model->save_graph($this->input->post('month'),$this->input->post('year'));
	}
	public function graph_sales()
	{
		$this-> authenticate();
		$session_data = $this->session->userdata('logged_in');
		$role_id= $session_data['user_role_id'];
 		$role_name= $session_data['user_role_name'];
					
		$id= $session_data['id'];
		$user_name= $session_data['username'];
					
		$data['role_id']=$role_id;
		$data['role_name']=$role_name;
		$data['user_id']=$id;
		$data['user_name']=$user_name;
		$data["link_val1"]="deactive";
		$data["link_val2"]="deactive";
		$data["link_val3"]="deactive";
		$data["link_val4"]="deactive";
		$data["link_val5"]="active";
 		$data['title'] = 'Admin:Graph';
		//$data['platform']=$this -> admin_model-> account_manager_sales(3,2015);
		if($role_id!=2)
		{
   			echo '<span style="color: #888; font-weight: bold;">Sorry you dont have permission</span>';
		//header("location:". base_url()."home/logout");
		}
		else
		{	 
		   $this->load->view('admin/header', $data);
		   $this->load->view('admin/graph',$data);
		   $this->load->view('admin/footer', $data);
		}
	}
} 
?>