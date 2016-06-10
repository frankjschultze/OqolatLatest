<?php
class Admin_model extends CI_Model {

	public function __construct() {
		$this -> load -> database();
	}

	public function get_users_data() {
		$query = $this->db->where('users_role !=', 2);
		$query =$this -> db -> order_by("users_status", "desc");
		$query = $this -> db -> get('users');
		if ($query -> num_rows() > 0) {
			return $query -> result_array();
		} else {
			return false;
		}

	}
	public function get_roles_details()
	{
		$query = $this->db->where('roles_id >', 2);
		$query = $this -> db -> get("user_roles");
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
		$role=$this -> input -> post('role_id');
		if($role=="") 
			$role=1;
		$data = array('email' => $email, 'fname' => $fname, 'lname' => $lname, 'tel_number' => $tel, 'mob_number' => $mobile, 'add1' => $adr1, 'add2' => $adr2, 'add3' => $adr3, 'pcode' => $pcode, 'users_role' => $role);
        $this -> db -> where('user_id', $user_id);
		$upd = $this -> db -> update('users', $data);
		return $upd;
	}
	public function activate_user($user_id, $role_id)
	{
		$data = array('users_status' => 1, 'users_role' => $role_id);
		$this -> db -> where('user_id', $user_id);
		$upd = $this -> db -> update('users', $data);
	}
	public function change_user_status($uid, $status)
	{
		if($status==2)
			$data = array('users_status' => 1);
		else 
			$data = array('users_status' => 2);
		$this -> db -> where('user_id', $uid);
		$upd = $this -> db -> update('users', $data);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
		 
		/*
		$query = $this->db->where('user_id', $uid);
				  $query = $this->db->limit(1,0);
				  $query = $this->db->delete('users');
				  return ($this->db->affected_rows() > 0) ? TRUE : FALSE;*/
		
	}
	public function delete_users_data_selected($uid)
	{
		$data=explode(',', $uid);
		$this->db->where_in('user_id', $data);
		$this->db->delete('users');
      	return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}
	public function get_users_roles()
	{
		//$query = $this->db->where('roles_id >', 1);
		$query = $this -> db -> get('user_roles');
		if ($query -> num_rows() > 0) {
			return $query -> result_array();
		} else {
			return false;
		}
	}
	public function insert_user_role()
	{
		$role=$this->input->post('role');
		$data = array('roles_name' => $role);
		$ins=$this->db->insert("user_roles", $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
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
	public function delete_user_role($rid)
	{
		$query = $this -> db -> where('roles_id', $rid);
		$query = $this -> db -> limit(1,0);
		$query = $this -> db -> delete('user_roles');
		return ($this -> db -> affected_rows() > 0) ? TRUE : FALSE;
	}
	public function get_table_view($id, $table)
	{
		$condition=array('user_id' => $id, 'table_name' => $table);
		$query = $this->db->where($condition);
		$query = $this -> db -> get('dataTable_view');
		if ($query -> num_rows() > 0) {
			return $query -> result_array();
		} else {
			return false;
		}
	}
	public function get_platform_list()
	{
		$query = $this -> db -> get("platform");
		if ($query -> num_rows() > 0) {
			return $query -> result_array();
		} else {
			return false;
		}
	}
	public function get_type_list()
	{
		$query = $this -> db -> get("contract_line_types");
		if ($query -> num_rows() > 0) {
			return $query -> result_array();
		} else {
			return false;
		}
	}
	public function account_manager_sales($month,$year)
	{
		    $this -> db -> select('acct_managers.acct_manager,IFNULL(SUM(contract_lines.line_total),0) AS total',FALSE);
		    $this -> db -> from('acct_managers');
		    $this -> db -> join('clients','clients.acct_manager=acct_managers.acct_manager_id','left');
			$this -> db -> join('contracts','contracts.client=clients.client_id','left');
			$this -> db -> join('contract_lines', 'contract_lines.contract_id = contracts.id AND MONTH( contract_lines.create_time )='.$month.' AND YEAR( contract_lines.create_time )='.$year,'left');
			$this -> db -> group_by('acct_managers.acct_manager');
			$query=$this->db->get();
			return $query->result_array();
	}
	public function graph_data()
	{
		$this -> db -> select('month,year');
		$this -> db -> from('graph');
		$query=$this->db->get();
		$result=$query->result_array();
		$time=array('month'=>$result[0]['month'],'year'=>$result[0]['year']);
		$sales=$this->account_manager_sales($result[0]['month'],$result[0]['year']);
		$details=array('time'=>$time,'sales'=>$sales);
		return $details;
	}
	public function save_graph($month, $year)
	{
		    $this->db->empty_table('graph');
		    $data = array(
				    'month' => $month ,
				    'year' =>  $year 
		         );
		    $this->db->insert('graph', $data);
	}
}
