<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Login_Process extends CI_Model{

		public function f_select_password($user_id){
			$this->db->select('password');
			$this->db->where('user_id',$user_id);
			$data=$this->db->get('mm_users');

			if($data->num_rows() > 0 )
			{
				return $data->row();
			}
			else
			{
				return false;
			}
		}

		public function f_insert_audit_trail($user_id){

			$time = date("Y-m-d h:i:s");
			$pcaddr = $_SERVER['REMOTE_ADDR'];

			$value = array('login_dt'=> $time,
				       'user_id' => $user_id,
			      	       'terminal_name'=>$pcaddr);
			$this->db->insert('td_audit_trail',$value);
		}

		public function f_get_user_inf($user_id){
			$this->db->select('*');
			$this->db->where('user_id',$user_id);
			$data=$this->db->get('mm_users');
			return $data->row();
		}
	
		public function f_get_kms_inf($sl_no){

			$this->db->select('*');

			$this->db->where('sl_no',$sl_no);

			$data = $this->db->get('mm_kms_yr');

			return $data->row();

	}


		public function f_get_kms_yr(){

			$this->db->select('*');

			$data = $this->db->get('mm_kms_yr');

			return $data->result();
		}
		public function get_order_detail($hsn_code){
			
			$start = START_SESSION_YEAR;
			$end   = END_SESSION_YEAR;
			$sql   = $this->db->query("SELECT IFNULL(SUM(allot_qty),0) AS allot_qty FROM
                                    td_sw_supply_order WHERE hsn_no = '$hsn_code'
									and order_dt between '$start' and '$end' ");
            return $sql->row();
			
		}
		
		public function get_deliver_detail($hsn_code){
			
			$start = START_SESSION_YEAR;
			$end   = END_SESSION_YEAR;
			$sql   = $this->db->query("SELECT IFNULL(SUM(del_qty),0) AS del_qty,IFNULL(SUM(tot_amnt),0) AS tot_amnt FROM
                                    td_sw_delivery WHERE hsn_no = '$hsn_code'
									and trans_dt between '$start' and '$end' ");
            return $sql->row();
			
		}
		
		public function get_sale_detail($hsn_code){
			
			$start = START_SESSION_YEAR;
			$end   = END_SESSION_YEAR;
			$sql   = $this->db->query("SELECT IFNULL(SUM(td_sw_delivery.del_qty),0) AS del_qty,IFNULL(SUM(td_sw_sale.tot_amnt),0) AS tot_amnt FROM
                                    td_sw_sale,td_sw_delivery WHERE td_sw_sale.hsn_no = '$hsn_code' and
									td_sw_delivery.challan_no = td_sw_sale.challan_no
									and td_sw_sale.trans_dt between '$start' and '$end' ");
            return $sql->row();
			
		}
		
		public function f_update_audit_trail($user_id){
			$time = date("Y-m-d h:i:s");
			$sl_no= $this->session->userdata('sl_no')->sl_no;
			$value= array('logout'=>$time);
			$this->db->where('sl_no',$sl_no);
			$this->db->update('td_audit_trail',$value);
		}
		
		public function f_get_parameters($sl_no){
			$this->db->select('param_value');
			$this->db->where('sl_no',$sl_no);
			$data=$this->db->get('md_parameters');

			if($data->num_rows() > 0 ){
				return $data->row();
			}else{
				return false;
			}
		}
		
		public function f_audit_trail_value($user_id){
    		$this->db->select_max('sl_no');
    		$this->db->where('user_id', $user_id);
    		$details = $this->db->get('td_audit_trail');
    		return $details->row();
    	}

		

	}	
?>
