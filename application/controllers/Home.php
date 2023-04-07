<?php

class Home extends Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	public function index()
	{
		//$page_data['page_name'] = 'home';
		//$this->load->view('home/index', $page_data);
		redirect(base_url() . '?login', 'refresh');
	}
	
	public function register()
	{
		$page_data['page_name'] = 'register';
		$this->load->view('home/index', $page_data);
	}
}