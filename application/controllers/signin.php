 <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


 class Signin extends CI_Controller
    {		
            public function __construct()
            {
                parent::__construct();
                
                $this->load->helper('form');
                $this->load->library('form_validation');
                $this->load->model('members');
            }
            
            
            function index(){
                
                $data['title'] = 'Admin-Login';
                
                $data['access_uri'] = '';
                
                $data['additional_js'] = '';
                
                #$data['error'] = '';
                
                $data['content'] = '';
                
                $this->load->view('signin', $data);
                
            }
    }
            
            
            ?>