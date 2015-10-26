<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Role extends CI_Controller {

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
		$admins = $this->Role_model->get_paged_list($this->limit, $offset)->result();
		
		// generate pagination
		$this->load->library('pagination');
		$config['base_url'] = site_url('role/');
 		$config['total_rows'] = $this->Role_model->count_all();
 		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		// load view
		$data['roles'] = $this->Role_model->get_list_role();
		$this->load->view('includes/header');
		$this->load->view('role/roleList', $data);
		$this->load->view('includes/footer');
		
		}
		
		else
		
		{
			redirect('login','refresh');
		}
	}
	
	function add()
	
	{
		$date = date_create(date("Y-m-d H:i:s"), timezone_open('Africa/Nairobi'));
		$role = array('name' => $this->input->post('name'),
					'description' => $this->input->post('description'));
		
		$audit = array('username' =>($this->session->userdata('logged_in')['username']),
						'description' => "Created a Role :: Name: ". $this->input->post('name'). ", Description: ". $this->input->post('description')."",
						'date' => date_format($date, 'Y-m-d H:i:s'),
						'category' => 2);
		if($this->Audit_model->save($audit) && $this->Role_model->save($role))
		
			echo "Role successfully added";
			
		else
		
			echo "Role could not be added";
	
	}
	
	function edit( $id = null)
	
	{
		if($id == null)
		
		{
			$date = date_create(date("Y-m-d H:i:s"), timezone_open('Africa/Nairobi'));
			$id = $this->input->post('item_id');
			
			$role = array('name' => $this->input->post('name'),
						'description' => $this->input->post('description'));
						
			$audit = array('username' =>($this->session->userdata('logged_in')['username']),
						'description' => "Editted Role Details :: Name: ". $this->input->post('name'). ", Description: ". $this->input->post('description')."",
						'date' => date_format($date, 'Y-m-d H:i:s'),
						'category' => 2);
						
			($this->Audit_model->save($audit) && $this->Role_model->update($id, $role));
		
			echo "Role successfully Updated";
			
		}
		
		else
		
		{
			$data['role'] = $this->Role_model->get_by_id($id);
			$this->load->view('role/editRole', $data);
		}
	
	}
	
	public function delete($id)
	
	{
	
		$this->Role_model->delete($id);
		$this->session->set_flashdata('message', 'Role Deleted Successful');
		redirect('role','refresh');
	}
	
}
?>