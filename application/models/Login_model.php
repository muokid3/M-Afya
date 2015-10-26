<?php
class Login_model extends CI_Model {
	
	private $tbl_system_user= 'users';
	
	function __construct(){
		parent::__construct();
	}
	
	function login($username, $password)
	{
		$this -> db -> select('id, username, password, role_id');
		$this -> db -> from('users');
		$this -> db -> where('username = ' . "'" . $username . "'"); 
		$this -> db -> where('password = ' . "'" . MD5($password) . "'"); 
		$this -> db -> limit(1);

		$query = $this -> db -> get();

		if($query -> num_rows() == 1)
		{
			return $query->result();
		}
		else
		{
			return false;
		}

	}

	function merchantLogin($username, $password)
	{
		$this -> db -> select('id, username, password, business_no');
		$this -> db -> from('merchants');
		$this -> db -> where('username = ' . "'" . $username . "'"); 
		$this -> db -> where('password = ' . "'" . MD5($password) . "'"); 
		$this -> db -> limit(1);

		$query = $this -> db -> get();

		if($query -> num_rows() == 1)
		{
			return $query->result();
		}
		else
		{
			return false;
		}

	}

	
}
?>