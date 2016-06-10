<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
session_start();
class Users extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

	 public function __construct()
			{
			parent::__construct();
			$this->load->model('user_model');
			}
	
	public function register($page = 'register') {
		if (!file_exists(APPPATH . '/views/users/' . $page . '.php')) {
			// Whoops, we don't have a page for that!
			show_404();
		}
		$data['title'] = ucfirst($page);
		// Capitalize the first letter
		
		$this -> load -> view('users/' . $page, $data);
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
	public function create()
		{
		$this->load->helper('form');
		$this->load->library('form_validation');
	
		$data['title'] = 'User Registration';
	
		$this->form_validation->set_rules('username', 'Username', 'required|min_length[5]|max_length[12]|is_unique[users.username]');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
				$this->form_validation->set_rules('fname', 'First Name', 'required');
				$this->form_validation->set_rules('tel', '', '');
				$this->form_validation->set_rules('lname', '', '');
				$this->form_validation->set_rules('mobile', 'Mobile Number', 'required|numeric|greater_than[0.99]');
				$this->form_validation->set_rules('postal', 'Postal/zip code', 'required|numeric|greater_than[0.99]'); 
				$this->form_validation->set_rules('adr1','Address','required');
				$this->form_validation->set_rules('adr2','','');
				$this->form_validation->set_rules('adr3','','');
		$this->form_validation->set_rules('password', 'Password', 'required|matches[password_check]');
		$this->form_validation->set_rules('password_check', 'Re-type password', 'required');
	
		if ($this->form_validation->run() === FALSE)
		{
			//$this->load->view('templates/header', $data);
			$this->load->view('users/register');
			//$this->load->view('templates/footer');
	
		}
		else
		{
			$ins=$this->user_model->insert_user();
			if($ins)
			{
				$data['msg']="Successful registration. Login here";
				$this->load->view('users/login', $data);
				//$this->load->view('users/login');
			}
		}
		
	}
		public function login()
		{
			$this->load->view('users/login');
		}
		public function login_check()
		{
			//$this->load->library('session');
			
			$this->load->library('form_validation');
			$this->form_validation->set_rules('username','Username','trim|required|xss_clean');
			$this->form_validation->set_rules('password','password','trim|required|xss_clean|callback_check_database');
			$username=$this->input->post('username');
		//	$password=$this->input->post('password');
			//$check=$this->user_model->login_check();
			if($this->form_validation->run() == FALSE)
			{
				$data["error"]="Invalid User Id and Password combination";
				$this->load->view('users/login', $data);
			}
			else
			{
				$this->authenticate();
				$role=$this->check_user_role();
				if($role)
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
					
					if($role_id==2)
					{
						$data['title']='Admin';
						$data["link_val1"]="active";
						$data["link_val2"]="deactive";
						$data["link_val3"]="deactive";
						$data["link_val4"]="deactive";
						$data["link_val5"]="deactive";
						$this->load->view('admin/header', $data);
						$this->load->view('users/dashboard', $data);
						$this->load->view('admin/footer', $data);
						//$this->load->view('admin/admin_home', $data);
					}
					else if($role_id==1)
					{
						echo 'Registerd user. Role not activated!. Contact admin';
						//$this->load->view('admin/admin_home', $data);
					}
					else if($role_id==3)
					{
						$data['title']='Sales';
						$data["link_val1"]="active";
						$data["link_val2"]="deactive";
						$this->load->view('Roles/Common/header', $data);
						$this->load->view('users/dashboard', $data);
						$this->load->view('Roles/Common/footer', $data);
					}
					else if($role_id==4)
					{
						$data['title']='Traffic';
						$data["link_val1"]="active";
						$data["link_val2"]="deactive";
						$this->load->view('Roles/Common/header', $data);
						$this->load->view('users/dashboard', $data);
						$this->load->view('Roles/Common/footer', $data);
					}
					else if($role_id==5)
					{
						$data['title']='Analytics';
						$data["link_val1"]="active";
						$data["link_val2"]="deactive";
						$this->load->view('Roles/Common/header', $data);
						$this->load->view('users/dashboard', $data);
						$this->load->view('Roles/Common/footer', $data);
					}
					else 
					{
						$data['title']='user';
						$this->load->view('users/home', $data);
					}
					
				}
				else 
				{
					$data["error"]="User role not activated";
					$this->load->view('users/login', $data);
				}
				//$this->session->set_userdata('session_user', $username);
				//redirect('home', 'refresh');
				//$this->load->view('users/home', $data);
			}	
		}
		public function check_database($password)
		{
			$username=$this->input->post('username');
			$result = $this->user_model->login_check($username, $password);
			if($result)
			{
				$sess_array = array();
     			foreach($result as $row)
     			{
       				$sess_array = array(
         			'id' => $row -> user_id,
         			'username' => $row -> username,
         			'user_role_id' => $row -> users_role
					  );
       				$this->session->set_userdata('logged_in', $sess_array);
     			}
     			return TRUE;
     			
			}
			else
			{
				$this->form_validation->set_message('check_database', 'Invalid username or password');
     			return false;
			}
		}
		public function check_user_role()
		{
			$this->authenticate();
			$session_data = $this->session->userdata('logged_in');
 			$role_id= $session_data['user_role_id'];
			$user_id= $session_data['id'];
			$username=$session_data['username'];
			$role=$this->user_model->get_user_role($role_id);
			if($role)
			{
				foreach($role as $row)
				{
					$sess_array = array(
									'id' => $user_id,
         							'username' => $username,
         							'user_role_id' => $role_id,
									'user_role_name' => $row->roles_name
									  );
					$this->session->set_userdata('logged_in', $sess_array);		
				}
				return true;
			}
			else {
				return false;
			}
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
		public function settings_get_user()
 		{
 			$id=$this -> input -> POST('user_id');
 			$data['edit_result']=$this->user_model->get_user_data($id);
 	
			$edit_data=json_encode($data['edit_result']);
			echo $edit_data;
 		}
		public function settings_user_update()
 		{
 			//echo 'success';
			$this-> authenticate();
			$user_id = $this -> input -> post('user_id');
			$upd=$this->user_model->update_users_data();
			echo $upd;
		}
		public function settings_check_password()
		{
			$this->authenticate();
			$check=$this->user_model->check_password();
			echo $check;
		}
		public function send_mail($from,$fname,$to,$tname,$subject,$msg)
		{
			$this->load->library('email');
			$this->email->set_mailtype("html");
            $this->email->from($from, $fname);
			$this->email->to($to);
			$this->email->subject($subject);
			$this->email->message($msg);
			$this->email->send();
		}
		public function change_password()
		{
			$this->load->helper('url');
			$data['msg']="";
			$data['test']="";
			$data['email']="";
			$data['active']="";
			if($this->input->post('pword'))
			{	
			      $this->load->library('form_validation');
			      $this->form_validation->set_rules('pword', 'Password', 'trim|required|matches[cpword]|min_length[6]|max_length[18]');
			      if($this->form_validation->run()==TRUE)
			      {	
			         $this->user_model->update_password($this->session->flashdata('activate_id'),$this->input->post('pword')); 
			      	 $data['msg']="Password has been successfully changed. You can login <a href='".site_url()."'>here</a>";
			      }    
			}
			else if($this->input->post('email'))
			{
				$data['email']=$this->input->post('email');
				if(!$this->user_model->check_user_by_email($this->input->post('email')))
				{
					$data['msg']="Your email address is not registered in our database";
				}
				else
				{
					$id=$this->user_model->pchange_link($this->input->post('email'));
					if($id)
					{	
					  $activation_link=site_url('users/change_password?activate='.$id);
					   $msg = <<< html
                                         Hello,<br/><br>
					
                                         <p>Please click <a href='$activation_link'>here</a> to change the password. Otherwise go to this url: $activation_link.</p><br><br>
                                         		
                                         Thanks, <br>
					                     Admin.
html;
					
					  $this->send_mail("admin@dovecor.com","admin",$this->input->post('email'),"","Change Password",$msg);
					  $data['test']=$msg;
					  $data['msg']="An activation link has been sent to your mail";
					}
					else
					{
						$data['msg']="An activation link has already been sent to your mail";
					}
				}
			}
			else if($this->input->get('activate'))
			{
				$this->load->library('session');
				if($this->user_model->check_activate_id($this->input->get('activate')))
				{
					$data['active']=$this->input->get('activate');
					$this->session->set_flashdata('activate_id', $data['active']);
				}
				else 
				{
					$data['msg']="The activation link you provided has expired or the link doesn't exist";
				}		
			}	
			else 
			{
				
			}	
			$this->load->view('users/change_password',$data);
		}
		public function settings_change_password()
		{
		    $this -> authenticate();
			$msg=$this->user_model->change_password();
			echo $msg;
		}
		public function preserve_datatable_view()
		{
			$this->authenticate();
			$user_id=$this-> input -> post('user_id');
			$table_val=$this->input->post('table_val');
			$table=$this->input->post('table');
			$upd=$this->user_model->set_datatable_view($user_id, $table_val, $table);
			echo $upd;
		}
		
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
