<?php
class Subscriber_model extends CI_Model {
	
	private $main_account= 'main_accounts';
	
	function __construct(){
		parent::__construct();
	}
	
	function get_role_by_id($id){
		return $this->db->where(array('id' => $id))->get($this->main_account);
	}
	
	
	function get_list(){
        $this->db->order_by('id','asc');
        return $this->db->get($this->main_account);
    }
	
	function get_list_active($searchvalue = null){
		if ($searchvalue == null) 
		{
			$this->db->select('main_accounts.*, main_accounts.account_no as ma_account_no, main_accounts.id as ma_id, main_accounts.balance as ma_balance,
       					 voucher_maternity.*, voucher_maternity.balance as vm_balance');
		   $this->db->from('main_accounts');
		   $this->db->join('voucher_maternity', 'main_accounts.account_no = voucher_maternity.account_no', 'inner');
		   $this->db->where('main_accounts.active', 1);
		   $this->db->where('main_accounts.account_activate', 1);
		   return $this->db->get();
		}
		else
		{
			$search_where = "main_accounts.account_no LIKE '%".$searchvalue."%' OR main_accounts.fname LIKE '%".$searchvalue."%' OR main_accounts.lname LIKE '%".$searchvalue."%'";
			$this->db->select('main_accounts.*, main_accounts.account_no as ma_account_no, main_accounts.id as ma_id, main_accounts.balance as ma_balance,
       					 voucher_maternity.*, voucher_maternity.balance as vm_balance');
		   $this->db->from('main_accounts');
		   $this->db->join('voucher_maternity', 'main_accounts.account_no = voucher_maternity.account_no', 'inner');
		   $this->db->where('main_accounts.active', 1);
		   $this->db->where($search_where);
		   $this->db->where('main_accounts.account_activate', 1);
		   return $this->db->get();
		}
       

    }

    function get_list_active_no($searchvalue = null){
		if ($searchvalue == null) 
		{
			$this->db->select('main_accounts.*, main_accounts.account_no as ma_account_no, main_accounts.id as ma_id, main_accounts.balance as ma_balance,
       					 voucher_maternity.*, voucher_maternity.balance as vm_balance');
		   $this->db->from('main_accounts');
		   $this->db->join('voucher_maternity', 'main_accounts.account_no = voucher_maternity.account_no', 'inner');
		   $this->db->where('main_accounts.active', 1);
		   $this->db->where('main_accounts.account_activate', 1);
		   $query = $this->db->get();
		   return $query->num_rows();
		}
		else
		{
			$search_where = "main_accounts.account_no LIKE '%".$searchvalue."%' OR main_accounts.fname LIKE '%".$searchvalue."%' OR main_accounts.lname LIKE '%".$searchvalue."%'";
			$this->db->select('main_accounts.*, main_accounts.account_no as ma_account_no, main_accounts.id as ma_id, main_accounts.balance as ma_balance,
       					 voucher_maternity.*, voucher_maternity.balance as vm_balance');
		   $this->db->from('main_accounts');
		   $this->db->join('voucher_maternity', 'main_accounts.account_no = voucher_maternity.account_no', 'inner');
		   $this->db->where('main_accounts.active', 1);
		   $this->db->where($search_where);
		   $this->db->where('main_accounts.account_activate', 1);
		   $query = $this->db->get();
		   return $query->num_rows();
		}
       

    }

	function list_all(){
		$this->db->order_by('id','asc');
		return $this->db->get($main_account);
	}
	
	function count_all(){
		return $this->db->count_all($this->main_account);
	}
	
	function get_paged_list($limit = 10, $offset = 0){
		$this->db->order_by('id','asc');
		return $this->db->get($this->main_account, $limit, $offset);
	}
	
	function get_by_id($id){
		$this->db->where('id', $id);
		return $this->db->get($this->main_account);
	}
	
	function save($voucher){
		$this->db->insert($this->main_account, $voucher);
		return $this->db->insert_id();
	}
	
	function update($id, $voucher){
		$this->db->where('id', $id);
		$this->db->update($this->main_account, $voucher);
	}
	
	function delete($id){
		$this->db->where('id', $id);
		$this->db->delete($this->main_account);
	}
}
?>