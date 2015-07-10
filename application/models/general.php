<?php

    class General extends CI_Model
    {
        
        function __construct()
        {
            parent::__construct();
            $this->load->database();
        }

	function get($table, $what, array $where, $order = "asc")
	{            
            $this->db->select($what);
            $this->db->where($where);
            $this->db->from($table);
	    $this->db->order_by($what, $order);
            $query = $this->db->get();
	    
            if($query->num_rows() > 0)
            {
                foreach($query->result() as $value)
                    return $value->$what;
            }
            
            return false;
	}
	
	function get_all($table, $what, array $where, $order = "asc")
	{
		$this->db->select($what);
		if(count($where) > 0) $this->db->where($where);
		$this->db->from($table);
		if($what != "*")$this->db->order_by($what, $order);
		$query = $this->db->get();
				    
		return $query;		
	}
        
        function is_exist($table, $param_array)
        {
            $query = $this->db->get_where($table, $param_array);
            
            if($query->num_rows() > 0) return true;
            
            return false;			
        }

        function build_dropdown_list($db_table, $drop_down_key_field, $drop_down_value_field, $drop_down_form_name, $param = '', $js = '')
        {
            //$db_table: this is the table from the database the records should be pulled from
            //$drop_down_key_field: this is the field to be pulled from the database as the key of the dropdown. It must be the exact name of the field
            //$drop_down_value_field: this is the field to be pulled from the database as the value of the dropdown. It must be the exact name of the field
            //$drop_down_form_name: this is the name you want to give the dropdown button
            
            $drop_down_list = array();
            $drop_down_list[''] = "--Select--";
            
            $this->db->select('*');
            $this->db->from($db_table);
            
            //if param is not null
            if(!empty($param)) $this->db->where($param);
            
            $query = $this->db->get();
            
            foreach($query->result_array() as $row)
            {
                $drop_down_list[$row[$drop_down_key_field]] = $row[$drop_down_value_field];
            }
            
            asort($drop_down_list);
            
            $this->load->helper('form');
            
            return form_dropdown($drop_down_form_name, $drop_down_list, set_value($drop_down_form_name), 'id="'.$drop_down_form_name.'" '. $js);            
        }
        
        function get_insert_id()
        {                
            return $this->db->insert_id();           
        }
        
        function update_entry($table, $where_array, $param_array)
        {
            $this->db->where($where_array);
            $this->db->update($table, $param_array);
        }
        
        function insert_entry($table, $param)
        {    
            $this->db->insert($table, $param);
        }        

    }