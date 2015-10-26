<?php
class Audit_model extends CI_Model {
	
	private $audits= 'audits';
	
	function __construct(){
		parent::__construct();
	}
	
	
	function get_list($searchvalue = null){

		if ($searchvalue == null) 
		{
			$this->db->order_by('audits.id','desc');

			$this->db->select('audits.*, audits.id as audit_id, users.*, users.username as user_username');
			$this->db->from('audits');
			$this->db->join('users', 'audits.user_id = users.id');
			return $this->db->get();
		}
		else
		{
			
		
			$this->db->order_by('audits.id','desc');

			$this->db->select('audits.*, audits.id as audit_id, users.*, users.username as user_username');
			$this->db->from('audits');
			$this->db->join('users', 'audits.user_id = users.id');

			$search_where = "users.username LIKE '%".$searchvalue."%' OR audits.datetime LIKE '%".$searchvalue."%' OR audits.detail LIKE '%".$searchvalue."%'";

			$this->db->where($search_where);

			return $this->db->get();
        

        
		}
    }

	function list_all(){
		$this->db->order_by('id','asc');
		return $this->db->get($audits);
	}
	
	function count_all(){
		return $this->db->count_all($this->audits);
	}
	
	function get_paged_list($limit = 10, $offset = 0){
		$this->db->order_by('id','asc');
		return $this->db->get($this->audits, $limit, $offset);
	}
	
	function get_by_id($id){
		$this->db->where('id', $id);
		return $this->db->get($this->audits);
	}
	
	function save($voucher){
		$this->db->insert($this->audits, $voucher);
		return $this->db->insert_id();
	}
	
	function update($id, $voucher){
		$this->db->where('id', $id);
		$this->db->update($this->audits, $voucher);
	}
	
	function delete($id){
		$this->db->where('id', $id);
		$this->db->delete($this->audits);
	}
}
?>