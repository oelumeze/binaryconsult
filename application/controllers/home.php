<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Home extends CI_Controller
    {
        public function __construct()
        {
            parent::__construct();
            
            $this->load->helper('form');
            $this->load->library('form_validation');
            $this->load->model('general');
            $this->load->model('members');
        }
        
        public function _remap($method, $params = array())
        {            
            if(method_exists($this, $method))
            {               
                if(!$this->session->userdata('mem_id'))
                {
                    $this->session->sess_destroy();
                    redirect('login');
                }
                
                return call_user_func_array(array($this, $method), $params);
            }
            
            show_404();
        }
        
        function index()
        {
            //header dynamic variables
            $data['title'] = "Africa Ground Transport - Welcome";
            $data['menu'] = "<ul>
                                    <li ><a href=".site_url('home')." class=\"active\">Dashboard</a></span></li>                                    
                                    <li ><a href=".site_url('home/book').">Book</a></li>
                                    <li ><a href=".site_url('home/transaction').">Transaction History</a></li>
                                    <li ><a href=".site_url('home/profile').">Profile</a></li>
                                </ul>";
                                    
            $data['additional_js'] = $error = "";
            $data['mem_name'] = $this->session->userdata('mem_name');
            $data['menu_title'] = "Dashboard";
            
            $data['content'] =   "<h1>Welcome ".$this->session->userdata('mem_name')."</h1>
                                    <div class=\"panel\">
                                        <ul>
                                                <li>Hello</li>
                                        </ul>        
                                        <ul>
                                        <div class=\"clear\"></div>
                                    </div>";
            
            $this->load->view('home', $data);
        }
        
        function book()
        {
            //header dynamic variables
            $data['title'] = "Africa Ground Transport - Create Booking";
            $data['menu'] = "<ul>
                                    <li ><a href=".site_url('home').">Dashboard</a></span></li>                                    
                                    <li ><a href=".site_url('home/book')." class=\"active\">Book</a></li>
                                    <li ><a href=".site_url('home/transaction').">Transaction History</a></li>
                                    <li ><a href=".site_url('home/profile').">Profile</a></li>
                                </ul>";
                                    
            $data['additional_js'] = '<script type="text/javascript" src="'.base_url().'assets/js/calendarDateInput.js"></script>
                                        <script type="text/javascript" src="'.base_url().'assets/js/jquery.timePicker.js"></script>
                                        <script type="text/javascript" src="'.base_url().'assets/js/action.js"></script>
                                        <script language="javascript">
                                            
                                            // JavaScript Document
                                             $(document).ready(function() {
                                             
                                                $("#city_id").change(function() {
                                                   load_widget("#city_id", "#loader", "home/fetch_city", "#city_loader_from", "city_location_from");
                                                   load_widget("#city_id", "#loader", "home/fetch_city", "#city_loader_to", "city_location_to");
                                                   load_widget("#city_id", "#loader", "home/fetch_city_resize", "#city_loader_from_return", "city_location_from_return");
                                                   load_widget("#city_id", "#loader", "home/fetch_city_resize", "#city_loader_to_return", "city_location_to_return");
                                                });
                                                
                                                $("#vehicle_cat_id").change(function(){
                                                    get_tariff_cost();
                                                });                                                
                      
                                                load_widget("#city_id", "#loader", "home/fetch_city", "#city_loader_from", "city_location_from");
                                                load_widget("#city_id", "#loader", "home/fetch_city", "#city_loader_to", "city_location_to");
                                                load_widget("#city_id", "#loader", "home/fetch_city_resize", "#city_loader_from_return", "city_location_from_return");
                                                load_widget("#city_id", "#loader", "home/fetch_city_resize", "#city_loader_to_return", "city_location_to_return");
                                                $("#pickuptime").timePicker({step:15});
                                                $("#pickuptime_return").timePicker({step:15});
                                                moreOptions(\'.recurr\' , \'.pMore\'  );
                                            });
                                            
                                            function get_tariff_cost(var_value)
                                            {
                                                var city_location_from = $("#city_location_from").val();
                                                var city_location_to = $("#city_location_to").val();
                                                var vehicle_cat_id = $("#vehicle_cat_id").val();
                                                //var myreturn = $("#returnvar:checked").val();
                                                //var myreturn = $("#returnvar").val();
                                                
                                                $.get("'.site_url('home/get_price').'", {city_location_from_var: city_location_from, city_location_to_var: city_location_to, vehicle_cat_id_var: vehicle_cat_id, return_var: var_value}, function(response) {
                                                    $("#cost").html(unescape(response));
                                                    //setTimeout("finishAjax(\'" + target_widget_loader + "\', \'"+escape(response)+"\', \'"+ loader_id + "\')", 400);
                                                });                                                
                                            }
                                            
                                            function load_widget(widget_id, loader_id, page_link, target_widget_loader, the_widget_id, resize)
                                            {
                                                $(loader_id).show();
                                                var widget_val = $(widget_id).val();
                                                
                                                $.get("'.site_url('/').'" + page_link, {widget_id_val: widget_val, widget_id: the_widget_id}, function(response) {
                                                    setTimeout("finishAjax(\'" + target_widget_loader + "\', \'"+escape(response)+"\', \'"+ loader_id + "\')", 400);
                                                });
                                            }
                                            
                                            function finishAjax(id, response, loader){
                                              $(loader).hide();
                                              $(id).html(unescape(response));
                                              $(id).fadeIn();
                                            }
                                            
                                        </script>';
                                
            $data['error'] = "";
            $data['mem_name'] = $this->session->userdata('mem_name');
            $data['menu_title'] = "Booking";
            $mem_id = $this->session->userdata('mem_id');

            $this->form_validation->set_rules('city_id', 'City', 'required|xss_clean|trim');
            $this->form_validation->set_rules('city_location_from', 'Pickup Address', 'required|xss_clean|trim|callback_city_checkup');
            $this->form_validation->set_rules('city_location_to', 'Destination', 'required|xss_clean|trim');
            $this->form_validation->set_rules('vehicle_cat_id', 'Vechicle Type', 'required|xss_clean|trim');
            $this->form_validation->set_rules('pickuptime', 'Pickup Time', 'required|xss_clean|trim');
            $this->form_validation->set_rules('omobile', 'Other Mobile Contact', 'xss_clean|trim|is_natural|exact_length[11]');
            
            //
            
            if($this->form_validation->run() == FALSE)
            {
                $data['mmobile'] = $this->members->get('mobile', array('mem_id' => $mem_id), 'member_info');
                $data['error'] = validation_errors();
                $this->load->view('booking', $data);
            }
            else
            {
                $data['city'] = $this->input->post('city_id');
                $data['pickupaddress'] = $this->input->post('city_location_from');
                $data['destination'] = $this->input->post('city_location_to');
                $data['vehicle_cat'] = $this->input->post('vehicle_cat_id');
                $data['pickupdate'] = $this->input->post('pickupdate');
                $data['pickuptime'] = $this->input->post('pickuptime');
                $data['return'] = $this->input->post('return') == "" ? "no" : "yes";
                $data['city_location_from_return'] = $this->input->post('city_location_from_return');
                $data['city_location_to_return'] = $this->input->post('city_location_to_return');
                $data['pickupdate_return'] = $this->input->post('pickupdate_return');
                $data['pickuptime_return'] = $this->input->post('pickuptime_return');
                $data['omobile'] = $this->input->post('omobile');
                
                //if($data['return'] == "no")
                //{
                    $msg =  array('city_id' => $data['city'],
                                    'mem_id' => $mem_id,
                                    'pickupaddress_id' => $data['pickupaddress'],
                                    'destination_id' => $data['destination'],
                                    'vehicle_cat_id' => $data['vehicle_cat'],
                                    'pickupdate' => date_format(date_create($data['pickupdate']), 'Y-m-d'),
                                    'pickuptime' => $data['pickuptime'],
                                    'return' => $data['return'],
                                    'return_from' => $data['city_location_from_return'],
                                    'return_to' => $data['city_location_to_return'],
                                    'return_date' => date_format(date_create($data['pickupdate_return']), 'Y-m-d'),
                                    'return_time' => $data['pickuptime_return'],
                                    'omobile' => $data['omobile']);
                //}
                //else
                //{
                //    $this->form_validation->set_rules('city_location_from', 'Pickup Address', 'required|xss_clean|trim|callback_city_checkup');
                //}
                
                $this->load->library('encrypt');
                $data['encrypted_string'] = $this->encrypt->encode(serialize($msg));
                
                $this->load->view('confirm', $data);
            }

        }
        
        function transaction()
        {
            //header dynamic variables
            $data['title'] = "Africa Ground Transport - Create Booking";
            $data['menu'] = "<ul>
                                    <li ><a href=".site_url('home').">Dashboard</a></span></li>                                    
                                    <li ><a href=".site_url('home/book').">Book</a></li>
                                    <li ><a href=".site_url('home/transaction')." class=\"active\">Transaction History</a></li>
                                    <li ><a href=".site_url('home/profile').">Profile</a></li>
                                </ul>";
            $data['additional_js'] = $error = "";
            $data['mem_name'] = $this->session->userdata('mem_name');
            $mem_id = $this->session->userdata('mem_id');
            $data['menu_title'] = "Transaction";
            
            $query = $this->general->get_all('booking_details', '*', array('mem_id' => $mem_id), "desc");
            
            $data['content'] = "<div class=\"invoiceTb\">
                                <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
                                <thead>
                                    <tr>
                                        <th>Journey Details</th>
                                        <th>Date and Time</th>
                                        <th>Vehicle Type</th>
                                    </tr>
                                </thead>
                                <tbody>";
                                    
            foreach($query->result() as $row)
            {
                $city = $row->city_id;
                $pickupaddress_id = $row->pickupaddress_id;
                $destination_id = $row->destination_id;
                $vehicle_cat_id = $row->vehicle_cat_id;
                $pickupdate = $row->pickupdate;
                $pickuptime = $row->pickuptime;
                
                $data['content'] .= "<tr>
                                        <td>".$this->general->get('city', 'city_name', array('id' => $city))." (".$this->general->get('location', 'location_name', array('id' => $pickupaddress_id))." - ".$this->general->get('location', 'location_name', array('id' => $destination_id)).")</td>
                                        <td>$pickupdate $pickuptime</td>
                                        <td>".$this->general->get('vehicle_category', 'vehicle_category_name', array('id' => $vehicle_cat_id))."</td>
                                    </tr>";
            }
            
            if($query->num_rows() == 0)
                $data['content'] .= "<tr>
                                        <td colspan=\"4\">No record found!</td>
                                    </tr>";
            
            $data['content'] .= "</tbody>
                                    </table></div>";
            
            $this->load->view('home', $data);
            
        }

        function profile()
        {
            $data['title'] = "Africa Ground Transport - Create Booking";
            $data['menu'] = "<ul>
                                    <li ><a href=".site_url('home').">Dashboard</a></span></li>                                    
                                    <li ><a href=".site_url('home/book').">Book</a></li>
                                    <li ><a href=".site_url('home/transaction').">Transaction History</a></li>
                                    <li ><a href=".site_url('home/profile')." class=\"active\">Profile</a></li>
                                </ul>";
            $data['additional_js'] = $error = "";
            $data['mem_name'] = $this->session->userdata('mem_name');
            $mem_id = $this->session->userdata('mem_id');
            $data['menu_title'] = "Profile";

            $this->form_validation->set_rules('yname', 'Your Name', 'required|xss_clean|trim|min_length[5]|max_length[130]');
            $this->form_validation->set_rules('mobile', 'Mobile', 'required|xss_clean|trim|is_natural|exact_length[11]');
            $this->form_validation->set_rules('contact_ad', 'Contact Address', 'required|xss_clean|trim|min_length[5]|max_length[130]');
            
            if($this->form_validation->run() == FALSE)
            {
                $get_mem_info = $this->members->get_member_basic_info($mem_id);
                
                $data['yname'] = $get_mem_info['yname'];
                $data['email_ad'] = $get_mem_info['email_ad'];
                $data['mobile'] = $get_mem_info['mobile'];
                $data['contact_ad'] = $get_mem_info['contact_ad'];
                
                $data['error'] = validation_errors();
                $this->load->view('profile', $data);
            }
            else
            {
                $mem_info = array('yname' => $this->input->post('yname'),
                                'mobile' => $this->input->post('mobile'),
                                'contact_ad' => $this->input->post('contact_ad'));
                
                $this->general->update_entry('member_info', array('mem_id' => $mem_id), $mem_info);
                redirect('home/success');
            }

        }
        
        function process()
        {
            $bdetails = $this->input->post('bdetails');
            
            $this->load->library('encrypt');
            $plaintext_string = unserialize($this->encrypt->decode($bdetails));
            
            if(is_array($plaintext_string))
            {                
                //insert into the database
                $this->general->insert_entry('booking_details', $plaintext_string);
                
                $email_ad = $this->general->get('member_info', 'email_ad', array('mem_id' => $plaintext_string['mem_id']));
                $yname = $this->general->get('member_info', 'yname', array('mem_id' => $plaintext_string['mem_id']));
                
                //send mail
                $this->load->model('correspondence');
                $this->correspondence->email_notification("segunoni@gmail.com", ucwords(strtolower($yname)), NOTIFICATION);

                redirect('home/success');
            }
            else
                redirect('home/book');
        }
        
        function pay()
        {
           //payment module 
        }
        
        function logout()
        {
            $this->session->sess_destroy();
            redirect('login');           
        }
        
        function fetch_city()
        {
            if($this->input->get('widget_id_val') || $this->input->get('widget_id'))
            {
                $widget_id_val = $this->form_validation->xss_clean($this->input->get('widget_id_val'));
                $widget_id = $this->form_validation->xss_clean($this->input->get('widget_id'));
                
                $js = 'onChange="get_tariff_cost();"';
                
                echo $this->general->build_dropdown_list('location', 'id', 'location_name', $widget_id, array('city_id' => $widget_id_val), $js);
            }
            else
            {
                echo form_dropdown($widget_id, array('' => '--Select--'), '');
            }
        }
        
        function fetch_city_resize()
        {
            if($this->input->get('widget_id_val') || $this->input->get('widget_id'))
            {
                $widget_id_val = $this->form_validation->xss_clean($this->input->get('widget_id_val'));
                $widget_id = $this->form_validation->xss_clean($this->input->get('widget_id'));
                
                $js = 'style="width:310px;" onChange="get_tariff_cost();"';
                
                echo $this->general->build_dropdown_list('location', 'id', 'location_name', $widget_id, array('city_id' => $widget_id_val), $js);
            }
            else
            {
                echo form_dropdown($widget_id, array('' => '--Select--'), '', 'style="width:310px;"');
            }
        }        
        
        function get_price()
        {
            if($this->input->get('city_location_from_var') && $this->input->get('city_location_to_var') && $this->input->get('vehicle_cat_id_var'))
            {
                $city_location_from_var = $this->form_validation->xss_clean($this->input->get('city_location_from_var'));
                $city_location_to_var = $this->form_validation->xss_clean($this->input->get('city_location_to_var'));
                $vehicle_cat_id_var = $this->form_validation->xss_clean($this->input->get('vehicle_cat_id_var'));
                $return = $this->form_validation->xss_clean($this->input->get('return_var'));
                    
                $mutiplyrate  = ($return != "undefined" ? 2 : 1);
                
                if($city_location_from_var != $city_location_to_var)
                {
                    $cost = $this->general->get('tarrif_table', 'cost', array('location_id1' => $city_location_from_var, 'location_id2' => $city_location_to_var, 'vechicle_cat_id' => $vehicle_cat_id_var));
                    
                    if($cost != "")
                        echo "$". ($cost * $mutiplyrate);
                    else
                        echo "$". ($this->general->get('tarrif_table', 'cost', array('location_id1' => $city_location_to_var, 'location_id2' => $city_location_from_var, 'vechicle_cat_id' => $vehicle_cat_id_var)) * $mutiplyrate);
                }
                else
                    echo "$0.00";
                
            }
            else
            {
                echo "$0.00";
            }            
        }
        
	function success()
	{
            //header dynamic variables
            $data['title'] = "Africa Ground Transport - Welcome";
            $data['menu'] = "<ul>
                                    <li ><a href=".site_url('home').">Dashboard</a></span></li>                                    
                                    <li ><a href=".site_url('home/book').">Book</a></li>
                                    <li ><a href=".site_url('home/transaction').">Transaction History</a></li>
                                    <li ><a href=".site_url('home/profile').">Profile</a></li>
                                </ul>";
                                    
            $data['additional_js'] = $data['error'] = "";
            $data['menu_title'] = "Success";
            $data['mem_name'] = $this->session->userdata('mem_name');
					
	    $this->load->view('success',$data);
	}
        
        function check_username($username)
        {            
            if($this->general->is_exist('member', array('member_username' => $username)))
            {
                    $this->form_validation->set_message('check_username', 'Sorry, there is already a user with this email address!');
                    return false;
            }
            
            return true;			
        }
        
	function city_checkup($str)
	{
		$city_to = $this->input->post('city_location_to');
		
		if($str == $city_to)
		{
			$this->form_validation->set_message('city_checkup', 'The pickup address can not be the same with the destination!');
			return false;			
		}	
		
		return true;
	}        
        
    }