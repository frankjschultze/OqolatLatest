<?php
class Analytics_model extends CI_Model {
	
	public function __construct() 
	{
		$this -> load -> database();
	}
	/*
	 *  This function is used to add radio stations to database.
	 *  param(station) station name
	 *  */
	public function add_radio_station($station,$url)
	{
		$data = array(
				'name' => $station ,
				'url'  => $url,
				'status' => '1' 
		);
		$this->db->insert('radio_stations', $data);
	}
	
	/*
	 *  This function is used to edit radio stations to database.
	*  param(station) array of details to be updated
	*  param(id) id of the station to be edited
	*  */
	public function edit_radio_station($data,$id)
	{
		$this->db->where('id', $id);
		$this->db->update('radio_stations', $data);
		
	}
	
	
	/*
	 *  This function is used to add radio stations to database.
	*  param(station) station id
	*  */
	public function delete_station($station)
	{
		$this->db->delete('radio_stations', array('id' => $station));
	}
	/* 
	 *  This function is used to fetch the available radio stations. 
	 *  If user_id is given as argument it will return the radio stations that the user is subscribed to.
	 *  param(user_id) user id (optional)
	 *  */
	public function get_radio_stations($user=null)
	{
		if($user)
		{
			$this -> db -> select('radio_stations.id,name,user_id,url,status');
			$this -> db -> from('radio_stations');
			$this -> db -> join('radio_stations_subscribers', 'radio_stations.id = radio_stations_subscribers.station_id AND user_id='.$user,'left');
			$this -> db -> where('status','1');
			
		}
		else
		{		
		    $this -> db -> select('id, name,url,status');
		    $this -> db -> from('radio_stations');
		    $this -> db -> where('status','1');
		}
		$query = $this -> db -> get();
		if($query -> num_rows() > 0)
		{
			return $query -> result_array();
		}
		else
		{
			return false;
		}	
	}
	/*
	 *  This function is used to fetch the details of a radio station.
	 *   param(id) station id 
	 *  */
	public function get_radio_station_details($id)
	{
		$this -> db -> select('id, name,url,status');
		$this -> db -> from('radio_stations');
		$this -> db -> where('id',$id);
		$this -> db -> where('status','1');
		$query = $this -> db -> get();
		if($query -> num_rows() > 0)
		{
			return $query -> result_array();
		}
		else
		{
			return false;
		}
	}
	/**
	 * This function check if a user has subscribed to a specific stations
	 * param(user_id) user id
	 * param(station) name of the station that need to be checked
	 */
	public function check_station_subscription($user_id,$station)
	{
	     $this -> db -> select('*');
	     $this -> db -> from('radio_stations_subscribers');
	     $this -> db -> where('user_id',$user_id);
	     $this -> db -> where('station_id',$station); 
	     $query = $this -> db -> get();
	     if($query -> num_rows() > 0)
	     {
	     	return true;
	     }
	     else
	     {
	     	return false;
	     }
	     	
	}
	/**
	 * This function subscribes users to specific stations 
	 * param(user_id) user id
	 * param(stations) array of station ids to which the user need to be subscribed
	 */
	public function subscribe_to_stations($user_id,$stations)
	{
		$this->db->where('user_id', $user_id);
		$this->db->delete('radio_stations_subscribers');
		$data=array();
		if(!empty($stations))
		{	
		    foreach($stations as $value)
			{
				$info=array('user_id'=>$user_id,'station_id'=>$value);
				array_push($data,$info);
			}
			return $this->db->insert_batch('radio_stations_subscribers',$data);
		}
		else
		{
			return false;
		}		
	}	
	
	
}