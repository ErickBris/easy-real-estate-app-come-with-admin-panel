<?php

/**

 *

 */

class type_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	function get($select = "*", $where = false, $like = false, $first = false, $offset = false, $order_by = false) {
		$data = array();
		if( $order_by != false){
			$order = key($order_by);
			if ($order != null) {
				$sort = $order_by[$order];
				$this -> db -> order_by($order, $sort);
			}
		}

		$this -> db -> select($select);
		$this -> db -> from('types');
		if($where != false)
			$this -> db -> where($where);
		if($like != false)
			$this -> db -> like($like);
		if($offset != false){
			$this -> db -> limit($offset, $first);
		}

		$query = $this -> db -> get();
		if ($query -> num_rows() > 0) {
			foreach ($query->result() as $rows) {
				$data[] = $rows;
			}
			$query -> free_result();
			return $data;
		} else {
			return null;
		}
	}

	function total($where, $like) {
		$this -> db -> select('count(*) as total');
		$this -> db -> where($where);
		$this -> db -> like($like);
		$this -> db -> from('types');
		$query = $this -> db -> get();
		$rows = $query -> result();
		$query -> free_result();
		return $rows[0] -> total;
	}

	function get_by_id($id) {
		$select = '*';
		$where = array('id' => $id);
		$like = array();
		$order_by = array();
		return $this -> get($select, $where, $like, 0, 1, $order_by);
	}

	function get_by_exact_name($name){
		$select = '*';
		$like=array();
		$where = array('name'=>$name);
		$order_by = array();
		return $this -> get($select, $where, $like, 0, 1, $order_by);
	}

	function get_by_name($name, $first, $offset) {
		$select = '*';
		$where = array();
		$like = array('name'=>$name);
		$order_by = array();
		return $this -> get($select, $where, $like, $first, $offset, $order_by);
	}

	function get_by_name_and_diff_id($id,$name){
		$select = '*';
		$where = array('name'=>$name,'id <>'=>$id);
		$like = array();
		$order_by = array();
		return $this -> get($select, $where, $like, 0, 1, $order_by);
	}

	function get_by_id_and_name($id,$name, $first, $offset) {
		$select = '*';
		$where = array();
		$like = array('name'=>$name,'id'=>$id);
		$order_by = array();
		return $this -> get($select, $where, $like, $first, $offset, $order_by);
	}


	function insert($data_array) {
		$data_array['created_at']=date('Y-m-d H:i:s');
		$data_array['updated_at']=date('Y-m-d H:i:s');
		$this -> db -> insert('types', $data_array);
		return $this -> db -> insert_id();
	}

	public function remove($arr_where) {
		$this -> db -> where($arr_where);
		$this -> db -> delete('types');
		return $this->db->affected_rows();
	}

	public function remove_by_id($id) {
		$where = array('id' => $id);
		return $this -> remove($where);
	}

	function update($data_array, $where) {
		$this -> db -> where($where);
		$this -> db -> update('types', $data_array);
	}
}
?>