<?php

    class Members extends CI_Model
    {
        
        function __construct()
        {
            parent::__construct();
            $this->load->database();
        }
        
        function admin_do_login($username, $password)
        {
            $query = $this->db->get_where('admin', array('admin_username' => $username, 'admin_password' => $password, 'enabled' => YES));
            
            if($query->num_rows() == 1)
            {
                    return true;
            }
            
            return false;			
        }
        
        function get_num_of_students(){
            
            $this->db->select('student_id');
            $this->db->from('student_info');
            
            $query = $this->db->get();
            
            return $query->num_rows();
            
        }
        
	function get_num_of_jobs(){
	    
	    $this->db->select('job_id');
	    $this->db->from('jobs');
	    
	    $query = $this->db->get();
	    
	    return $query->num_rows();  
	    
	}
	
	function get_num_of_applicants(){
	    
	    $this->db->select('applicant_id');
	    $this->db->from('applicants');
	    
	    $query = $this->db->get();
	    
	    return $query->num_rows();
	    
	    
	}
	
	function get_all_jobs($limit,$offset = 0){
	    
	    $this->db->select('*');
	    $this->db->from('jobs');
	    $this->db->order_by('date_created','desc');
	    $this->db->limit($limit,$offset);
	    
	    $query = $this->db->get();
	    
	    return $query->result_array();
	    
	}
	
	function get_all_applicants($limit,$offset = 0){
	    
	    $this->db->select('*');
	    $this->db->from('applicants');
	    $this->db->join('jobs','applicants.job_id = jobs.job_id');
	    $this->db->limit($limit,$offset);
	    $this->db->order_by('applicants.date_created','desc');
	    
	    $query = $this->db->get();
	    
	    return $query->result_array();
	    
	    
	}
	
        function get_num_of_admitted_students(){
            
            $this->db->select('admission_id');
            $this->db->from('admissions');
            
            $query = $this->db->get();
            
            return $query->num_rows();
            
        }
        
        
        
        function get_all_students(){
            
            $this->db->select('student_id, first_name, last_name, email, school_name, passport, birth, result, admission_status');
            $this->db->from('student_info');
            $this->db->order_by('admission_status', 'asc');
            
            $query = $this->db->get();
            
            return $query->result_array();
        }
        
        function get_all_admitted_students(){
            
            $this->db->select('*');
            $this->db->from('admissions');
            $this->db->join('student_info', 'student_info.student_id = admissions.student_id');
            
            
            $query = $this->db->get();
            
            
	    
	    return $query->result_array();	
		
                
        }
        
        function get_all_uploads($id){
            
            $this->db->select('passport, birth, result');
            $this->db->from('student_info');
            $this->db->where('student_id', $id);
            
            $query = $this->db->get();
            
            return $query->result_array();
            
        }
        
        
        function get_other_details($id){
            
            $where = array(
                           'student_id' => $id
                           );
            
            $this->db->select('present_class,school_type,personal_computer,computer_knowledge,computer_rating,solving_problem,solved_problem,learn_program,best_subject,reason');
            $this->db->from('student_info');
            $this->db->where($where);
            
            $query = $this->db->get();
            
            return $query->result_array();
            
            
            
        }
        
        
        function is_exist($table, $param_array)
        {
            $query = $this->db->get_where($table, $param_array);
            
            if($query->num_rows() > 0) return true;
            
            return false;			
        }
        
        function verified($mem_id)
        {
            if($this->is_exist('member_info', array('mem_id' => $mem_id, 'status' => ENABLED)))
                return true;
            
            return false;
        }
        
        function get($what_id, $where_array, $table)
        {
            $this->db->select($what_id);
            $this->db->where($where_array);
            $this->db->limit(1);
            $query = $this->db->get($table);
            
            foreach($query->result() as $value)
                return $value->$what_id;            
        }
        
        function get_member_basic_info($mem_id)
        {
            $this->db->select('yname, email_ad, mobile, contact_ad');
            $this->db->where('mem_id', $mem_id);
            $this->db->limit(1);
            
            $query = $this->db->get('member_info');
            
            $member_info = array();
            
            foreach($query->result() as $row)
            {
                $member_info['yname'] = $row->yname;
                $member_info['email_ad'] = $row->email_ad;
                $member_info['mobile'] = $row->mobile;
                $member_info['contact_ad'] = $row->contact_ad;
            }
            
            return $member_info;
        }
        
        function get_insert_id()
        {                
            return $this->db->insert_id();           
        }
        
        function update_entry($mem_id, $param_array)
        {
            $this->db->where(array('mem_id' => $mem_id));
            $this->db->update('member_info', $param_array);
            
        }
        
        function delete_entry($table, $param_array)
        {
            #$this->db->where(array('stud_id' => $mem_id));
            $this->db->delete($table, $param_array);
            
        }
        
        function insert_entry($table, $param)
        {    
            $this->db->insert($table, $param);
        }
	
	function delete_all($table){
	    
	    $this->db->truncate($table);
	}
	
	
	function select_industry()
		{
			$this->db->select('*');
			$this->db->from('jobs');
			
			$query = $this->db->get();
			
			$table = "<tr><th><label><p>Industry</p></label></th>
			<td>
			    <select name=\"industry\">";
			
			foreach($query->result() as $row)
			{
				$industry = $row->industry;
				//$jamz_genre = $row->jamz_genre;
				//$artist_id = $row->mem_id;
				//$jamz_id = $row->jamz_id;
				//$profile_img = $this->member_thumb_pix($artist_id, MINI_THUMB_TYPE);
				
				$table .= "<option value = \"".$industry."\">$industry</option>";
				
			}
			$table .= "</select></td></tr>";
			
			return $table;	
		}
		
		function sort_by_jobtitle($limit,$offset = 0){
		    
		    $this->db->select('*');
		    $this->db->from('applicants');
		    $this->db->join('jobs','applicants.job_id = jobs.job_id');
		    $this->db->limit($limit,$offset);
		    $this->db->order_by('job_title','asc');
			
		    $query = $this->db->get();
		    
		    return $query->result_array();
		    
		}
		
		function sort_by_companyname($limit,$offset = 0){
		    
		    $this->db->select('*');
		    $this->db->from('applicants');
		    $this->db->join('jobs','applicants.job_id = jobs.job_id');
		    $this->db->limit($limit,$offset);
		    $this->db->order_by('company_name','asc');
			
		    $query = $this->db->get();
		    
		    return $query->result_array();
		    
		}
		
		
		
		function sort_by_gender($limit,$offset = 0){
		    
		    $this->db->select('*');
		    $this->db->from('applicants');
		    $this->db->join('jobs','applicants.job_id = jobs.job_id');
		    $this->db->limit($limit,$offset);
		    $this->db->order_by('sex','asc');
			
		    $query = $this->db->get();
		    
		    return $query->result_array();
		    
		}
		
		function sort_by_status($limit,$offset = 0){
		    
		    $this->db->select('*');
		    $this->db->from('applicants');
		    $this->db->join('jobs','applicants.job_id = jobs.job_id');
		    $this->db->limit($limit,$offset);
		    $this->db->order_by('marital_status','asc');
			
		    $query = $this->db->get();
		    
		    return $query->result_array();
		    
		    
		    
		}
		
		
		function sort_by_state($limit,$offset = 0){
		    
		    $this->db->select('*');
		    $this->db->from('applicants');
		    $this->db->join('jobs','applicants.job_id = jobs.job_id');
		    $this->db->limit($limit,$offset);
		    $this->db->order_by('state','asc');
			
		    $query = $this->db->get();
		    
		    return $query->result_array();
		    
		    
		    
		}
		
		


    }