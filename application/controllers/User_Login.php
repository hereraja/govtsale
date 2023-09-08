<?php 
class User_Login extends MX_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('Login_Process');
	}
		
	public function index(){

		if($_SERVER['REQUEST_METHOD']=="POST"){
			$user_id = $_POST['user_id'];
			$user_pw = $_POST['user_pwd'];
			$result  = $this->Login_Process->f_select_password($user_id);
			$match	 = password_verify($user_pw,$result->password);
			if($match){
				$user_data = $this->Login_Process->f_get_user_inf($user_id);
				$this->session->set_userdata('loggedin',$user_data);
				$_SESSION['menu']= '';
				$this->Login_Process->f_insert_audit_trail($user_id);
				$this->session->set_userdata('sl_no',$this->Login_Process->f_audit_trail_value($user_id));
				//redirect('User_Login/deptselect');
				redirect('User_Login/main');
				

			}else{
				redirect(base_url());
			}
		}else{
			
			if($this->session->userdata('loggedin')){
				redirect('User_Login/main');
	
			}else{
			  
				$this->load->view('login/login');
			}
		}
	}
	public function menuset(){
		$menu = $this->input->post('menu');
		$_SESSION['menu']  = $menu;
		echo $menu;
	}

	public function deptselect(){

		$this->load->view('post_login/deptselect');
		$this->load->view('post_login/home');
		$this->load->view('post_login/footer');

	} 

	public function main(){

		if($this->session->userdata('loggedin')){

			//$this->session->set_userdata('sysdate',$this->Login_Process->f_get_parameters(4));
			$_SESSION['sys_date']= date('Y-m-d');
			
			//$this->session->set_userdata('cashcode', $this->Login_Process->f_get_parameters(13));
			//$_SESSION['cash_code']=$this->session->userdata('cashcode')->param_value;
			//  ***  Supply Order Section  ***  //
			$this->load->view('post_login/main');
			$this->load->view('post_login/home');
			$this->load->view('post_login/footer');

		}
		else{

			redirect(base_url());

		}
		
	}
		
	public function dashboard(){

		if($this->session->userdata('loggedin')){
			$_SESSION['sys_date']= date('Y-m-d');
			$this->session->set_userdata('cashcode', $this->Login_Process->f_get_parameters(13));
			$_SESSION['cash_code']=$this->session->userdata('cashcode')->param_value;
			
			$data['rice']  = $this->Login_Process->get_order_detail('1006');   // Code To Get Rice

			$data['dal']   = $this->Login_Process->get_order_detail('713');   // Code To Get Dal
			$data['salt']  = $this->Login_Process->get_order_detail('2501');   // Code To Get Salt
			$data['oil']   = $this->Login_Process->get_order_detail('1514');   // Code To Get Oil
			
			//  ***  Delivery/Purchase Order Section  ***  // 
			
			$data['del_rice']  = $this->Login_Process->get_deliver_detail('1006');   // Code To Get Rice
			$data['del_dal']   = $this->Login_Process->get_deliver_detail('713');   // Code To Get Dal
			$data['del_salt']  = $this->Login_Process->get_deliver_detail('2501');   // Code To Get Salt
			$data['del_oil']   = $this->Login_Process->get_deliver_detail('1514');   // Code To Get Oil
			
			//  ***  Sale/Purchase Order Section  ***  // 
			
			$data['sale_rice']  = $this->Login_Process->get_sale_detail('1006');   // Code To Get Rice
			$data['sale_dal']   = $this->Login_Process->get_sale_detail('713');   // Code To Get Dal
			$data['sale_salt']  = $this->Login_Process->get_sale_detail('2501');   // Code To Get Salt
			$data['sale_oil']   = $this->Login_Process->get_sale_detail('1514');   // Code To Get Oil

			$this->load->view('post_login/main');
			$this->load->view('post_login/home',$data);
			$this->load->view('post_login/footer');

		}
		else{
			redirect(base_url());
		}
		
	}		

		public function logout(){

			if($this->session->userdata('loggedin')){

				$user_id    =   $this->session->userdata('loggedin')->user_id;
				$this->Login_Process->f_update_audit_trail($user_id);
				$this->session->unset_userdata('loggedin');
				$this->session->unset_userdata('sl_no');
				redirect(base_url());

			}else{

				redirect(base_url());

			}
		}
	}
?>
