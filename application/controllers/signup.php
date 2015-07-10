<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Signup extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			
			$this->load->helper(array('form', 'file'));
			$this->load->library(array('pagination', 'upload', 'form_validation'));
			#$this->load->helper('captcha');
			
			$this->load->model('members');
			#$this->output->enable_profiler(TRUE);
			
		}
		
		
		function index(){
			
			$data['title'] = 'Signup: Basic Info';
			#$data['query'] = $this->members->get('status', array('session_id' => '1'), 'sessions');
			#$data['end_date'] =  $this->members->get('end_date', array('session_id' => '1'), 'sessions');
						
			$data['access_uri'] = '';
			
			$data['content'] = $data['rerror'] = $data['rerror2'] = $data['rerror3'] = '';
			
			$data['additional_js'] = '<script type="text/javascript" src="'.base_url().'assets/js/calendarDateInput.js"></script>
						  <script type="text/javascript" src="'.base_url().'assets/js/jquery.timePicker.js"></script>
						  <script type="text/javascript" src="'.base_url().'assets/js/action.js"></script>
					          <script language="javascript">
						  function load_widget(widget_id, loader_id, page_link, target_widget_loader, the_widget_id, resize)
						{
                                                $(loader_id).show();
                                                var widget_val = $(widget_id).val();
                                                
                                                $.get("'.site_url('/').'" + page_link, {widget_id_val: widget_val, widget_id: the_widget_id}, function(response) {
                                                    setTimeout("finishAjax(\'" + target_widget_loader + "\', \'"+escape(response)+"\', \'"+ loader_id + "\')", 400);
                                                });
						}
					    
						</script>';
			
			//$data['rerror'] = $this->upload->display_errors();
			
		
			//Upload Parameters for passport
			$config['upload_path'] = 'folders/images/member_data';
			$config['allowed_types'] = 'jpeg|jpg|png';
			$config['max_size'] = 3000;
			$config['file_name'] = time();
				
			$this->upload->initialize($config);
			if ($this->upload->do_upload('passport')){
					
				$passport = $this->upload->file_name;
			}
			else{
				$data['rerror'] =  $this->upload->display_errors();
				//$this->load->view('basic_info.php',$data);
			}
			

			//Upload Parameters for Birth Certificate
			$config['upload_path'] = 'folders/images/member_data';
			$config['allowed_types'] = 'jpeg|jpg|png';
			$config['max_size'] = 3000;
			$config['file_name'] = time();
				
			$this->upload->initialize($config);
			#$this->upload->do_upload($birth);
			
			if($this->upload->do_upload('birth')){
					
				$birth = $this->upload->file_name;
			}
			else{
				$data['rerror2'] = $this->upload->display_errors();
			}
				 			
			
			//Upload Parameters for Results
			$config['upload_path'] = 'folders/images/member_data';
			$config['allowed_types'] = 'jpeg|jpg|png';
			$config['max_size'] = 3000;
			$config['file_name'] = time();
				
			$this->upload->initialize($config);
			#$this->upload->do_upload($result);
			 
			if($this->upload->do_upload('result')){
					
				$result = $this->upload->file_name;
			}
			
			else{
				$data['rerror3'] = $this->upload->display_errors();
				//$this->load->view('basic_info',$data);
			}
			/*
			else{
				echo $this->upload->display_errors();
			}*/
			
			$this->form_validation->set_rules('first_name', 'First Name', 'required|trim|xss_clean');
			$this->form_validation->set_rules('last_name',  'Last Name', 'required|trim|xss_clean');
			$this->form_validation->set_rules('nationality', 'Nationality', 'required|trim|xss_clean');
			$this->form_validation->set_rules('email', 'Email Address', 'required|valid_email|callback_check_email');
			$this->form_validation->set_rules('pickupdate', 'Birth Date', 'required|trim|xss_clean');
			$this->form_validation->set_rules('school_name', 'School Name', 'required|trim|xss_clean');					
			$this->form_validation->set_rules('personal_computer', 'Personal Computer Availability', 'required|trim|xss_clean');
			$this->form_validation->set_rules('computer_knowledge', 'Computer Knowledge', 'required|trim|xss_clean');
			$this->form_validation->set_rules('solving_problem', 'Solving Problem', 'required|trim|xss_clean');
			$this->form_validation->set_rules('solved_problem', 'Problem Solved', 'required|trim|xss_clean');
			$this->form_validation->set_rules('best_subject', 'Best Subject', 'required|trim|xss_clean');
			$this->form_validation->set_rules('reason', 'Best Subject Reason', 'required|trim|xss_clean');
			
			
			
			
			if ($this->form_validation->run() == FALSE){
				
				$data['error'] = validation_errors();
			
			$this->load->view('basic_info.php', $data);
			}
			
			else{
				
				
				$this->load->library('images');
				$this->load->helper('file');
				$this->images->resize($this->upload->upload_path.$this->upload->file_name, 200, 200, $this->upload->upload_path.$this->upload->file_name);
				
				$passport = $this->upload->file_name;
				$birth = $this->upload->file_name;
				$result = $this->upload->file_name;
				
				#$status = $query['status'];
				$first_name = $this->input->post('first_name');
			
				$last_name = $this->input->post('last_name');
				$date_of_birth = $this->input->post('pickupdate');
				$nationality = $this->input->post('nationality');
				$sex = $this->input->post('sex');
				$email = $this->input->post('email');
				$phone_number = $this->input->post('phone_number');
				$school_name = $this->input->post('school_name');
				$school_type = $this->input->post('school_type');
				$present_class = $this->input->post('present_class');
				$personal_computer = $this->input->post('personal_computer');
				$computer_knowledge = $this->input->post('computer_knowledge');
				$computer_rating = $this->input->post('computer_rating');
				$solving_problem = $this->input->post('solving_problem');
				$solved_problem = $this->input->post('solved_problem');
				$learn_program = $this->input->post('learn_program');
				$best_subject = $this->input->post('best_subject');
				$reason = $this->input->post('reason');
				
				$start_date =  $this->members->get('start_date', array('session_id' => '1'), 'sessions');
				$end_date =   $this->members->get('end_date', array('session_id' => '1'), 'sessions');
				#$start_date = $');
				
				
				$param = array(
					'first_name' => $first_name,
					'last_name' => $last_name,
					'date_of_birth' =>  date_format(date_create($date_of_birth), 'Y-m-d'),
					 'nationality' => $nationality,
					 'sex' => $sex,
					 'email' => $email,
					 'phone_number' => $phone_number,
					 'school_name' => $school_name,
					 'school_type' => $school_type,
					 'present_class' => $present_class,
					 'personal_computer' => $personal_computer,
					 'computer_knowledge' => $computer_knowledge,
					 'computer_rating' => $computer_rating,
					 'solving_problem' => $solving_problem,
					 'solved_problem' => $solved_problem,
					 'learn_program' => $learn_program,
					 'best_subject' => $best_subject,
					 'reason' => $reason,
					 'passport' => $passport,
					 'birth' => $birth,
					 'result' => $result,
					 'admission_status' => 'awaiting',
					 'date_registered' => date('Y-m-d'),
					 'start_date' => $start_date,
					 'end_date' => $end_date,
					 'session_date' => date('Y-m')
					 
					
				);
				/*$res1 = $param['passport'];
				$res2 = $param['birth'];
				$res3 = $param['result'];
				
				if(!$res || !$res2 || $res3){
					
					$data['rerror'] = $this->upload->display_errors();
					$this->load->view('basic_info.php',$data);
					
				}*/
				$starttime = strtotime($param['start_date']);
				$datetime = strtotime($param['date_registered']);
				$endtime = strtotime($param['end_date']);
				
				if ($datetime <= $starttime || $datetime >= $endtime){
				 
					$data['error'] = '<p>Sorry We cannot receive applications at the moment</p>';
					$this->load->view('basic_info.php', $data);
				}
				else{
				#echo $status;
				$this->members->insert_entry('student_info', $param);
				//
				//get inserted auto created id
				$mem_id = $this->members->get_insert_id();
				
				$this->session->set_userdata(array('stud_mail'=>$email));
				
				$this->load->model('correspondence');
				$this->correspondence->email_notification($email, $last_name, REGISTERED);
				
				redirect('signup/success');
				
			}
			}
		}
		
		
		
		function check_email($email)
		{
			if($this->members->is_exist('student_info', array('email' => $email)))
			{
				$this->form_validation->set_message('check_email', 'A member with this email address already exist!');
				return false;
			}			
				
			return true;			
		}
		
		function success(){
			
			$stud_mail = $this->session->userdata('stud_mail');
			
			$data['title'] = 'Success Page';
			
			$data['access_uri'] = '';
			
			$data['content'] = '<p align = "center">User Successfully Registered</p>
					    <p align = "center">Email sent to'." ".'<b><em>'.$stud_mail.'</em></b>
					    check spam if mail not in inbox</p>
					    <div id = "logout" align = "center"><a href = "'.site_url('signup/logout').'">
					    Logout</a></div>';
			
			$data['additional_js'] = '';
			
			$data['error'] = '';
			
			$this->load->view('partial/header_page.php', $data);
		}
		
		function admin(){
			
		$data['title'] = 'Admin-Login';
                
                $data['access_uri'] = '';
                
                $data['additional_js'] = '';
                
                $data['error'] = '';
                
                $data['content'] = '';
		
		$this->session->sess_destroy();
		
		$this->form_validation->set_rules('username', 'Email Address', 'valid_email|required|xss_clean|trim');
                $this->form_validation->set_rules('password', 'Password', 'required|xss_clean|trim');
		
		if($this->form_validation->run() == FALSE){
                
		$data['error'] = validation_errors();
                $this->load->view('signin', $data);
		
		}
		
		else{
			
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			
			if($username == ADMIN_EMAIL && $password == ADMIN_PASSWORD){
				
				$this->session->set_userdata(array('admin_email'=> $username));
				redirect('signup/home');
				
			}
			
			else{
				$data['error'] = 'Login Details are incorrect';
				$this->load->view('signin', $data);
			}
			
			
		}
		
		}
		
		function home(){
			
			if(!$this->session->userdata('admin_email') || $this->session->userdata('admin_email') == NULL){
				
				$this->session->sess_destroy();
				redirect('signup/admin');
				
			}
			
			$data['title'] = 'Dashboard';
			
			$data['access_uri'] = '<ul>
						   <li><a href = "'.site_url('signup/home').'">Dashboard</a></li>
						   <li><a href = "'.site_url('signup/students').'">Students</a></li>
						   <li><a href = "'.site_url('signup/admission').'">Admitted Students</a></li>
						   <li><a href = "'.site_url('signup/startdate').'">Set Date</a></li><br/><br/>';
			
			$students = $this->members->get_num_of_students();
			$admitted_students = $this->members->get_num_of_admitted_students();
			$data['content'] = $data['content'] = 'You are signed in as:'." " .$this->session->userdata('admin_email')." ".'<a href = "'.site_url('signup/signout').'">Signout</a><br/>
						'.$students.'<a href ="'.site_url('signup/students').'">Registered Students</a><br/>
						'.$admitted_students.'<a href = "'.site_url('signup/admission').'">Admitted Students</a>';
			
			$data['additional_js'] = '';
			
			
			
			$this->load->view('partial/header_page.php', $data);
			
			
			
		}
		
		function students(){
		
		
			if(!$this->session->userdata('admin_email') || $this->session->userdata('admin_email') == NULL){
				
				$this->session->sess_destroy();
				redirect('signup/admin');
				
			}
			else{
				
			$data['title'] = 'Students';
			
			$data['error'] = '';
			
			$data['access_uri'] = '<ul>
						   <li><a href = "'.site_url('signup/home').'">Dashboard</a></li>
						   <li><a href = "'.site_url('signup/students').'">Students</a></li>
						   <li><a href = "'.site_url('signup/admission').'">Admitted Students</a></li>
						   <li><a href = "'.site_url('signup/startdate').'">Set Date</a></li><br/><br/>';
			
			$data['content'] = $data['content'] = 'You are signed in as:'." " .$this->session->userdata('admin_email')." ".'<a href = "'.site_url('signup/signout').'">Signout</a><br/>';			
			$data['additional_js'] = '';
			$data['query'] = $this->members->get_all_students();
			
			$config['uri_segment'] = 4;
			$config['base_url'] = site_url('signup/students');
			$config['total_rows'] = $this->members->get_num_of_students();
			$config['per_page'] = 20;
			$config['first_link'] = 'First';
			$config['last_link'] = 'Last';
			$config['next_link'] = 'Next&gt';
			$config['prev_link'] = '&Previous';
			
			$this->pagination->initialize($config);
			$data['pagination'] = $this->pagination->create_links();
			
			$this->load->view('students.php', $data);
			
		}
		}
		
		
		function admit(){
			
			if(!$this->session->userdata('admin_email') || $this->session->userdata('admin_email') == NULL){
				
				$this->session->sess_destroy();
				redirect('signup/admin');
				
			}
			
			
			$id = $this->uri->segment(3);
			$param = array('student_id' => $id,
			       'date_added' => date('Y-m-d')
			       );
			if ($this->members->is_exist('admissions', array('student_id'=> $id))){
			
			$data['title'] = 'Dashboard';
			
			$data['error'] = '<p>Student has already been admitted</p>';
			
			$data['access_uri'] = '<ul>
						   <li><a href = "'.site_url('signup/home').'">Dashboard</a></li>
						   <li><a href = "'.site_url('signup/students').'">Students</a></li>
						   <li><a href = "'.site_url('signup/admission').'">Admitted Students</a></li>
						   <li><a href = "'.site_url('signup/startdate').'">Set Date</a></li><br/><br/>';
			
			$data['content'] = $data['content'] = 'You are signed in as:'." " .$this->session->userdata('admin_email')." ".'<a href = "'.site_url('signup/signout').'">Signout</a><br/>';
			
			$data['additional_js'] = '';
			
			$data['query'] = $this->members->get_all_students();
			$config['uri_segment'] = 4;
			$config['base_url'] = site_url('signup/students');
			$config['total_rows'] = $this->members->get_num_of_students();
			$config['per_page'] = 20;
			$config['first_link'] = 'First';
			$config['last_link'] = 'Last';
			$config['next_link'] = 'Next&gt';
			$config['prev_link'] = '&Previous';
			
			$this->pagination->initialize($config);
			$data['pagination'] = $this->pagination->create_links();
			
			
			$this->load->view('students.php', $data);
			
				
				
			}
			else{
			
			$this->members->insert_entry('admissions', $param);
			
			$email = $this->members->get('email', array('student_id' => $id), 'student_info');
			$fname = $this->members->get('first_name', array('student_id' => $id), 'student_info');
			
			$this->load->model('correspondence');
			$this->correspondence->email_notification($email, $fname, SUCCESS);
			
			
			$delete_param = array('admission_status' => 'granted');
			
			$this->load->model('general');
			$this->general->update_entry('student_info', array('student_id' => $id), $delete_param);
		
				redirect('signup/students');
			}
		}
		
		//method that grants a student admission
		function admission(){
			if(!$this->session->userdata('admin_email') || $this->session->userdata('admin_email') == NULL){
				
				$this->session->sess_destroy();
				redirect('signup/admin');
				
			}	
			$data['title'] = 'Admitted Students';
			
			$data['error'] = '';
			
			$data['access_uri'] = '<ul>
						   <li><a href = "'.site_url('signup/home').'">Dashboard</a></li>
						   <li><a href = "'.site_url('signup/students').'">Students</a></li>
						   <li><a href = "'.site_url('signup/admission').'">Admitted Students</a></li>
						   <li><a href = "'.site_url('signup/startdate').'">Set Date</a></li><br/><br/>';
			
			$data['content'] = $data['content'] = 'You are signed in as:'." " .$this->session->userdata('admin_email')." ".'<a href = "'.site_url('signup/signout').'">Signout</a><br/>';
			
			$data['additional_js'] = '';
			$data['query'] = $this->members->get_all_admitted_students();
			
			$config['uri_segment'] = 4;
			$config['base_url'] = site_url('signup/admission');
			$config['total_rows'] = $this->members->get_num_of_admitted_students();
			$config['per_page'] = 20;
			$config['first_link'] = 'First';
			$config['last_link'] = 'Last';
			$config['next_link'] = 'Next&gt';
			$config['prev_link'] = '&Previous';
			
			$this->pagination->initialize($config);
			$data['pagination'] = $this->pagination->create_links();
			
			$this->load->view('admission.php', $data);
		}
		
		//other student details which were not displayed on the admin dashboard
		function details(){
			
			if(!$this->session->userdata('admin_email') || $this->session->userdata('admin_email') == NULL){
				
				$this->session->sess_destroy();
				redirect('signup/admin');
				
			}	
			$data['title'] = 'Other Details';
			
			$data['error'] = '';
			
			$data['access_uri'] = '<ul>
						   <li><a href = "'.site_url('signup/home').'">Dashboard</a></li>
						   <li><a href = "'.site_url('signup/students').'">Students</a></li>
						   <li><a href = "'.site_url('signup/admission').'">Admitted Students</a></li>
						   <li><a href = "'.site_url('signup/startdate').'">Set Date</a></li><br/><br/>';
			
			
			$id = $this->uri->segment(3);
			
			$this->load->model('general');
			$query = $this->general->get_all('student_info', '*', array('student_id' => $id), "desc");
			
			
			$data['content'] = 'You are signed in as:'." " .$this->session->userdata('admin_email')." ".'<a href = "'.site_url('signup/signout').'">Signout</a><br/>';
			foreach($query->result() as $row){
				
				
				$present_class = $row->present_class;
				$school_type = $row->school_type;
				$personal_computer = $row->personal_computer;
				$computer_knowledge = $row->computer_knowledge;
				$computer_rating = $row->computer_rating;
				$solving_problem = $row->solving_problem;
				$solved_problem = $row->solved_problem;
				$learn_program = $row->learn_program;
				$best_subject = $row->best_subject;
				$reason = $row->reason;
			
			$data['content'] .= '<p><b>Current Class Of Student:</b> '.$present_class.'</p><br/>
					    <p><b>Type Of School Attended: </b>'.$school_type.'</p><br/>
					    <p><b>Personal Computer Available: </b> '.$personal_computer.'</p><br/>
					    <p><b>Knowledge of Information Technology: </b> '.$computer_knowledge.'</p><br/>
					    <p><b>Student Computer Rating: </b>'.$computer_rating.'</p><br/>
					    <p><b>Student Ability to Solve Problem: </b>'.$solving_problem.'</p><br/>
					    <p><b>Previous Solved Problem: </b>'.$solved_problem.'</p><br/>
					    <p><b>Student Reason For Learning Programming:</b> '.$learn_program.'</p><br/>
					    <p><b>Student Best Subject at School:</b> '.$best_subject.'</p><br/>
					    <p><b>Student Reason For Best Subject: </b>'.$reason.'</p>';
			}
			$data['additional_js'] = '';
			
			$this->load->view('partial/header_page.php', $data);
			
			
			
		}
		
		
		
		/*function uploads(){
			
			
			if(!$this->session->userdata('admin_email') || $this->session->userdata('admin_email') == NULL){
				
				$this->session->sess_destroy();
				redirect('signup/admin');
				
			}	
			$data['title'] = 'Dashboard';
			
			$id = $this->uri->segment(3);
			
			$data['error'] = '';
			
			$data['access_uri'] = '<ul>
						   <li><a href = "'.site_url('signup/home').'">Dashboard</a></li>
						   <li><a href = "'.site_url('signup/students').'">Students</a></li>
						   <li><a href = "'.site_url('signup/admission').'">Admitted Students</a></li>
						   <li><a href = "'.site_url('signup/startdate').'">Set Date</a></li><br/><br/>';
			
			$data['content'] = 'You are signed in as:'." " .$this->session->userdata('admin_email').'<a href = "'.site_url('signup/signout').'"></a><br/>
						<table>
							<tr>
								<th>Passport</th>
								<th>Birth Certificate</th>
								<th>Result</th>
							</tr>';
			
			$this->load->model('general');
			$query = $this->general->get_all('student_info', 'passport, birth, result', array('student_id' => $id), "desc");
			
			foreach($query->result() as $row){
				
				$passport = $row->passport;
				$birth = $row->birth;
				$result = $row->result;
				
			$data['content'] .= '<tr>
						<td>'.$passport.'</td>
						<td>'.$birth.'</td>
						<td>'.$result.'</td>
						<td><a href = "'.site_url('signup/download/'.$id).'">Download All</a></td>
					    </tr>';
				
				
			}
			
			$data['content'] .= '</table>';
			
			$data['additional_js'] = '';
			
			
			$this->load->view('partial/header_page.php', $data);
			
			
		}*/
		
		
		//to download all student uploaded files into a zip file
		function download($id){
			
			if(!$this->session->userdata('admin_email') || $this->session->userdata('admin_email') == NULL){
				
				$this->session->sess_destroy();
				redirect('signup/admin');
				
			}
			
			$this->load->library('zip');
			
			$id = $this->uri->segment(3);
			
			$this->load->model('general');
			
			$query = $this->general->get_all('student_info', 'last_name, passport, birth, result', array('student_id' => $id), "desc");
			
			if (count($query) < 1){
				echo "<p>No file available</p>";	
				
			}
			
			else{
			foreach($query->result() as $row){
				
				$passport = $row->passport;
				$birth = $row->birth;
				$result = $row->result;
				$last_name = $row->last_name;
				
				
			#print_r($query);
		
			$data = array(
				      $passport => read_file('./folders/images/member_data/'.$passport),
				      $birth => read_file('./folders/images/member_data/'.$birth),
				      $result => read_file('./folders/images/member_data/'.$result)
				      );
			//echo readfile(base_url().'folders/images/member_data/'.$passport);
			$this->zip->add_data($data);
			
			//$this->zip->read_file($data,TRUE);
			#$this->zip->archive(base_url().'/data/my_backup.zip');

			$this->zip->download($last_name);			
			}
			}
			
		}
		
		
		
		
		// to set the date of application
		function startdate(){
			
			if(!$this->session->userdata('admin_email') || $this->session->userdata('admin_email') == NULL){
				
				$this->session->sess_destroy();
				redirect('signup/admin');
				
			}
			
			$id = '1';
			
			$data['set_start_date'] = 'Current Start Date:'.$this->members->get('start_date', array('session_id'=> $id), 'sessions');
	
			$data['set_end_date'] =	'Current End Date:'.$this->members->get('end_date', array('session_id'=> $id), 'sessions');
			
			$data['title'] = 'Start Date';
			
			$data['access_uri'] = '<ul>
						   <li><a href = "'.site_url('signup/home').'">Dashboard</a></li>
						   <li><a href = "'.site_url('signup/students').'">Students</a></li>
						   <li><a href = "'.site_url('signup/admission').'">Admitted Students</a></li>
						   <li><a href = "'.site_url('signup/startdate').'">Set Date</a></li><br/><br/>';
			
			$data['content'] = $data['content'] = 'You are signed in as:'." " .$this->session->userdata('admin_email')." ".'<a href = "'.site_url('signup/signout').'">Signout</a><br/>';
			
			$data['additional_js'] = '<script type="text/javascript" src="'.base_url().'assets/js/calendarDateInput.js"></script>
						  <script type="text/javascript" src="'.base_url().'assets/js/jquery.timePicker.js"></script>
						  <script type="text/javascript" src="'.base_url().'assets/js/action.js"></script>
					          <script language="javascript">
						  function load_widget(widget_id, loader_id, page_link, target_widget_loader, the_widget_id, resize)
						{
                                                $(loader_id).show();
                                                var widget_val = $(widget_id).val();
                                                
                                                $.get("'.site_url('/').'" + page_link, {widget_id_val: widget_val, widget_id: the_widget_id}, function(response) {
                                                    setTimeout("finishAjax(\'" + target_widget_loader + "\', \'"+escape(response)+"\', \'"+ loader_id + "\')", 400);
                                                });
						}
					    
						</script>';
						
			#$data['error'] = '';
			
			$this->form_validation->set_rules('pickupdate', 'the Date', 'required');
			
			if ($this->form_validation->run() == FALSE){
				
				$data['error'] = validation_errors();
				$this->load->view('startdate.php',$data);
				
			}
			
			else{
			
				$start_date = $this->input->post('pickupdate');
				$end_date = $this->input->post('pickdate');
				
				
				$foo = array('start_date' => date_format(date_create($start_date), 'Y-m-d'),
					     'end_date' => date_format(date_create($end_date), 'Y-m-d')
					     );
				if (strtotime($foo['end_date']) <= strtotime($foo['start_date'])){
					
					$data['error'] = 'Start date cannot be ahead or equal to End date';
					$this->load->view('startdate.php', $data);
				}
				else{
				
				$this->load->model('general');
				$this->general->update_entry('sessions', array('session_id' => $id), $foo);
				
				redirect('signup/home');
				
				}
			}
			
			
			
			
		}
		
		
		//to set the deadline for application
		/*function enddate(){
			
			if(!$this->session->userdata('admin_email') || $this->session->userdata('admin_email') == NULL){
				
				$this->session->sess_destroy();
				redirect('signup/admin');
				
			}
			
			$id = '1';
			
			$data['title'] = 'End Date';
			
			$data['access_uri'] = '<ul>
						   <li><a href = "'.site_url('signup/home').'">Dashboard</a></li>
						   <li><a href = "'.site_url('signup/students').'">Students</a></li>
						   <li><a href = "'.site_url('signup/admission').'">Admitted Students</a></li>
						   <li><a href = "'.site_url('signup/setdate').'">Set Date</a></li><br/><br/>';
			
			$data['content'] = 'You are signed in as:'." " .$this->session->userdata('admin_email')." ".'<a href = "'.site_url('signup/signout').'">Signout</a><br/>';
			
			$data['additional_js'] = '<script type="text/javascript" src="'.base_url().'assets/js/calendarDateInput.js"></script>
						  <script type="text/javascript" src="'.base_url().'assets/js/jquery.timePicker.js"></script>
						  <script type="text/javascript" src="'.base_url().'assets/js/action.js"></script>
					          <script language="javascript">
						  function load_widget(widget_id, loader_id, page_link, target_widget_loader, the_widget_id, resize)
						{
                                                $(loader_id).show();
                                                var widget_val = $(widget_id).val();
                                                
                                                $.get("'.site_url('/').'" + page_link, {widget_id_val: widget_val, widget_id: the_widget_id}, function(response) {
                                                    setTimeout("finishAjax(\'" + target_widget_loader + "\', \'"+escape(response)+"\', \'"+ loader_id + "\')", 400);
                                                });
						}
					    
						</script>';
						
			#$data['error'] = '';
			
			$this->form_validation->set_rules('pickdate', 'the Date', 'required');
			
			if ($this->form_validation->run() == FALSE){
				
				$data['error'] = validation_errors();
				$this->load->view('enddate.php',$data);
				
			}
			
			else{
			
				$start_date = $this->input->post('pickdate');
				$foo = array('end_date' => date_format(date_create($start_date), 'Y-m-d'));
				
				
				$this->load->model('general');
				$this->general->update_entry('sessions', array('session_id' => $id), $foo);
				
				redirect('signup/setdate');
				
				
			}
			
			
			
			
		}*/
		
		
		
		//to logout a student
		function logout(){
			
			$this->session->sess_destroy();
			
			redirect('signup');
		}
		
		function fckeditorform()
		{
		#echo "here";
		$fckeditorConfig = array(
						'instanceName' => 'content',
						'BasePath' => base_url().'system/plugins/fckeditor/',
						'ToolbarSet' => 'Basic',
						'Width' => '100%',
						'Height' => '200',
						'Value' => ''
						 );
			$this->load->library('fckeditor', $fckeditorConfig);
			$this->load->view('fckeditorView');
			#$this->load->library('fckeditor');
        
		}
	
		function fckeditorshowpost()
		{
    
		echo $this->input->post('content');
        
		}
	
		
		//to logout the admin
		function signout(){
			
			$this->session->sess_destroy();
			
			redirect('signup/admin');
		}
                
                
                
                
                
                
                
                
                
        }