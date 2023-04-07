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
		/*else
		{
			//	Checking login data for agent
			$query_agent = $this->db->get_where('agent', $data);
			if($query_agent->num_rows() > 0)
			{
				$row = $query_agent->row();
				if($row->status == 0)
				{
					$response = array(
						'status'	=> 'info',
						'title'		=> 'Opps..',
						'text'		=> '<p>Your can\'t login because you have not subcription</p> <p>Pay for your subscription <a href class="btn btn-success btn-xs">here</a></p>',
						'footer'	=> '<a href="">Need help?</a>'
					);
					echo json_encode($response);
				}
				else if ($row->status == 1)
				{
					$this->session->set_userdata('agent_login', '1');
					$this->session->set_userdata('agent_login_id', $row->agent_id);
					$this->session->set_userdata('login_type', 'agent');

					$response = array(
						'status'	=> 'success',
						'message'	=> '<span> <strong>Login Successful!</strong> </span>',
						'redirect'	=> base_url().'?agent/dashboard'
					);
					echo json_encode($response);
				}
			}
			else
			{
				//	Checking login data for merchant
				$query_merchant = $this->db->get_where('merchant', $data);
				if($query_merchant->num_rows() > 0)
				{
					$row = $query_merchant->row();
					if($row->status == 0)
					{
						$response = array(
							'status'	=> 'info',
							'title'		=> 'Oops..',
							'text'		=> '<p>Your can\'t login because you have not subcribe</p> <p>Pay for your subscription <a href class="btn btn-success btn-xs">here</a></p>',
							'footer'	=> '<a href="">Need help?</a>'
						);
						echo json_encode($response);
					}
					else if ($row->status == 1)
					{
						$this->session->set_userdata('merchant_login', '1');
						$this->session->set_userdata('merchant_login_id', $row->merchant_id);
						$this->session->set_userdata('login_type', 'merchant');

						$response = array(
							'status'	=> 'success',
							'message'	=> '<span> <strong>Login Successful!</strong> </span>',
							'redirect'	=> base_url().'?merchant/dashboard'
						);
						echo json_encode($response);
					}
				}
				//	Report error
				else{
					$response = array(
						'status'	=> 'error',
						'message'	=> '<span> <strong>Error!</strong> Invalid Login. </span>'
					);
					echo json_encode($response);
				}
			}
		}
		*/
	}
	
	/*** PASSWORD RESET BY EMAIL ***/
	public function forgot_password()
	{
		$this->load->view('portal/forgot_password');
	}
	
	public function reset_password()
	{
		$email = $this->input->post('email');
		$reset_account_type     = '';
		//resetting user password here
		$new_password           =   substr( md5( rand(100000000,20000000000) ) , 0,7);
		
		// Checking credential for admin
		$query = $this->db->get_where('admin' , array('email' => $email));
		if ($query->num_rows() > 0)
		{
			$reset_account_type     =   'admin';
			//$this->db->where('email' , $email);
			//$this->db->update('admin' , array('password' => $new_password));
			// send new password to user email
			//$this->email_model->password_reset_email($new_password , $reset_account_type , $email);
			$this->session->set_flashdata('reset_success', 'Please check your Email for new Password');
			redirect(base_url() . 'index.php?login/forgot_password', 'refresh');
		}
		
		$this->session->set_flashdata('reset_error', 'Password Reset was Failed');
		redirect(base_url() . 'index.php?login/forgot_password', 'refresh');
	}
	
	/*** LOGOUT FUNCTION ***/
	public function logout()
	{
		$this->session->sess_destroy();
		$this->session->set_flashdata('logout_notification', 'Logged Out');
		redirect(base_url().'index.php?login', 'refresh');
	}

}