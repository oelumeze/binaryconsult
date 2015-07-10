<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Submittest extends CI_Controller
    {		
            public function __construct()
            {
                parent::__construct();
                $this->load->helper(array('form','download'));
                $this->load->library(array('form_validation','pagination','upload'));
            }           
            
            function index()
            {
                // Has the form been posted?
                if (isset($_POST['submit']))
                {
                    // Load the library - no config specified here
                    $this->load->library('upload');
             
                    // Check if there was a file uploaded - there are other ways to
                    // check this such as checking the 'error' for the file - if error
                    // is 0, you are good to code
                    if (!empty($_FILES['userfile']['name']))
                    {
                        // Specify configuration for File 1
                        $config['file_name'] = 'doc_'.time();
                        $config['upload_path'] = 'folders/images/member_data';
                        $config['allowed_types'] = 'doc|pdf|docx';
                        $config['max_size'] = '1000';      
             
                        // Initialize config for File 1
                        $this->upload->initialize($config);
             
                        // Upload file 1
                        if ($this->upload->do_upload('userfile'))
                        {
                            $data = $this->upload->data();
                        }
                        else
                        {
                            echo $this->upload->display_errors();
                        }
             
                    }
             
                    // Do we have a second file?
                    if (!empty($_FILES['userfile1']['name']))
                    {
                        // Config for File 2 - can be completely different to file 1's config
                        // or if you want to stick with config for file 1, do nothing!
                        $config['file_name'] = 'pic_'.time();
                        $config['upload_path'] = 'folders/images/member_data';
                        $config['allowed_types'] = 'gif|jpg|png';
                        $config['max_size'] = '1000';
             
                        // Initialize the new config
                        $this->upload->initialize($config);
             
                        // Upload the second file
                        if ($this->upload->do_upload('userfile1'))
                        {
                            $data = $this->upload->data();
                        }
                        else
                        {
                            echo $this->upload->display_errors();
                        }
             
                    }
                }
                else
                {
                    $this->load->view("upload_form");
                }
            }
    }