<?php
class Voucher_transfer_model extends CI_Model {
	
	private $voucher_transfers= 'voucher_transfers';
	
	function __construct(){
		parent::__construct();
	}
	
	
	function get_list($searchvalue = null, $from = null, $to = null){
        if ($searchvalue == null && $from == null && $to == null) 
    	{
    		$this->db->order_by('id','desc');
        	return $this->db->get($this->voucher_transfers);
    	}
    	elseif ($searchvalue != null && $from == null && $to == null) 
    	{
    		$this->db->order_by('id','desc');
        	$this->db->from('voucher_transfers');
        	$search_where = "voucher_transfers.voucher_type LIKE '%".$searchvalue."%' OR voucher_transfers.account_from LIKE '%".$searchvalue."%' 
        	OR voucher_transfers.account_to LIKE '%".$searchvalue."%' OR voucher_transfers.amount LIKE '%".$searchvalue."%' OR voucher_transfers.datetime LIKE '%".$searchvalue."%'
        	OR voucher_transfers.id LIKE '%".$searchvalue."%'";
        	$this->db->where($search_where);
        	return $this->db->get();
    	}
    	elseif ($searchvalue == null && $from != null && $to != null) 
    	{
    		$this->db->order_by('id','desc');
        	$this->db->from('voucher_transfers');
        	
        	/*$search_where = "voucher_transfers.voucher_type LIKE '%".$searchvalue."%' OR voucher_transfers.account_from LIKE '%".$searchvalue."%' 
        	OR voucher_transfers.account_to LIKE '%".$searchvalue."%' OR voucher_transfers.amount LIKE '%".$searchvalue."%' OR voucher_transfers.datetime LIKE '%".$searchvalue."%'
        	OR voucher_transfers.id LIKE '%".$searchvalue."%'";*/
        	
        	$another_where = "DATE(datetime) >='".date("Y-m-d", strtotime($from))."' AND DATE(datetime) <= '".date("Y-m-d", strtotime($to))."'";

        	//$this->db->where($search_where);
        	$this->db->where($another_where);
        	return $this->db->get();
    	}
    	else
    	{
    		$this->db->order_by('id','desc');
        	$this->db->from('voucher_transfers');
        	
            $search_where = "voucher_transfers.voucher_type LIKE '%".$searchvalue."%' OR voucher_transfers.account_from LIKE '%".$searchvalue."%' 
        	OR voucher_transfers.account_to LIKE '%".$searchvalue."%' OR voucher_transfers.amount LIKE '%".$searchvalue."%' OR voucher_transfers.datetime LIKE '%".$searchvalue."%'
        	OR voucher_transfers.id LIKE '%".$searchvalue."%'";

        	$another_where = "DATE(datetime) >='".date("Y-m-d", strtotime($from))."' AND DATE(datetime) <= '".date("Y-m-d", strtotime($to))."'";

        	$this->db->where($another_where);
        	$this->db->where($search_where);
        	return $this->db->get();
    	}


    }

	function list_all(){
		$this->db->order_by('id','asc');
		return $this->db->get($voucher_transfers);
	}
	
	function count_all(){
		return $this->db->count_all($this->voucher_transfers);
	}
	
	function get_paged_list($limit = 10, $offset = 0){
		$this->db->order_by('id','asc');
		return $this->db->get($this->voucher_transfers, $limit, $offset);
	}
	
	function get_by_id($id){
		$this->db->where('id', $id);
		return $this->db->get($this->voucher_transfers);
	}
	
	function save($voucher){
		$this->db->insert($this->voucher_transfers, $voucher);
		return $this->db->insert_id();
	}
	
	function update($id, $voucher){
		$this->db->where('id', $id);
		$this->db->update($this->voucher_transfers, $voucher);
	}
	
	function delete($id){
		$this->db->where('id', $id);
		$this->db->delete($this->voucher_transfers);
	}
}
?>