<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Audit extends CI_Controller {

	// num of records per page
	private $limit = 10;
	
	function __construct()
	{
		parent::__construct();
		
		// load library
		$this->load->library(array('table','form_validation'));
		
		// load helper
		//$this->load->helper('url');
		
		// load model
		$this->load->model('Audit_model','',TRUE);
		
	}
	
	function index($offset = 0)
	{
		
			
		$searchvalue = $this->input->post('search');
		// offset
		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);
		
		
		
		// load view
		$data['audits'] = $this->Audit_model->get_list($searchvalue);
		$this->load->view('partials/header');
		$this->load->view('audits/auditList', $data);
		$this->load->view('partials/footer');	
		
		
	}
	
	
	
}
?>