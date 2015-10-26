<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Merchant_transactions extends CI_Controller {

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
		$this->load->model('Service_provider_report_model','',TRUE);
		
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
			$data['sp_reports'] = $this->Service_provider_report_model->get_list_joined($searchvalue, $from, $to);
			$this->load->view('partials/merchantHeader');
			$this->load->view('sp_reports/service_provider_reportList', $data);
			$this->load->view('partials/footer');	
		
		}
		else
		{
			redirect('login', 'refresh');
		}
	}
	
	
	
}
?>