<?php

class Admin extends Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
		
		//	Cache control
		header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
		header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		header('Pragma: no-cache');
		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	}
	
	//	Default function, redirects to login page if no admin logged in yet
	public function index()
	{
		if($this->session->userdata('admin_login') != 1)
			redirect(base_url() . '?admin/login', 'refresh');
		if($this->session->userdata('admin_login') == 1)
			redirect(base_url() . '?admin/dashboard', 'refresh');
	}
	
	
	
	//	Admin login page
	public function login()
	{
		$page_data['page_name']		= 'login';
		$page_data['page_title']	= 'Admin Login | Food Basket Nigeria';
		$this->load->view('admin/index', $page_data);
	}
	
	//	Admin signin
	public function signin()
	{
		$data = array(
			'username'	=> $this->input->post('uname'),
			'passcode'	=> $this->input->post('upin')
		);
		
		//	Checking login data for admin
		$query = $this->db->get_where('admin', $data);
		if($query->num_rows() > 0)
		{
			$row = $query->row();
			
			$this->session->set_userdata('admin_login', 1);
			$this->session->set_userdata('admin_login_id', $row->id);
			$this->session->set_userdata('login_type', 'admin');

			$response = array(
				'status'	=> 'success',
				'message'	=> '<span> <strong>Login Successful!</strong> </span>'
			);
			echo json_encode($response);
		}
		else{
			$response = array(
				'status' => 'error',
				'message' => '<span> <strong>Error!</strong> Invalid Login. </span>'
			);
			echo json_encode($response);
		}
		
	}
	
	//	Admin logout
	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url() . '?admin/login', 'refresh');
	}
	
	//	Admin dashboard page
	public function dashboard()
	{
		if($this->session->userdata('admin_login') != 1)
			redirect(base_url() . '?admin/login', 'refresh');
		
		$page_data['page_name']		= 'dashboard';
		$page_data['page_title']	= 'Admin Dashboard | Food Basket Nigeria';
		$this->load->view('admin/index', $page_data);
	}
	
	//	Admin members page
	public function members()
	{
		if($this->session->userdata('admin_login') != 1)
			redirect(base_url() . '?admin/login', 'refresh');
		
		$page_data['page_name']		= 'members';
		$page_data['page_title']	= 'Users - Members | Food Basket Nigeria';
		$this->load->view('admin/index', $page_data);
	}
	
	//	Admin agents page
	public function agents()
	{
		if($this->session->userdata('admin_login') != 1)
			redirect(base_url() . '?admin/login', 'refresh');
		
		$page_data['page_name']		= 'agents';
		$page_data['page_title']	= 'Users - Agents | Food Basket Nigeria';
		$this->load->view('admin/index', $page_data);
	}
	
	//	Admin merchants page
	public function merchants()
	{
		if($this->session->userdata('admin_login') != 1)
			redirect(base_url() . '?admin/login', 'refresh');
		
		$page_data['page_name']		= 'merchants';
		$page_data['page_title']	= 'Users - Merchants | Food Basket Nigeria';
		$this->load->view('admin/index', $page_data);
	}
	
	//	Admin requests page
	public function requests()
	{
		if($this->session->userdata('admin_login') != 1)
			redirect(base_url() . '?admin/login', 'refresh');
		
		$page_data['page_name']		= 'requests';
		$page_data['page_title']	= 'Withdraw Requests | Food Basket Nigeria';
		$this->load->view('admin/index', $page_data);
	}
	
	//	Admin credits page
	public function credits()
	{
		if($this->session->userdata('admin_login') != 1)
			redirect(base_url() . '?admin/login', 'refresh');
		
		$page_data['page_name']		= 'credits';
		$page_data['page_title']	= 'Users Credit History | Food Basket Nigeria';
		$this->load->view('admin/index', $page_data);
	}
	
	//	Admin debits page
	public function debits()
	{
		if($this->session->userdata('admin_login') != 1)
			redirect(base_url() . '?admin/login', 'refresh');
		
		$page_data['page_name']		= 'debits';
		$page_data['page_title']	= 'Users Debit History | Food Basket Nigeria';
		$this->load->view('admin/index', $page_data);
	}
	
	//	Admin - user credit page
	public function credit()
	{
		if($this->session->userdata('admin_login') != 1)
			redirect(base_url() . '?admin/login', 'refresh');
		
		$page_data['page_name']		= 'credit';
		$page_data['page_title']	= 'Credit User | Food Basket Nigeria';
		$this->load->view('admin/index', $page_data);
	}
	
	//	Admin debit page
	public function debit()
	{
		if($this->session->userdata('admin_login') != 1)
			redirect(base_url() . '?admin/login', 'refresh');
		
		$page_data['page_name']		= 'debit';
		$page_data['page_title']	= 'Debit User | Food Basket Nigeria';
		$this->load->view('admin/index', $page_data);
	}
	
	//	Admin settings page
	public function settings($param = '')
	{
		if($this->session->userdata('admin_login') != 1)
			redirect(base_url() . '?admin/login', 'refresh');
		
		if($param == ''){
			$page_data['page_name']		= 'settings';
			$page_data['page_title']	= 'Settings | Food Basket Nigeria';
		}
		//	General setting
		if($param == 'general'){
			$page_data['page_name']		= 'settings_general';
			$page_data['page_title']	= 'General Settings | Food Basket Nigeria';
		}
		
		$this->load->view('admin/index', $page_data);
	}
	
	
	
	//	Activate User
	function activate($user_id = NULL)
	{
		$user_type = $this->db->get_where('user', array('user_id' => $user_id))->row()->category;
		//	If user type is member
		if($user_type == 'member')
		{
			$this->db->update('user', array('user_id' => $user_id), array('status' => 1));
			$referrer = $this->db->get_where('user', array('user_id' => $user_id))->row()->referrer;
			//	If referrer exists
			if($referrer != '')
			{
				$this->set_upline($user_id);
				//	Reward referrer
				$ref_id = $this->db->get_where('user', array('referral_code' => $referrer))->row()->user_id;
				$this->referral_reward($ref_id);

				$this->session->set_flashdata('flash_message', 'Member account activated successfully.');
				redirect(base_url() . '?admin/members', 'refresh');
			}
			else
			{
				$group = $this->db->get('user', array('groups', 'DESC'))->first_row()->groups;
				$new_group = $group + 1;
				$this->db->update('user', array('user_id' => $user_id), array('groups' => $new_group));
				
				$this->session->set_flashdata('flash_message', 'Member account activated successfully.');
				redirect(base_url() . '?admin/members', 'refresh');
			}
		}
		//	If user type is merchant
		if($user_type == 'merchant')
		{
			$this->db->update('user', array('user_id' => $user_id), array('status' => 1));
			
			$group = $this->db->get('user', array('groups', 'DESC'))->first_row()->groups;
			$new_group = $group + 1;
			$this->db->update('user', array('user_id' => $user_id), array('groups' => $new_group));
			
			$this->session->set_flashdata('flash_message', 'Merchant account activated successfully.');
			redirect(base_url() . '?admin/merchants', 'refresh');
		}
		//	If user type is agent
		if($user_type == 'agent')
		{
			$this->db->update('user', array('user_id' => $user_id), array('status' => 1));
			
			$group = $this->db->get('user', array('groups', 'DESC'))->first_row()->groups;
			$new_group = $group + 1;
			$this->db->update('user', array('user_id' => $user_id), array('groups' => $new_group));
			
			$this->session->set_flashdata('flash_message', 'Agent account activated successfully.');
			redirect(base_url() . '?admin/agents', 'refresh');
		}
	}
	
	//	Set Upline for user
	function set_upline($usr_id = NULL)
	{
		//	Check referrer downline
		$ref = $this->db->get_where('user', array('user_id' => $usr_id))->row()->referrer;
		$ref_dl = $this->db->get_where('user', array('upline' => $ref))->num_rows();
		//	Tf referrer dl is < 2
		if($ref_dl < 2)
		{
			//	Update user upline
			$ref_group = $this->db->get_where('user', array('referral_code' => $ref))->row()->groups;
			$this->db->update('user', array('user_id' => $usr_id), array('upline' => $ref, 'groups' => $ref_group));
			
			$upl = $this->db->get_where('user', array('user_id' => $usr_id))->row()->upline;
			$this->upgrade_level($upl);	//	Upgrade upline level
		}
		//	If downline is equal 2
		if($ref_dl == 2)
		{
			$ref_group = $this->db->get_where('user', array('referral_code' => $ref))->row()->groups;
			$dl_arr = array();
			
			$dl = $this->db->get_where('user', array('upline' => $ref));
			foreach($dl->result_object() as $user)
			{
				array_push($dl_arr, $user->referral_code);
			}
			
			$this->get_upline($usr_id, $ref_group, $dl_arr);
		}
	}
	
	//	Get Upline of user
	function get_upline($usr_id = NULL, $group = NULL, $upl_arr = array())
	{
		$new_dl_arr = array();
//		echo count($upl_arr);
		foreach($upl_arr as $upl)
		{
			$upl_dl = $this->db->get_where('user', array('upline' => $upl))->num_rows();
			
			if($upl_dl < 2) {
				$update = $this->db->update('user', array('user_id' => $usr_id), array('upline' => $upl, 'groups' => $group));
				if($update){
					$usr_upl = $this->db->get_where('user', array('user_id' => $usr_id))->row()->upline;
				}
				$this->upgrade_level($usr_upl);
				
				return;
			}
		}
		
		foreach($upl_arr as $upl)
		{
			$upl_dl = $this->db->get_where('user', array('upline' => $upl))->num_rows();
			
			if($upl_dl == 2) {
				$dl = $this->db->get_where('user', array('upline' => $upl));
				foreach($dl->result_array() as $user)
				{
					$new_dl_arr[] = $user['referral_code'];
				}
			}	
		}
		
		if(count($new_dl_arr) > 0) {
//			print_r($new_dl_arr);
			$this->get_upline($usr_id, $group, $new_dl_arr);
		}
	}
	
	//	Upgrade user level
	function upgrade_level($usr = NULL)
	{
		$usr_dl = $this->db->get_where('user', array('upline' => $usr))->num_rows();
		$usr_id = $this->db->get_where('user', array('referral_code' => $usr))->row()->user_id;
		$usr_upl = $this->db->get_where('user', array('referral_code' => $usr))->row()->upline;
		
		if($usr_dl == 2)
		{
			$this->level_upgrade($usr);
			$this->upgrade_reward($usr_id);
			if($usr_upl != ''){
				$this->upgrade_check($usr_upl);
			}
		}
		return;
	}
	
	//	Check for user level upgrade
	function upgrade_check($usr)
	{
		$dls = $this->db->get_where('user', array('upline' => $usr))->num_rows();
		if($dls == 2)
		{
			$dl1 = $this->db->get_where('user', array('upline' => $usr))->first_row();
			$dl1_lvl = $dl1->level;
			$dl1_stg = $dl1->stage;
			$dl2 = $this->db->get_where('user', array('upline' => $usr))->last_row();
			$dl2_lvl = $dl2->level;
			$dl2_stg = $dl2->stage;

			if($dl1_lvl == $dl2_lvl && $dl1_stg == $dl2_stg)
			{
				$this->upgrade_level($usr);
			}
		}
		return;
	}
	
	//	Level upgrade
	function level_upgrade($ref_code = NULL)
	{
		$init_lvl = $this->db->get_where('user', array('referral_code' => $ref_code))->row()->level;
		$init_stg = $this->db->get_where('user', array('referral_code' => $ref_code))->row()->stage;
		
		if($init_lvl < 1){
			$new_lvl = ($init_lvl+1);
			$new_stg = ($init_stg+1);
			$this->db->update('user', array('referral_code' => $ref_code), array('level' => $new_lvl, 'stage' => $new_stg));
		}
		elseif($init_stg == 5 && $init_lvl > 0)
		{
			$new_lvl = ($init_lvl+1);
			$new_stg = 0;
			$this->db->update('user', array('referral_code' => $ref_code), array('level' => $new_lvl, 'stage' => $new_stg));
		} else {
			$new_stg = ($init_stg+1);
			$this->db->update('user', array('referral_code' => $ref_code), array('stage' => $new_stg));
		}
	}
	
	//	Referral reward
	function referral_reward($usr_id = NULL)
	{
		$init_bal = $this->db->get_where('user_accounts', array('user_id' => $usr_id))->row()->balance;
		
		$reward = 2000 * (20/100);
		$new_bal = ($init_bal + $reward);
		
		$this->db->update('user_accounts', array('user_id' => $usr_id), array('balance' => $new_bal));
	}
	
	//	Upgrade reward
	function upgrade_reward($usr_id = NULL)
	{
		$init_bal = $this->db->get_where('user_accounts', array('user_id' => $usr_id))->row()->balance;

		$reward = 2000 * (15/100);
		$new_bal = ($init_bal + $reward);

		$this->db->update('user_accounts', array('user_id' => $usr_id), array('balance' => $new_bal));
	}
	
	
	//	Request actions
	function request($param = '', $req_id = null){
		//	Approve request
		if($param == 'approve')
		{
			$request = $this->db->get_where('requests', array('id' => $req_id))->row();
			$user_id = $request->user_id;
			
			//	Update request approval status
			$this->db->update('requests', array('id' => $req_id), array('status' => 1));
			
			$user = $this->db->get_where('user', array('user_id' => $user_id))->row();
			$store = $this->db->get_where('stores', array('user_id' => $user_id))->row();
			$username = ucwords($user->firstname . ' ' . $user->lastname.' ('.$store->name.')');
			
			$response = array(
				'type'		=> 'success',
				'title'		=> 'Request Approved',
				'text'		=> '<p>You have successfully approve <strong>'.$username.'</strong> request</p>'
			);
			echo json_encode($response);
		}
		
		//	Disapprove request
		if($param == 'disapprove')
		{
			$request = $this->db->get_where('requests', array('id' => $req_id))->row();
			$user_id = $request->user_id;
			
			//	Update request disapproval status
			$this->db->update('requests', array('id' => $req_id), array('status' => 2));
			
			$user = $this->db->get_where('user', array('user_id' => $user_id))->row();
			$store = $this->db->get_where('stores', array('user_id' => $user_id))->row();
			$username = ucwords($user->firstname . ' ' . $user->lastname.' ('.$store->name.')');
			
			$user_bal = $this->db->get_where('user_accounts', array('user_id' => $user_id))->row()->balance;
			$return_bal = ($user_bal + $request->amount);
			
			//	Return user requested balance
			$this->db->update('user_accounts', array('user_id' => $user_id), array('balance' => $return_bal));
			
			$response = array(
				'type'		=> 'success',
				'title'		=> 'Request Disapproved',
				'text'		=> '<p>You have successfully disapprove <strong>'.$username.'</strong> request</p>'
			);
			echo json_encode($response);
		}
	}
	
	
	//	User wallet credit validation
	function credit_validation()
	{
		$recipient = $this->input->post('recipient');
		$amount = $this->input->post('amount');
		
		//	Check receiver account no.
		$query = $this->db->get_where('user', array('account_no' => $recipient));
		if($query->num_rows() > 0)
		{
			$amount = $this->input->post('amount');
			
			$user = $query->row();
			$username = ucwords($user->firstname . ' ' . $user->lastname);
			$response = array(
				'type'		=> 'warning',
				'username'	=> $username,
				'amount'	=> $amount
			);
			echo json_encode($response);
		}
		else
		{
			$response = array(
				'type'		=> 'error',
				'title'		=> 'Invalid Account Number!',
				'text'		=> '<p>The Recipient Account No. you enter is invalid.</p>',
				'footer'	=> ''
			);
			echo json_encode($response);
		}
	}
	
	//	Credit user wallet
	function credit_user()
	{
		$recipient = $this->input->post('recipient');
		$query = $this->db->get_where('user', array('account_no' => $recipient));
		if($query->num_rows() > 0)
		{
			$amount = $this->input->post('amount');
			$reference = 'CRED-'.substr(rand(0, 999999999), 0, 6);
			$datetime = strtotime(date("Y-m-d H:i:s"));

			$recipient_bal = $this->db->get_where('user_accounts', array('account_no' => $recipient))->row()->balance;
			$user_bal = ($recipient_bal + $amount);
			//	Credit user
			$credit = $this->db->update('user_accounts', array('account_no' => $recipient), array('balance' => $user_bal));

			if($credit)
			{
				//	Record transactions
				$trans = $this->db->insert('transactions', array(
					'reference' 	=> $reference,
					'sender'		=> 1,
					'recipient'		=> $recipient,
					'amount'		=> $amount,
					'type'			=> 'CRED',
					'status'		=> 1,
					'datetime'		=> $datetime
				));

				$rec = $this->db->get_where('user', array('account_no' => $recipient))->row();
				$recpname = ucwords($rec->firstname . ' ' . $rec->lastname);
				$response = array(
					'type'		=> 'success',
					'username'	=> $recpname,
					'amount'	=> $amount
				);
				echo json_encode($response);
			}
		}
	}
	
	//	User wallet debit validation
	function debit_validation()
	{
		$recipient = $this->input->post('recipient');
		$amount = $this->input->post('amount');
		
		//	Check user account no.
		$query = $this->db->get_where('user', array('account_no' => $recipient));
		if($query->num_rows() > 0)
		{
			$amount = $this->input->post('amount');
			
			$user = $query->row();
			$username = ucwords($user->firstname . ' ' . $user->lastname);
			$response = array(
				'type'		=> 'warning',
				'username'	=> $username,
				'amount'	=> $amount
			);
			echo json_encode($response);
		}
		else
		{
			$response = array(
				'type'		=> 'error',
				'title'		=> 'Invalid Account Number!',
				'text'		=> '<p>The Recipient Account No. you enter is invalid.</p>',
				'footer'	=> ''
			);
			echo json_encode($response);
		}
	}
	
	//	Debit user wallet
	function debit_user()
	{
		$recipient = $this->input->post('recipient');
		$query = $this->db->get_where('user', array('account_no' => $recipient));
		if($query->num_rows() > 0)
		{
			$amount = $this->input->post('amount');
			$reference = 'DEB-'.substr(rand(0, 999999999), 0, 6);
			$datetime = strtotime(date("Y-m-d H:i:s"));

			$recipient_bal = $this->db->get_where('user_accounts', array('account_no' => $recipient))->row()->balance;
			$user_bal = ($recipient_bal - $amount);
			//	Debit user
			$debit = $this->db->update('user_accounts', array('account_no' => $recipient), array('balance' => $user_bal));

			if($debit)
			{
				//	Record transactions
				$trans = $this->db->insert('transactions', array(
					'reference' 	=> $reference,
					'sender'		=> $recipient,
					'recipient'		=> 1,
					'amount'		=> $amount,
					'type'			=> 'DEB',
					'status'		=> 1,
					'datetime'		=> $datetime
				));

				$rec = $this->db->get_where('user', array('account_no' => $recipient))->row();
				$recpname = ucwords($rec->firstname . ' ' . $rec->lastname);
				$response = array(
					'type'		=> 'success',
					'username'	=> $recpname,
					'amount'	=> $amount
				);
				echo json_encode($response);
			}
		}
	}
	
	
	
	function getLastNdays($days, $format = 'd/m') {
		$m = date('m');
		$de = date('d');
		$y = date('Y');
		$dateArray = array();
		for ($i = 0; $i <= $days-1; $i++) {
			$date = date($format, mktime(0, 0, 0, $m, ($de-$i), $y));
			$dateArray[] = $date;
		}
		return array_reverse($dateArray);
	}
	
	//	User chart
	function userchart()
	{
		$arr = $this->getLastNdays(7, 'd-m-Y');
		$data1 = array();
		$data2 = array();
		$data3 = array();

		for ($i = 0; $i < 7; $i++)
		{
			$d = $arr[$i];
			$date = strtotime($d);
			$date2 = strtotime($d)+86400;

			$member = $this->db->query("SELECT * FROM `user` WHERE category = 'member' AND reg_date BETWEEN $date AND $date2")->num_rows();
			$data1[] = $member;
			$merchant = $this->db->query("SELECT * FROM `user` WHERE category = 'merchant' AND reg_date BETWEEN $date AND $date2")->num_rows();
			$data2[] = $merchant;
			$agent = $this->db->query("SELECT * FROM `user` WHERE category = 'agent' AND reg_date BETWEEN $date AND $date2")->num_rows();
			$data3[] = $agent;
		}
		
		$res = array(
			'name1' => 'Member',
			'data1' => $data1,
			'name2' => 'Merchant',
			'data2' => $data2,
			'name3' => 'Agent',
			'data3' => $data3
		);
		
		echo json_encode($res);
	}
}