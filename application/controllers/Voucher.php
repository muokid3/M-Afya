<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Voucher extends CI_Controller {

	// num of records per page
	private $limit = 10;
	
	function __construct()
	{
		parent::__construct();
		
		// load library
		$this->load->library(array('table','form_validation'));
		
		// load helper
		//$this->load->helper('url');
		//$this->load->library('session');
		
		// load model
		$this->load->model('Voucher_model','',TRUE);
		
	}
	
	function index($offset = 0)
	{
		
			
		if ($this->session->userdata ('logged_in')) 
		{
			
			
				// offset
				$uri_segment = 3;
				$offset = $this->uri->segment($uri_segment);
				
				
				
				// load view
				$data['vouchers'] = $this->Voucher_model->get_list();
				$this->load->view('partials/header');
				$this->load->view('voucher/voucherList', $data);
				$this->load->view('partials/footer');	
			
		}
		else
		{
			redirect('login', 'refresh');
		}
		
	}
	
	function add()
	
	{
	
		$voucher = array('name' => $this->input->post('name'),
					'description' => $this->input->post('description'));
		
		
		if($this->Voucher_model->save($voucher))
		
			echo "Voucher successfully added";
			
		else
		
			echo "Voucher could not be added";
	
	}
	
	function edit( $id = null)
	
	{
		if($id == null)
		
		{
			
			$id = $this->input->post('voucher_id');
			$voucher = array('name' => $this->input->post('name'),
						'description' => $this->input->post('description'));
			$this->Voucher_model->update($id, $voucher);
		
			echo "Voucher successfully Updated";
			
		}
		
		else
		
		{
			$data['voucher'] = $this->Voucher_model->get_by_id($id);
			$this->load->view('voucher/editVoucher', $data);
		}
	
	}
	
	public function delete($id)
	
	{
	
		if ($this->Voucher_model->delete($id)) {
			echo "Voucher Deleted Successful";
		}		
		
	}
	
}
?>