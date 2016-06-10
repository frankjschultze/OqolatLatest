<?php
class Sales_model extends CI_Model {

	public function __construct() {
		$this -> load -> database();
	}

	public function create_client() {
		$sts=$this->input->post('sts');
		if($sts!=1)
			$sts=2;
		$product_id = $this -> input -> post('c_product');
		$campaign_id = $this -> input -> post('c_campaign');
		$audience=$this->input->post('c_audience');
		if($audience)
			$aud=implode(":",$audience);
		else
			$aud=null;
		if($product_id=="")
			$product_id=null;
		if($campaign_id=="")
			$campaign_id=null;
		$acm= $this-> input -> post('c_acm');
		if($acm=="")
			$acm=null;
		$data = array(
		'name' => $this -> input -> post('name'),
		'email' => $this -> input -> post('email'),
		'mobile' => $this -> input -> post('mob'),
		'phone' => $this -> input -> post('phone'),
		'pcode' => $this -> input -> post('post'),
		'physical_address_1' => $this -> input -> post('adr1'),
		'physical_address_2' => $this -> input -> post('adr2'),
		'physical_address_3' => $this -> input -> post('adr3'),
		'post_address_1' => $this -> input -> post('padr1'),
		'post_address_2' => $this -> input -> post('padr2'),
		'post_address_3' => $this -> input -> post('padr3'),
		'client_status' => $sts,
		'client_discount' => $this -> input -> post('discount'),
		'client_type' => $this -> input -> post('type'),
		'product_id' => $product_id,
		'campaign_id' => $campaign_id,
		'target_audience_id' =>  $aud,
		'acct_manager' => $acm
		);
		return $this -> db -> insert('clients', $data);
	}
	public function get_clients_data()
	{
		$query =$this -> db -> order_by("client_status", "desc");
		$query = $this -> db -> get('clients');
		if ($query -> num_rows() > 0) {
			return $query -> result_array();
		} else {
			return false;
		}
		
	}
	public function get_clients_type()
	{
		$query = $this -> db -> get("client_type");
		if ($query -> num_rows() > 0) {
			return $query -> result_array();
		} else {
			return false;
		}
	}
	public function change_client_status($cid, $status)
	{
		if($status==2)
			$data = array('client_status' => 1);
		else 
			$data = array('client_status' => 2);
		$this -> db -> where('client_id', $cid);
		$query = $this -> db -> limit(1,0);
		$upd = $this -> db -> update('clients', $data);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}
	public function update_client_data()
	{
		$client_id=$this->input->post('client_id');
		//$acct_id = $this -> input -> post('acm');
		$client_discount = $this -> input -> post('discount');
		$sts=$this -> input -> post('sts');
		if($sts!=1)
			$sts=2;
		//if($acct_id=="")
		//	$acct_id=null;
		$data = array(
		'name' => $this -> input -> post('name'),
		'email' => $this -> input -> post('email'),
		'mobile' => $this -> input -> post('mobile'),
		'phone' => $this -> input -> post('phone'),
		'pcode' => $this -> input -> post('post'),
		'physical_address_1' => $this -> input -> post('adr1'),
		'physical_address_2' => $this -> input -> post('adr2'),
		'physical_address_3' => $this -> input -> post('adr3'),
		'post_address_1' => $this -> input -> post('padr1'),
		'post_address_2' => $this -> input -> post('padr2'),
		'post_address_3' => $this -> input -> post('padr3'),
		'client_type' => $this -> input -> post('type_id'),
		//'acct_manager' => $acct_id,
		'client_status' => $sts,
		'client_discount' => $this -> input -> post('discount')
		);

		$this -> db -> where('client_id', $client_id);
		$query = $this -> db -> limit(1,0);
		$upd = $this -> db -> update('clients', $data);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}
	public function delete_clients_data_selected($cid)
	{
		$data=explode(',', $cid);
		$this->db->where_in('client_id', $data);
		$this->db->delete('clients');
      	return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}
	public function insert_client_type()
	{
		$type=$this->input->post('type');
		$data = array('type_name' => $type);
		$ins=$this->db->insert("client_type", $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}
	public function delete_client_type($rid)
	{
		$check=$this->check($rid);
		if($check) {
		$query = $this -> db -> where('type_id', $rid);
		$query = $this -> db -> limit(1,0);
		$query = $this -> db -> delete('client_type');
		return ($this -> db -> affected_rows() > 0) ? TRUE : FALSE;
		}
		else {
			return false;
		}
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
	public function get_campaign_list()
	{
		$query = $this -> db -> get("campaigns");
		if ($query -> num_rows() > 0) {
			return $query -> result_array();
		} else {
			return false;
		}
	}
	public function get_audience_list()
	{
		$query = $this -> db -> get("target_audience");
		if ($query -> num_rows() > 0) {
			return $query -> result_array();
		} else {
			return false;
		}
	}
	public function update_client_advertiser()
	{
		$client_id=$this->input->post('client_id');
		$product_id = $this -> input -> post('product_id');
		$campaign_id = $this -> input -> post('campaign_id');
		$audience=$this->input->post('audience');
		if($audience)
			$aud=implode(":",$audience);
		else
			$aud=null;
		if($product_id=="")
			$product_id=null;
		if($campaign_id=="")
			$campaign_id=null;
		$data = array(
		'product_id' => $product_id,
		'campaign_id' => $campaign_id,
		'target_audience_id' =>  $aud
		);

		$this -> db -> where('client_id', $client_id);
		$query = $this -> db -> limit(1,0);
		$upd = $this -> db -> update('clients', $data);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}
	public function update_account()
	{
		$client_id=$this->input->post('client_id');
		$acm= $this-> input -> post('acm');
		if($acm=="")
			$acm=null;
		$data = array(
		'acct_manager' => $acm
		);
		
		$this -> db -> where('client_id', $client_id);
		$query = $this -> db -> limit(1,0);
		$upd = $this -> db -> update('clients', $data);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}
	public function delete_product($pid)
	{
		$query = $this -> db -> where('product_id', $pid);
		$query = $this -> db -> limit(1,0);
		$query = $this -> db -> delete('products');
		return ($this -> db -> affected_rows() > 0) ? TRUE : FALSE;
	}
	public function delete_manager($mid)
	{
		$query = $this -> db -> where('acct_manager_id', $mid);
		$query = $this -> db -> limit(1,0);
		$query = $this -> db -> delete('acct_managers');
		return ($this -> db -> affected_rows() > 0) ? TRUE : FALSE;
	}
	public function delete_campaign($cid)
	{
		$query = $this -> db -> where('campaign_id', $cid);
		$query = $this -> db -> limit(1,0);
		$query = $this -> db -> delete('campaigns');
		return ($this -> db -> affected_rows() > 0) ? TRUE : FALSE;
	}
	public function delete_audience($aid)
	{
		$query = $this -> db -> where('target_audience_id', $aid);
		$query = $this -> db -> limit(1,0);
		$query = $this -> db -> delete('target_audience');
		return ($this -> db -> affected_rows() > 0) ? TRUE : FALSE;
	}
	public function insert_product()
	{
		$product=$this->input->post('product');
		$data = array('product_name' => $product);
		$ins=$this->db->insert("products", $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}
	public function insert_manager()
	{
		$manager=$this->input->post('acnt');
		$data = array('acct_manager' => $manager);
		$ins=$this->db->insert("acct_managers", $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}
	public function insert_campaign()
	{
		$campaign=$this->input->post('cmpgn');
		$data = array('campaign_name' => $campaign);
		$ins=$this->db->insert("campaigns", $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}
	public function insert_audience()
	{
		$audience=$this->input->post('adns');
		$data = array('target_audience' => $audience);
		$ins=$this->db->insert("target_audience", $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}
	public function check($rid)
	{
		$query = $this -> db -> where('client_type', $rid);
		$query = $this -> db -> get('clients');
		if ($query -> num_rows() > 0) {
			return false;
		} else {
			return true;
		}
	}
	

}
