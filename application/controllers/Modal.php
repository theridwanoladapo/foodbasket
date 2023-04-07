<?php

class Modal extends Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
	}
	
	public function index()
	{
		
	}
	
	/** Modal Popup **/
	function popup($page_name = '', $param2 = '', $param3 = '')
	{
		$account_type			=	$this->session->userdata('login_type');
		$page_data['param2']	=	$param2;
		$page_data['param3']	=	$param3;
		$this->load->view($account_type.'/'.$page_name, $page_data);
	}
}