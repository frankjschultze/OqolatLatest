<?php
class User_model extends CI_Model {

	public function __construct() {
		$this -> load -> database();
	}

	public function insert_user() {
		$this -> load -> helper('url');

		$slug = url_title($this -> input -> post('title'), 'dash', TRUE);
		$password= $this -> input -> post('password');
		$password=md5($password);
		$data = array(
		'username' => $this -> input -> post('username'),
		//'slug' => $slug,
		'email' => $this -> input -> post('email'),
		'fname' => $this -> input -> post('fname'),
		'tel_number' => $this -> input -> post('tel'),
		'lname' => $this -> input -> post('lname'),
		'users_company' =>1,
		'add1' => $this -> input -> post('adr1'),
		'add2' => $this -> input -> post('adr2'),
		'add3' => $this -> input -> post('adr3'),
		'mob_number' => $this -> input -> post('mobile'),
		'pcode' => $this -> input -> post('postal'),
		'users_status' => 2,
		'users_role' => 1,
		'password' => $password,
		);

		return $this -> db -> insert('users', $data);
	}
	public function login_check($username,$password)
	{
		$this -> db -> select('user_id, username, password, users_status, users_role');
   		$this -> db -> from('users');
   		$this -> db -> where('username', $username);
   		$this -> db -> where('password', MD5($password));
		$this -> db -> where('users_status', 1);
   		$this -> db -> limit(1);
 
   		$query = $this -> db -> get();
 
   		if($query -> num_rows() == 1)
   		{
     		return $query->result();
   		}
   		else
   		{
     		return false;
   		}
	}
	public function get_user_role($role)
	{
		$query = $this->db->where('roles_id' ,$role );
		$query = $this -> db -> get('user_roles');
		if ($query -> num_rows() > 0) {
			return $query -> result();
		} else {
			return false;
		}
	}
	public function get_user_data($id) {
		$query = $this->db->where('user_id =',$id );
		$query = $this -> db -> get('users');
		if ($query -> num_rows() > 0) {
			return $query -> result_array();
		} else {
			return false;
		}

	}
	public function update_users_data() {
		$user_id = $this -> input -> post('user_id');
		$email = $this -> input -> post('email');
		$fname = $this -> input -> post('fname');
		$lname = $this -> input -> post('lname');
		$tel = $this -> input -> post('tel');
		$mobile = $this -> input -> post('mobile');
		$adr1 = $this -> input -> post('adr1');
		$adr2 = $this -> input -> post('adr2');
		$adr3 = $this -> input -> post('adr3');
		$pcode = $this -> input -> post('pcode');
		
		$data = array('email' => $email, 'fname' => $fname, 'lname' => $lname, 'tel_number' => $tel, 'mob_number' => $mobile, 'add1' => $adr1, 'add2' => $adr2, 'add3' => $adr3, 'pcode' => $pcode);

		$this -> db -> where('user_id', $user_id);
		$upd = $this -> db -> update('users', $data);
		return $upd;
	}
	public function check_password()
	{
		$user_id=$this -> input -> post('user_id');
		$pwd=$this -> input ->post('password');
		$query = $this->db->where('user_id' ,$user_id );
		$query = $this->db->where('password' ,md5($pwd));
		$query = $this -> db -> get('users');
		if ($query -> num_rows() > 0) {
			return true;
		} else {
			return 2;
		}
	}
	public function change_password()
	{
		$user_id=$this->input -> post('user_id');
		$password=$this->input->post('password');
		$data = array('password' => md5($password));
        $this -> db -> where('user_id', $user_id);
		$upd = $this -> db -> update('users', $data);
		return $upd;
	}
	public function update_password($id,$pwd)
	{
		$data = array('users.password'=>md5($pwd));
        $this->db->where('password_change.activation_id', $id);
        $this->db->update('users JOIN password_change ON users.email = password_change.email', $data);
	}
	public function generate_password($email)
	{
		$this->load->helper('string');
		$password = random_string('alnum', 8);
		$data = array('password' => md5($password));
	    $this -> db -> where('email', $email);
		$this -> db -> update('users', $data);
		return $password;
	}
	public function pchange_link($email)
	{
		$num=1;
		$query = $this->db->where('email' ,$email);
		$query = $this->db->where('time BETWEEN timestamp(DATE_SUB(NOW(), INTERVAL 60 MINUTE)) AND timestamp(NOW())');
		$query = $this -> db -> get('password_change');
		if(!$query->num_rows)
		{	
		   $this->db->delete('password_change',array('email'=>$email));
		   while($num)
		   {
		 	   $activation_id = random_string('alnum', 16);
		 	   $query = $this->db->where('activation_id' ,$activation_id);
		 	   $query = $this -> db -> get('password_change');
		 	   $num=$query->num_rows();
		   }
		   $data=array('email'=>$email,'activation_id'=>$activation_id);
		   $this->db->insert('password_change',$data);
		   $id=$data['activation_id'];
		} 
		else 
		{
			$id=0;
		}	
		return $id;
	}
	public function check_activate_id($id)
	{
		$query = $this->db->where('activation_id' ,$id);
		$query = $this -> db -> get('password_change');
		return $query->num_rows;
	}
	public function set_datatable_view($user_id, $table_val, $table)
	{
		if($table_val)
			$table_string=implode(",",$table_val);
		else 
			$table_string=null;
			
			
		$check=$this->check_user($user_id,$table);
		if($check)
		{
			$data = array('table_order' => $table_string);
			$condition=array('user_id' => $user_id, 'table_name' => $table);
			$this -> db -> where($condition);
			$query = $this->db->limit(1,0);
			$upd = $this -> db -> update('dataTable_view', $data);
			return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
		}
		else
		{
			$data = array('user_id' => $user_id, 'table_name' => $table, 'table_order' => $table_string);
			$ins=$this->db->insert('dataTable_view', $data);
			return $ins;
		}
			
	}
	function check_user($user_id, $table)
    {
        $query = null; 
        $query = $this->db->get_where('dataTable_view', array(//making selection
           'user_id' => $user_id, 'table_name'=>$table
        	));

        $count = $query->num_rows(); //counting result from query
        return $count;
    }
    function check_user_by_email($email)
    {
    	$query = $this->db->get_where('users', array('email' => $email));
        $count = $query->num_rows(); //counting result from query
    	return $count;
    }
    
}
