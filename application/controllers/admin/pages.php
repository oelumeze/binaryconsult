<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Pages extends CI_Controller
    {
        public function __construct()
        {
            parent::__construct();
            
            $this->load->helper('form');
            $this->load->library('form_validation');
            $this->load->model('general');
            $this->load->model('tariff');
        }
        
        public function _remap($method, $params = array())
        {            
            if(method_exists($this, $method))
            {               
                if(!$this->session->userdata('mem_id'))
                {
                    $this->session->sess_destroy();
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
                                    <li ><a href=".site_url('admin/pages')." class=\"active\">Dashboard</a></span></li>                                    
                                    <li ><a href=".site_url('admin/pages/members').">View Members</a></li>
                                    <li ><a href=".site_url('admin/pages/booking').">Bookings</a></li>
                                    <li ><a href=".site_url('admin/setup').">Setup</a></li>
                                </ul>";
                                    
            $data['additional_js'] = $error = "";
            $data['mem_name'] = $this->session->userdata('mem_name');
            $data['menu_title'] = "Dashboard";
            
            $data['content'] =   "<h1>Welcome Administrator</h1>
                                    <div class=\"panel\">
                                        <ul>
                                                <li>Hello</li>
                                        </ul>        
                                        <ul>
                                        <div class=\"clear\"></div>
                                    </div>";
            
            $this->load->view('home', $data);
        }
        
        function members()
        {
            $data['title'] = "Africa Ground Transport - Welcome";
            $data['menu'] = "<ul>
                                    <li ><a href=".site_url('admin/pages').">Dashboard</a></span></li>                                    
                                    <li ><a href=".site_url('admin/pages/members')." class=\"active\">View Members</a></li>
                                    <li ><a href=".site_url('admin/pages/booking').">Bookings</a></li>
                                    <li ><a href=".site_url('admin/setup').">Setup</a></li>
                                </ul>";
                                    
            $data['additional_js'] = $error = "";
            $data['mem_name'] = $this->session->userdata('mem_name');
            $data['menu_title'] = "Members";
            
            $query = $this->general->get_all('member_info', '*', array());
            
            $data['content'] = "<div class=\"invoiceTb\">
                                <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email Address</th>
                                        <th>Mobile Number</th>
                                        <th>Contact Address</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>";
                                    
            foreach($query->result() as $row)
            {
                $yname = $row->yname;
                $email_ad = $row->email_ad;
                $mobile = $row->mobile;
                $contact_ad = $row->contact_ad;
                $status = $row->status;
                
                $data['content'] .= "<tr>
                                        <td>$yname</td>
                                        <td>$email_ad</td>
                                        <td>$mobile</td>
                                        <td>$contact_ad</td>
                                        <td>".ucwords(strtolower($status))."</td>
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
        
        function booking()
        {
            $data['title'] = "Africa Ground Transport - Welcome";
            $data['menu'] = "<ul>
                                    <li ><a href=".site_url('admin/pages').">Dashboard</a></span></li>                                    
                                    <li ><a href=".site_url('admin/pages/members').">View Members</a></li>
                                    <li ><a href=".site_url('admin/pages/booking')." class=\"active\">Bookings</a></li>
                                    <li ><a href=".site_url('admin/setup').">Setup</a></li>
                                </ul>";
                                    
            $data['additional_js'] = $error = "";
            $data['mem_name'] = $this->session->userdata('mem_name');
            $data['menu_title'] = "Booking";
            
            $query = $this->tariff->get_all_bookings();
            
            $data['content'] = "<div class=\"invoiceTb\">
                                <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
                                <thead>
                                    <tr>
                                        <th>Journey Details</th>
                                        <th>Date and Time</th>
                                        <th>Vehicle Type</th>
                                        <th>Return Route</th>
                                        <th>Return Time</th>
                                        <th>Contact</th>
                                        <th>Cost</th>
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
                $return_from = $row->return_from;
                $return_to = $row->return_to;
                $return_date = $row->return_date;
                $return_time = $row->return_time;
                //$contact_ad = $row->contact_ad;
                $mobile = $row->mobile;
                $omobile = $row->omobile;
                $return = $row->return;
                
                $cost = $this->general->get('tarrif_table', 'cost', array('location_id1' => $pickupaddress_id, 'location_id2' => $destination_id, 'vechicle_cat_id' => $vehicle_cat_id));
                $mutiplyrate  = ($return == "yes" ? 2 : 1);
                
                if($cost != "")
                    $cost_total = $cost * $mutiplyrate;
                else
                    $cost_total = $this->general->get('tarrif_table', 'cost', array('location_id1' => $pickupaddress_id, 'location_id2' => $destination_id, 'vechicle_cat_id' => $vehicle_cat_id)) * $mutiplyrate;                
                
                $data['content'] .= "<tr>
                                        <td>".$this->general->get('city', 'city_name', array('id' => $city))." (".$this->general->get('location', 'location_name', array('id' => $pickupaddress_id))." - ".$this->general->get('location', 'location_name', array('id' => $destination_id)).")</td>
                                        <td>$pickupdate $pickuptime</td>
                                        <td>".$this->general->get('vehicle_category', 'vehicle_category_name', array('id' => $vehicle_cat_id))."</td>
                                        <td>".$this->general->get('location', 'location_name', array('id' => $return_from))." - ".$this->general->get('location', 'location_name', array('id' => $return_to))."</td>
                                        <td>".$return_date." ".$return_time."</td>
                                        <td>$mobile ". ($omobile == "" ? "" : "($omobile)"). " </td>
                                        <td>$cost_total</td>
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

        function logout()
        {
            $this->session->sess_destroy();
            redirect('admin/login');           
        }
        
	function success()
	{
            //header dynamic variables
            $data['title'] = "Africa Ground Transport - Success";
            $data['menu'] = "<ul>
                                    <li ><a href=".site_url('admin/pages').">Dashboard</a></span></li>                                    
                                    <li ><a href=".site_url('admin/pages/members').">View Members</a></li>
                                    <li ><a href=".site_url('admin/pages/upload').">Bookings</a></li>
                                    <li ><a href=".site_url('admin/setup').">Setup</a></li>
                                    <li><a href=\"".site_url('admin/pages/logout')."\">Log Out</a></li>
                                </ul>";
                                    
            $data['additional_js'] = $error = "";
            $data['mem_name'] = $this->session->userdata('mem_name');           

	    $data['content'] = "<h1>Success</h1>
                                <div class=\"panel\">
                                    <ul>
                                        <div class=\"note\">The current request was successful</div>
                                    </ul>
                                    <div class=\"clear\"></div>
                                </div>";
					
	    $this->load->view('home',$data);
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
        
    }