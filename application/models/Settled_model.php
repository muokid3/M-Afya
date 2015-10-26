<?php
class Settled_model extends CI_Model {
	
	private $merchant_settlements= 'merchant_settlements';
	
	function __construct(){
		parent::__construct();
	}
	
	
	function get_list(){
        $this->db->order_by('id','desc');
        return $this->db->get($this->merchant_settlements);
    }

    function get_list_settled($searchvalue = null)
    {
   
		if ($searchvalue == null) 
		{
			$this->db->select('merchant_settlements.datetime,merchant_settlements.business_no,
			merchant_settlements.amount, merchant_settlements.id AS ms_id, merchant_settlements.debit, 
			merchant_settlements.settlement_status, merchants.bs_name, merchants.id AS m_id');
			$this->db->from('merchant_settlements');
			$this->db->join('merchants', 'merchant_settlements.business_no = merchants.business_no');
			$this->db->where('merchant_settlements.settlement_status', 1);

			return $this->db->get();
		}
		else
		{
			
			$this->db->select('merchant_settlements.datetime,merchant_settlements.business_no,
			merchant_settlements.amount, merchant_settlements.id AS ms_id, merchant_settlements.debit, 
			merchant_settlements.settlement_status, merchants.bs_name, merchants.id AS m_id');
			$this->db->from('merchant_settlements');
			$this->db->join('merchants', 'merchant_settlements.business_no = merchants.business_no');
			
			$search_where = "merchant_settlements.business_no LIKE '%".$searchvalue."%'";
			$another_where = "merchants.bs_name LIKE '%".$searchvalue."%' AND merchant_settlements.business_no = merchants.business_no AND merchant_settlements.settlement_status = 1";
			
			$this->db->where('merchant_settlements.settlement_status', 1);
			$this->db->where($search_where ." OR ". $another_where);

			return $this->db->get();
		}
		
    }

	function list_all(){
		$this->db->order_by('id','asc');
		return $this->db->get($merchant_settlements);
	}
	
	function count_all(){
		return $this->db->count_all($this->merchant_settlements);
	}
	
	function get_paged_list($limit = 10, $offset = 0){
		$this->db->order_by('id','asc');
		return $this->db->get($this->merchant_settlements, $limit, $offset);
	}
	
	function get_by_id($id){
		$this->db->where('id', $id);
		return $this->db->get($this->merchant_settlements);
	}
	
	function save($voucher){
		$this->db->insert($this->merchant_settlements, $voucher);
		return $this->db->insert_id();
	}
	
	function update($id, $voucher){
		$this->db->where('id', $id);
		$this->db->update($this->merchant_settlements, $voucher);
	}
	
	function delete($id){
		$this->db->where('id', $id);
		$this->db->delete($this->merchant_settlements);
	}
	
	function export_csv($searchvalue = null)
	{
		if ($searchvalue == null) 
		{
			$this->db->select('merchant_settlements.datetime as Date,merchant_settlements.business_no as Business_no,
			merchant_settlements.amount as Amount, merchants.bs_name as Business_Name');
			$this->db->from('merchant_settlements');
			$this->db->join('merchants', 'merchant_settlements.business_no = merchants.business_no');
			$this->db->where('merchant_settlements.settlement_status', 1);

			return $this->db->get();
		}
		else
		{
			
			$this->db->select('merchant_settlements.datetime as Date,merchant_settlements.business_no as Business_no,
			merchant_settlements.amount as Amount, merchants.bs_name as Business_Name');
			$this->db->from('merchant_settlements');
			$this->db->join('merchants', 'merchant_settlements.business_no = merchants.business_no');
			
			$search_where = "merchant_settlements.business_no LIKE '%".$searchvalue."%'";
			$another_where = "merchants.bs_name LIKE '%".$searchvalue."%' AND merchant_settlements.business_no = merchants.business_no AND merchant_settlements.settlement_status = 1";
			
			$this->db->where('merchant_settlements.settlement_status', 1);
			$this->db->where($search_where ." OR ". $another_where);

			return $this->db->get();
		}
	}

	function accept($acceptance)
	{
		$this->db->where('settlement_status', 1);
		$this->db->update($this->merchant_settlements, $acceptance);
	}
}
?>