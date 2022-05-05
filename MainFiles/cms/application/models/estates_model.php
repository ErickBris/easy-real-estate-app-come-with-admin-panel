<?php

/**

 *

 */

class Estates_model extends CI_Model {
	function __construct() {
		parent::__construct();
		$this->load->helper('settings');
	}

	function get($select = "*,estates.id as id", $where = false, $like = false, $first = false, $offset = false, $order_by = false) {
		$data = array();
		$settings= getSettings(CURRENCY_SETTING_FILE);
		if( $order_by != false){
			$order = key($order_by);
			if ($order != null) {
				$sort = $order_by[$order];
				$this -> db -> order_by($order, $sort);
			}
		}else{
			$this->db->order_by('estates.id','DESC');
		}

		$this -> db -> select($select);
		$this -> db -> from('estates');
		if($where != false)
			$this -> db -> where($where);
		if($like != false)
			$this -> db -> like($like);
		if($offset != false){
			$this -> db -> limit($offset, $first);
		}

		$this->db->join('types','estates.types_id = types.id');
		$this->db->join('county','estates.county_id = county.id');
		$this->db->join('users','estates.user_id=users.id');
		$this->db->join('cities','estates.cities_id=cities.id');
		$this->db->join('marker','estates.marker_id=marker.id','left');
		$query = $this -> db -> get();
		if ($query -> num_rows() > 0) {
			foreach ($query->result() as $rows) {
				$data[] = $rows;
			}
			foreach ($data as $r) {
				$r->content=preg_replace('/[\r\n]+/', "",htmlspecialchars_decode($r->content));
				$r->title=preg_replace('/[\r\n]+/', "", $r->title);
				$r->currency=$settings['currency_symbol'];
				$r->created_at=date('d-m-Y H:i:s',strtotime($r->created_at));
				$r->updated_at=date('d-m-Y H:i:s',strtotime($r->updated_at));
				continue;
			}

			$query -> free_result();
			return $data;
		} else {
			return null;
		}
	}

	function get_by_query($query){
		$settings= getSettings(CURRENCY_SETTING_FILE);
		$query=$this->db->query($query);
		if ($query -> num_rows() > 0) {
			foreach ($query->result() as $rows) {
				$data[] = $rows;
			}
			foreach ($data as $r) {
				$r->content=preg_replace('/[\r\n]+/', "",htmlspecialchars_decode($r->content));
				$r->title=preg_replace('/[\r\n]+/', "", $r->title);
				$r->currency=$settings['currency_symbol'];
				$r->created_at=date('d-m-Y H:i:s',strtotime($r->created_at));
				$r->updated_at=date('d-m-Y H:i:s',strtotime($r->updated_at));
				continue;
			}

			$query -> free_result();
			return $data;
		} else {
			return null;
		}
	}

	function total_by_query($query){
		$query = $this -> db -> query($query);
		$rows = $query -> result();
		$query -> free_result();
		return $rows[0] -> total;
	}

	function total($where, $like) {
		$this -> db -> select('count(*) as total');
		if($where!=null || $where!=''){
			$this -> db -> where($where);
		}
		$this -> db -> like($like);
		$this -> db -> from('estates');
		$this->db->join('types','estates.types_id = types.id');
		$this->db->join('county','estates.county_id = county.id');
		$this->db->join('users','estates.user_id=users.id');
		$this->db->join('cities','estates.cities_id=cities.id');
		$query = $this -> db -> get();
		$rows = $query -> result();
		$query -> free_result();
		return $rows[0] -> total;
	}

	function get_by_id($id,$activated=null,$user_activated=null) {
		$select = '*,types.name as type_name,
		cities.name as cities_name,county.name as county_name,
		estates.address as address,
		estates.id as id,estates.created_at as created_at,estates.updated_at as updated_at';
		$where = array('estates.id' => $id);
		if($activated!=null){
			$where['estates.activated']=$activated;
		}
		if($user_activated!=null){
			$where['users.activated']=$activated;
		}
		$like = array();
		$order_by = array();
		return $this -> get($select, $where, $like, 0, 1, $order_by);
	}


	function get_by_user_id($id,$limit,$offset) {
		$select = '*,estates.id as id,estates.address as address,estates.created_at as created_at,estates.updated_at as updated_at';
		$where = array('user_id' => $id);
		$like = array();
		$order_by = array('estates.created_at'=>'DESC');
		return $this -> get($select, $where, $like, $limit, $offset, $order_by);
	}

	function get_by_user_id_and_diff_estates_id($id,$estates_id,$limit,$offset,$activated=null,$user_activated=null) {
		$select = '*,estates.id as id,estates.created_at as created_at,estates.updated_at as updated_at,estates.address as address';
		$where = array('user_id' => $id,'estates.id <>'=>$estates_id);
		if($activated!=null){
			$where['estates.activated']=$activated;
		}
		if($user_activated!=null){
			$where['users.activated']=$user_activated;
		}
		$like = array();
		$order_by = array();
		return $this -> get($select, $where, $like, $limit, $offset, $order_by);
	}

	function get_by_exact_name($name){
		$select = '*,estates.id as id';
		$like=array();
		$where = array('title'=>$name);
		$order_by = array();
		return $this -> get($select, $where, $like, 0, 1, $order_by);
	}

	function get_by_name($name, $first, $offset) {
		$select = '*,estates.id as id';
		$where = array();
		$like = array('title'=>$name);
		$order_by = array();
		return $this -> get($select, $where, $like, $first, $offset, $order_by);
	}

	function get_by_name_and_diff_id($id,$name){
		$select = '*,estates.id as id';
		$where = array('title'=>$name,'estates.id <>'=>$id);
		$like = array();
		$order_by = array();
		return $this -> get($select, $where, $like, 0, 1, $order_by);
	}

	function get_by_id_and_name($id,$name,$offset,$first) {
		$select = '*';
		$where = array();
		$like = array('title'=>$name,'estates.id'=>$id);
		$order_by = array();
		return $this -> get($select, $where, $like, $offset, $first, $order_by);
	}

	function get_by_id_and_user_id($id,$user_id){
		$select = '*';
		$where = array('estates.id'=>$id,'user_id'=>$user_id);
		$like = array();
		$order_by = array();
		return $this -> get($select, $where, $like, 0, 1, $order_by);
	}

	function insert($data_array) {
		$data_array['created_at']=date('Y-m-d H:i:s');
		$data_array['updated_at']=date('Y-m-d H:i:s');
		$this -> db -> insert('estates', $data_array);
		return $this -> db -> insert_id();
	}

	public function remove($arr_where) {
		$this -> db -> where($arr_where);
		$this -> db -> delete('estates');
		return $this->db->affected_rows();
	}

	public function remove_by_id($id) {
		$where = array('id' => $id);
		return $this -> remove($where);
	}

	function update($data_array, $where) {
		$this -> db -> where($where);
		$this -> db -> update('estates', $data_array);
	}

	function update_query($query){
		$this->db->query($query);
	}
}
?>