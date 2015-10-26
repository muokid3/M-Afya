<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Declined extends CI_Controller {

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
		$this->load->model('Declined_model','',TRUE);
		
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
			$data['declined'] = $this->Declined_model->get_list_declined($searchvalue);
			$this->load->view('partials/header');
			$this->load->view('declined/declinedList', $data);
			$this->load->view('partials/footer');	
		
		}
		else
		{
			redirect('login', 'refresh');
		}
	}
	
	
	
}
?>