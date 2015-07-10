<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Register extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			
			$this->load->helper('form');
			$this->load->library('form_validation');
			$this->load->helper('captcha');
			
			$this->load->model('members');
		}
		
		function index()
		{
			//header dynamic variables
			$data['title'] = "Register Free";
			$data['additional_js'] = "";
			$data['error'] = "";
			
			$this->session->sess_destroy();
			
			$this->form_validation->set_rules('yname', 'Your Name', 'required|xss_clean|trim|min_length[5]|max_length[130]');
			$this->form_validation->set_rules('email_ad', 'Email Address', 'valid_email|required|xss_clean|trim|min_length[5]|max_length[130]|callback_check_email');
			$this->form_validation->set_rules('password', 'Password', 'required|xss_clean|trim|min_length[5]|max_length[50]|md5');
			$this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|xss_clean|trim|matches[password]');
                        $this->form_validation->set_rules('mobile', 'Mobile', 'required|xss_clean|trim|is_natural|exact_length[11]');
			$this->form_validation->set_rules('captcha', 'Verification', 'xss_clean|required|callback_check_captcha');
			
			$vals = array(
				'word' 		 => sprintf("%04d",abs(mt_rand(1000,9999))),
				'img_path'	 => './captcha/',
				'img_url'	 => base_url().'captcha/',
				'img_width'	 => '200',
				'img_height' => 30,
				'expiration' => 3600
			);
			
			$cap = create_captcha($vals);
			
			$this->session->set_userdata(array('cap_word' => $cap['word']));
			
			$data['cap_img'] = $cap['image'];
			$data['cap_word'] = $cap['word'];			
			
			if($this->form_validation->run() == FALSE)
			{
				$data['error'] = validation_errors();
				$this->load->view('register', $data);
			}
			else
			{
				$yname = $this->input->post('yname');				
                                $email_ad = $this->input->post('email_ad');
                                $password = $this->input->post('password');
                                $mobile = $this->input->post('mobile');
				$verification_code = random_string('alnum', 10);
                                
                                $this->load->helper('string');
                                
                                $param = array('yname' => $yname,
                                    'email_ad' => $email_ad,
                                    'mobile' => $mobile,
                                    'password' => $password,
                                    'verification' => $verification_code,
                                    'status' => DISABLED);
				// 
				////insert into members info table
				$this->members->insert_entry('member_info', $param);
				//
				//get inserted auto created id
				$mem_id = $this->members->get_insert_id();
				//
				////set session for auto login
				$this->session->set_userdata(array('mem_id' => $mem_id, 'mem_name' => $yname));
				//
				////send mail
				$this->load->model('correspondence');
				$this->correspondence->email_notification($email_ad, ucwords(strtolower($yname)), REGISTRATION, $verification_code);
				//
				#redirect('register/verification');
				
			}

		}
		
		function verification()
		{
			$this->load->helper('security');
			$this->load->helper('email');
			
			$mem_id = $this->session->userdata('mem_id');
			$mem_name = $this->session->userdata('mem_name');
			
			//header dynamic variables
			$data['title'] = "Verification ";
			$data['additional_js'] = "";
			$data['error'] = $data['rerror'] = "";
			
			//check if artist is logged in
			if(($mem_id == NULL) || ($mem_id == '') || $this->members->verified($mem_id))
			{
				$this->session->sess_destroy();
				redirect('login');
			}
			
			if($this->input->post('resend'))
			{
				if(valid_email(xss_clean($this->input->post('email_verification_code'))))
				{
					$email_ad = $this->input->post('email_verification_code');
					
					if($this->members->get('email_ad', array('mem_id' => $mem_id), 'member_info') == $email_ad)
					{
						$verification_code = $this->members->get('verification', array('mem_id' => $mem_id), 'member_info');
						
						//send mail
						$this->load->model('correspondence');
						$this->correspondence->email_notification($email_ad, ucwords(strtolower($mem_name)), VERIFICATION, $verification_code);
						
						$data['rerror'] = $mem_name.", We have just sent your verification code, check your mail box or sometimes spam.";
					}
					else
						$data['rerror'] = "The email address is not the same with what you registered with.";
				}
				else
					$data['rerror'] = "Your email address is in-valid";
			}
			
			
			$this->form_validation->set_rules('verification_code', 'Verification Code', 'required|xss_clean|trim|alpha_numeric|callback_check_verification|exact_length[10]');
			
			if($this->form_validation->run() == FALSE)
			{
				if(!$this->input->post('resend')) $data['error'] = validation_errors();
				$this->load->view('verification', $data);
			}
			else
			{
				$mem_info = $this->members->get_member_basic_info($mem_id);
				//
				foreach($mem_info as $value)
				{
					$yname = $value['yname'];
					$email_ad = $value['email_ad'];
				}
				//	
				$this->session->set_userdata(array('mem_id' => $mem_id,
								   'mem_name' => $mem_name));
				//
				$this->members->update_entry($mem_id, array('status' => ENABLED));
					
				////send mail
				$this->load->model('correspondence');
				$this->correspondence->email_notification($email_ad, ucwords(strtolower($yname)), REGISTRATION);
					
				//redirect to members page
				redirect('home');
					
				
			}
	
		}
		
		function check_email($email_ad)
		{
			if($this->members->is_exist('member_info', array('email_ad' => $email_ad)))
			{
				$this->form_validation->set_message('check_email', 'A member with this email address already exist!');
				return false;
			}			
				
			return true;			
		}
		
		function check_captcha($captcha)
		{
			if(strtolower($this->input->post('cap_word')) == strtolower($captcha))
				return true;
			
			$this->form_validation->set_message('check_captcha', 'Wrong Validation Code');
			return false;
		}

		function check_verification($verification_code)
		{
			$mem_id = $this->session->userdata('mem_id');
			
			if(!$this->members->is_exist('member_info', array('mem_id' => $mem_id, 'verification' => $verification_code)))
			{
				$this->form_validation->set_message('check_verification', 'Sorry you have a wrong verification code!');
				return false;
			}			
				
			return true;		
		}

	} // End Home

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */