<?php
class Subscriber_trans_model extends CI_Model {
	
	private $subscriber_transactions= 'subscriber_transactions';
	
	function __construct(){
		parent::__construct();
	}
	
	
	function get_list(){
        $this->db->order_by('id','desc');
        return $this->db->get($this->subscriber_transactions);
    }

    function get_list_joined(){
        $this->db->select('subscriber_transactions.*, subscriber_transactions.id as st_id, 
        					main_accounts.*, main_accounts.fname as fname, main_accounts.lname as lname');
        $this->db->from('subscriber_transactions');
        $this->db->join('main_accounts', 'subscriber_transactions.account_no = main_accounts.account_no');
        $this->db->where('main_accounts.active', 1);
        $this->db->where('main_accounts.account_activate', 1);
        return $this->db->get();
    }

	function list_all(){
		$this->db->order_by('id','asc');
		return $this->db->get($subscriber_transactions);
	}
	
	function count_all(){
		return $this->db->count_all($this->subscriber_transactions);
	}
	
	function get_paged_list($limit = 10, $offset = 0){
		$this->db->order_by('id','asc');
		return $this->db->get($this->subscriber_transactions, $limit, $offset);
	}
	
	function get_by_id($id){
		$this->db->where('id', $id);
		return $this->db->get($this->subscriber_transactions);
	}
	
	function save($voucher){
		$this->db->insert($this->subscriber_transactions, $voucher);
		return $this->db->insert_id();
	}
	
	function update($id, $voucher){
		$this->db->where('id', $id);
		$this->db->update($this->subscriber_transactions, $voucher);
	}
	
	function delete($id){
		$this->db->where('id', $id);
		$this->db->delete($this->subscriber_transactions);
	}
}
?>