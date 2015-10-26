<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Processing extends CI_Controller {

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
		$this->load->model('Processing_model','',TRUE);
		
	}
	
	function index($offset = 0)
	{
		if ($this->session->userdata('logged_in'))
		{
			
		
			$searchvalue = $this->input->post('search');			
			
			// offset
			$uri_segment = 3;
			$offset = $this->uri->segment($uri_segment);
			
			
			
			// load view
			$data['processing'] = $this->Processing_model->get_list_processing($searchvalue);
			$this->load->view('partials/header');
			$this->load->view('processing/processingList', $data);
			$this->load->view('partials/footer');	
		}

		else
		{
			redirect('login', 'refresh');
		}
		
	}

	function suspend($id)
	{
		$suspension = array('settlement_status' => 3);
		$this->Processing_model->suspend($id, $suspension);
		echo "Transaction Suspended";
	}

	function accept($id)
	{
		
		$acceptance = array('settlement_status' => 1);
		$this->Processing_model->accept($id, $acceptance);
		echo "Transaction Accepted";
	}
	function decline($id)
	{
		$declination = array('settlement_status' => 4);
		$this->Processing_model->decline($id, $declination);
		echo "Transaction Declined";
	}
	
	
}
?>