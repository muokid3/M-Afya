<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Suspended extends CI_Controller {

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
		$this->load->model('Suspended_model','',TRUE);
		
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
			$data['suspended'] = $this->Suspended_model->get_list_suspended($searchvalue);
			$this->load->view('partials/header');
			$this->load->view('suspended/suspendedList', $data);
			$this->load->view('partials/footer');	
		}
		else
		{
			redirect('login', 'refresh');
		}
		
	}	
	
	function settled()
	{
		
		// load view
		$data['suspended'] = $this->Suspended_model->get_list_suspended();
		$this->load->view('partials/header');
		$this->load->view('suspended/suspendedList', $data);
		$this->load->view('partials/footer');	
		
		
	}

	function unsuspend($id)
	{
		$suspension = array('settlement_status' => 2);
		$this->Suspended_model->unsuspend($id, $suspension);
		echo "Transaction Unsuspended";
	}
	
	
	
}
?>