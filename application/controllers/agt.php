<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Agt extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
		}
		
		function index()
		{
		    //header dynamic variables
                    $data['title'] = "Africa Ground Transport";
                    
                    $this->session->sess_destroy();
                    
                    $this->load->view('agt', $data);
		}
		
	} // End Home

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */