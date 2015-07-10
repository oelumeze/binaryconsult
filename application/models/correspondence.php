<?php

    class Correspondence extends CI_Model
    {
        
        function __construct()
        {
            parent::__construct();            
        }
        
        function email_notification($email, $name, $type)
        {
            $this->load->library('email');
            
            switch($type){
             
             case REGISTERED:
                    
                    $subject = "Registration Completed";
                   $message = "<i>Dear <b>".$name."</b></i>,<br>
                    
                                <p>Your curriculum vitae has been received
                                and you will be contacted on availability of job
                                in your relevent industry</p>";
                    break;
                
            
               case SUCCESS:
                
                    $subject = "Admission Granted";
                    $message = "<i>Dear <b>".$name."</b></i>,<br>
                    
                                <p>The Youth Initiative for Information Technology</p>";
                    break;
                
            }                    
                 
            
            
            //building html
            $html = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                    <html xmlns="http://www.w3.org/1999/xhtml">
                    <head>
                    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                    <title>Binary Consult</title>
                    </head>
                    
                    <body>';
                    
                            
            $footer = '<div style="clear:both"></div>
                    </div>
                        </td>
                      </tr>
                    </table>
                    </body>
                    </html>';
            
            
            //setting the html format
            $config['mailtype'] = 'html';
            $this->email->initialize($config);
            
            //echo "here";
            $this->email->from('Binary Consult', 'no-reply@binaryconsult.com');
            $this->email->to($email);
            $this->email->subject($subject);
            $this->email->message($html.$message.$footer);
            
            $this->email->send();
        }
        
        function sms_notification($fone, $name, $type, $option = '', $option2 = '')
        {            
            switch($type)
            {                
                case NOTIFICATION:
                    
                    $message = "Dear ".$name.",
A new member has been added to your downliners.
Your total downline is now ".$option.".

We wish you success.";
                    
                    break;
                
                case COMPLETE_TREE_NOTIFICATION:
                    
                    $message = "Congratulations ".$name."!
You have successfully completed the tree children requirement for your plan.
Please check your mail for more information.";
                    break;
                
                case ADDED_PLAN:
                    
                    $message = "Dear ".$name.",
We have confirmed your payment for the plan '".$option."'.

Your plan Id is ".$option2."

Happy Networking!";
                                
                    break;
            }
            
            //send verification code as sms
            $this->config->load('sms');
            
            $sms_username = $this->config->item('username');
            $sms_password = $this->config->item('password');
            $sms_route = $this->config->item('route');
            $sms_url = $this->config->item('url');
            
            $sms_param = array('username' => $sms_username, 'password' => $sms_password, 'route' => $sms_route);
            
            $this->load->helper('sms_helper');
            
            send_sms(foneFormatToSendSMS($fone), $message, SMS_TYPE, SENDER_ID, $sms_param, $sms_url);
        }
    }