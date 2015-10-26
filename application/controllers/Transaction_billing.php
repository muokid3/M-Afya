<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Transaction_billing extends CI_Controller {

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
		$this->load->model('transaction_billing_model','',TRUE);
		
	}
	
	function index($offset = 0)
	{
		
			
		if ($this->session->userdata('logged_in')) 
		{			
		
			// offset
			$uri_segment = 3;
			$offset = $this->uri->segment($uri_segment);
			
			$searchvalue = $this->input->post('search');
			$from = $this->input->post('from');
			$to = $this->input->post('to');


			// load view
			$data['trans_billing'] = $this->transaction_billing_model->get_list_joined($searchvalue, $from, $to);
			$this->load->view('partials/header');
			$this->load->view('transaction_billing/transactionBillingList', $data);
			$this->load->view('partials/footer');	
		
		}
		else
		{
			redirect('login', 'refresh');
		}
	}

	function service_providers()
	{

		if ($this->session->userdata('logged_in')) 
		{			
		
			// offset
			$uri_segment = 3;
			$offset = $this->uri->segment($uri_segment);
			
			$searchvalue = $this->input->post('search');
			$from = $this->input->post('from');
			$to = $this->input->post('to');


			// load view
			$data['trans_billing'] = $this->transaction_billing_model->get_provider_list_joined($searchvalue, $from, $to);
			$this->load->view('partials/header');
			$this->load->view('transaction_billing/providerTransactionBillingList', $data);
			$this->load->view('partials/footer');	
		
		}
		else
		{
			redirect('login', 'refresh');
		}
	}
	
	
	
}
?>