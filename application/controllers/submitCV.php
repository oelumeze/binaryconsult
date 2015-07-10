<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class SubmitCV extends CI_Controller
    {		
            public function __construct()
            {
                parent::__construct();
                
                $this->load->helper(array('form','download'));
                $this->load->library(array('form_validation','pagination','upload'));
                $this->load->model(array('members','general','correspondence'));
            }
            
            
            
            function index($offset=null){
                        
                $data['title'] = 'Binary Consult : Job Search';
                
                $data['access_uri'] = "";
                $data['additional_css'] = " <div class=\"container adminContent\">
                                                <div class=\"row\">
                                                    <div class=\"span12\"><h2>Manage Jobs</h2></div></div>
                                                    <div class=\"row\">
                                                    <div class=\"span12\">
                                                    <ul class=\"nav nav-pills\">
                                            <li >";
                
                if(!is_numeric($offset))
		{
			$offset = 0;
		}
		//exit(var_dump($page_no));
		
		$offset = intval($offset);
                
                $config['uri_segment'] = 4;
		$config['base_url'] = site_url('submitCV/index');
		$config['total_rows'] = $this->members->get_num_of_jobs();
		$config['per_page'] = 20;
                $config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['next_link'] = 'Next&gt';
		$config['prev_link'] = '&Previous';
			
                
		$data['query'] = $this->members->get_all_jobs($config['per_page'],$offset);
                
		$this->pagination->initialize($config);
                
		$data['pagination'] = $this->pagination->create_links();
                
                
                
                $this->load->view('joblist.php',$data);
                
                  
                
               
            }
            
            
            
            function success(){
                //echo $this->session->userdata('upload');
                //echo $this->session->userdata('passport');
                 $data['title'] = 'Submit CV';
                 
                 $data['user_email'] = $this->session->userdata('email');
                 
                 $this->load->view('user_success.php',$data);
                
                
                
            }
            
            
            
            
            
            function apply(){
               
                
                $data['title'] = 'Submit CV';
                
                $data['error'] ='';
                
                $data['rerror'] = $data['rerror2'] = '';
                
                $data['id']  = $this->uri->segment(3);
                
                
                
                $data['query'] = 'You are currently Applying For '.'<b>'.$this->members->get('job_title',array('job_id'=>$this->uri->segment(3)),'jobs').'</b>'.' '.'Position At'.' '.'<b>'.$this->members->get('company_name',array('job_id'=>$this->uri->segment(3)),'jobs').'</b><br/>';
                $data['query'] .= 'Fill the Form To Complete Application';
                
//                
//			//Upload Parameters for CV
//			$config['upload_path'] = 'folders/images/member_data';
//			$config['allowed_types'] = 'doc|pdf';
//			$config['max_size'] = 3048;
//			$config['file_name'] = time();
//				
//			$this->upload->initialize($config);
//                    
//			if ($this->upload->do_upload('userfile')){
//				
//                                $upload = $this->upload->file_name;
//                                	
//				
//			}
//			else{
//				$data['rerror'] =  $this->upload->display_errors();
//				//$this->load->view('basic_info.php',$data);
//			}
//			
//
//			//Upload Parameters for Passport
//			$config['upload_path'] = 'folders/images/member_data';
//			$config['allowed_types'] = 'jpeg|jpg|png';
//			$config['max_size'] = 1048;
//			$config['file_name'] = time();
//				
//			$this->upload->initialize($config);
//			#$this->upload->do_upload($birth);
//			
//			if($this->upload->do_upload('passport')){
//				
//                                $passport = $this->upload->file_name;
//                                
//			}
//			else{
//				
//                                $data['rerror'] = $this->upload->display_errors();
//		
//			}
			
                
                $this->form_validation->set_rules('name','SurName','required|xss_clean|trim');
                $this->form_validation->set_rules('fname','First Name','required|xss_clean|trim');
                $this->form_validation->set_rules('nationality','Nationality','required|xss_clean|trim');
                $this->form_validation->set_rules('state','State','required|xss_clean|trim');
                $this->form_validation->set_rules('lga','Local Government','required|xss_clean|trim');
                $this->form_validation->set_rules('email','Email','required|xss_clean|trim|valid_email');
                $this->form_validation->set_rules('phone','Phone','required|xss_clean|trim');
                
                
               
                	
                if($this->form_validation->run() == FALSE){
                    
                    $data['error'] = validation_errors();
                    $this->load->view('applications.php',$data);
                    
                    
                }
                else{
                    
                    //$this->load->library('images');
		    //$this->load->helper('file');
                // Has the form been posted?
                
                       // Check if there was a file uploaded - there are other ways to
                       // check this such as checking the 'error' for the file - if error
                       // is 0, you are good to code
                       if (!empty($_FILES['userfile']['name']) && !empty($_FILES['userfile1']['name']))
                       {
                           // Specify configuration for File 1
                           $config['file_name'] = 'doc_'.time();
                           $config['upload_path'] = 'folders/images/member_data';
                           $config['allowed_types'] = 'doc|pdf|docx';
                           $config['max_size'] = '1000';      
                
                           // Initialize config for File 1
                           $this->upload->initialize($config);
                           
                           // Upload file 1
                           if (!$this->upload->do_upload('userfile'))
                           {
                               $data['rerror'] = $this->upload->display_errors();
                           }
                           else
                            $upload =$this->upload->file_name;
                           
                        // Config for File 2 - can be completely different to file 1's config
                           // or if you want to stick with config for file 1, do nothing!
                           $config['file_name'] = 'pic_'.time();
                           $config['upload_path'] = 'folders/images/member_data';
                           $config['allowed_types'] = 'gif|jpg|png|jpeg';
                           $config['max_size'] = '1000';
                
                           // Initialize the new config
                           $this->upload->initialize($config);
                
                           if (!$this->upload->do_upload('userfile1'))
                           {
                               $data['rerror2'] = $this->upload->display_errors();
                           }
                           else
                            $passport = $this->upload->file_name;
                           
                           if($data['rerror'] != '' || $data['rerror2'] != '')
                           {
                               $this->load->view('applications.php',$data);
                           }
                           else
                           {
                                   //$this->images->resize($this->upload->upload_path.$this->upload->file_name, 200, 200, $this->upload->upload_path.$this->upload->file_name);
                               $this->load->library('images');
                               $this->load->helper('file');
                               $this->images->resize($this->upload->upload_path.$this->upload->file_name, 200, 200, $this->upload->upload_path.$this->upload->file_name);                               
                               
                               $sname = $this->input->post('name');
                               $fname = $this->input->post('fname');
                               $oname = $this->input->post('oname');
                               $industry = $this->members->get('industry',array('job_id'=>$this->uri->segment(3)),'jobs');
                               $sex = $this->input->post('sex');
                               $date = $this->input->post('month').'-'.$this->input->post('day').'-'.$this->input->post('year');
                               $status = $this->input->post('marital_status');
                               $nationality = $this->input->post('nationality');
                               $state = $this->input->post('state');
                               $lga = $this->input->post('lga');
                               $email = $this->input->post('email');
                               $phone = $this->input->post('phone');
                               $contact_address = $this->input->post('contact_address');
                               $qualification = 'Institution :'.$this->input->post('institution').' '.'Course :'.$this->input->post('course').' '.'Classification :'.$this->input->post('classification').' '.'Year'.$this->input->post('qyear');
                               $experience = 'CompanyName :'.$this->input->post('company_name').' '.'Position'.$this->input->post('position').' '.'Job :'.$this->input->post('job').' '.'Year'.$this->input->post('eyear');
                               $professional = 'Certification : '.$this->input->post('certification').' '.'Year'.$this->input->post('cyear');
                               //$upload =$this->upload->file_name;
                               //$passport = $this->upload->file_name;
                               
                               $param = array(
                                               'job_id'=>$this->uri->segment(3),
                                              'sname'=>$sname,
                                              'fname'=>$fname,
                                              'oname'=>$oname,
                                              'industry'=>$industry,
                                              'sex'=>$sex,
                                              'date'=>$date,
                                              'marital_status'=>$status,
                                              'nationality'=>$nationality,
                                              'state'=>$state,
                                              'lga'=>$lga,
                                              'email'=>$email,
                                              'phone'=>$phone,
                                              'contact_address'=>$contact_address,
                                              'qualification'=>$qualification,
                                              'work_experience'=>$experience,
                                              'professional_certification'=>$professional,
                                              'userfile'=>$upload,
                                              'passport'=>$passport,
                                              'date_created'=>date('y-m-d : h:i:s',time())
                                              
                                              );
                              
                               
                               $this->members->insert_entry('applicants',$param);
                               
                               $this->session->set_userdata(array('email'=>$email,'name'=>$sname,'upload'=>$upload,'passport'=>$passport));
                               $this->correspondence->email_notification($email,$sname,REGISTERED);
                               redirect('submitCV/success');
                           }
                
                       }
               
                    //
                    
                
                }    
                
            }
            
            
            
            
            
            
            
            
            
            }