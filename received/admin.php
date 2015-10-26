<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	// num of records per page
	private $limit = 10;
	
	function __construct()
	{
		parent::__construct();
		
		// load library
		$this->load->library(array('table','form_validation'));
		
		// load helper
		$this->load->helper('url');
		
		// load model
		$this->load->model('Role_model','',TRUE);
		$this->load->model('Admin_model','',TRUE);
		$this->load->model('Toilet_model','',TRUE);
		$this->load->model('Device_model','',TRUE);
		$this->load->model('Audit_model','',TRUE);
	}
	
	function index($offset = 0)
	{
		if($this->session->userdata('logged_in'))
		{	
		
		// offset
		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);
		
		// load data
		$admins = $this->Admin_model->get_paged_list($this->limit, $offset)->result();
		
		// generate pagination
		$this->load->library('pagination');
		$config['base_url'] = site_url('admin/');
 		$config['total_rows'] = $this->Admin_model->count_all();
 		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		// load view
		$data['roles'] = $this->Role_model->get_list();
		$data['admins'] = $this->Admin_model->get_list();
		$this->load->view('includes/header');
		$this->load->view('admin/adminList', $data);
		$this->load->view('includes/footer');
		
		}
		
		else
		
		{
			redirect('login','refresh');
		}
	}
	
	function flo($offset = 0)
	{
		if($this->session->userdata('logged_in'))
		{	
		
		// offset
		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);
		
		// load view
		$data['roles'] = $this->Role_model->get_list();
		$data['admins'] = $this->Admin_model->get_list_flo();
		$data['toilets'] = $this->Toilet_model->get_list();
		$data['devices'] = $this->Device_model->get_list();
		$this->load->view('includes/header');
		$this->load->view('admin/floList', $data);
		$this->load->view('includes/footer');
		}
		
		else
		
		{
			redirect('login','refresh');
		}
	}

	function add()
	
	{
	
		$this->form_validation->set_rules('username', 'Username', 'is_unique[tbl_system_user.username]');
		$active_status = null;
		//print_r($this->input->post()); die();
		$roles = $this->Role_model->get_role_by_id($this->input->post('role'));
			foreach($roles->result() as $role)
			$role_variable = $role->name;
	    $date = date_create(date("Y-m-d H:i:s"), timezone_open('Africa/Nairobi'));
		$admin = array('name' => $this->input->post('name'),
						'username' => $this->input->post('username'),
						'role' => $this->input->post('role'),
						'status' => $this->input->post('active'),
						'password' => md5($this->input->post('password')));
					
		if ($this->input->post('active') == "1")
			$active_status = "Active";
		else
			$active_status = "Inactive";
		//print_r("Status:". $active_status . $this->input->post('active')); die();
		$audit = array('username' =>($this->session->userdata('logged_in')['username']),
						'description' => "Created a New System User :: Name: ". $this->input->post('name'). ", Username: ". $this->input->post('username'). ", Role: ". $role_variable.", Status: ". $active_status. "",
						'date' => date_format($date, 'Y-m-d H:i:s'),
						'category' => 2);
						
		if ($this->form_validation->run() == TRUE)
		
		{
		
			$this->db->trans_start();
								
			$this->Audit_model->save($audit);
			$this->Admin_model->save($admin);
			
			$this->db->trans_complete();
		
			if ($this->db->trans_status() === FALSE)
				{
				echo "System User could not be added";
				}
			else
				{
				echo "System User successfully added";
				}
		}
		
		else
		
		{
			echo "System User not added, Username already exists";
			
		}
	
	}
	
	public function username_check($str)
	{
		if ($str == 'tests')
		{
			$this->form_validation->set_message('username_check', 'The %s field can not be the word "test"');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	function floadd()
	
	{	
		$this->form_validation->set_rules('username', 'Username', 'is_unique[tbl_system_user.username]');
		$active_status = null;
		$toilets = $this->Toilet_model->get_toilet_by_id($this->input->post('toilet'));
			foreach($toilets->result() as $toilet)
			$toilet_variable = $toilet->name;
		$devices = $this->Device_model->get_device_by_id($this->input->post('device'));
			foreach($devices->result() as $device)
			$device_variable = $device->imei;
		$date = date_create(date("Y-m-d H:i:s"), timezone_open('Africa/Nairobi'));
		$admin = array('name' => $this->input->post('name'),
						'username' => $this->input->post('username'),
						'toilet' => $this->input->post('toilet'),
						'device' => $this->input->post('device'),
						'status' => $this->input->post('active'),
						'role' => 5,
						'password' => md5($this->input->post('password')));
						
		if ($this->input->post('active') == "1")
			$active_status = "Active";
		else
			$active_status = "Inactive";
			
		$audit = array('username' =>($this->session->userdata('logged_in')['username']),
						'description' => "Created FLO:: Name: ". $this->input->post('name'). ", Username: ". $this->input->post('username').", Toilet: ". $toilet_variable.", Device: ". $device_variable." , Status: ". $active_status."",
						'date' => date_format($date, 'Y-m-d H:i:s'),
						'category' => 2);
		if ($this->form_validation->run() == TRUE)
		
		{
			$this->db->trans_start();
								
			$this->Audit_model->save($audit);
			$this->Admin_model->save($admin);
			
			$this->db->trans_complete();
		
			if ($this->db->trans_status() === FALSE)
				{
				echo "FLO could not be added";
				}
			else
				{
				echo "FLO successfully added";
				}
		}
		
		else
		
		{
			echo "FLO not added, Username already exists";
			
		}
		
	}
	
	function edit( $id = null)
	
	{
		if($id == null)
		
		{
		//print_r($this->input->post()); die();
			$active_status = null;
			$roles = $this->Role_model->get_role_by_id($this->input->post('role'));
				foreach($roles->result() as $role)
				$role_variable = $role->name;
			$date = date_create(date("Y-m-d H:i:s"), timezone_open('Africa/Nairobi'));
			$id = $this->input->post('item_id');
			
			$admin = array('name' => $this->input->post('name'),
						'role' => $this->input->post('role'),
						'status' => $this->input->post('edit_active'));
			
			if ($this->input->post('edit_active') == "1")
			
				$active_status = "Active";
			
			else
			
				$active_status = "Inactive";
				
			$audit = array('username' =>($this->session->userdata('logged_in')['username']),
						'description' => "Updated System User Details:: Name: ". $this->input->post('name'). ", Role: ". $role_variable.", Status: ". $active_status."",
						'date' => date_format($date, 'Y-m-d H:i:s'),
						'category' => 2);
						
			$this->db->trans_start();
								
			$this->Audit_model->save($audit);
			$this->Admin_model->update($id, $admin);
			
			$this->db->trans_complete();
		
			if ($this->db->trans_status() === FALSE)
				{
				echo "System User could not be added";
				}
			else
				{
				echo "System User successfully Updated";
				}
		}
		
		else
		
		{
			$data['admin'] = $this->Admin_model->get_by_id($id);
			$data['roles'] = $this->Role_model->get_list_role();
			$this->load->view('admin/editAdmin', $data);
		}
	
	}
	
	function floedit( $id = null)
	
	{
		if($id == null)
		
		{
		//print_r($this->input->post());
			$toilets = $this->Toilet_model->get_toilet_by_id($this->input->post('toilet'));
				foreach($toilets->result() as $toilet)
				$toilet_variable = $toilet->name;
			$devices = $this->Device_model->get_device_by_id($this->input->post('device'));
				foreach($devices->result() as $device)
				$device_variable = $device->imei;
			$date = date_create(date("Y-m-d H:i:s"), timezone_open('Africa/Nairobi'));
			$id = $this->input->post('item_id');
			
			$admin = array('name' => $this->input->post('name'),
						'toilet' => $this->input->post('toilet'),
						'device' => $this->input->post('device'),
						'status' => $this->input->post('edit_flo_active'));
			
			if ($this->input->post('edit_flo_active') == "1")
			
				$active_status = "Active";
			
			else
			
				$active_status = "Inactive";
				
			$audit = array('username' =>($this->session->userdata('logged_in')['username']),
						'description' => "Updated FLO Details:: Name: ". $this->input->post('name'). ", Toilet: ". $toilet_variable.", Device: ". $device_variable.", Status: ". $active_status."",
						'date' => date_format($date, 'Y-m-d H:i:s'),
						'category' => 2);
						
			$this->db->trans_start();
								
			$this->Audit_model->save($audit);
			$this->Admin_model->update($id, $admin);
			
			$this->db->trans_complete();
		
			if ($this->db->trans_status() === FALSE)
				{
				echo "FLO details could not be updated, Please try again";
				}
			else
				{
				echo "FLO details successfully Updated";
				}
		}
		
		else
		
		{
			$data['admin'] = $this->Admin_model->get_by_id($id);
			$data['toilets'] = $this->Toilet_model->get_list($id);
			$data['devices'] = $this->Device_model->get_list($id);
			$this->load->view('admin/editFlo', $data);
		}
	
	}
	
	public function delete($id)
	
	{
		$date = date_create(date("Y-m-d H:i:s"), timezone_open('Africa/Nairobi'));
		$role_variable = null;
		$active_status = null;
		
		$datas = $this->Admin_model->get_join_by_id($id);
				foreach ($datas->result() as $admin)
				
		if ($admin->status == "1")
			
				$active_status = "Active";
			
			else
			
				$active_status = "Inactive";
				
		$audit = array('username' =>($this->session->userdata('logged_in')['username']),
							'description' => "Deleted System User :: Name: ". $admin->name. ", Username: ". $admin->username. ", Role: ". $admin->role.", Active Status: ". $active_status."",
							'date' => date_format($date, 'Y-m-d H:i:s'),
							'category' => 2);		
		$this->db->trans_start();
							
		$this->Audit_model->save($audit);
		$this->Admin_model->delete($id);
			
		$this->db->trans_complete();
		
		if ($this->db->trans_status() === FALSE)
		
			{
				echo "System User could not be deleted Successful";
				redirect('admin','refresh');
			} 
				echo "System User Deleted Successful";
				redirect('admin','refresh');
			
		//$this->session->set_flashdata('message', 'System User Deleted Successful');
	}
	
	public function flodelete($id)
	
	{
		$date = date_create(date("Y-m-d H:i:s"), timezone_open('Africa/Nairobi'));
		$role_variable = null;
		$active_status = null;
				
		$datas = $this->Admin_model->get_join_by_id($id);
				foreach ($datas->result() as $admin)
			
		if ($admin->status == "1")
			
				$active_status = "Active";
			
			else
			
				$active_status = "Inactive";
					
		$audit = array('username' =>($this->session->userdata('logged_in')['username']),
							'description' => "Deleted FLO :: Name: ". $admin->name. ", Username: ". $admin->username. ", Role: ". $admin->role.", Active Status: ". $active_status."",
							'date' => date_format($date, 'Y-m-d H:i:s'),
							'category' => 2);
		
		$this->db->trans_start();
							
		$this->Audit_model->save($audit);
		$this->Admin_model->delete($id);
			
		$this->db->trans_complete();
		
		if ($this->db->trans_status() === FALSE)
		
			{
				echo "FLO could not be deleted Successful";
				redirect('admin/flo','refresh');
			} 
				$this->session->set_flashdata('message', 'FLO Deleted Successful');
				redirect('admin/flo','refresh');
			
		$this->Audit_model->save($audit);
		$this->Admin_model->delete($id);
		$this->session->set_flashdata('message', 'FLO Deleted Successful');
		redirect('admin/flo','refresh');
	}
	
}
?>