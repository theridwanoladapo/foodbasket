<?php
	
	function get_type_name_by_id($type = '', $type_id = '', $field = 'name')
	{
		$con = &get_instance();
		if($type_id != null && $type_id != 0)
		{
			return $con->db->get_where($type, array($type.'_id' => $type_id))->row()->$field;
			//return($name != null) ? $name : '';
		}
	}
	
	////////STUDENT/////////////
	function get_students($class_id)
	{
		$con = &get_instance();
		$query = $con->db->get_where('student', array('class_id' => $class_id));
		return $query->result_array();
	}
	
	function get_student_info($student_id)
	{
		$con = &get_instance();
		$query = $con->db->get_where('student', array('student_id' => $student_id));
		return $query->result_array();
	}
	
	/////////TEACHER/////////////
	function get_teachers()
	{
		$con = &get_instance();
		$query = $con->db->get('teacher');
		return $query->result_array();
	}
	
	function get_teacher_name($teacher_id)
	{
		$con = &get_instance();
		$query = $con->db->get_where('teacher', array('teacher_id' => $teacher_id));
		$res = $query->result_array();
		foreach($res as $row)
			return $row['name'];
	}
	
	function get_teacher_info($teacher_id)
	{
		$con = &get_instance();
		$query = $con->db->get_where('teacher', array('teacher_id' => $teacher_id));
		return $query->result_array();
	}
	
	//////////SUBJECT/////////////
	function get_subjects()
	{
		$con = &get_instance();
		$query = $con->db->get('subject');
		return $query->result_array();
	}
	
	function get_subject_info($subject_id)
	{
		$con = &get_instance();
		$query = $con->db->get_where('subject', array('subject_id' => $subject_id));
		return $query->result_array();
	}
	
	function get_subjects_by_class($class_id)
	{
		$con = &get_instance();
		$query = $con->db->get_where('subject', array('class_id' => $class_id));
		return $query->result_array();
	}
	
	function get_subject_name_by_id($subject_id)
	{
		$con = &get_instance();
		$query = $con->db->get_where('subject', array('subject_id' => $subject_id))->row();
		return $query->name;
	}
	
	////////////CLASS///////////
	function get_class_name($class_id)
	{
		$con = &get_instance();
		$query = $con->db->get_where('class', array('class_id' => $class_id));
		$res = $query->result_array();
		foreach($res as $row)
			return $row['name'];
	}
	
	function get_class_name_numeric($class_id)
	{
		$con = &get_instance();
		$query = $con->db->get_where('class', array('class_id' => $class_id));
		$res = $query->result_array();
		foreach($res as $row)
			return $row['name_numeric'];
	}
	
	function get_classes()
	{
		$con = &get_instance();
		$query = $con->db->get('class');
		return $query->result_array();
	}
	
	function get_class_info($class_id)
	{
		$con = &get_instance();
		$query = $con->db->get_where('class', array('class_id' => $class_id));
		return $query->result_array();
	}
	
	////////////Section///////////
	function get_section_name($section_id)
	{
		$con = &get_instance();
		$query = $con->db->get_where('section', array('section_id' => $section_id));
		$res = $query->result_array();
		foreach($res as $row)
			return $row['name'];
	}
	
	function get_section_nick_name($section_id)
	{
		$con = &get_instance();
		$query = $con->db->get_where('section', array('section_id' => $section_id));
		$res = $query->result_array();
		foreach($res as $row)
			return $row['nick_name'];
	}
	
	function get_sections()
	{
		$con = &get_instance();
		$query = $con->db->get('section');
		return $query->result_array();
	}
	
	function get_section_info($section_id)
	{
		$con = &get_instance();
		$query = $con->db->get_where('section', array('section_id' => $section_id));
		return $query->result_array();
	}
	
	//////////EXAMS/////////////
	function get_exams()
	{
		$query = $con->db->get_where('exam', array(
			'year' => $con->db->get_where('settings', array('type' => 'running_year'))->row()->description
		));
		return $query->result_array();
	}
	
	function get_exam_info($exam_id)
	{
		$con = &get_instance();
		$query = $con->db->get_where('exam', array('exam_id' => $exam_id));
		return $query->result_array();
	}
	
	//////////GRADES/////////////
	function get_grades()
	{
		$con = &get_instance();
		$query = $con->db->get('grade');
		return $query->result_array();
	}
	
	function get_grade_info($grade_id)
	{
		$con = &get_instance();
		$query = $con->db->get_where('grade', array('grade_id' => $grade_id));
		return $query->result_array();
	}
	
	function get_obtained_marks($exam_id, $class_id, $subject_id, $student_id)
	{
		$con = &get_instance();
		$marks = $con->db->get_where('mark', array(
					'subject_id' => $subject_id,
					'exam_id' => $exam_id,
					'class_id' => $class_id,
					'student_id' => $student_id
				))->result_array();
		
		foreach($marks as $row) {
			echo $row['mark_obtained'];
		}
	}
	
	function get_highest_marks($exam_id, $class_id, $subject_id)
	{
		$con = &get_instance();
		$where = array('exam_id' => $exam_id, 'class_id' => $class_id, 'subject_id' => $subject_id);
		$con->db->select_max('mark_obtained');
		$highest_marks = $con->db->get('mark')->result_array();
		foreach($highest_marks as $row) {
			echo $row['mark_obtained'];
		}
	}
	
	function get_grade($mark_obtained)
	{
		$con = &get_instance();
		$query = $con->db->get('grade');
		$grades = $query->result_array();
		foreach($grades as $row) {
			if($mark_obtained >= $row['mark_from'] && $mark_obtained <= $row['mark_upto'])
				return $row;
		}
	}
	
	function create_log($data)
	{
		$data['timestamp'] = strtotime(date('Y-m-d') . ' ' . date('H:i:s'));
		$data['ip'] = $_SERVER["REMOTE_ADDR"];
		$location = new SimpleXMLElement(file_get_contents('http://freegeoip.net/xml/' . $_SERVER["REMOTE_ADDR"]));
		$data['location'] = $location->City . ' , ' . $location->CountryName;
		$con->db->insert('log', $data);
	}
	
	function get_system_settings()
	{
		$con = &get_instance();
		$query = $con->db->get('settings');
		return $query->result_array();
	}
	
	////////BACKUP RESTORE/////////
	function create_backup($type)
	{
		$con = &get_instance();
		$con->load->dbutil();
		
		
		$options = array(
			'format' => 'txt', // gzip, zip, txt
			'add_drop' => TRUE, // Whether to add DROP TABLE statements to backup file
			'add_insert' => TRUE, // Whether to add INSERT data to backup file
			'newline' => "\n"               // Newline character used in backup file
		);
		
		if($type == 'all')
		{
			$tables = array('');
			$file_name = 'system_backup';
		} else {
			$tables = array('tables' => array($type));
			$file_name = 'backup_' . $type;
		}
		
		$backup = & $con->dbutil->backup(array_merge($options, $tables));
		
		$con->load->helper('download');
		force_download($file_name . '.sql', $backup);
	}
	
	/////////RESTORE TOTAL DB/ DB TABLE FROM UPLOADED BACKUP SQL FILE//////////
	function restore_backup()
	{
		//move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/backup.sql');
		$con->load->dbutil();
		
		$prefs = array(
			'filepath' => 'uploads/backup.sql',
			'delete_after_upload' => TRUE,
			'delimiter' => ';'
		);
		$restore = & $con->dbutil->restore($prefs);
		unlink($prefs['filepath']);
	}
	
	/////////DELETE DATA FROM TABLES///////////////
	function truncate($type)
	{
		$con = &get_instance();
		if($type == 'all')
		{
			$con->db->truncate('student');
			$con->db->truncate('mark');
			$con->db->truncate('teacher');
			$con->db->truncate('subject');
			$con->db->truncate('class');
			$con->db->truncate('exam');
			$con->db->truncate('grade');
		} else {
			$con->db->truncate($type);
		}
	}
	
	////////IMAGE URL//////////
	function get_image_url($type = '', $id = '')
	{
		if(file_exists('uploads/' . $type . '_image/' . $id . '.jpg'))
			$image_url = base_url() . 'uploads/' . $type . '_image/' . $id . '.jpg';
		else
			$image_url = base_url() . 'uploads/avatar.png';
		
		return $image_url;
	}
	
	////////STUDY MATERIAL//////////
	function save_study_material_info()
	{
		$con = &get_instance();
		$data['timestamp']		= strtotime($con->input->post('timestamp'));
		$data['title']			= $con->input->post('title');
		$data['description']	= htmlentities($con->input->post('description'), ENT_QUOTES, "UTF-8");
		if(!empty($_FILES["file_name"]["name"])){
			$data['file_name']		= $_FILES["file_name"]["name"];
		}else {
			$data['file_name']		= null;
		}
		if($con->input->post('file_type') != null){
			$data['file_type']		= $con->input->post('file_type');
		}else {
			$data['file_type']		= null;
		}
		$data['class_id']		= $con->input->post('class_id');
		$data['subject_id']		= $con->input->post('subject_id');
		
		$con->db->insert('document', $data);
		
		$document_id			= $con->db->insert_id();
		if(!empty($_FILES["file_name"]["name"]))
			move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/document/".$_FILES["file_name"]["name"]);
	}
	
	function select_study_material_info()
	{
		$con = &get_instance();
		$order_by = array("timestamp", "DESC");
		return $con->db->get('document', $order_by)->result_array();
	}
	//selecting study material info for specific teacher
	
	function select_study_material_info_for_teacher()
	{
		$con = &get_instance();
		$order_by = array("timestamp", "DESC");
		return $con->db->get_where('document', array('teacher_id' => $con->session->userdata('teacher_id')), $order_by)->result_array();
	}
	
	function select_study_material_info_for_student()
	{
		$con = &get_instance();
		$student_id = $con->session->userdata('student_id');
		$class_id = $con->db->get_where('enroll', array(
			'student_id' => $student_id,
			'year' => $con->db->get_where('settings' , array('type' => 'running_year'))->row()->description
		))->row()->class_id;
		$order_by = array("timestamp", "DESC");
		return $con->db->get_where('document', array('class_id' => $class_id), $order_by)->result_array();
	}
	
	function update_study_material_info($document_id)
	{
		$con = &get_instance();
		$data['timestamp']		= strtotime($con->input->post('timestamp'));
		$data['title']			= $con->input->post('title');
		$data['description']	= $con->input->post('description');
		$data['class_id']		= $con->input->post('class_id');
		$data['subject_id']		= $con->input->post('subject_id');
		$where = array('document_id' => $document_id);
		$con->db->update('document', $where, $data);
	}
	
	function delete_study_material_info($document_id)
	{
		$con = &get_instance();
		$where = array('document_id' => $document_id);
		$con->db->delete('document', $where);
	}
	
	////////private message//////
	function send_new_private_message()
	{
		$con = &get_instance();
		$message    = $con->input->post('message');
		$timestamp  = strtotime(date("Y-m-d H:i:s"));
		
		$reciever   = $con->input->post('reciever');
		$sender     = $con->session->userdata('login_type') . '-' . $con->session->userdata('login_user_id');
		
		//check if the thread between those 2 users exists, if not create new thread
		$num1 = $con->db->get_where('message_thread', array('sender' => $sender, 'reciever' => $reciever))->num_rows();
		$num2 = $con->db->get_where('message_thread', array('sender' => $reciever, 'reciever' => $sender))->num_rows();
		
		//check if file is attached or not
		if($_FILES['attached_file_on_messaging']['name'] != "") {
			$data_message['attached_file_name'] = $_FILES['attached_file_on_messaging']['name'];
		}
		
		if($num1 == 0 && $num2 == 0) {
			$message_thread_code                        = substr(md5(rand(100000000, 20000000000)), 0, 15);
			$data_message_thread['message_thread_code'] = $message_thread_code;
			$data_message_thread['sender']              = $sender;
			$data_message_thread['reciever']            = $reciever;
			$con->db->insert('message_thread', $data_message_thread);
		}
		if($num1 > 0)
			$message_thread_code = $con->db->get_where('message_thread', array('sender' => $sender, 'reciever' => $reciever))->row()->message_thread_code;
		if($num2 > 0)
			$message_thread_code = $con->db->get_where('message_thread', array('sender' => $reciever, 'reciever' => $sender))->row()->message_thread_code;
		
		
		$data_message['message_thread_code']    = $message_thread_code;
		$data_message['message']                = $message;
		$data_message['sender']                 = $sender;
		$data_message['timestamp']              = $timestamp;
		$con->db->insert('message', $data_message);
		
		// notify email to email reciever
		//$con->email_model->notify_email('new_message_notification', $con->db->insert_id());
		
		return $message_thread_code;
	}
	
	function send_reply_message($message_thread_code)
	{
		$con = &get_instance();
		$message    = $con->input->post('message');
		$timestamp  = strtotime(date("Y-m-d H:i:s"));
		$sender     = $con->session->userdata('login_type') . '-' . $con->session->userdata('login_user_id');
		//check if file is attached or not
		if($_FILES['attached_file_on_messaging']['name'] != "") {
			$data_message['attached_file_name'] = $_FILES['attached_file_on_messaging']['name'];
		}
		$data_message['message_thread_code']    = $message_thread_code;
		$data_message['message']                = $message;
		$data_message['sender']                 = $sender;
		$data_message['timestamp']              = $timestamp;
		$con->db->insert('message', $data_message);
		
		// notify email to email reciever
		//$con->email_model->notify_email('new_message_notification', $con->db->insert_id());
	}
	
	function mark_thread_messages_read($message_thread_code)
	{
		$con = &get_instance();
		// mark read only the oponnent messages of con thread, not currently logged in user's sent messages
		$current_user = $con->session->userdata('login_type') . '-' . $con->session->userdata('login_user_id');
		$con->db->where('sender !=', $current_user);
		$con->db->where('message_thread_code', $message_thread_code);
		$con->db->update('message', array('read_status' => 1));
	}
		
	function count_unread_message_of_thread($message_thread_code)
	{
		$con = &get_instance();
		$unread_message_counter = 0;
		$current_user = $con->session->userdata('login_type') . '-' . $con->session->userdata('login_user_id');
		$messages = $con->db->get_where('message', array('message_thread_code' => $message_thread_code))->result_array();
		foreach($messages as $row)
		{
			if($row['sender'] != $current_user && $row['read_status'] == '0')
				$unread_message_counter++;
		}
		return $unread_message_counter;
	}
	
	// QUESTION PAPER
	function create_question_paper()
	{
		$con = &get_instance();
		$data['title']          = $con->input->post('title');
		$data['class_id']       = $con->input->post('class_id');
		$data['exam_id']        = $con->input->post('exam_id');
		$data['question_paper'] = $con->input->post('question_paper');
		$data['teacher_id']     = $con->session->userdata('login_user_id');
		
		$con->db->insert('question_paper', $data);
	}
	
	function update_question_paper($question_paper_id = '')
	{
		$con = &get_instance();
		$data['title']          = $con->input->post('title');
		$data['class_id']       = $con->input->post('class_id');
		$data['exam_id']        = $con->input->post('exam_id');
		$data['question_paper'] = $con->input->post('question_paper');
		
		$con->db->update('question_paper', $data, array('question_paper_id' => $question_paper_id));
	}
	
	function delete_question_paper($question_paper_id = '')
	{
		$con = &get_instance();
		$con->db->where('question_paper_id', $question_paper_id);
		$con->db->delete('question_paper');
	}
	
	// BOOK REQUEST
	function create_book_request()
	{
		$con = &get_instance();
		$data['book_id']            = $con->input->post('book_id');
		$data['student_id']         = $con->session->userdata('login_user_id');
		$data['issue_start_date']   = strtotime($con->input->post('issue_start_date'));
		$data['issue_end_date']     = strtotime($con->input->post('issue_end_date'));
		
		$con->db->insert('book_request', $data);
	}
	
	function delete_student($student_id)
	{
		$con = &get_instance();
		// deleting data of student from all associated tables
		//$tables = array('student', 'attendance', 'book_request', 'enroll', 'invoice', 'mark', 'payment');
		$tables = array('student', 'enroll');
		$con->db->delete($tables, array('student_id' => $student_id));
		// deleting data from messages
		/*
		$threads = $con->db->get('message_thread')->result_array();
		if(count($threads) > 0)
		{
			foreach($threads as $row)
			{
				$sender = explode('-', $row['sender']);
				$receiver = explode('-', $row['reciever']);
				if(($sender[0] == 'student' && $sender[1] == $student_id) ||($receiver[0] == 'student' && $receiver[1] == $student_id))
				{
					$thread_code = $row['message_thread_code'];
					$con->db->delete('message', array('message_thread_code' => $thread_code));
					$con->db->delete('message_thread', array('message_thread_code' => $thread_code));
				}
			}
		}
		*/
	}
	
	function force_download($file, $name, $mime_type='')
	{
		if(!file_exists($file) || !is_readable($file)) return;
		
		if(file_exists($file))
		{
			$size = filesize($file);
			$name = rawurldecode($name);
			$known_mime_types = array(
				"pdf"	=>	"application/pdf",
				"txt"	=>	"text/plain",
				"html"	=>	"text/html",
				"htm"	=>	"text/html",
				"exe"	=>	"application/octet-stream",
				"zip"	=>	"application/zip",
				"doc"	=>	"application/msword",
				"xls"	=>	"application/vnd.ms-excel",
				"ppt"	=>	"application/vnd.ms-powerpoint",
				"gif"	=>	"image/gif",
				"png"	=>	"image/png",
				"jpeg"	=>	"image/jpg",
				"jpg"	=>	"image/jpg",
				"php"	=>	"text/plain"
			);
			
			if($mime_type == '')
			{
				$file_extension = strtolower(substr(strrchr($file,"."),1));
				if(array_key_exists($file_extension, $known_mime_types))
				{
					$mime_type = $known_mime_types[$file_extension];
				} else
				{
					$mime_type = "application/force-download";
				}
			}
			
			header('Content-Description: File Transfer');
			header('Content-Type: '.$mime_type);
			header('Content-Disposition: attachment; filename="'.basename($name).'"');
			header('Expires: 0');
			header("Content-Transfer-Encoding: binary");
			header('Cache-Control: no-store, no-cache, must-revalidate');
			header('Pragma: no-cache');
			header('Content-Length: '.$size);
			readfile($file);
			exit;
		}
	}
	