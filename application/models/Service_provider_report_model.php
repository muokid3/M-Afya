<?php
class Service_provider_report_model extends CI_Model {
	
	private $merchant_transactions= 'merchant_transactions';
	
	function __construct(){
		parent::__construct();
	}
	
	
	function get_list(){
        $this->db->order_by('id','desc');
        return $this->db->get($this->merchant_transactions);
    }

    function get_list_joined($searchvalue = null, $from = null, $to = null)

    {
    	if ($searchvalue == null && $from == null && $to == null) 
    	{
    		$this->db->select('merchant_transactions.*, merchant_transactions.id as mt_id, 
       					merchants.*, merchants.bs_name as bs_name,
       					main_accounts.*, main_accounts.fname as fname, main_accounts.lname as lname');
	       $this->db->from('merchant_transactions');
	       $this->db->join('merchants','merchant_transactions.business_no = merchants.business_no');
	       $this->db->join('main_accounts', 'merchant_transactions.account_no = main_accounts.account_no');
	       $this->db->where('main_accounts.active', 1);
	       $this->db->where('main_accounts.account_activate', 1);
	       return $this->db->get();

    	}

    	elseif ($searchvalue != null && $from == null && $to == null) 

    	{
    		$this->db->select('merchant_transactions.*, merchant_transactions.id as mt_id, 
       					merchants.*, merchants.bs_name as bs_name,
       					main_accounts.*, main_accounts.fname as fname, main_accounts.lname as lname');
	       $this->db->from('merchant_transactions');
	       $this->db->join('merchants','merchant_transactions.business_no = merchants.business_no');
	       $this->db->join('main_accounts', 'merchant_transactions.account_no = main_accounts.account_no');
	       $this->db->where('main_accounts.active', 1);
	       $this->db->where('main_accounts.account_activate', 1);

	       $search_where = "merchants.bs_name LIKE '%".$searchvalue."%' 
	       OR merchant_transactions.business_no LIKE '%".$searchvalue."%' OR merchant_transactions.voucher LIKE '%".$searchvalue."%'
	       OR main_accounts.fname LIKE '%".$searchvalue."%' OR main_accounts.lname LIKE '%".$searchvalue."%'";

	       $this->db->where($search_where);
	       return $this->db->get();

    	}

    	elseif ($searchvalue == null && $from != null && $to != null)

    	{
    		$this->db->select('merchant_transactions.*, merchant_transactions.id as mt_id, 
       					merchants.*, merchants.bs_name as bs_name,
       					main_accounts.*, main_accounts.fname as fname, main_accounts.lname as lname');
	       $this->db->from('merchant_transactions');
	       $this->db->join('merchants','merchant_transactions.business_no = merchants.business_no');
	       $this->db->join('main_accounts', 'merchant_transactions.account_no = main_accounts.account_no');
	       $this->db->where('main_accounts.active', 1);
	       $this->db->where('main_accounts.account_activate', 1);

	       $search_where = "DATE(datetime) >='".date("Y-m-d", strtotime($from))."' AND DATE(datetime) <= '".date("Y-m-d", strtotime($to))."'";
	       
	       $this->db->where($search_where);
	       
	       return $this->db->get();
    	}
    	else
    	{
    		$this->db->select('merchant_transactions.*, merchant_transactions.id as mt_id, 
       					merchants.*, merchants.bs_name as bs_name,
       					main_accounts.*, main_accounts.fname as fname, main_accounts.lname as lname');
	       $this->db->from('merchant_transactions');
	       $this->db->join('merchants','merchant_transactions.business_no = merchants.business_no');
	       $this->db->join('main_accounts', 'merchant_transactions.account_no = main_accounts.account_no');
	       $this->db->where('main_accounts.active', 1);
	       $this->db->where('main_accounts.account_activate', 1);

	       $another_where = "merchants.bs_name LIKE '%".$searchvalue."%' 
	       OR merchant_transactions.business_no LIKE '%".$searchvalue."%' OR merchant_transactions.voucher LIKE '%".$searchvalue."%'
	       OR main_accounts.fname LIKE '%".$searchvalue."%' OR main_accounts.lname LIKE '%".$searchvalue."%'";

	       $search_where = "DATE(datetime) >='".date("Y-m-d", strtotime($from))."' AND DATE(datetime) <= '".date("Y-m-d", strtotime($to))."'";

	       $this->db->where($search_where);
	       $this->db->where($another_where);
	       return $this->db->get();
    	}
       
    }

	function list_all(){
		$this->db->order_by('id','asc');
		return $this->db->get($merchant_transactions);
	}
	
	function count_all(){
		return $this->db->count_all($this->merchant_transactions);
	}
	
	function get_paged_list($limit = 10, $offset = 0){
		$this->db->order_by('id','asc');
		return $this->db->get($this->merchant_transactions, $limit, $offset);
	}
	
	function get_by_id($id){
		$this->db->where('id', $id);
		return $this->db->get($this->merchant_transactions);
	}
	
	function save($voucher){
		$this->db->insert($this->merchant_transactions, $voucher);
		return $this->db->insert_id();
	}
	
	function update($id, $voucher){
		$this->db->where('id', $id);
		$this->db->update($this->merchant_transactions, $voucher);
	}
	
	function delete($id){
		$this->db->where('id', $id);
		$this->db->delete($this->merchant_transactions);
	}
}
?>