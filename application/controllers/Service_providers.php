<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Service_providers extends CI_Controller {

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
		$this->load->model('Service_provider_model','',TRUE);
		
	}
	
	function index($offset = 0)
	{
		
		if ($this->session->userdata('logged_in')) 
		{
			
				// offset
				$uri_segment = 3;
				$offset = $this->uri->segment($uri_segment);
				
				
				
				// load view
				$data['sproviders'] = $this->Service_provider_model->get_list();
				$data['roles'] = $this->Service_provider_model->get_roles();
				$this->load->view('partials/header');
				$this->load->view('sproviders/serviceProviderList', $data);
				$this->load->view('partials/footer');
			
		} 
		else
		{
			redirect('login', 'refresh');
		}

		
	}

	function add()
	
	{
		$facility_code = $this->input->post('facilityno');
		$bank_code = $this->input->post('bank_code');

		//$data['fa_details'] = $this->Service_provider_model->getFacilityDetails($facility_code);
		$query = $this->Service_provider_model->getFacilityDetails($facility_code);
		$query2 = $this->Service_provider_model->getBankDetails($bank_code);
		$query3 = $this->Service_provider_model->checkMerchant($facility_code);
		

		if(!empty($query3))
		{
			echo "The Service Provider is already registered";
		}
		elseif (!empty($query) && !empty($query2)) 
		{
			
			foreach ($query as $detail) 
			{
				$bs_name = $detail->facility_name;
				$location = $detail->district;
				$facility_= $detail->facility_code;
			}
			
			foreach ($query2 as $detail2) 
			{
				$bank_name= $detail2->bank_name;
				$bank_branch= $detail2->bank_branch;
				$code= $detail2->code;
			}
			
			$s_provider = array('bs_name' => $bs_name,
					'business_no' => $facility_,
					'phone_no' => $this->input->post('phoneno'),
					'location' => $location,
					'licence_no' => "None",
					'commission' => $this->input->post('commission'),
					'balance' => 0,
					'email' => $this->input->post('email'),
					'username' => $this->input->post('username'),
					'merchant_bank_account' => $this->input->post('bank_account_no'),
					'merchant_bank_name' => $bank_name,
					'merchant_bank_branch' => $bank_branch,
					'password' => md5($this->input->post('password')));

			if ($this->Service_provider_model->save($s_provider)) 
			{
				echo "Service Provider Successfully Added";
			}
			else
			{
				echo "Service Provider NOT Added";
			}
		}
		else
		{
			echo "The Service Provider or Bank Code is not Recognized by the Government";
		}
		
		
	}

	public function delete($id)
	
	{
	
		if ($this->Service_provider_model->delete($id)) {
			echo "Service Provider Deleted Successfully";
		}		
		
	}

	function verify()
	{
		if ($this->session->userdata('logged_in')) 
		{
			
				// offset
				$uri_segment = 3;
				$offset = $this->uri->segment($uri_segment);
				
				
				
				// load view
				$data['providers'] = $this->Service_provider_model->get_unverified_list();
				$data['roles'] = $this->Service_provider_model->get_roles();
				$this->load->view('partials/header');
				$this->load->view('sproviders/verifyServiceProvider', $data);
				$this->load->view('partials/footer');
			
		} 
		else
		{
			redirect('login', 'refresh');
		}

	}

	function actionVerify($id = null)
	{
		if ($id == null) 
		{
			$id = $this->input->post('provider_id');
			$status = array('bs_name' => $this->input->post('bs_name') ,'phone_no'=> $this->input->post('phone_no'), 'location' => $this->input->post('location'),
				'email' => $this->input->post('email'),'commission' => $this->input->post('commission'),'username' => $this->input->post('username'),
				'merchant_pin' => $this->input->post('merchant_pin'),'preferred_settlement' => $this->input->post('preferred_settlement'),'merchant_bank_account' => $this->input->post('merchant_bank_account'),
				'merchant_bank_name' => $this->input->post('merchant_bank_name'),'merchant_bank_branch' => $this->input->post('merchant_bank_branch'));

			$this->Service_provider_model->verify($id, $status);
			echo "Service Provider Verified Successfully";
		}
		else
		{
			$data['sprovider'] = $this->Service_provider_model->get_by_id($id);
			$this->load->view('sproviders/verifyEditServiceProvider', $data);
		}
		
		
	}
	
	function actionSuspend($id)
	{
		$status = array('active' => 0);
		$this->Service_provider_model->suspend($id, $status);
		echo "Service Provider Suspended Successfully";
	
	}
	
	
}
?>