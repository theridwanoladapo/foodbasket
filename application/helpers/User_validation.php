<?php
	//	Email validation
	function email_validation($table, $email)
	{
		$con = &get_instance();
		$where = array('email' => $email);
		$num_rows = $con->db->get_where($table, $where)->num_rows();
		if($num_rows > 0){
			return 0;
		} else {
			return 1;
		}
	}
	
	//	Email validation for edit
	function email_validation_for_edit($table, $email, $id, $type)
	{
		$con = &get_instance();
		$where = array('email' => $email);
		$num_rows = $con->db->get_where_not_in($table, $type, $id, $where)->num_rows();
		if($num_rows > 0){
			return 0;
		} else {
			return 1;
		}
	}
	
	//	Mobile validation
	function mobile_validation($table, $mobile)
	{
		$con = &get_instance();
		$where = array('mobile' => $mobile);
		$num_rows = $con->db->get_where($table, $where)->num_rows();
		if($num_rows > 0){
			return 0;
		} else {
			return 1;
		}
	}
	
	//	Mobile validation for update
	function mobile_validation_update($table, $mobile, $user_id)
	{
		$con = &get_instance();
		$where = array('user_id' => $user_id, 'mobile' => $mobile);
		$num_rows = $con->db->get_where($table, $where)->num_rows();
		if($num_rows > 0){
			return 0;
		} else {
			return 1;
		}
	}

	//	Username validation
	function username_validation($table, $uname)
	{
		$con = &get_instance();
		$where = array('username' => $uname);
		$num_rows = $con->db->get_where($table, $where)->num_rows();
		if($num_rows > 0){
			return 0;
		} else {
			return 1;
		}
	}
	
	//	Mobile validation for update
	function username_validation_update($uname, $user_id)
	{
		$con = &get_instance();
		$where = array('user_id' => $user_id, 'username' => $uname);
		$num_rows = $con->db->get_where('user', $where)->num_rows();
		if($num_rows > 0){
			return 0;
		} else {
			return 1;
		}
	}
