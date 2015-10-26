<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subscribers extends CI_Controller {

	// num of records per page
	private $limit = 10;
	
	function __construct()
	{
		parent::__construct();
		
		// load library
		$this->load->library(array('table','form_validation','pagination'));
		
		 
		 
		 $this->load->helper('form');
		
		 

 		
		
		// load helper
		//$this->load->helper('url');
		//$this->load->library('session');
		
		// load model
		$this->load->model('Subscriber_model','',TRUE);
		$this->load->model('Login_model','', TRUE);
		
		
	}
	
	function index($offset = 0)
	{
		if ($this->session->userdata('logged_in')) 
		{
			
				
				$searchvalue = $this->input->post('search');


				// Config setup
				 $num_rows=$this->Subscriber_model->get_list_active_no($searchvalue);
				 $config['base_url'] = base_url().'subscribers/index';
				 $config['total_rows'] = $num_rows;
				 $config['per_page'] = 5;
				 $config['num_links'] = 2;
				 $config['use_page_numbers'] = TRUE;
				 $this->pagination->initialize($config);


		 
				
				
				// offset
				$uri_segment = 3;
				$offset = $this->uri->segment($uri_segment);
				
				
				
				// load view
				$data['subscribers'] = $this->Subscriber_model->get_list_active($searchvalue);
				$this->load->view('partials/header');
				$this->load->view('subscribers/subscriberList', $data);
				$this->load->view('partials/footer');	
			
			
		}
		else
		{
			redirect('login', 'refresh');
		}
		
	}

	



	
}
?>