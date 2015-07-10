<?php

    class Tariff extends CI_Model
    {
        
        function __construct()
        {
            parent::__construct();
            $this->load->database();
        }
        
        function is_exist($table, $param_array)
        {
            $query = $this->db->get_where($table, $param_array);
            
            if($query->num_rows() > 0) return true;
            
            return false;			
        }
        
        function get_insert_id()
        {                
            return $this->db->insert_id();           
        }
        
        function get_all_bookings()
        {
            $this->db->select('*');
            $this->db->from('booking_details');
            $this->db->join('member_info', 'booking_details.mem_id = member_info.mem_id');
            return $query = $this->db->get();
        }
        
        function update_entry($mem_id, $param_array)
        {
            $this->db->where(array('mem_id' => $mem_id));
            $this->db->update('member_info', $param_array);
        }
        
        function insert_entry($table, $param)
        {    
            $this->db->insert($table, $param);
        }        

    }