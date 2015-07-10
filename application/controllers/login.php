<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Login extends CI_Controller
    {		
            public function __construct()
            {
                parent::__construct();
                
                $this->load->helper(array('form','download'));
                $this->load->library(array('form_validation','pagination','upload'));
                $this->load->model(array('members','general','correspondence'));
            }
            
            function index()
            {
                
                $data['title'] = 'Admin Login';
                
                $this->form_validation->set_rules('username', 'Username', 'required');
                $this->form_validation->set_rules('password', 'Password', 'required');
                
                if($this->form_validation->run() == FALSE){
                    
                       $data['error'] = validation_errors();
                       $this->load->view('admin.php',$data);
                    
                }
                else{
                
                if ($this->input->post('username') != ADMIN_EMAIL || $this->input->post('password') != ADMIN_PASSWORD){
                    
                    $data['error'] = 'Login Details Incorrect';
                    $this->load->view('admin.php',$data);
                    
                    
                }
                
                else{
                    
                    $admin_email = $this->session->set_userdata(array('admin_email'=>$this->input->post('username')));
                    //echo $admin_email;
                    redirect('login/home');
                }
                
                
                }       
                      
            }
            
            
            
            function home($offset=null){
                
                $admin_email = $this->session->userdata('admin_email');
                
                if(!$admin_email || $admin_email == NULL){
                    
                    $this->session->sess_destroy();
                    
                    redirect('login');
                    
                }
                else{
                
                $data['title'] = 'Admin : Job list';
                
                $data['access_uri'] = "<div class=\"navbar navbar-fixed-top\">
                                            <div class=\"container\">
	
                                             <ul class=\"nav\">
                                                <li ><a href=\"".URL."\"><-- Back To Website</a></li>
                                                <li class=\"pull-right\"><a href=\"".site_url('login/applications')."\">CVs</a></li>
                                                <li class=\"active\"><a href=\"".site_url('login/home')."\">Jobs</a></li>
                                            </ul>
  
                                        </div>
                                        </div>
                                        </div>";
                
                if(!is_numeric($offset))
		{
			$offset = 0;
		}
		//exit(var_dump($page_no));
		
		$offset = intval($offset);
                
                $config['uri_segment'] = 4;
		$config['base_url'] = site_url('login/home');
		$config['total_rows'] = $this->members->get_num_of_jobs();
		$config['per_page'] = 20;
                $config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['next_link'] = 'Next&gt';
		$config['prev_link'] = '&Previous';
			
                
		$data['query'] = $this->members->get_all_jobs($config['per_page'],$offset);
                
		$this->pagination->initialize($config);
                
		$data['pagination'] = $this->pagination->create_links();
                
                
                
                $this->load->view('adminInterior.php',$data);
                
                }   
                
               
            }
            
            
            function addjob(){
                
                
                $data['title'] = 'Admin : New Job';
                
                $data['access_uri'] = "<div class=\"navbar navbar-fixed-top\">
                                            <div class=\"container\">
	
                                            <ul class=\"nav\">
                                                <li ><a href=\"".URL."\"><-- Back To Website</a></li>
                                                <li class=\"pull-right\"><a href=\"".site_url('login/applications')."\">CVs</a></li>
                                                <li class=\"active\"><a href=\"".site_url('login/home')."\">Jobs</a></li>
                                            </ul>
  
                                        </div>
                                        </div>
                                        </div>";
                
                
                
                $this->form_validation->set_rules('job_title','Job Title','required|xss_clean|trim');
                $this->form_validation->set_rules('company_name','Company Name','required|xss_clean|trim');
                $this->form_validation->set_rules('location','Location','required|xss_clean|trim');
                //$this->form_validation->set_rules('summary','Summary','required|xss_clean|trim');
                //$this->form_validation->set_rules('salary1','Salary','required|xss_clean|trim|');
                //$this->form_validation->set_rules('salary2','Salary','required|xss_clean|trim|');
                
                if($this->form_validation->run() == FALSE){
                
                    $data['error'] = validation_errors();
                    $this->load->view('add_jobs.php',$data);
                }
                
                else{
                    
                    $industry = $this->input->post('industry');
                    $job_title = $this->input->post('job_title');
                    $company_name = $this->input->post('company_name');
                    $location = $this->input->post('location');
                    $summary = $this->input->post('summary');
                    //$salary = $this->input->post('salary1').'-'.$this->input->post('salary2');
                    
                    $param = array(
                        'industry'=>$industry,
                        'job_title' => $job_title,
                        'company_name'=>$company_name,
                        'location'=>$location,
                        'summary'=>$summary,
                        'salary'=>$this->input->post('salary1').'-'.$this->input->post('salary2'),
                        'date_created'=>date('y-m-d : h:i:s',time())
                    );
                    
                    
                    
                    $this->members->insert_entry('jobs',$param);
                    redirect('login/home');
                    
                }
                
                
            }
            
            
            
            function deletejob(){
                
                
                $admin_email = $this->session->userdata('admin_email');
                
                if(!$admin_email || $admin_email == NULL){
                    
                    $this->session->sess_destroy();
                    
                    redirect('login');
                    
                }
                
                else{
                $job_id = $this->uri->segment(3);
                
                $this->members->delete_entry('jobs',array('job_id'=>$job_id));
                redirect('login/home');
                
                
                }
                
                
            }
            
            
            function clearjobs(){
                
                $admin_email = $this->session->userdata('admin_email');
                
                if(!$admin_email || $admin_email == NULL){
                    
                    $this->session->sess_destroy();
                    
                    redirect('login');
                    
                }
                
                else{
                    
                    $this->members->delete_all('jobs');
                    redirect('login/home');
                }
                
            }
            
            
            function applications($offset = null){
                
                $admin_email = $this->session->userdata('admin_email');
                
                if(!$admin_email || $admin_email == NULL){
                    
                    $this->session->sess_destroy();
                    
                    redirect('login');
                    
                }
                
                 else{
                
                $data['title'] = 'Admin : User CVs';
                
                $data['access_uri'] = "<div class=\"navbar navbar-fixed-top\">
                                            <div class=\"container\">
	
                                            <ul class=\"nav\">
                                                <li ><a href=\"".URL."\"><-- Back To Website</a></li>
                                                <li class=\"active\"><a href=\"".site_url('login/applications')."\">CVs</a></li>
                                                <li class=\"pull-right\"><a href=\"".site_url('login/home')."\">Jobs</a></li>
                                            </ul>
  
                                        </div>
                                        </div>
                                        </div>";
                
                
                
                if(!is_numeric($offset))
		{
			$offset = 0;
		}
		//exit(var_dump($page_no));
		
		$offset = intval($offset);
                
                $config['uri_segment'] = 4;
		$config['base_url'] = site_url('login/applications');
		$config['total_rows'] = $this->members->get_num_of_applicants();
		$config['per_page'] =10;
                $config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['next_link'] = 'Next&gt';
		$config['prev_link'] = '&Previous';
			
                
		$data['query'] = $this->members->get_all_applicants($config['per_page'],$offset);
                
		$this->pagination->initialize($config);
                
		$data['pagination'] = $this->pagination->create_links();
                
                
                
                $this->load->view('applicants.php',$data);
                
                }
                
                }
            
            
            
            
            function submitCV(){
                
                $admin_email = $this->session->userdata('admin_email');
                
                if(!$admin_email || $admin_email == NULL){
                    
                    $this->session->sess_destroy();
                    
                    redirect('login');
                    
                }
                
                else{
                
                $data['title'] = 'Submit CV';
                
                $data['error'] = $data['rerror'] = '';
                
                $config['upload_path'] = 'folders/images/member_data';
		$config['allowed_types'] = 'doc|pdf';
		$config['max_size'] = 3000;
		$config['file_name'] = time();
				
		$this->upload->initialize($config);
                
                if ($this->upload->do_upload('userfile')){
					
		    $passport = $this->upload->file_name;
		}
		else{
			$data['rerror'] =  $this->upload->display_errors();
			//$this->load->view('basic_info.php',$data);
		}
			
                
                $this->form_validation->set_rules('name','Name','required|xss_clean|trim');
                $this->form_validation->set_rules('nationality','Nationality','required|xss_clean|trim');
                $this->form_validation->set_rules('state','State','required|xss_clean|trim');
                $this->form_validation->set_rules('lga','Local Government','required|xss_clean|trim');
                $this->form_validation->set_rules('email','Email','required|xss_clean|trim|valid_email');
                $this->form_validation->set_rules('phone','Phone','required|xss_clean|trim');
                $this->form_validation->set_rules('contact_address','Contact Address','required|xss_clean|trim');
                $this->form_validation->set_rules('institution','Institution','required|xss_clean|trim');
                $this->form_validation->set_rules('course','Course','required|xss_clean|trim');
                $this->form_validation->set_rules('qyear','Qualification Year','required|xss_clean|trim|is_numeric');
                $this->form_validation->set_rules('company_name','Company Name','required|xss_clean|trim');
                $this->form_validation->set_rules('position','Position Held','required|xss_clean|trim');
                $this->form_validation->set_rules('job','Job Description','required|xss_clean|trim');
                $this->form_validation->set_rules('eyear','Year Of Experience','required|xss_clean|trim|is_numeric');
                $this->form_validation->set_rules('certification','Certification','required|xss_clean|trim');
                
               
                	
                if($this->form_validation->run() == FALSE){
                    
                    $data['error'] = validation_errors();
                    $this->load->view('applications.php',$data);
                    
                    
                }
                
                else{
                    
                    $name = $this->input->post('name');
                    $industry = $this->input->post('industry');
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
                    $upload =$this->upload->file_name;
                    
                    $param = array(
                                   'name'=>$name,
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
                                   'userfile'=>$upload
                                   
                                   );
                    
                    
                    $this->members->insert_entry('applicants',$param);
                    $this->correspondence->email_notification($email,$name,REGISTERED);
                    redirect('login/submitCV');
                    
                    //
                    
                }
                }
                
                
            }
            
            
            
            function downloadCV($id){
                
                if(!$this->session->userdata('admin_email') || $this->session->userdata('admin_email') == NULL){
				
				$this->session->sess_destroy();
				redirect('signup/admin');
				
			}
			
                        
                $id = $this->uri->segment(3);
                
                $query = $this->members->get('userfile',array('applicant_id'=>$id),'applicants');
                
                $data = file_get_contents('./folders/images/member_data/'.$query);
                
                $name = $query;
                
                force_download($query,$data);
                
                
                
            }
            
            function viewimage($id){
                
                if(!$this->session->userdata('admin_email') || $this->session->userdata('admin_email') == NULL){
				
				$this->session->sess_destroy();
				redirect('signup/admin');
				
			}
			
                        
                $id = $this->uri->segment(3);
                
                $query = $this->members->get('passport',array('applicant_id'=>$id),'applicants');
                
                $data = '<img src ="'.base_url().'folders/images/member_data/'.$query.'" width = "" height = "" >';
                
                echo $data;
                
                
                
            }
            
            function full_details($id){
                
                $admin_email = $this->session->userdata('admin_email');
                
                if(!$admin_email || $admin_email == NULL){
                    
                    $this->session->sess_destroy();
                    
                    redirect('login');
                    
                }

                
                
            }
            
            
            function jobtitle($offset = null){
                
                $admin_email = $this->session->userdata('admin_email');
                
                if(!$admin_email || $admin_email == NULL){
                    
                    $this->session->sess_destroy();
                    
                    redirect('login');
                    
                }
                
                 else{
                
                $data['title'] = 'Admin : User CVs';
                
                $data['access_uri'] = "<div class=\"navbar navbar-fixed-top\">
                                            <div class=\"container\">
	
                                            <ul class=\"nav\">
                                                <li ><a href=\"".URL."\"><-- Back To Website</a></li>
                                                <li class=\"active\"><a href=\"".site_url('login/applications')."\">CVs</a></li>
                                                <li class=\"pull-right\"><a href=\"".site_url('login/home')."\">Jobs</a></li>
                                            </ul>
  
                                        </div>
                                        </div>
                                        </div>";
                
                
                
                if(!is_numeric($offset))
		{
			$offset = 0;
		}
		//exit(var_dump($page_no));
		
		$offset = intval($offset);
                
                $config['uri_segment'] = 4;
		$config['base_url'] = site_url('login/applications');
		$config['total_rows'] = $this->members->get_num_of_applicants();
		$config['per_page'] = 20;
                $config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['next_link'] = 'Next&gt';
		$config['prev_link'] = '&Previous';
			
                
		$data['query'] = $this->members->sort_by_jobtitle($config['per_page'],$offset);
                
		$this->pagination->initialize($config);
                
		$data['pagination'] = $this->pagination->create_links();
                
                
                
                $this->load->view('applicants.php',$data);
                
                }
                
                }
                
                
            
            function status($offset=null){
                
                 $admin_email = $this->session->userdata('admin_email');
                
                if(!$admin_email || $admin_email == NULL){
                    
                    $this->session->sess_destroy();
                    
                    redirect('login');
                    
                }
                
                 else{
                
                $data['title'] = 'Admin : User CVs';
                
                $data['access_uri'] = "<div class=\"navbar navbar-fixed-top\">
                                            <div class=\"container\">
	
                                            <ul class=\"nav\">
                                                <li ><a href=\"".URL."\"><-- Back To Website</a></li>
                                                <li class=\"active\"><a href=\"".site_url('login/applications')."\">CVs</a></li>
                                                <li class=\"pull-right\"><a href=\"".site_url('login/home')."\">Jobs</a></li>
                                            </ul>
  
                                        </div>
                                        </div>
                                        </div>";
                
                
                
                if(!is_numeric($offset))
		{
			$offset = 0;
		}
		//exit(var_dump($page_no));
		
		$offset = intval($offset);
                
                $config['uri_segment'] = 4;
		$config['base_url'] = site_url('login/applications');
		$config['total_rows'] = $this->members->get_num_of_applicants();
		$config['per_page'] = 20;
                $config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['next_link'] = 'Next&gt';
		$config['prev_link'] = '&Previous';
			
                
		$data['query'] = $this->members->sort_by_status($config['per_page'],$offset);
                
		$this->pagination->initialize($config);
                
		$data['pagination'] = $this->pagination->create_links();
                
                
                
                $this->load->view('applicants.php',$data);
                
                }
                 }
                 
                 function gender($offset=null){
                
                 $admin_email = $this->session->userdata('admin_email');
                
                if(!$admin_email || $admin_email == NULL){
                    
                    $this->session->sess_destroy();
                    
                    redirect('login');
                    
                }
                
                 else{
                
                $data['title'] = 'Admin : User CVs';
                
                $data['access_uri'] = "<div class=\"navbar navbar-fixed-top\">
                                            <div class=\"container\">
	
                                            <ul class=\"nav\">
                                                <li ><a href=\"".URL."\"><-- Back To Website</a></li>
                                                <li class=\"active\"><a href=\"".site_url('login/applications')."\">CVs</a></li>
                                                <li class=\"pull-right\"><a href=\"".site_url('login/home')."\">Jobs</a></li>
                                            </ul>
  
                                        </div>
                                        </div>
                                        </div>";
                
                
                
                if(!is_numeric($offset))
		{
			$offset = 0;
		}
		//exit(var_dump($page_no));
		
		$offset = intval($offset);
                
                $config['uri_segment'] = 4;
		$config['base_url'] = site_url('login/applications');
		$config['total_rows'] = $this->members->get_num_of_applicants();
		$config['per_page'] = 20;
                $config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['next_link'] = 'Next&gt';
		$config['prev_link'] = '&Previous';
			
                
		$data['query'] = $this->members->sort_by_gender($config['per_page'],$offset);
                
		$this->pagination->initialize($config);
                
		$data['pagination'] = $this->pagination->create_links();
                
                
                
                $this->load->view('applicants.php',$data);
                
                }
                 }
            
            function state($offset=null){
                
                 $admin_email = $this->session->userdata('admin_email');
                
                if(!$admin_email || $admin_email == NULL){
                    
                    $this->session->sess_destroy();
                    
                    redirect('login');
                    
                }
                
                 else{
                
                $data['title'] = 'Admin : User CVs';
                
                $data['access_uri'] = "<div class=\"navbar navbar-fixed-top\">
                                            <div class=\"container\">
	
                                            <ul class=\"nav\">
                                                <li ><a href=\"".URL."\"><-- Back To Website</a></li>
                                                <li class=\"active\"><a href=\"".site_url('login/applications')."\">CVs</a></li>
                                                <li class=\"pull-right\"><a href=\"".site_url('login/home')."\">Jobs</a></li>
                                            </ul>
  
                                        </div>
                                        </div>
                                        </div>";
                
                
                
                if(!is_numeric($offset))
		{
			$offset = 0;
		}
		//exit(var_dump($page_no));
		
		$offset = intval($offset);
                
                $config['uri_segment'] = 4;
		$config['base_url'] = site_url('login/applications');
		$config['total_rows'] = $this->members->get_num_of_applicants();
		$config['per_page'] = 20;
                $config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['next_link'] = 'Next&gt';
		$config['prev_link'] = '&Previous';
			
                
		$data['query'] = $this->members->sort_by_state($config['per_page'],$offset);
                
		$this->pagination->initialize($config);
                
		$data['pagination'] = $this->pagination->create_links();
                
                
                
                $this->load->view('applicants.php',$data);
                
                }
                 }
                 
                 
                 function companyname($offset = null){
                    
                      $admin_email = $this->session->userdata('admin_email');
                
                if(!$admin_email || $admin_email == NULL){
                    
                    $this->session->sess_destroy();
                    
                    redirect('login');
                    
                }
                
                 else{
                
                $data['title'] = 'Admin : User CVs';
                
                $data['access_uri'] = "<div class=\"navbar navbar-fixed-top\">
                                            <div class=\"container\">
	
                                            <ul class=\"nav\">
                                                <li ><a href=\"".URL."\"><-- Back To Website</a></li>
                                                <li class=\"active\"><a href=\"".site_url('login/applications')."\">CVs</a></li>
                                                <li class=\"pull-right\"><a href=\"".site_url('login/home')."\">Jobs</a></li>
                                            </ul>
  
                                        </div>
                                        </div>
                                        </div>";
                
                
                
                if(!is_numeric($offset))
		{
			$offset = 0;
		}
		//exit(var_dump($page_no));
		
		$offset = intval($offset);
                
                $config['uri_segment'] = 4;
		$config['base_url'] = site_url('login/applications');
		$config['total_rows'] = $this->members->get_num_of_applicants();
		$config['per_page'] = 20;
                $config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['next_link'] = 'Next&gt';
		$config['prev_link'] = '&Previous';
			
                
		$data['query'] = $this->members->sort_by_companyname($config['per_page'],$offset);
                
		$this->pagination->initialize($config);
                
		$data['pagination'] = $this->pagination->create_links();
                
                
                
                $this->load->view('applicants.php',$data);
                
                }
                    
                    
                 }
            
            
            
            function logout(){
                
                
                $this->session->sess_destroy();
                
                redirect('login');
                
                
            }
            

    } // End Home