<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

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
		$this->load->model('Login_model','',TRUE);
		$this->load->model('Users_model','',TRUE);

	}
	
	public function index()
	{
		$this->load->view('dashboard');

	}

	public function logout ()
	{
		$this->session->unset_userdata('logged_in');
		$this->session->sess_destroy();
		redirect('login', 'refresh');
	}
	public function changePass ()
	{
		$login = $this->session->userdata('logged_in');
		$uname = $login['username'];
		$pass = $this->input->post('oldpass');
		$user = $this->Login_model->login($uname, $pass);
		if (empty($user)) 
		{
			echo "Wrong Old Password";
		}
		else
		{
			$admin = array('password' => md5($this->input->post('newpass')));
			$this->Users_model->update($user[0]->id, $admin);
			echo "Password Changed Successfully";
		}
	}

	public function merchantChangePass ()
	{
		$login = $this->session->userdata('logged_in');
		$uname = $login['username'];
		$pass = $this->input->post('oldpass');
		$user = $this->Login_model->merchantLogin($uname, $pass);
		if (empty($user)) 
		{
			echo "Wrong Old Password";
		}
		else
		{
			$admin = array('password' => md5($this->input->post('newpass')));
			$this->Users_model->updateMerchant($user[0]->id, $admin);
			echo "Password Changed Successfully";
		}
	}


	
}
?>