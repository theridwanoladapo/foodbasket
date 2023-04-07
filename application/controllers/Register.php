<?php

class Register extends Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
        $this->load->library('session');
		
		//	Cache control
        header('Last-Modified: '.gmdate("D, d M Y H:i:s").' GMT');
        header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        header('Pragma: no-cache');
        header("Expires: Mon, 26 Jul 2010 05:00:00 GMT");
	}
	
	//	Default function, redirects to Member Registration page
	public function index($param1 = NULL)
	{
		redirect(base_url() . '?register/member/' . $param1, 'refresh');
	}
	
	//	Referrer function, redirects to Member Registration page
	public function ref($param1 = NULL)
	{
		redirect(base_url() . '?register/member/' . $param1, 'refresh');
	}
	
	//	Register member
	public function member($param1 = NULL)
	{
		$page_data['page_name'] = 'register';
		$page_data['ref'] = $param1;
		$this->load->view('home/index', $page_data);
	}
	
	//	Register agent
	public function agent($param1 = NULL)
	{
		$page_data['page_name'] = 'agent';
		$page_data['ref'] = $param1;
		$this->load->view('home/index', $page_data);
	}
	
	//	Register merchant
	public function merchant($param1 = NULL)
	{
		$page_data['page_name'] = 'merchant';
		$page_data['ref'] = $param1;
		$this->load->view('home/index', $page_data);
	}
	
	
	//	Sign up
	public function signup($param1 = '')
	{
		//	Sign up as an user (member / agent / merchant)
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
					// $email_msg		=	"Welcome to Food Basket Nigeria<br />";
					// $email_msg		.=	"Your account type : ".$param1."<br />";
					// $email_msg		.=	"Your username : ". $data['username'] ."<br />";
					// $email_msg		.=	"Login Here : ".base_url() . '/account/'."<br />";
					// $email_sub		=	"Account opening email - Food Basket Nigeria";
					// $email_to		=	$data['email'];
					// $SendFrom =    "Food Basket Nigeria <hello@foodbasketnigeria.com>";
					// $email_msg .= "\n" . @gethostbyaddr($_SERVER["REMOTE_ADDR"]) . "\n" . $_SERVER["HTTP_USER_AGENT"];
					// $MsgBody = htmlspecialchars($email_msg, ENT_NOQUOTES); 
					// if (mail($email_to, $email_sub, $email_msg, "From: $SendFrom")) {
					
					$msg = "First line of text\nSecond line of text";
					$msg = wordwrap($msg,70);
					if (mail("olaitanoladapo29@gmail.com","My subject",$msg)) {

					$last_account_no = $this->db->get('user')->last_row()->account_no;
					$account_no = ($last_account_no + 1);
					//$data['account_no']		= 20 . substr(rand(0, 100000000), 0, 8);
					$data['account_no']		= $account_no;
					$data['category']		= $param1;
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
					//	For agent
					if($param1 == 'agent'){
						$this->db->insert('agency_accounts', array(
							'user_id' => $uid, 'account_no' => $account_no, 'balance' => 0
						));
					}
					//	For merchant
					if($param1 == 'merchant'){
						$store_name	= $this->input->post('store_name');
						$store_loc	= $this->input->post('store_location');

						$this->db->insert('stores', array(
							'user_id' => $uid, 'name' => $store_name, 'location' => $store_loc
						));
					}


						# code...
					}
					
					// $this->email_model->account_opening_email($param1, $data['email'], $data['username']);

					$response = array(
						'type'		=> 'success',
						'title'		=> 'Registration Successful',
						'text'		=> '<p>We have sent your account details to your email</p> <p>Pay for your subscription</p> <a href class="btn btn-success btn-xs">here</a>',
						'footer'	=> ''
					);
					echo json_encode($response);
				}
				else
				{
					$response = array(
						'type'		=> 'error',
						'title'		=> 'Registration Error',
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
					'title'		=> 'Registration Error',
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
				'title'		=> 'Registration Error',
				'text'		=> 'The email address you provide has already been used.',
				'footer'	=> '<a href="">Need help?</a>'
			);
			echo json_encode($response);
		}
	}
}