<?php

class Login extends Controller
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
	
	//	Default function, redirects to login page if no user logged in yet
	public function index()
	{
		if ($this->session->userdata('member_login') == 1)
			redirect(base_url() . 'index.php?member/dashboard', 'refresh');
		
		if ($this->session->userdata('agent_login') == 1)
			redirect(base_url() . 'index.php?agent/dashboard', 'refresh');
		
		if ($this->session->userdata('merchant_login') == 1)
			redirect(base_url() . 'index.php?merchant/dashboard', 'refresh');
		
		$page_data['page_name'] = 'login';
		$this->load->view('home/index', $page_data);
	}
	
	//	User signin
	public function signin()
	{
		$data = array(
			'username'	=> $this->input->post('uname'),
			'upin'		=> $this->input->post('upin')
		);
		
		//	Checking login data for user
		$query = $this->db->get_where('user', $data);
		if($query->num_rows() > 0)
		{
			$row = $query->row();
			if($row->status == 0)
			{
				$response = array(
					'status'	=> 'info',
					'title'		=> 'Opps..',
					'text'		=> '<p>You can\'t login because you have not subcription</p> <p>Pay for your subscription <a href class="btn btn-success btn-xs">here</a></p>',
					'footer'	=> '<a href="">Need help?</a>'
				);
				echo json_encode($response);
			}
			else if ($row->status == 1)
			{
				//	Member login
				if($row->category == 'member')
				{
					$this->session->set_userdata('member_login', '1');
					$this->session->set_userdata('member_login_id', $row->user_id);
					$this->session->set_userdata('login_type', $row->category);
					
					$response = array(
						'status'	=> 'success',
						'message'	=> '<span> <strong>Login Successful!</strong> </span>',
						'redirect'	=> base_url() . '?member/dashboard'
					);
					echo json_encode($response);
				}
				//	Agent login
				if($row->category == 'agent')
				{
					$this->session->set_userdata('agent_login', '1');
					$this->session->set_userdata('agent_login_id', $row->user_id);
					$this->session->set_userdata('login_type', $row->category);
					
					$response = array(
						'status'	=> 'success',
						'message'	=> '<span> <strong>Login Successful!</strong> </span>',
						'redirect'	=> base_url() . '?agent/dashboard'
					);
					echo json_encode($response);
				}
				//	Merchant login
				if($row->category == 'merchant')
				{
					$this->session->set_userdata('merchant_login', '1');
					$this->session->set_userdata('merchant_login_id', $row->user_id);
					$this->session->set_userdata('login_type', $row->category);
					
					$response = array(
						'status'	=> 'success',
						'message'	=> '<span> <strong>Login Successful!</strong> </span>',
						'redirect'	=> base_url() . '?merchant/dashboard'
					);
					echo json_encode($response);
				}
			}
		}
		else{
			//	Report error
			$response = array(
				'status'	=> 'error',
				'message'	=> '<span> <strong>Error!</strong> Invalid Login. </span>'
			);
			echo json_encode($response);
		}
	}
	
	/*** PASSWORD RESET BY EMAIL ***/
	public function forgot_pin()
	{
		// $this->load->view('portal/forgot_password');
		$page_data['page_name'] = 'forgot_pin';
		$this->load->view('home/index', $page_data);
	}
	
	public function reset_pin()
	{
		$email = $this->input->post('email');
		$reset_account_type     = '';
		//resetting user password here
		// $new_pin = substr(md5(rand(100000000,20000000000)), 0 ,5);
		$new_pin = substr(rand(100000000,20000000000), 0 ,6);
		
		// Checking credential for admin
		$query = $this->db->get_where('user' , array('email' => $email));
		if ($query->num_rows() > 0)
		{
			$row = $query->row();
			//$this->db->where('email' , $email);
			//$this->db->update('admin' , array('password' => $new_password));
			$this->db->update('user', array('email' => $email), array('upin' => $new_pin));
			
			// send new password to user email
			$email_msg		=	"Password Reset Mail \n";
			$email_msg		.=	"Your account type : ".$row->category."\n";
			$email_msg		.=	"Your username : ". $row->username ."\n";
			$email_msg		.=	"Your new pin : ". $new_pin ."\n";
			$email_msg		.=	"Login here : ".base_url()."\n";
			$email_sub		=	"Password Reset - Food Basket Nigeria";
			$email_to		=	$email;
			$SendFrom =    "Food Basket Nigeria <hello@foodbasketnigeria.com>";
			$MsgBody = htmlspecialchars($email_msg, ENT_NOQUOTES); 

			if (mail($email_to, $email_sub, $email_msg, "From: $SendFrom")) 
			{
				$this->session->set_flashdata('reset_success', 'Please check your email for new pin.');
				redirect(base_url() . 'index.php?login/forgot_pin', 'refresh');
			}
		}
		
		$this->session->set_flashdata('reset_error', 'The email you provide does not exist.');
		redirect(base_url() . 'index.php?login/forgot_pin', 'refresh');
	}
	
	/*** LOGOUT FUNCTION ***/
	public function logout()
	{
		$this->session->sess_destroy();
		$this->session->set_flashdata('logout_notification', 'Logged Out');
		redirect(base_url().'index.php?login', 'refresh');
	}

}