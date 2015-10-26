<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settled extends CI_Controller {

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
		$this->load->model('Settled_model','',TRUE);
		
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
			$data['settled'] = $this->Settled_model->get_list_settled($searchvalue);
			$this->load->view('partials/header');
			$this->load->view('settled/settledList', $data);
			$this->load->view('partials/footer');	
		}
		else
		{
			redirect('login', 'refresh');
		}
		
	}



    function csv($filename = 'CSV_Report.csv')
	{
		$searchvalue = $this->input->post('search');
        $ids = $this->input->post('ids');
        $this->load->dbutil();
        $this->load->helper('download');
        $delimiter = ",";
        $newline = "\r\n";
        $query = $this->Settled_model->export_csv($searchvalue);
        $data = $this->dbutil->csv_from_result($query, $delimiter, $newline);
        force_download($filename, $data);


        $acceptance = array('settlement_status' => 5);
		$this->Settled_model->accept($acceptance);
		
	}
	
	
	
}
?>