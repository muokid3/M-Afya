<?php
class Users_model extends CI_Model {
	
	private $users= 'users';
	private $roles= 'roles';
	private $merchants = 'merchants';
	
	function __construct(){
		parent::__construct();
	}
	
	
	function get_list(){
        $this->db->order_by('id','desc');
        return $this->db->get($this->users);
    }
    function get_roles(){
        $this->db->order_by('id','desc');
        return $this->db->get($this->roles);
    }

	function list_all(){
		$this->db->order_by('id','asc');
		return $this->db->get($users);
	}
	
	function count_all(){
		return $this->db->count_all($this->users);
	}
	
	function get_paged_list($limit = 10, $offset = 0){
		$this->db->order_by('id','asc');
		return $this->db->get($this->users, $limit, $offset);
	}
	
	function get_by_id($id){
		$this->db->where('id', $id);
		return $this->db->get($this->users);
	}
	
	function save($user){
		$this->db->insert($this->users, $user);
		return $this->db->insert_id();
	}
	
	function update($id, $user){
		$this->db->where('id', $id);
		$this->db->update($this->users, $user);
	}

	function updateMerchant($id, $user){
		$this->db->where('id', $id);
		$this->db->update($this->merchants, $user);
	}
	
	function delete($id){
		$this->db->where('id', $id);
		return $this->db->delete($this->users);
	}
}
?>