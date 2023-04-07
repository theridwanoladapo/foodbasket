<?php

class Member extends Controller
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
	
	//	Default function, redirects to login page if no member logged in yet
	public function index()
	{
		if($this->session->userdata('member_login') != 1)
			redirect(base_url() . '?login', 'refresh');
		if($this->session->userdata('member_login') == 1)
			redirect(base_url() . '?member/dashboard', 'refresh');
	}
	
	
	
	//	Member dashboard page
	public function dashboard()
	{
		if($this->session->userdata('member_login') != 1)
			redirect(base_url() . '?login', 'refresh');
		
		$page_data['page_name']		= 'dashboard';
		$page_data['page_title']	= 'My Dashboard | Food Basket Nigeria';
		$this->load->view('member/index', $page_data);
	}
	
	//	Member profile page
	public function profile()
	{
		if($this->session->userdata('member_login') != 1)
			redirect(base_url() . '?login', 'refresh');
		
		$page_data['page_name']		= 'profile';
		$page_data['page_title']	= 'My Profile | Food Basket Nigeria';
		$this->load->view('member/index', $page_data);
	}
	
	//	Member info edit page
	public function edit($param = '')
	{
		if($this->session->userdata('member_login') != 1)
			redirect(base_url() . '?login', 'refresh');
		
		//	Profile edit
		if($param == 'profile'){
			$page_data['page_name']		= 'profile_edit';
			$page_data['page_title']	= 'Edit Profile | Food Basket Nigeria';
		}
		//	Store info edit
		if($param == 'store'){
			$page_data['page_name']		= 'store_edit';
			$page_data['page_title']	= 'Store Info Edit | Food Basket Nigeria';
		}
		//	Pin edit
		if($param == 'pin'){
			$page_data['page_name']		= 'pin_edit';
			$page_data['page_title']	= 'Change Pin | Food Basket Nigeria';
		}
		
		$this->load->view('member/index', $page_data);
	}
	
	//	Member tree page
	public function tree()
	{
		if($this->session->userdata('member_login') != 1)
			redirect(base_url() . '?login', 'refresh');
		
		$page_data['page_name']		= 'tree';
		$page_data['page_title']	= 'Level Tree | Food Basket Nigeria';
		$this->load->view('member/index', $page_data);
	}
	
	//	Member transfer page
	public function transfer()
	{
		if($this->session->userdata('member_login') != 1)
			redirect(base_url() . '?login', 'refresh');
		
		$page_data['page_name']		= 'transfer';
		$page_data['page_title']	= 'Transfer | Food Basket Nigeria';
		$this->load->view('member/index', $page_data);
	}
	
	//	Member transactions page
	public function transactions()
	{
		if($this->session->userdata('member_login') != 1)
			redirect(base_url() . '?login', 'refresh');
		
		$page_data['page_name']		= 'transactions';
		$page_data['page_title']	= 'Transactions | Food Basket Nigeria';
		$this->load->view('member/index', $page_data);
	}
	
	//	Member referral page
	public function referral()
	{
		if($this->session->userdata('member_login') != 1)
			redirect(base_url() . '?login', 'refresh');
		
		$page_data['page_name']		= 'referral';
		$page_data['page_title']	= 'Referral | Food Basket Nigeria';
		$this->load->view('member/index', $page_data);
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
			
			//	Check sender balance
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