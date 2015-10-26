<?php
class Role_model extends CI_Model {
	
	private $roles= 'roles';
	
	function __construct(){
		parent::__construct();
	}
	
	function get_role_by_id($id){
		return $this->db->where(array('id' => $id))->get($this->roles);
	}
	
	function get_list_role(){
        return $this->db->where("id != 5")->select('*')->from($this->roles)->get();
    }
	
	function get_list(){
        $this->db->order_by('id','asc');
        return $this->db->get($this->roles);
    }

	function list_all(){
		$this->db->order_by('id','asc');
		return $this->db->get($roles);
	}
	
	function count_all(){
		return $this->db->count_all($this->roles);
	}
	
	function get_paged_list($limit = 10, $offset = 0){
		$this->db->order_by('id','asc');
		return $this->db->get($this->roles, $limit, $offset);
	}
	
	function get_by_id($id){
		$this->db->where('id', $id);
		return $this->db->get($this->roles);
	}
	
	function save($role){
		$this->db->insert($this->roles, $role);
		return $this->db->insert_id();
	}
	
	function update($id, $role){
		$this->db->where('id', $id);
		$this->db->update($this->roles, $role);
	}
	
	function delete($id){
		$this->db->where('id', $id);
		$this->db->delete($this->roles);
	}
}
?>