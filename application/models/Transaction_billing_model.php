<?php
class Transaction_billing_model extends CI_Model {
	
	private $transaction_billing= 'transaction_billing';
	
	function __construct(){
		parent::__construct();
	}
	
	
	function get_list(){
        $this->db->order_by('id','desc');
        return $this->db->get($this->transaction_billing);
    }

    function get_list_joined($searchvalue = null, $from = null, $to = null)

    {
    	if ($searchvalue == null && $from == null && $to == null) 
    	{
    		$this->db->select('transaction_billing.*, transaction_billing.id as ts_id,
    			main_accounts.*, main_accounts.fname as fname, main_accounts.lname as lname');
	       $this->db->from('transaction_billing');
	       $this->db->join('main_accounts', 'transaction_billing.account_number = main_accounts.account_no', 'inner');
	       $this->db->order_by('transaction_billing.id','desc');
	       return $this->db->get();

    	}

    	elseif ($searchvalue != null && $from == null && $to == null) 

    	{
    		$this->db->select('transaction_billing.*, transaction_billing.id as ts_id,
    			main_accounts.*, main_accounts.fname as fname, main_accounts.lname as lname');
	       $this->db->from('transaction_billing');
	       $this->db->join('main_accounts', 'transaction_billing.account_number = main_accounts.account_no');
	       
	       $search_where = "main_accounts.fname LIKE '%".$searchvalue."%' OR main_accounts.lname LIKE '%".$searchvalue."%' 
	       OR transaction_billing.account_number LIKE '%".$searchvalue."%' OR transaction_billing.user_type LIKE '%".$searchvalue."%'
	       OR transaction_billing.amount LIKE '%".$searchvalue."%' OR transaction_billing.transaction_type LIKE '%".$searchvalue."%'";

	       $this->db->where($search_where);
	      $this->db->order_by('transaction_billing.id','desc');
	       return $this->db->get();

    	}

    	elseif ($searchvalue == null && $from != null && $to != null)

    	{
    		$this->db->select('transaction_billing.*, transaction_billing.id as ts_id,
    			main_accounts.*, main_accounts.fname as fname, main_accounts.lname as lname');
	       $this->db->from('transaction_billing');
	       $this->db->join('main_accounts', 'transaction_billing.account_number = main_accounts.account_no');

	       $search_where = "DATE(datetime) >='".date("Y-m-d", strtotime($from))."' AND DATE(datetime) <= '".date("Y-m-d", strtotime($to))."'";
	       
	       $this->db->where($search_where);
	       $this->db->order_by('transaction_billing.id','desc');
	       
	       return $this->db->get();
    	}
    	else
    	{
    		$this->db->select('transaction_billing.*, transaction_billing.id as ts_id,
    			main_accounts.*, main_accounts.fname as fname, main_accounts.lname as lname');
	       $this->db->from('transaction_billing');
	       $this->db->join('main_accounts', 'transaction_billing.account_number = main_accounts.account_no');

	       $search_where = "main_accounts.fname LIKE '%".$searchvalue."%' OR main_accounts.lname LIKE '%".$searchvalue."%' 
	       OR transaction_billing.account_number LIKE '%".$searchvalue."%' OR transaction_billing.user_type LIKE '%".$searchvalue."%'
	       OR transaction_billing.amount LIKE '%".$searchvalue."%' OR transaction_billing.transaction_type LIKE '%".$searchvalue."%'";

	       $another_where= "DATE(datetime) >='".date("Y-m-d", strtotime($from))."' AND DATE(datetime) <= '".date("Y-m-d", strtotime($to))."'";

	       $this->db->where($search_where);
	       $this->db->where($another_where);
	       $this->db->order_by('transaction_billing.id','desc');
	       return $this->db->get();
    	}
       
    }

    function get_provider_list_joined($searchvalue = null, $from = null, $to = null)
    {
    	if ($searchvalue == null && $from == null && $to == null) 
    	{
    		$this->db->select('transaction_billing.*, transaction_billing.id as ts_id,
    			merchants.*, merchants.bs_name as bs_name, merchants.location as location');
	       $this->db->from('transaction_billing');
	       $this->db->join('merchants', 'transaction_billing.account_number = merchants.phone_no', 'inner');
	       $this->db->order_by('transaction_billing.id','desc');
	       $this->db->where("transaction_billing.user_type='Service Provider'");
	       return $this->db->get();

    	}

    	elseif ($searchvalue != null && $from == null && $to == null) 

    	{
    		$this->db->select('transaction_billing.*, transaction_billing.id as ts_id,
    			merchants.*, merchants.bs_name as bs_name, merchants.location as location');
	       $this->db->from('transaction_billing');
	       $this->db->join('merchants', 'transaction_billing.account_number = merchants.phone_no', 'inner');
	       
	       $search_where = "merchants.bs_name LIKE '%".$searchvalue."%' OR merchants.location LIKE '%".$searchvalue."%' 
	       OR transaction_billing.account_number LIKE '%".$searchvalue."%' OR transaction_billing.user_type LIKE '%".$searchvalue."%'
	       OR transaction_billing.amount LIKE '%".$searchvalue."%' OR transaction_billing.transaction_type LIKE '%".$searchvalue."%'";

	       $this->db->where($search_where);
	       $this->db->where("transaction_billing.user_type='Service Provider'");
	       $this->db->order_by('transaction_billing.id','desc');
	       return $this->db->get();

    	}

    	elseif ($searchvalue == null && $from != null && $to != null)

    	{
    		$this->db->select('transaction_billing.*, transaction_billing.id as ts_id,
    			merchants.*, merchants.bs_name as bs_name, merchants.location as location');
	       $this->db->from('transaction_billing');
	       $this->db->join('merchants', 'transaction_billing.account_number = merchants.phone_no', 'inner');

	       $search_where = "DATE(datetime) >='".date("Y-m-d", strtotime($from))."' AND DATE(datetime) <= '".date("Y-m-d", strtotime($to))."'";
	       
	       $this->db->where($search_where);
	       $this->db->where("transaction_billing.user_type='Service Provider'");
	       $this->db->order_by('transaction_billing.id','desc');
	       
	       return $this->db->get();
    	}
    	else
    	{
    		$this->db->select('transaction_billing.*, transaction_billing.id as ts_id,
    			merchants.*, merchants.bs_name as bs_name, merchants.location as location');
	       $this->db->from('transaction_billing');
	       $this->db->join('merchants', 'transaction_billing.account_number = merchants.phone_no', 'inner');

	       $search_where = "merchants.bs_name LIKE '%".$searchvalue."%' OR merchants.location LIKE '%".$searchvalue."%' 
	       OR transaction_billing.account_number LIKE '%".$searchvalue."%' OR transaction_billing.user_type LIKE '%".$searchvalue."%'
	       OR transaction_billing.amount LIKE '%".$searchvalue."%' OR transaction_billing.transaction_type LIKE '%".$searchvalue."%'";

	       $another_where= "DATE(datetime) >='".date("Y-m-d", strtotime($from))."' AND DATE(datetime) <= '".date("Y-m-d", strtotime($to))."'";

	       $this->db->where($search_where);
	       $this->db->where($another_where);
	       $this->db->where("transaction_billing.user_type='Service Provider'");
	       $this->db->order_by('transaction_billing.id','desc');
	       return $this->db->get();
    	}
    }

	function list_all(){
		$this->db->order_by('id','asc');
		return $this->db->get($transaction_billing);
	}
	
	function count_all(){
		return $this->db->count_all($this->transaction_billing);
	}
	
	function get_paged_list($limit = 10, $offset = 0){
		$this->db->order_by('id','asc');
		return $this->db->get($this->transaction_billing, $limit, $offset);
	}
	
	function get_by_id($id){
		$this->db->where('id', $id);
		return $this->db->get($this->transaction_billing);
	}
	
	function save($voucher){
		$this->db->insert($this->transaction_billing, $voucher);
		return $this->db->insert_id();
	}
	
	function update($id, $voucher){
		$this->db->where('id', $id);
		$this->db->update($this->transaction_billing, $voucher);
	}
	
	function delete($id){
		$this->db->where('id', $id);
		$this->db->delete($this->transaction_billing);
	}
}
?>