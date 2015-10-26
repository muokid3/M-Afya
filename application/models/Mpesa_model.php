<?php
class Mpesa_model extends CI_Model {
	
	private $mpesa_transactions_log= 'mpesa_transactions_log';
	
	function __construct(){
		parent::__construct();
	}
	
	
	function get_list($searchvalue = null, $from = null, $to = null){
        if ($searchvalue == null && $from == null && $to == null) 
        {
        	$this->db->order_by('id','desc');
        	return $this->db->get($this->mpesa_transactions_log);
        }
        elseif($searchvalue != null && $from == null && $to == null)
        {
        	$search_where = "mpesa_transactions_log.first_name LIKE '%".$searchvalue."%' OR mpesa_transactions_log.last_name LIKE '%".$searchvalue."%' OR mpesa_transactions_log.mp_transaction_id LIKE '%".$searchvalue."%' OR mpesa_transactions_log.phone_no LIKE '%".$searchvalue."%'";
        	
        	$this->db->where($search_where);
        	$this->db->order_by('id','desc');
        	return $this->db->get($this->mpesa_transactions_log);
        }
        elseif ($searchvalue == null && $from != null && $to != null) 
        {
        	$another_where = "DATE(date) >='".date("Y-m-d", strtotime($from))."' AND DATE(date) <= '".date("Y-m-d", strtotime($to))."'";
        	$this->db->where($another_where);
        	$this->db->order_by('id','desc');
        	return $this->db->get($this->mpesa_transactions_log);
        }
        else
        {
        	$search_where = "mpesa_transactions_log.first_name LIKE '%".$searchvalue."%' OR mpesa_transactions_log.last_name LIKE '%".$searchvalue."%' OR mpesa_transactions_log.mp_transaction_id LIKE '%".$searchvalue."%' OR mpesa_transactions_log.phone_no LIKE '%".$searchvalue."%'";
        	$another_where = "DATE(date) >='".date("Y-m-d", strtotime($from))."' AND DATE(date) <= '".date("Y-m-d", strtotime($to))."'";
        	$this->db->where($another_where);
        	$this->db->where($search_where);
        	$this->db->order_by('id','desc');
        	return $this->db->get($this->mpesa_transactions_log);
        }
    }

	function list_all(){
		$this->db->order_by('id','asc');
		return $this->db->get($mpesa_transactions_log);
	}
	
	function count_all(){
		return $this->db->count_all($this->mpesa_transactions_log);
	}
	
	function get_paged_list($limit = 10, $offset = 0){
		$this->db->order_by('id','asc');
		return $this->db->get($this->mpesa_transactions_log, $limit, $offset);
	}
	
	function get_by_id($id){
		$this->db->where('id', $id);
		return $this->db->get($this->mpesa_transactions_log);
	}
	
	function save($voucher){
		$this->db->insert($this->mpesa_transactions_log, $voucher);
		return $this->db->insert_id();
	}
	
	function update($id, $voucher){
		$this->db->where('id', $id);
		$this->db->update($this->mpesa_transactions_log, $voucher);
	}
	
	function delete($id){
		$this->db->where('id', $id);
		$this->db->delete($this->mpesa_transactions_log);
	}
}
?>