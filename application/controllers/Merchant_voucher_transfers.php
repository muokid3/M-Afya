<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Merchant_voucher_transfers extends CI_Controller {

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
		$this->load->model('Voucher_transfer_model','',TRUE);
		
	}
	
	function index($offset = 0)
	{
		
		if ($this->session->userdata('logged_in')) 
		{
				
			$searchvalue = $this->input->post('search');
			$from = $this->input->post('from');
			$to = $this->input->post('to');

			
			// offset
			$uri_segment = 3;
			$offset = $this->uri->segment($uri_segment);
			
			
			
			// load view
			$data['voucher_trans'] = $this->Voucher_transfer_model->get_list($searchvalue, $from, $to);
			$this->load->view('partials/merchantHeader');
			$this->load->view('voucher_trans/voucher_transferList', $data);
			$this->load->view('partials/footer');	
		}

		else
		{
			redirect('login', 'refresh');
		}
		
	}
	
	
	
}
?>