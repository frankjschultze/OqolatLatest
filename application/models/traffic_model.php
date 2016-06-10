<?php
class Traffic_model extends CI_Model {

	public function __construct() {
		$this -> load -> database();
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
	
	public function insert_platform()
	{
		$platform=$this->input->post('pfm');
		$des_pfm=$this->input->post('des_pfm');
		$data = array('name' => $platform, 'description' => $des_pfm);
		$ins=$this->db->insert("platform", $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}
	public function delete_platform($pfm)
	{
		$query = $this -> db -> where('id', $pfm);
		$query = $this -> db -> limit(1,0);
		$query = $this -> db -> delete('platform');
		return ($this -> db -> affected_rows() > 0) ? TRUE : FALSE;
	}
	public function insert_type()
	{
		$type=$this->input->post('type');
		$des_type=$this->input->post('des_type');
		$data = array('name' => $type, 'description' => $des_type);
		$ins=$this->db->insert("contract_line_types", $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}
	public function delete_type($tid)
	{
		$query = $this -> db -> where('id', $tid);
		$query = $this -> db -> limit(1,0);
		$query = $this -> db -> delete('contract_line_types');
		return ($this -> db -> affected_rows() > 0) ? TRUE : FALSE;
	}
	public function get_clients_list()
	{
		
		$query = $this -> db -> order_by("name", "asc");
		$query = $this -> db -> get("clients");
		if ($query -> num_rows() > 0) {
			return $query -> result_array();
		} else {
			return false;
		}
	}
	public function get_contract_list()
	{
		$query = $this -> db -> order_by("id", "asc");
		$query = $this -> db -> get("contracts");
		if ($query -> num_rows() > 0) {
			return $query -> result_array();
		} else {
			return false;
		}
	}
	public function get_contract_products_list()
	{
		//$this->db->select('*'); // <-- There is never any reason to write this line!
		$this->db->from('contracts');
		$this->db->join('clients', 'clients.client_id = contracts.client');
		$query = $this -> db -> order_by("id", "asc");
		$query = $this->db->get();
		if ($query -> num_rows() > 0) {
			return $query -> result_array();
		} else {
			return false;
		}
	}
	
	public function get_products_list()
	{
		$query = $this -> db -> get("products");
		if ($query -> num_rows() > 0) {
			return $query -> result_array();
		} else {
			return false;
		}
	}
	public function get_acctmanager_list()
	{
		$query = $this -> db -> get("acct_managers");
		if ($query -> num_rows() > 0) {
			return $query -> result_array();
		} else {
			return false;
		}
	}
	public function create_contract() {
		$this->load->helper('form');
		$this->load->library('form_validation');
		$start_dt=$this -> input -> post('start_dt');
		$end_dt=$this -> input -> post('end_dt');
		$client = $this -> input -> post('nm_client');
		$account=$this -> input -> post('account');
		if(!$account)
			$account=NULL;
		$this->form_validation->set_rules('contract_no', 'contract_no', 'is_unique[contracts.contract_no]');
		if($this->form_validation->run() === FALSE)
		{
			return 'This Contract Number already exists. Insertion Failed';
		}
		else {
			
		$data = array(
		'contract_no' => $this -> input -> post('contract_no'),
		'status' => 1,
		'client' => $this -> input -> post('nm_client'),
		'account' => $account,
		'order_no' => $this -> input -> post('order_no'),
		'contact' => $this -> input -> post('contact'),
		'description' => $this -> input -> post('contract_des'),
		'start' => date('Y-m-d', strtotime($start_dt)),
		'end' =>date('Y-m-d', strtotime($end_dt)),
		'discount' => $this -> input -> post('discount'),
		'acct_discount' => $this -> input -> post('acct_discount'),
		'notes' => $this -> input -> post('notes')
		);
			$ins= $this -> db -> insert('contracts', $data) or die(mysql_error());
			if($ins)
			{
				$id=$this->db->insert_id();
				$data1 = array(
				'product_id' => $this -> input -> post('nm_product'),
				'acct_manager' => $this -> input -> post('nm_acm'),
				'client_discount' => $this -> input -> post('nm_discount')
			);
			$this -> db -> where('client_id', $client);
			$query = $this -> db -> limit(1,0);
			$upd1 = $this -> db -> update('clients', $data1);
			return $id;
			}
		}
	}
	public function create_contractline()
	{
		$linestart_dt=$this -> input -> post('linestart_dt');
		$lineend_dt=$this -> input -> post('lineend_dt');
		
		$cno=$this -> input -> post('line_cno');
		if(!$cno)
			$cno=$this -> input -> post('line_contract');
		$data = array(
		'contract_id' => $cno,
		'platform_id' => $this -> input -> post('line_platform'),
		'type_id' => $this -> input -> post('line_type'),
		'start_time' => date('H:i', strtotime($linestart_dt)),
		'end_time' =>date('H:i', strtotime($lineend_dt)),
		'description' => $this -> input -> post('line_des'),
		'rate' => $this -> input -> post('line_rate'),
		'quantity' => $this -> input -> post('line_qnty'),
		'line_total' => $this -> input -> post('line_total'),
		'duration' => $this -> input -> post('line_duration')
		);
		$ins=$this -> db -> insert('contract_lines', $data) or die(mysql_error());
		return $this->db->insert_id();
		
	}
	public function delete_contracts_data_selected($cid)
	{
		$data=explode(',', $cid);
		$this->db->where_in('id', $data);
		$this->db->delete('contracts');
      	return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}
	public function change_contract_status($cid, $status)
	{
		if($status==2)
			$data = array('status' => 1);
		else 
			$data = array('status' => 2);
		$this -> db -> where('id', $cid);
		$query = $this -> db -> limit(1,0);
		$upd = $this -> db -> update('contracts', $data);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}
	public function update_contract_data()
	{
		$contract_id=$this->input->post('contract_id');
		$sts=$this -> input -> post('status');
		if($sts!=1)
			$sts=2;
		//if($acct_id=="")
		//	$acct_id=null;
		$start_dt=$this -> input -> post('start_dt');
		$end_dt=$this -> input -> post('end_dt');
		
		$data = array(
		'contract_no' => $this -> input -> post('contract_no'),
		'order_no' => $this -> input -> post('order_no'),
		
		'discount' => $this -> input -> post('discount'),
		'start' => date('Y-m-d', strtotime($start_dt)),
		'end' => date('Y-m-d', strtotime($end_dt)),
		'contact' => $this -> input -> post('contact'),
		'description' => $this -> input -> post('contract_des'),
		'notes' => $this -> input -> post('notes'),
		'status' => $sts
		);

		$this -> db -> where('id', $contract_id);
		$query = $this -> db -> limit(1,0);
		$upd = $this -> db -> update('contracts', $data);
		return ($this -> db -> affected_rows() > 0) ? TRUE : FALSE;
	}
	public function update_client_data()
	{
		
		$contract_id=$this->input->post('contract_id');
		$old_client=$this->input->post('old_client');
		$new_client=$this->input->post('new_client');
		$account=$this -> input -> post('account1');
		if(!$account)
			$account=NULL;
		$upd=0;
		$upd1=0;
		$data = array(
		'client' => $this -> input -> post('new_client'),
		'acct_discount' => $this -> input -> post('ac_discount'),
		'account' => $account
		
		);
		$this -> db -> where('id', $contract_id);
		$query = $this -> db -> limit(1,0);
		$upd = $this -> db -> update('contracts', $data);
		$x=($this -> db -> affected_rows() > 0) ? TRUE : FALSE;
		
		$data1 = array(
		'product_id' => $this -> input -> post('nm_product'),
		'acct_manager' => $this -> input -> post('acm'),
		'client_discount' => $this -> input -> post('nm_discount')
		
		);
		$this -> db -> where('client_id', $new_client);
		$query = $this -> db -> limit(1,0);
		$upd1 = $this -> db -> update('clients', $data1);
		$upd1 = $this -> db -> affected_rows();
		$y= ($this -> db -> affected_rows() > 0) ? TRUE : FALSE;
		return ($x || $y);
	}
	public function get_contract_line($slug=FALSE)
	{
		if(!$slug) {
		$id=$this-> input -> post('contract_id');
		$query= $this-> db -> where("contract_id = ", $id);
		}
		$query = $this -> db -> order_by("contract_id", "asc");
		$query = $this -> db -> get("contract_lines");
		if ($query -> num_rows() > 0) {
			return $query -> result_array();
		} else {
			return false;
		}
	}
	public function delete_contracts_line_selected($cid)
	{
		$data=explode(',', $cid);
		$this->db->where_in('id', $data);
		$this->db->delete('contract_lines');
      	return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}
	public function delete_contracts_line_update_total($cid)
	{//Select Line total to update Total in the table 
		$data=explode(',', $cid);
		$this->db->select('line_total');
		$msg=$this->db->where_in('id', $data); 
	//Delete selected
      	$query = $this -> db -> get("contract_lines");
		$this->db->where_in('id', $data);
		$this->db->delete('contract_lines');
      	return $query -> result_array();
	}
	public function get_contract_line_unique()
	{
		$id=$this-> input -> post('line_id');
		$query= $this-> db -> where("id = ", $id);
		$query = $this -> db -> order_by("id", "asc");
		$query = $this -> db -> get("contract_lines");
		if ($query -> num_rows() > 0) {
			return $query -> result_array();
		} else {
			return false;
		}
	}
	public function update_contract_line()
	{
		$start=$this -> input -> post('start');
		$end=$this -> input -> post('end');
		$line_id=$this -> input -> post('line_id');
		$rate=$this -> input -> post('rate');
		$qnty=$this -> input -> post('qnty');
		if(!$qnty)
			$qnty= 1;
		$line_total = $rate*$qnty;
		$data = array(
		'platform_id' => $this -> input -> post('pid'),
		'type_id' => $this -> input -> post('type'),
		'start_time' => date('H:i', strtotime($start)),
		'end_time' =>date('H:i', strtotime($end)),
		'description' => $this -> input -> post('des'),
		'rate' => $this -> input -> post('rate'),
		'duration' => $this -> input -> post('dur'),
		'quantity' => $this -> input -> post('qnty'),
		'line_total' => $line_total
		);
		$this -> db -> where('id', $line_id);
		$query = $this -> db -> limit(1,0);
		$upd = $this -> db -> update('contract_lines', $data);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}
	public function client_type()
	{
		$client_id=$this->input->post('client_id');
		$this->db->from('clients');
		$this->db->join('client_type', 'clients.client_type = client_type.type_id');
		$query= $this-> db -> where("clients.client_id = ", $client_id);
		//$query= $this-> db -> where("client_type.type_id != ", 2);
		$query = $this->db->get();
		if ($query -> num_rows() > 0) {
			return $query -> result_array();
		} else {
			return false;
		}
		
	}
	public function get_contract_line_search($slug=FALSE)
	{
		if($slug)
		{
			$month=date('m', strtotime($slug)); 
			$year=date('Y',strtotime($slug));
			$this->db->from('contract_lines');
			$this->db->join('contracts', 'contract_lines.contract_id = contracts.id');
			$query= $this-> db -> where("EXTRACT(MONTH FROM contracts.start) = ", $month);
			$query= $this-> db -> where("EXTRACT(YEAR FROM contracts.start) = ", $year);
			$query = $this->db->get();
			if ($query -> num_rows() > 0) {
				return $query -> result_array();
			} else {
				return false;
			}
		}
	}
}
