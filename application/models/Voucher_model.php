<?php
class Voucher_model extends CI_Model {
	
	private $vouchers= 'vouchers';
	
	function __construct(){
		parent::__construct();
	}
	
	function get_role_by_id($id){
		return $this->db->where(array('id' => $id))->get($this->vouchers);
	}
	
	
	function get_list(){
        $this->db->order_by('id','asc');
        return $this->db->get($this->vouchers);
    }

	function list_all(){
		$this->db->order_by('id','asc');
		return $this->db->get($vouchers);
	}
	
	function count_all(){
		return $this->db->count_all($this->vouchers);
	}
	
	function get_paged_list($limit = 10, $offset = 0){
		$this->db->order_by('id','asc');
		return $this->db->get($this->vouchers, $limit, $offset);
	}
	
	function get_by_id($id){
		$this->db->where('id', $id);
		return $this->db->get($this->vouchers);
	}
	
	function save($voucher){
		$this->db->insert($this->vouchers, $voucher);
		return $this->db->insert_id();
	}
	
	function update($id, $voucher){
		$this->db->where('id', $id);
		$this->db->update($this->vouchers, $voucher);
	}
	
	function delete($id){
		$this->db->where('id', $id);
		return $this->db->delete($this->vouchers);
	}
}
?>