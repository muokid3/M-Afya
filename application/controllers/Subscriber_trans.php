<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subscriber_trans extends CI_Controller {

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
		$this->load->model('Subscriber_trans_model','',TRUE);
		
	}
	
	function index($offset = 0)
	{
		
			
		if ($this->session->userdata('logged_in')) 
		{
			
		
			// offset
			$uri_segment = 3;
			$offset = $this->uri->segment($uri_segment);
			
			
			
			// load view
			$data['sub_trans'] = $this->Subscriber_trans_model->get_list_joined();
			$this->load->view('partials/header');
			$this->load->view('subscriber_trans/subscriber_transList', $data);
			$this->load->view('partials/footer');	
		}
		else
		{
			redirect('login', 'refresh');
		}
		
	}
	
	
	
}
?>