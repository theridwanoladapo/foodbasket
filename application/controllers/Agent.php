<?php

class Agent extends Controller
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
	
	//	Default function, redirects to login page if no agent logged in yet
	public function index()
	{
		if($this->session->userdata('agent_login') != 1)
			redirect(base_url() . '?login', 'refresh');
		if($this->session->userdata('agent_login') == 1)
			redirect(base_url() . '?agent/dashboard', 'refresh');
	}
	
	
	
	//	Agent dashboard page
	public function dashboard()
	{
		if($this->session->userdata('agent_login') != 1)
			redirect(base_url() . '?login', 'refresh');
		
		$page_data['page_name']		= 'dashboard';
		$page_data['page_title']	= 'My Dashboard | Food Basket Nigeria';
		$this->load->view('agent/index', $page_data);
	}
	
	//	Agent profile page
	public function profile()
	{
		if($this->session->userdata('agent_login') != 1)
			redirect(base_url() . '?login', 'refresh');
		
		$page_data['page_name']		= 'profile';
		$page_data['page_title']	= 'My Profile | Food Basket Nigeria';
		$this->load->view('agent/index', $page_data);
	}
	
	//	Agent info edit page
	public function edit($param = '')
	{
		if($this->session->userdata('agent_login') != 1)
			redirect(base_url() . '?login', 'refresh');
		
		//	Profile edit
		if($param == 'profile'){
			$page_data['page_name']		= 'profile_edit';
			$page_data['page_title']	= 'Edit Profile | Food Basket Nigeria';
		}
		//	Pin edit
		if($param == 'pin'){
			$page_data['page_name']		= 'pin_edit';
			$page_data['page_title']	= 'Change Pin | Food Basket Nigeria';
		}
		
		$this->load->view('agent/index', $page_data);
	}
	
	//	Agent tree page
	public function tree()
	{
		if($this->session->userdata('agent_login') != 1)
			redirect(base_url() . '?login', 'refresh');
		
		$page_data['page_name']		= 'tree';
		$page_data['page_title']	= 'Level Tree | Food Basket Nigeria';
		$this->load->view('agent/index', $page_data);
	}
	
	//	Agent transfer page
	public function transfer()
	{
		if($this->session->userdata('agent_login') != 1)
			redirect(base_url() . '?login', 'refresh');
		
		$page_data['page_name']		= 'transfer';
		$page_data['page_title']	= 'Transfer | Food Basket Nigeria';
		$this->load->view('agent/index', $page_data);
	}
	
	//	Agent transactions page
	public function transactions()
	{
		if($this->session->userdata('agent_login') != 1)
			redirect(base_url() . '?login', 'refresh');
		
		$page_data['page_name']		= 'transactions';
		$page_data['page_title']	= 'Transactions | Food Basket Nigeria';
		$this->load->view('agent/index', $page_data);
	}
	
	//	Agent (Add member) page
	public function add_member()
	{
		if($this->session->userdata('agent_login') != 1)
			redirect(base_url() . '?login', 'refresh');
		
		$page_data['page_name']		= 'add_member';
		$page_data['page_title']	= 'Add Member | Food Basket Nigeria';
		$this->load->view('agent/index', $page_data);
	}
	
	//	Agent load account page
	public function load_account()
	{
		if($this->session->userdata('agent_login') != 1)
			redirect(base_url() . '?login', 'refresh');
		
		$page_data['page_name']		= 'load_account';
		$page_data['page_title']	= 'Load Agency Account | Food Basket Nigeria';
		$this->load->view('agent/index', $page_data);
	}
	
	//	Agent referral page
	public function referral()
	{
		if($this->session->userdata('agent_login') != 1)
			redirect(base_url() . '?login', 'refresh');
		
		$page_data['page_name']		= 'referral';
		$page_data['page_title']	= 'Referral | Food Basket Nigeria';
		$this->load->view('agent/index', $page_data);
	}
	
	
	
	//	Check transfer details
	function chk_trans($usr_id)
	{
		$recipient = $this->input->post('recipient');
		$amount = $this->input->post('amount');
		
		//	Check receiver account no.
		$query = $this->db->get_where('user', array('account_no' => $recipient));
		if($query->num_rows() > 0)
		{
			$amount = $this->input->post('amount');
			$sender = $this->db->get_where('user', array('user_id' => $usr_id))->row()->account_no;
			$sender_bal = $this->db->get_where('user_accounts', array('user_id' => $usr_id))->row()->balance;
			
			//	Check sender balance
			if($amount <= $sender_bal)
			{
				$rec = $this->db->get_where('user', array('account_no' => $recipient))->row();
				$recpname = ucwords($rec->firstname . ' ' . $rec->lastname);
				$response = array(
					'type'		=> 'warning',
					'username'	=> $recpname,
					'amount'	=> $amount
				);
				echo json_encode($response);
			}
			else
			{
				$response = array(
					'type'		=> 'error',
					'title'		=> 'Insufficient Balance!',
					'text'		=> '<p>The amount you enter is more than your balance.</p>',
					'footer'	=> ''
				);
				echo json_encode($response);
			}
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
	
	//	Do transfer
	function do_trans($usr_id)
	{
		$recipient = $this->input->post('recipient');
		$query = $this->db->get_where('user', array('account_no' => $recipient));
		if($query->num_rows() > 0)
		{
			$amount = $this->input->post('amount');
			$sender = $this->db->get_where('user', array('user_id' => $usr_id))->row()->account_no;
			$sender_bal = $this->db->get_where('user_accounts', array('user_id' => $usr_id))->row()->balance;

			if($amount <= $sender_bal)
			{
				$reference = 'TRF-'.substr(rand(0, 999999999), 0, 6);
				$datetime = strtotime(date("Y-m-d H:i:s"));

				$sender_bal = ($sender_bal - $amount);
				//	Debit sender
				$debit = $this->db->update('user_accounts', array('account_no' => $sender), array('balance' => $sender_bal));

				if($debit)
				{
					$recipient_bal = $this->db->get_where('user_accounts', array('account_no' => $recipient))->row()->balance;
					$recipient_bal = ($recipient_bal + $amount);
					//	Credit receiver
					$credit = $this->db->update('user_accounts', array('account_no' => $recipient), array('balance' => $recipient_bal));

					if($credit)
					{
						//	Record transactions
						$trans = $this->db->insert('transactions', array(
							'reference' 	=> $reference,
							'sender'		=> $sender,
							'recipient'		=> $recipient,
							'amount'		=> $amount,
							'type'			=> 'TRF',
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
		}
	}
	
	//	Check user balance for load account
	function chk_load($usr_id)
	{
		$amount = $this->input->post('amount');
		$user_earning = $this->db->get_where('user_accounts', array('user_id' => $usr_id))->row()->balance;

		if($amount <= $user_earning)
		{
			$response = array(
				'type'		=> 'warning',
				'amount'	=> $amount
			);
			echo json_encode($response);
		}
		else
		{
			$response = array(
				'type'		=> 'error',
				'title'		=> 'Insufficient Balance!',
				'text'		=> '<p>The amount you enter is more than your earning balance.</p>',
				'footer'	=> ''
			);
			echo json_encode($response);
		}
	}
	
	//	Do load account
	function load_acct($usr_id)
	{
		$amount = $this->input->post('amount');
		$user_earning = $this->db->get_where('user_accounts', array('user_id' => $usr_id))->row()->balance;

		if($amount <= $user_earning)
		{
			$user_earning = ($user_earning - $amount);
			//	Deduct earning
			$deduct = $this->db->update('user_accounts', array('user_id' => $usr_id), array('balance' => $user_earning));

			if($deduct)
			{
				$load_acct_bal = $this->db->get_where('agency_accounts', array('user_id' => $usr_id))->row()->balance;
				$load_acct_bal = ($load_acct_bal + $amount);
				//	Credit load Account
				$credit = $this->db->update('agency_accounts', array('user_id' => $usr_id), array('balance' => $load_acct_bal));
				$response = array(
					'type'		=> 'success',
					'amount'	=> $amount
				);
				echo json_encode($response);
			}
		}
	}
	
	
	// Member signup
	function membersignup()
	{
		$agent_id = $this->session->userdata('agent_login_id');
		$load_bal_chk = $this->chk_load_bal($agent_id);
		if($load_bal_chk == 1)
		{
			$data['firstname']	= $this->input->post('firstname');
			$data['lastname']	= $this->input->post('lastname');
			$data['email']		= $this->input->post('email');
			$data['mobile']		= $this->input->post('mobile');
			$data['username']	= $this->input->post('username');
			$data['upin']		= $this->input->post('upin');

			$email_validation = email_validation('user', $data['email']);
			if($email_validation == 1)
			{
				$mobile_validation = mobile_validation('user', $data['mobile']);
				if($mobile_validation == 1)
				{
					$username_validation = username_validation('user', $data['username']);
					if($username_validation == 1)
					{
						$last_account_no = $this->db->get('user')->last_row()->account_no;
						$account_no = ($last_account_no + 1);
						$data['account_no']		= $account_no;
						$data['category']		= 'member';
						$data['referral_code']	= substr(rand(0, 1000000), 0, 6);
						$data['referrer']		= $this->input->post('referrer');
						$data['upline']	= '';
						$data['groups']	= NULL;
						$data['level']	= 0;
						$data['stage']	= 0;
						$data['status']	= 0;
						$data['reg_date']	= strtotime(date("Y-m-d H:i:s"));
						
						$this->db->insert('user', $data);
						$uid = $this->db->insert_id();
						
						//	Create user accounts
						$this->db->insert('user_accounts', array(
							'user_id' => $uid, 'account_no' => $account_no, 'balance' => 0
						));
						
						//	Activate user
						//	$activate = $this->activate_user($uid);
						
						//	Deduct agent load account bal
						$this->deduct_load_bal($agent_id);
						
						$response = array(
							'type'		=> 'success',
							'title'		=> 'Success!',
							'text'		=> '<p>Member account created successfully. <br> We have sent account details to user\'s email.</p><p>Press \'OK\' to activate user\' account.</p>',
							'user_id'	=> $uid,
							'footer'	=> ''
						);
						echo json_encode($response);
					}
					else
					{
						$response = array(
							'type'		=> 'error',
							'title'		=> 'Username Error!',
							'text'		=> 'Username has already been taken.',
							'footer'	=> '<a href="">Need help?</a>'
						);
						echo json_encode($response);
					}
				}
				else
				{
					$response = array(
						'type'		=> 'error',
						'title'		=> 'Phone Number Error!',
						'text'		=> 'The phone number you provide has already been used.',
						'footer'	=> '<a href="">Need help?</a>'
					);
					echo json_encode($response);
				}
			}
			else
			{
				$response = array(
					'type'		=> 'error',
					'title'		=> 'Email Error!',
					'text'		=> 'The email address you provide has already been used',
					'footer'	=> '<a href="">Need help?</a>'
				);
				echo json_encode($response);
			}
		}
		else
		{
			$response = array(
				'type'		=> 'error',
				'title'		=> 'Insufficient Load Account Balance!',
				'text'		=> '<p>You can not add a new user. <br> You Load Account Balance is low.</p>',
				'footer'	=> '<a href="">Need help?</a>'
			);
			echo json_encode($response);
		}
	}
	
	//	Check load account balance
	function chk_load_bal($usr_id)
	{
		$amount = 2000;
		$load_acct_bal = $this->db->get_where('agency_accounts', array('user_id' => $usr_id))->row()->balance;

		if($load_acct_bal < $amount) {
			return 0;
		} else {
			return 1;
		}
	}
	
	//	Deduct load account balance
	function deduct_load_bal($usr_id)
	{
		$amount = 2000;
		
		$load_acct_bal = $this->db->get_where('agency_accounts', array('user_id' => $usr_id))->row()->balance;
		$load_acct_bal = ($load_acct_bal - $amount);
		
		$this->db->update('agency_accounts', array('user_id' => $usr_id), array('balance' => $load_acct_bal));
		
		return;
	}
	
	
	
	//	Activate user
	function activate_user($user_id = NULL)
	{
		$this->db->update('user', array('user_id' => $user_id), array('status' => 1));
		$referrer = $this->db->get_where('user', array('user_id' => $user_id))->row()->referrer;
		//	if referrer exists
		$this->set_upline($user_id);
		//	reward referrer
		$ref_id = $this->db->get_where('user', array('referral_code' => $referrer))->row()->user_id;
		$this->referral_reward($ref_id);
	}
	
	//	Set user upline
	function set_upline($usr_id = NULL)
	{
		//	Check referrer downline
		$ref = $this->db->get_where('user', array('user_id' => $usr_id))->row()->referrer;
		$ref_dl = $this->db->get_where('user', array('upline' => $ref))->num_rows();
		//	If referrer dl is < 2
		if($ref_dl < 2)
		{
			//	Update user upline
			$ref_group = $this->db->get_where('user', array('referral_code' => $ref))->row()->groups;
			$this->db->update('user', array('user_id' => $usr_id), array('upline' => $ref, 'groups' => $ref_group));
			
			$upl = $this->db->get_where('user', array('user_id' => $usr_id))->row()->upline;
			$this->upgrade_level($upl);	//	Upgrade upline level
			
			return;
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
		
		return;
	}
	
	//	Get user upline
	function get_upline($usr_id = NULL, $group = NULL, $upl_arr = array())
	{
		$new_dl_arr = array();
//		count($upl_arr);
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
		
		return;
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
		}
		if($usr_upl != ''){
			$this->upgrade_check($usr_upl);
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
		
		return;
	}
	
	//	Referral reward
	function referral_reward($usr_id = NULL)
	{
		$init_bal = $this->db->get_where('user_accounts', array('user_id' => $usr_id))->row()->balance;
		
		$reward = 2000 * (20/100);
		$new_bal = ($init_bal + $reward);
		
		$this->db->update('user_accounts', array('user_id' => $usr_id), array('balance' => $new_bal));
		
		return;
	}
	
	//	Upgrade reward
	function upgrade_reward($usr_id = NULL)
	{
		$init_bal = $this->db->get_where('user_accounts', array('user_id' => $usr_id))->row()->balance;

		$reward = 2000 * (15/100);
		$new_bal = ($init_bal + $reward);
		
		$this->db->update('user_accounts', array('user_id' => $usr_id), array('balance' => $new_bal));
		
		return;
	}
	
	
	//	Manage Editing
	function manage($param = '', $usr_id = '')
	{
		//	Edit Profile
		if($param == 'profile')
		{
			$data = array(
				'username'	=> $this->input->post('username'),
				'firstname'	=> $this->input->post('firstname'),
				'lastname'	=> $this->input->post('lastname'),
				'email'		=> $this->input->post('email'),
				'mobile'	=> $this->input->post('mobile')
			);
			
			$this->db->update('user', array('user_id' => $usr_id), $data);
			
			$response = array(
				'type'		=> 'success',
				'title'		=> 'Success!',
				'text'		=> '<p>Profile edited successfully.</p>',
				'footer'	=> ''
			);
			echo json_encode($response);
		}
		//	Edit Store
		if($param == 'store')
		{
			$data = array(
				'name'		=> $this->input->post('name'),
				'location'	=> $this->input->post('location')
			);
			
			$this->db->update('stores', array('user_id' => $usr_id), $data);
			
			$response = array(
				'type'		=> 'success',
				'title'		=> 'Success!',
				'text'		=> '<p>Store Info edited successfully.</p>',
				'footer'	=> ''
			);
			echo json_encode($response);
		}
		//	Change Pin
		if($param == 'pin')
		{
			$oldpin	= $this->input->post('oldpin');
			$newpin	= $this->input->post('newpin');
			
			$cpin = $this->db->get_where('user', array('user_id' => $usr_id))->row()->upin;
			if($cpin == $oldpin)
			{
				$this->db->update('user', array('user_id' => $usr_id), array('upin' => $newpin));

				$response = array(
					'type'		=> 'success',
					'title'		=> 'Success!',
					'text'		=> '<p>Pin change successfully.</p>',
					'footer'	=> ''
				);
				echo json_encode($response);
			}
			else
			{
				$response = array(
					'type'		=> 'error',
					'title'		=> 'Pin Error!',
					'text'		=> '<p>Incorrect old pin.</p>',
					'footer'	=> ''
				);
				echo json_encode($response);
			}
		}
	}
	
}