<?php
class Role_model extends CI_Model {
	
	private $tbl_role= 'tbl_role';
	
	function __construct(){
		parent::__construct();
	}
	
	function get_role_by_id($id){
		return $this->db->where(array('id' => $id))->get($this->tbl_role);
	}
	
	function get_list_role(){
        return $this->db->where("id != 5")->select('*')->from($this->tbl_role)->get();
    }
	
	function get_list(){
        $this->db->order_by('id','asc');
        return $this->db->get($this->tbl_role);
    }

	function list_all(){
		$this->db->order_by('id','asc');
		return $this->db->get($tbl_role);
	}
	
	function count_all(){
		return $this->db->count_all($this->tbl_role);
	}
	
	function get_paged_list($limit = 10, $offset = 0){
		$this->db->order_by('id','asc');
		return $this->db->get($this->tbl_role, $limit, $offset);
	}
	
	function get_by_id($id){
		$this->db->where('id', $id);
		return $this->db->get($this->tbl_role);
	}
	
	function save($role){
		$this->db->insert($this->tbl_role, $role);
		return $this->db->insert_id();
	}
	
	function update($id, $role){
		$this->db->where('id', $id);
		$this->db->update($this->tbl_role, $role);
	}
	
	function delete($id){
		$this->db->where('id', $id);
		$this->db->delete($this->tbl_role);
	}
}
?>