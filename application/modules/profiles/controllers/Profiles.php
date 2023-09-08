<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profiles extends MX_Controller {

    public function __construct(){

        parent::__construct();

        $this->load->model('Profile');
        
        //For User's Authentication
        if(!isset($this->session->userdata('loggedin')->user_id)){
            
            redirect('User_Login/login');

        }
        
    }

    public function index(){

        $this->load->view('post_login/main');
        $this->load->view('dashboard');
        $this->load->view('post_login/footer');

    }

    public function f_changepass(){
        
        $oldPass = $this->input->post('old_pass');
		$newPass = $this->input->post('new_pass');
		$matchPass = $this->Profile->matchPass($oldPass);
		$temp = password_verify($oldPass,$matchPass->password);
        
		if ($temp) {
			$password = password_hash($newPass, PASSWORD_DEFAULT);
            $msgPass = $this->Profile->editPassProcess($password);
            //Setting Messages
            $message    =   array(       
                'message'   => 'Password changed!',
                'status'    => 'success'
            );

        }
        else{

            $message    =   array( 
                'message'   => 'Old password was wrong',
                'status'    => 'danger'
            );

        }

        $this->session->set_flashdata('msg', $message);
        redirect('profile');
    }
    public function f_profile(){
        $user = $this->session->userdata('loggedin')->user_id;
        $data['userdetail']  = $this->Profile->f_get_particulars('mm_users',NULL,array('user_id' =>$user ),1);
        $this->load->view('post_login/main');
        $this->load->view('profile',$data);
        $this->load->view('post_login/footer');
    }
    public function f_updateprofile(){

        $data = array(  'user_name'  => $this->input->post('user_name'),
                        'emp_cd'     => $this->input->post('emp_cd'),
                        'dept'       => $this->input->post('dept'),
                        'designation'=> $this->input->post('designation'),
                        'modified_by'=> $this->session->userdata('loggedin')->user_id,
                        'modified_dt'=> date("Y-m-d h:i:s")
                    );
        $where  = array('user_id' => $this->session->userdata('loggedin')->user_id);  
                  
        $updt = $this->Profile->f_edit('mm_users',$data,$where);
        $message    =   array( 
            'message'   => 'Profile Updated',
            'status'    => 'danger'
        );
        if($updt){
            $this->session->set_flashdata('msg', $message);
        }
        redirect('profile/profile');
    }

}

?>