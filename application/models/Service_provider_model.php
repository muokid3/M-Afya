<?php
class Service_provider_model extends CI_Model {
	
	private $merchants= 'merchants';
	private $roles= 'roles';
	private $facility_details = 'facility_details';
	private $bank_details = 'bank_codes';
	
	function __construct(){
		parent::__construct();
	}
	
	function get_role_by_id($id){
		return $this->db->where(array('id' => $id))->get($this->merchants);
	}
	
	
	function get_list(){
        $this->db->order_by('id','desc');
        $this->db->where('active', 1);
        return $this->db->get($this->merchants);
    }

    function get_unverified_list()
    {
    	$this->db->order_by('id','desc');
        $this->db->where('active', 0);
        return $this->db->get($this->merchants);
    }
    function get_roles(){
        $this->db->order_by('id','desc');
        return $this->db->get($this->roles);
    }

	function list_all(){
		$this->db->order_by('id','asc');
		return $this->db->get($merchants);
	}
	
	function count_all(){
		return $this->db->count_all($this->merchants);
	}
	
	function get_paged_list($limit = 10, $offset = 0){
		$this->db->order_by('id','asc');
		return $this->db->get($this->merchants, $limit, $offset);
	}
	
	function get_by_id($id){
		$this->db->where('id', $id);
		return $this->db->get($this->merchants);
	}
	
	function save($s_provider){
		$this->db->insert($this->merchants, $s_provider);
		return $this->db->insert_id();
	}
	
	function update($id, $voucher){
		$this->db->where('id', $id);
		$this->db->update($this->merchants, $voucher);
	}
	
	function delete($id){
		$this->db->where('id', $id);
		return $this->db->delete($this->merchants);
	}

	function getFacilityDetails($facility_code)
	{
		$facility_details = 'facility_details';
		$this->db->where('facility_code', $facility_code);
		return $this->db->get($this->$facility_details)->result();
	}
	
	function getBankDetails($bank_code)
	{
		$bank_details = 'bank_codes';
		$this->db->where('code', $bank_code );
		$this->db->from('bank_codes');
		return $this->db->get()->result();
	}
	
	function checkMerchant($facility_code)
	{
		
		$this->db->where('business_no', $facility_code);
		$this->db->from('merchants');
		return $this->db->get()->result();
	}

	function verify($id, $status)
	{
		$this->db->where('id', $id);
		$this->db->update($this->merchants, $status);
	}

	function suspend($id, $status)
	{
		$this->db->where('id', $id);
		$this->db->update($this->merchants, $status);
	}
}
?>