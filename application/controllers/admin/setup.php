<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setup extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('tariff');
		$this->load->model('general');
		$this->load->library('pagination');
	}
	
	function index()
	{
		//header dynamic variables
		$data['title'] = "Africa Ground Transport - Setup";
		$data['menu'] = "<ul>
					<li ><a href=".site_url('admin/pages').">Dashboard</a></span></li>                                    
					<li ><a href=".site_url('admin/pages/members').">View Members</a></li>
					<li ><a href=".site_url('admin/pages/booking').">Bookings</a></li>
					<li ><a href=".site_url('admin/setup')." class=\"active\">Setup</a></li>
				    </ul>";

		$data['error'] = "";
		$data['additional_js'] = "";
		$data['menu_title'] = "Setup";
		$data['mem_name'] = "Administrator";
		
		if(!$this->session->userdata('mem_id'))
			redirect('admin/pages/logout');
		
		if($this->input->post('add_vehicle_cat'))
		{
			$this->form_validation->set_rules('vehicle_cat', 'Vehicle Category', 'required|xss_clean|trim|max_length[130]');
			
			if($this->form_validation->run() == FALSE)
			{
				$data['error'] = validation_errors();
			}
			else
			{
				$vehicle_cat = $this->input->post('vehicle_cat');
				
				if(!$this->tariff->is_exist('vehicle_category', array('vehicle_category_name' => $vehicle_cat)))
				{
					//insert into faculty table
					$this->tariff->insert_entry('vehicle_category', array('vehicle_category_name' => $vehicle_cat));
					
					//redirect to members page
					redirect('admin/pages/success');
				}
				else
					$error = "Vehicle Category name already existed!";
			}				
		}
		
		//add city name
		if($this->input->post('add_city_name'))
		{
			$this->form_validation->set_rules('city_name', 'City name', 'required|xss_clean|trim|max_length[130]');
			
			if($this->form_validation->run() == FALSE)
			{
				$data['error'] = validation_errors();
			}
			else
			{
				$city_name = $this->input->post('city_name');
				
				if(!$this->tariff->is_exist('city', array('city_name' => $city_name)))
				{
					//insert into faculty table
					$this->tariff->insert_entry('city', array('city_name' => $city_name));
					
					//redirect to members page
					redirect('admin/pages/success');
				}
				else
					$error = "City name already existed!";
			}				
		}		
		
		//
		if($this->input->post('add_location'))
		{
			$this->form_validation->set_rules('city_id', 'City', 'required|xss_clean|trim');
			$this->form_validation->set_rules('location', 'Location', 'required|xss_clean|trim');
			
			//						
			
			if($this->form_validation->run() == FALSE)
			{
				$data['error'] = validation_errors();
			}
			else
			{
				$city_id = $this->input->post('city_id');
				$location = $this->input->post('location');
			
				if(!$this->tariff->is_exist('location', array('city_id' => $city_id,
										  'location_name' => $location)))
				{	
					//insert into department table
					$this->tariff->insert_entry('location', array(
									 'city_id' => $city_id,
									 'location_name' => $location));
					
					//redirect to members page
					redirect('admin/pages/success');
				}
				else
					$error = "Location already existed!";
			}				
		}
		
		//
		if($this->input->post('update_tariff'))
		{
			$this->form_validation->set_rules('city_from', 'Update Tarrif From', 'required|xss_clean|trim|callback_city_checkup');
			$this->form_validation->set_rules('city_to', 'Update Tarrif To', 'required|xss_clean|trim');
			$this->form_validation->set_rules('vehicle_cat_id', 'Vehicle Category', 'required|xss_clean|trim');
			$this->form_validation->set_rules('travel_cost', 'Cost', 'is_natural_no_zero|required|xss_clean|trim');
			
			if($this->form_validation->run() == FALSE)
			{
				$data['error'] = validation_errors();
			}
			else
			{
				$city_from = $this->input->post('city_from');
				$city_to = $this->input->post('city_to');
				$cost = $this->input->post('travel_cost');
				$vehicle_cat_id = $this->input->post('vehicle_cat_id');
				$city_id = $this->general->get('location', 'city_id', array('id' => $city_from));
					
				//insert into department table
				$this->tariff->insert_entry('tarrif_table', array(
								 'location_id1' => $city_from,
								 'location_id2' => $city_to,
								 'vechicle_cat_id' => $vehicle_cat_id,
								 'cost' => $cost,
								 'city_id' => $city_id));
				
				//redirect to members page
				redirect('admin/pages/success');
			}				
		}		

		//tariff matrix
		//$data['tariff_table'] = $this->tariff->get_tariff_table();
		
		$this->load->view('admin/setup',$data);
	}
	
        function logout()
        {
            $this->session->sess_destroy();
            redirect('admin/login');
        }
	
	function city_checkup($str)
	{
		$city_to = $this->input->post('city_to');
		$vechicle_cat_id = $this->input->post('vehicle_cat_id');
		
		//get locations city id
		$city_from_location_id = $this->general->get('location', 'city_id', array('id' => $str));
		$city_to_location_id = $this->general->get('location', 'city_id', array('id' => $city_to));
		
		if($str == $city_to)
		{
			$this->form_validation->set_message('city_checkup', 'The location cannot be the same!');
			return false;			
		}		
		
		if($city_from_location_id != $city_to_location_id)
		{
			$this->form_validation->set_message('city_checkup', 'You can\'t choose from two different cities!');
			return false;
		}
		
		if(($this->general->is_exist('tarrif_table', array('location_id1' => $str, 'location_id2' => $city_to, 'vechicle_cat_id' => $vechicle_cat_id))) || ($this->general->is_exist('tarrif_table', array('location_id1' => $city_to, 'location_id2' => $str, 'vechicle_cat_id' => $vechicle_cat_id))))
		{
			$this->form_validation->set_message('city_checkup', 'The location tariff exist!');
			return false;
		}		
		
		return true;
	}
	
}