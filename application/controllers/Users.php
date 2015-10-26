<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

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
		$this->load->model('Users_model','',TRUE);
		
	}
	
	function index($offset = 0)
	{
		
			
		if ($this->session->userdata('logged_in')) 
		{
			
		
				// offset
				$uri_segment = 3;
				$offset = $this->uri->segment($uri_segment);
				
				
				
				// load view
				$data['users'] = $this->Users_model->get_list();
				$data['roles'] = $this->Users_model->get_roles();
				$this->load->view('partials/header');
				$this->load->view('users/userList', $data);
				$this->load->view('partials/footer');	
			
		}
		else
		{
			redirect('login', 'refresh');
		}
		
	}

	function add()
	
	{
		//print_r($this->input->post()); die();

		$user = array('name' => $this->input->post('user_name'),
					'username' => $this->input->post('user_username'),
					'password' => md5($this->input->post('user_password')),
					'role_id' => $this->input->post('user_role'),
					'active' => $this->input->post('active'));
		
		
		if($this->Users_model->save($user))
		
			echo "User successfully added";
			
		else
		
			echo "User could not be added";
	
	}

	public function delete($id)
	
	{
	
		if ($this->Users_model->delete($id)) {
			echo "User Deleted Successful";
		}		
		
	}

	function edit($id = null)
	{
		if ($id == null) 
		{
			$id = $this->input->post('hidden_id');

			$editedUser = array('name' => $this->input->post('name') , 'username' => $this->input->post('username'));
			$this->Users_model->update($id, $editedUser);

			echo "User Edited successfully";
		}
		else
		{
			$data['user'] = $this->Users_model->get_by_id($id);
			$this->load->view('users/editUser', $data);

		}
	}
	
	
	
}
?>