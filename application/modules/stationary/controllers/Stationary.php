<?php  class Stationary extends MX_Controller{
	
    public function __construct()
    {
        parent::__construct();
        $this->load->model('StationaryM');
        $this->load->helper('master_helper');
        $this->load->model('ApiVoucher');
        if(!isset($this->session->userdata('loggedin')->user_id)){
            redirect(base_url());
        }
    }

// *********************** For Unit Master Entry **************************** //

    public function units()
    {

        $this->load->view('post_login/main');
        $tableData['data'] = $this->StationaryM->f_get_unit_table();
        $this->load->view('add/unitTable', $tableData);
        $this->load->view('post_login/footer');

    }

    public function addUnit()
    {
        $this->load->view('post_login/main');
        $this->load->view('add/addUnit'); 
        $this->load->view('post_login/footer');
    }

    public function addNewUnit()
    {

        if($this->session->userdata('loggedin'))
        {
            $created_by   =  $this->session->userdata('loggedin')->user_name; 
        }

        $created_dt       =     date('y-m-d H:i:s');
        
        if($_SERVER['REQUEST_METHOD']=="POST")
        {
            $slNo = $this->StationaryM->f_get_unitSlNo_max();
            $sl_no = $slNo->sl_no + 1;
            $unit               =       $_POST['unit'];
            $this->StationaryM->addNewUnit($sl_no, $unit, $created_by, $created_dt);
            echo "<script> alert('Successfully Submitted');
            document.location= 'units' </script>";
        }
        else
        {
            echo "<script> alert('Sorry! Select Again.');
            document.location= 'addUnit' </script>";
        }

    }

    public function editUnit($sl_no)
    {

        $this->load->view('post_login/main');
        $editData['data'] = $this->StationaryM->f_get_unit_editData($sl_no);
        $this->load->view('add/editUnit', $editData);
        $this->load->view('post_login/footer');

    }

    public function updateUnit()
    {

        if($this->session->userdata('loggedin'))
        {
            $modified_by   =  $this->session->userdata('loggedin')->user_name; 
        }

        $modified_dt       =     date('y-m-d H:i:s');
        if($_SERVER['REQUEST_METHOD']=="POST")
        {
            $sl_no        =      $_POST['sl_no'];
            $unit         =      $_POST['unit'];
            $this->StationaryM->updateUnit($sl_no, $unit, $modified_by, $modified_dt);
            echo "<script> alert('Successfully Updated');
            document.location= 'units' </script>";
        }
        else
        {
            echo "<script> alert('Sorry! Select Again.');
            document.location= 'editUnit' </script>";
        }

    }

    public function deleteUnit($sl_no)
    {
        $this->StationaryM->deleteUnit($sl_no);
        $this->units();
    }


    //***************** For Suppliers Master Entry  *******************//

    public function suppliers()
    {
        $this->load->view('post_login/main');
        $tableData['data'] = $this->StationaryM->f_get_supplier_table();
        $this->load->view('add/supplierTable', $tableData);
        $this->load->view('post_login/footer');
    }

    public function js_get_supplier_cur_RenewalStatus() // For JS
    {
        $sl_no = $this->input->get('sl_no');
        $result = $this->StationaryM->js_get_supplier_cur_RenewalStatus($sl_no);
        echo json_encode($result);

    }

    public function js_edit_supplier_renewalStatus() // For JS
    {
        $sl_no      =      $this->input->post('sl_no');
        $cur_status =      $this->input->post('cur_status');
        $this->StationaryM->js_edit_supplier_renewalStatus($sl_no, $cur_status);
    }

    public function addSupplier()
    {
        $this->load->view('post_login/main');
        $this->load->view('add/entry');
        $this->load->view('post_login/footer');
    }

    public function addNewSupplier()
    {

        if($this->session->userdata('loggedin'))
        {
            $created_by   =  $this->session->userdata('loggedin')->user_name; 
        }

        $created_dt       =     date('y-m-d H:i:s');
        
        if($_SERVER['REQUEST_METHOD']=="POST")
        {
            $data = array('mngr_id' => 3 ,
                        'subgr_id' => 191,
                        'ac_name'=> $this->input->post('name'),
                        'br_id'=> 337,
                        'created_by'=> $created_by,
                        'created_dt' => $created_dt );
            $acc_code = $this->StationaryM->f_get_insert_ac_code($data);  //   Here code returning account code from Finance

            $slNo = $this->StationaryM->f_get_supplierSlNo_max();
            $sl_no = $slNo->sl_no + 1;
            $name               =       $_POST['name'];
            $contact_person     =       $_POST['contact_person'];
            $phn_no             =       $_POST['phn_no'];
            $email              =       $_POST['email'];
            $address            =       $_POST['address'];
            $gst_no             =       $_POST['gst_no'];
            $pan_no             =       $_POST['pan_no'];
            $trd_license        =       $_POST['trd_license'];
            $bank               =       $_POST['bank'];
            $accnt_no           =       $_POST['accnt_no'];
            $ifsc               =       $_POST['ifsc'];
            $st                 =       $_POST['st'];
            $it                 =       $_POST['it'];
         
            
            $this->StationaryM->addNewSupplier($sl_no,$name, $contact_person, $phn_no, $email, $address, $gst_no, $pan_no, $trd_license, $bank, $accnt_no, $ifsc, $st, $it,$acc_code, $created_by, $created_dt);

            echo "<script> alert('Successfully Submitted');
            document.location= 'suppliers' </script>";
        }
        else
        {
            echo "<script> alert('Sorry! Select Again.');
            document.location= 'addSupplier' </script>";
        }

    }

    public function editSupplier($sl_no)
    {
        $this->load->view('post_login/main');
        $editData['data1'] = $this->StationaryM->f_get_supplierEditData($sl_no);
        $this->load->view('add/editSupplier', $editData);
        $this->load->view('post_login/footer');
    }

    public function updateNewSupplier()
    {

        if($this->session->userdata('loggedin'))
        {
            $modified_by   =  $this->session->userdata('loggedin')->user_name; 
        }

        $modified_dt       =     date('y-m-d H:i:s');
        
        if($_SERVER['REQUEST_METHOD']=="POST")
        {

            $sl_no              =       $_POST['sl_no'];
            $name               =       $_POST['name'];
            $contact_person     =       $_POST['contact_person'];
            $phn_no             =       $_POST['phn_no'];
            $email              =       $_POST['email'];
            $address            =       $_POST['address'];
            $gst_no             =       $_POST['gst_no'];
            $pan_no             =       $_POST['pan_no'];
            $trd_license        =       $_POST['trd_license'];
            $bank               =       $_POST['bank'];
            $accnt_no           =       $_POST['accnt_no'];
            $ifsc               =       $_POST['ifsc'];
            $st                 =       $_POST['st'];
            $it                 =       $_POST['it'];
           
            
            $this->StationaryM->updateNewSupplier($sl_no, $name, $contact_person, $phn_no, $email, $address, $gst_no, $pan_no, $trd_license, $bank, $accnt_no, $ifsc, $st, $it,$modified_by, $modified_dt);
            echo "<script> alert('Successfully Updated');
            document.location= 'suppliers' </script>";
        }
        else
        {
            echo "<script> alert('Sorry! Select Again.');
            document.location= 'suppliers' </script>";
        }

    }

    public function deleteSupplier($sl_no)
    {
        $this->StationaryM->deleteSupplier($sl_no);
        $this->suppliers();
    }

    // **************************** For Project Section ***********************//

    public function projects()
    {
        $this->load->view('post_login/main');
        $tableData['data'] = $this->StationaryM->f_get_projects_table();
        $this->load->view('add/projectTable', $tableData);
        $this->load->view('post_login/footer');
    }

    public function addProject()
    {
        $this->load->view('post_login/main');
        $suppliersData['data'] = $this->StationaryM->f_get_suppliersData();
        $this->load->view('add/addProject', $suppliersData);
        $this->load->view('post_login/footer');
    }

    public function addNewProject()
    {

        if($this->session->userdata('loggedin'))
        {
            $created_by   =  $this->session->userdata('loggedin')->user_name; 
        }

        $created_dt       =     date('y-m-d H:i:s');
        
        if($_SERVER['REQUEST_METHOD']=="POST")
        {

            $data = array('mngr_id' => 3 ,
                        'subgr_id' => 191,
                        'ac_name'=> $this->input->post('name'),
                        'br_id'=> 337,
                        'created_by'=> $created_by,
                        'created_dt' => $created_dt );
            $acc_code = $this->StationaryM->f_get_insert_ac_code($data);  //   Here code returning account code from Finance
            $project_code = $this->StationaryM->f_get_projectCd_max();
            $project_cd = $project_code->project_cd + 1;

            $name               =       $_POST['name'];
            $phn_no             =       $_POST['phn_no'];
            $address            =       $_POST['address'];
            $supplier_cd        =       $_POST['supplier_cd'];
            $supplier_no        =       count($supplier_cd);
            //echo count($supplier_cd); die;
            $this->StationaryM->addNewProject($project_cd,$acc_code, $name, $phn_no, $address, $supplier_cd, $supplier_no, $created_by, $created_dt);
            $this->StationaryM->addNewProjectDtls($project_cd, $name, $phn_no, $address, $supplier_cd, $supplier_no, $created_by, $created_dt);
            echo "<script> alert('Successfully Submitted');
            document.location= 'projects' </script>";

        }
        else
        {
            echo "<script> alert('Sorry! Select Again.');
            document.location= 'addProject' </script>";
        }


    }

    public function editProject($project_cd)
    {
        $this->load->view('post_login/main');
        $editData['data1'] = $this->StationaryM->f_get_projectEditData($project_cd);
        $editData['data2'] = $this->StationaryM->f_get_projectDetailsEditData($project_cd);
        $this->load->view('add/editProject', $editData);
        $this->load->view('post_login/footer');
    }

    public function updateNewProject()
    {
        if($this->session->userdata('loggedin'))
        {
            $modified_by   =  $this->session->userdata('loggedin')->user_name; 
        }

        $modified_dt       =     date('y-m-d H:i:s');
        
        if($_SERVER['REQUEST_METHOD']=="POST")
        {
            $project_cd         =       $_POST['project_cd'];
           
            $name               =       $_POST['name'];
            $phn_no             =       $_POST['phn_no'];
            $address            =       $_POST['address'];
            $supplier_cd        =       $_POST['supplier_cd'];
            $supplier_no        =       count($supplier_cd);
            $this->StationaryM->updateNewProject($project_cd, $name, $phn_no, $address, $supplier_cd, $supplier_no, $modified_by, $modified_dt);
            //$this->StationaryM->updateNewProjectDtls($project_cd, $name, $phn_no, $address, $supplier_cd, $supplier_no, $modified_by, $modified_dt);
            echo "<script> alert('Successfully Updated');
            document.location= 'projects' </script>";
        }
        else
        {
            echo "<script> alert('Sorry! Select Again.');
            document.location= 'projects' </script>";
        }

    }

    public function deleteProject($project_cd)
    {
        $this->StationaryM->deleteProject($project_cd);
        $this->StationaryM->deleteProjectDtls($project_cd);
        $this->projects();
    }

    public function bills()
    {
        $this->load->view('post_login/main');
        $where = array('a.vendor_id = b.sl_no'=>NULL,'1 group by a.bulk_trans_id,a.trans_dt,a.vendor_id,a.s_bill_no'=>NULL);
        $select = array('sum(a.s_bill_amt) as s_bill_amt','sum(a.p_bill_amt) as p_bill_amt','a.trans_dt','a.bulk_trans_id','a.vendor_id','b.name','a.s_bill_no');
        $tableData['data'] = $this->StationaryM->f_select('td_stn_pbsb_dtls a,md_stn_supplier b',$select,$where,0);
        $this->load->view('bill/table', $tableData);
        $this->load->view('post_login/footer');
    }

    public function add_bill()
    {
        $this->load->view('post_login/main');
        $data['suppliers'] = $this->StationaryM->f_select('md_stn_supplier',NULL,NULL,0);
        $data['products'] = $this->StationaryM->f_select('md_product',NULL,NULL,0);
        $data['projects']  = $this->StationaryM->f_select('md_stn_project',array('project_cd','name'),NULL,0);
        $comission_rate   = $this->StationaryM->f_select('md_parameters',array('param_value'),array('sl_no'=>1),1);
        $comm  = $comission_rate->param_value;
        $value_forcalculation = 100+$comm;
        $data['vfc']   =  $value_forcalculation;
        $this->load->view('bill/add',$data);
        $this->load->view('post_login/footer');
    }
    public function js_get_hsncode(){

        $prod_id = trim($this->input->get('prod_id'));
        $result = $this->StationaryM->f_select('md_product',array('hsn_code'),array('id ='=>$prod_id),1);
        echo json_encode(trim($result->hsn_code));
    }
    
    public function savebill(){
            
		if($this->session->userdata('loggedin'))
		{
			$created_by   =  $this->session->userdata('loggedin')->user_name; 
		}
		$created_dt       =     date('y-m-d H:i:s');
		
		if($this->input->post('id') ==''){
		
			if($_SERVER['REQUEST_METHOD']=="POST")
			{   
                $trans_dt              = $_POST['trans_dt'];
                $project               =  $_POST['project'];
                $product               =  $this->input->post('product');
				$vendor_id             = $_POST['supplier_id'];
				$qty                   =  $this->input->post('qty');
				$s_bill_no             =  $_POST['s_bill_no'];
				$s_bill_dt             =  $_POST['s_bill_dt'];
				$s_taxable_value       =  $_POST['s_taxable_value'];
				$gst_rate              =  $_POST['gst_rate'];
				$s_cgst                =  $_POST['s_cgst'];
				$s_sgst                =  $_POST['s_sgst'];
				$s_bill_amt            =  $_POST['s_bill_amt'];
				$p_bill_no             =  $_POST['p_bill_no'];
				$p_bill_dt             =  $_POST['p_bill_dt'];
				$p_taxable_value       =  $_POST['p_taxable_value'];
				$p_cgst                =  $_POST['p_cgst'];
				$p_sgst                =  $_POST['p_sgst'];
				$p_bill_amt            =  $_POST['p_bill_amt'];
				$Unit_count            =  count($s_bill_no); 
				$datas = $this->StationaryM->bill_detail_entry($trans_dt,$project,$vendor_id,$product,$s_bill_no,$s_bill_dt,$qty,$s_taxable_value,$gst_rate,$s_cgst,$s_sgst, $s_bill_amt,$p_bill_no,$p_bill_dt,$p_taxable_value,$p_cgst,$p_sgst,$p_bill_amt,$Unit_count);
                if($datas == ''){
                    echo "<script> alert('Successfully Saved');
                   document.location= 'bills' </script>";
                }else{
                    echo "<script> alert('".$datas." Sale bill is Duplicate');
                document.location= 'bills' </script>";
                }
				
			}
			else
			{
				echo "<script> alert('Sorry! Select Again.');
				document.location= 'bills' </script>";
			}
		}	
	}
    public function editbill($id){

        $this->load->view('post_login/main');
        $data['suppliers'] = $this->StationaryM->f_select('md_stn_supplier',NULL,NULL,0);
        $data['projects']  = $this->StationaryM->f_select('md_stn_project',array('project_cd','name'),NULL,0);
        $select = array('a.*','b.prod_name');
        $where = array('a.prod_id=b.id'=>NULL,'bulk_trans_id'=> $id );
        $data['sbpb_list']  = $this->StationaryM->f_select('td_stn_pbsb_dtls a, md_product b',$select,$where,0);
        $this->load->view('bill/edit',$data);
        $this->load->view('post_login/footer');

    }
    public function updatebill(){
        if($_SERVER['REQUEST_METHOD']=="POST")
		{
               $data = array('trans_dt'    => $_POST['trans_dt'],
                            'project_cd'   =>  $_POST['project'],
                            'vendor_id'    => $_POST['supplier_id'],
                            'c_order_no'   =>  $_POST['order_no'],
                            's_bill_no'    => $_POST['s_bill_no'],
                            's_bill_dt'    => $_POST['s_bill_dt'],
                            's_taxable_value' => $_POST['s_taxable_value'],
                            'gst_rate'        => $_POST['gst_rate'],
                            's_cgst'          => $_POST['s_cgst'],
                            's_sgst'          => $_POST['s_sgst'],
                            's_bill_amt'      => $_POST['s_bill_amt'],
                            'p_bill_no'       => $_POST['p_bill_no'],
                            'p_bill_dt'       => $_POST['p_bill_dt'],
                            'p_taxable_value' => $_POST['p_taxable_value'],
                            'p_cgst'          => $_POST['p_cgst'],
                            'p_sgst'          => $_POST['p_sgst'],
                            'p_bill_amt'      => $_POST['p_bill_amt'],
                            'modified_by'     => $this->session->userdata('loggedin')->user_id,
                            'modified_dt'     => date("Y-m-d h:i:s")
                        );

                 $this->StationaryM->f_edit('td_stn_pbsb_dtls',$data,array('id'=>$this->input->post('id')));       
                 $this->bills();
        }
    }
    public function deletebill($id){
        
        $pur_api_data = array(
            "trans_do"=> $id,               //  Here ID is BULK TRANSACTION ID
            "rem"=>"GOVT TRANSACTION"
        );
        $rt = $this->ApiVoucher->f_delete_gov_transaction_jouranl($pur_api_data);
        if($rt == 1 ){
             $this->StationaryM->f_delete('td_stn_pbsb_dtls',array('bulk_trans_id'=>$id));
        }
        $this->bills();
        
    }
	
	public function bill_details(){

        if($_SERVER['REQUEST_METHOD']=="POST")  {
            $s_bill_no  = trim($this->input->post('s_bill_no'));
            $data['suppliers'] = $this->StationaryM->f_select('md_stn_supplier',NULL,NULL,0);
            $data['projects']  = $this->StationaryM->f_select('md_stn_project',array('project_cd','name'),NULL,0);
            $data['sbpb']  = $this->StationaryM->f_select('td_stn_pbsb_dtls',NULL,array('s_bill_no'=> $s_bill_no ),1);
            $this->load->view('post_login/main');
            $this->load->view('bill/bill_details',$data);
            $this->load->view('post_login/footer');
            }else{
                $distData['dist'] = $this->StationaryM->f_get_particulars('md_district',NULL,NULL,0);
                $this->load->view('post_login/main');
                $this->load->view('bill/bill_details',$distData);
                $this->load->view('post_login/footer');
            }

    }
    //   ***   Payment section               ***  ///
    public function payment()
	{
		$this->load->view('post_login/main');
		$tableData['data'] = $this->StationaryM->f_get_mrlist();
		$this->load->view('payment/table', $tableData);
		$this->load->view('post_login/footer');
	}
    public function js_get_sbno_pervendor() // For JS
    {
        $vendor_id = $this->input->get('vendor_id');
        $project_cd = $this->input->get('customer_id');
        $result = $this->StationaryM->f_select('td_stn_pbsb_dtls',array('s_bill_no'),array('vendor_id ='=>$vendor_id,'project_cd'=>$project_cd,'bill_status ='=>'0'),0);
        echo json_encode($result);

    }
    public function js_get_sbno(){
        $s_bill_no = trim($this->input->get('s_bill_no'));
        $sbnumber = $this->db->get_where('td_stn_pbsb_dtls',array('s_bill_no ='=>$s_bill_no))->num_rows();
        $data['cnt'] = $sbnumber;
        echo json_encode($data);
    }
    public function js_get_sbpb_detail(){

        $s_bill_no = $this->input->get('s_bill_no');
        $result = $this->StationaryM->f_select('td_stn_pbsb_dtls',NULL,array('s_bill_no ='=>$s_bill_no),1);
        echo json_encode($result);

    }
    public function add_payment()
	{
		$this->load->view('post_login/main');
		$select = array('id','trans_dt');
        $data['vendors'] = $this->StationaryM->f_get_particulars('md_stn_supplier',NULL,NULL,0);
        $data['banks'] = $this->StationaryM->f_get_particulars('md_bank',NULL,NULL,0);
		$this->load->view('payment/add',  $data);
		$this->load->view('post_login/footer');
	}

    public function savemr(){
            
		if($this->session->userdata('loggedin'))
		{
			$updated_by   =  $this->session->userdata('loggedin')->user_name; 
		}
		$updated_dt       =     date('y-m-d H:i:s');
		if($this->input->post('id') ==''){
		
			if($_SERVER['REQUEST_METHOD']=="POST")
			{
                $trans_dt              =  $_POST['trans_dt'];
                $gross_total           =  array_sum($_POST['s_bill_amt']);
                $s_cgst                =  array_sum($_POST['s_cgst']);
                if($_POST['sb_less_amt']  == ''){
			    $sort                  =  0.00;
                }else{
                $sort                  =  $_POST['sb_less_amt'] ? $_POST['sb_less_amt']:0.00;    
                }
                $pb_less_amt           =  $_POST['pb_less_amt'] ? $_POST['pb_less_amt']:0.00;
                $s_bill_no             =  $_POST['s_bill_no'] ;
                $tot_gst     = ($s_cgst)*2;
                $less_gst    = 0.00;
                $rate             = substr((($sort*100)/$gross_total),0,7);
                $less_gst += round($tot_gst-(($tot_gst*$rate)/100));
                $tot_less_calculate_gst= $gross_total-$sort-$less_gst;
                $confed_margin = round($tot_less_calculate_gst*.06);
                $add_gst  =round($less_gst-($less_gst*.06));
        
                $data =  array('trans_dt' => $_POST['trans_dt'],
                               'vendor_id' => $_POST['vendor_id'],
                                'sb_less_amt' => $sort,
                                'pb_less_amt' => $pb_less_amt,
                                'less_gst' => $less_gst,
                                'confed_margin' => $confed_margin,
                                'add_gst' => $add_gst,
                                'created_by' =>$updated_by,
                                'created_dt'=>$updated_dt);
                $this->db->insert('td_stn_pbsb_payment',$data);
                $paymentkey = $this->db->insert_id();
                for($j=0; $j<count($_POST['s_bill_no']); $j++)
                {
                $value = array( 'payment_key'  => $paymentkey,
                                's_bill_no'    => $s_bill_no[$j],
                                'created_by'   => $updated_by,
                                'created_dt'   => $updated_dt
                                );
                $this->db->insert('td_stn_pbsb_payment_details', $value);
                  //  Updating Bill Status
                $udata = array('bill_status'=>'1');
                $this->db->where('s_bill_no', $s_bill_no[$j]);
                $this->db->update('td_stn_pbsb_dtls',$udata);  
                 //  Updating Bill Status
                }
				
				$mr_no                 =  $_POST['mr_no'];
				$mr_dt                 =  $_POST['mr_dt'];
                $bank                  =  $_POST['bank'];
                $acc_no                =  $_POST['acc_no'];
				$trans_mode            =  $_POST['trans_mode'];
				$pay_dt                =  $_POST['pay_dt'];
                $mr_amt                =  $_POST['mr_amt'];
				$amt                   =  $_POST['amt'];
				$created_by            =  $updated_by;
				$created_dt            =  $updated_dt;
				$Unit_count            =  count($mr_no);
				$this->StationaryM->mr_detail_entry($paymentkey,$trans_dt,$mr_no,$mr_dt,$bank,$acc_no,$trans_mode,$pay_dt,$mr_amt,$amt,$Unit_count,$created_by,$created_dt);
				echo "<script> alert('Successfully Saved');
				document.location= 'payment' </script>";
			}
			else
			{
				echo "<script> alert('Sorry! Select Again.');
				document.location= 'payment' </script>";
			}
		
		}else{
			
			$this->payment();
		}
	}
    public function get_sort_calculation($id){
	
		$this->load->view('post_login/main');
		$where = array('a.s_bill_no = b.s_bill_no' => NULL,'a.payment_key' => $id);
		$data['sale_purchase'] = $this->StationaryM->f_select('td_stn_pbsb_payment_details a,td_stn_pbsb_dtls b',NULL,$where,0);
		$data['shortage'] = $this->StationaryM->f_select('td_stn_pbsb_payment',NULL,array('id' => $id),1);
		$data['mr_detail'] = $this->StationaryM->f_select('td_stn_pbsb_mrdetail',NULL,array('payment_key' => $id),0);
		$this->load->view('payment/calculation',$data);
		$this->load->view('post_login/footer');
	}
    public function notesheet($payment_key)
    {
        $where = array('a.vendor_id = b.sl_no' => NULL,'a.id' => $payment_key);
        $data['vendor'] = $this->StationaryM->f_select('td_stn_pbsb_payment a,md_stn_supplier b',array('a.*','b.name'),$where,1);
        $where = array('a.bulk_trans_id = d.bulk_trans_id' => NULL,'d.project_cd = b.project_cd' => NULL,'a.id' => $payment_key);
        $data['purchase_sale_details'] = $this->StationaryM->f_select('td_stn_pbsb_payment a,td_stn_pbsb_dtls d,md_stn_project b',NULL,$where,0);
        
        $selects =array('a.*','b.bank_name');
        $wheres = array('a.bank = b.sl_no' => NULL,
                       'a.payment_key' => $payment_key);
        $data['mr_details']     =  $this->StationaryM->f_select('td_stn_pbsb_mrdetail a,md_bank b',$selects,$wheres,0);
        
        $this->load->view('post_login/main');
        $this->load->view('printbill/notesheet',$data);
        $this->load->view('post_login/footer');
    }

    public function deletepayment($id){
		
		$this->StationaryM->f_delete('td_stn_pbsb_mrdetail',array('payment_key'=>$id));
        $this->StationaryM->f_delete('td_stn_pbsb_payment',array('id'=>$id));
        $this->StationaryM->f_delete('td_stn_pbsb_payment_details',array('payment_key'=>$id));
		$this->payment();
	}
    public function get_voucher($id){
		$this->load->view('post_login/main');
		$selects = array('a.*','b.name');
		$wheres = array('a.vendor_id = b.sl_no' => NULL,'a.id' => $id);
		$data['shortage'] = $this->StationaryM->f_get_particulars('td_stn_pbsb_payment a,md_stn_supplier b',$selects,$wheres,1);
        $where = array('a.s_bill_no = d.s_bill_no' => NULL,'a.payment_key' => $id);
        $data['purchase_sale_details'] = $this->StationaryM->f_select('td_stn_pbsb_payment_details a,td_stn_pbsb_dtls d',NULL,$where,0);
		$data['mr_detail'] = $this->StationaryM->f_get_particulars('td_stn_pbsb_mrdetail',NULL,array('payment_key' => $id),0);
		$this->load->view('printbill/voucher',$data);
		$this->load->view('post_login/footer');
	}
	public function gstreport(){

        if($_SERVER['REQUEST_METHOD']=="POST")
        {
            $supplier_id =  $this->input->post('supplier_id');
            $startDt     =       $_POST['fr_dt'];
            $endDt       =       $_POST['to_dt'];
            $gstrt       =       $_POST['gst'];

            $Data['report'] = $this->StationaryM->gst_report($supplier_id,$startDt, $endDt,$gstrt);
            $Data['startDt'] = $startDt;
            $Data['endDt'] = $endDt;
            $Data['supplier_id'] = $supplier_id;
            $Data['suppliers'] = $this->StationaryM->f_get_suppliersData();
            $this->load->view('post_login/main');
            $this->load->view('report/gstreport', $Data);
            $this->load->view('post_login/footer');

        }else{

            $data['suppliers'] = $this->StationaryM->f_get_suppliersData();
            $this->load->view('post_login/main');
            $this->load->view('report/gstreport',$data);
            $this->load->view('post_login/footer');

        }
    }
    public function stnprojectpaystatus()
    {
        if($_SERVER['REQUEST_METHOD']=="POST")  {
        $fr_dt  = $this->input->post('from_date');
        $to_dt  = $this->input->post('to_date');
        $data['paymenttot'] = $this->StationaryM->f_get_totpaymentprojectwise($fr_dt,$to_dt);
        $data['paymentmaid'] = $this->StationaryM->f_get_paymentmaidprojectwise($fr_dt,$to_dt);
        $data['startDt']  = $fr_dt;
        $data['endDt']  = $to_dt;
        $this->load->view('post_login/main');
        $this->load->view('report/stnproj_payment',$data);
        $this->load->view('post_login/footer');
        }else{
            $distData['dist'] = $this->StationaryM->f_get_particulars('md_district',NULL,NULL,0);
            $this->load->view('post_login/main');
            $this->load->view('report/stnproj_payment',$distData);
            $this->load->view('post_login/footer');
        }

    }
    public function stnvendorpaystatus()
    {
        if($_SERVER['REQUEST_METHOD']=="POST")  {
        $fr_dt  = $this->input->post('from_date');
        $to_dt  = $this->input->post('to_date');
        $dist_cd  = $this->input->post('dist_cd');
        $data['paymenttot'] = $this->StationaryM->f_get_totpaymentvendorwise($fr_dt,$to_dt);
        $data['startDt']  = $fr_dt;
        $data['endDt']  = $to_dt;
        $this->load->view('post_login/main');
        $this->load->view('report/stnvendor_payment',$data);
        $this->load->view('post_login/footer');
        }else{
            $distData['dist'] = $this->StationaryM->f_get_particulars('md_district',NULL,NULL,0);
            $this->load->view('post_login/main');
            $this->load->view('report/stnvendor_payment',$distData);
            $this->load->view('post_login/footer');
        }

    }

    //  ***********   Codeing Satrt for advance version   27/04/2023      ******  // 
    public function payment_adv_ver()
	{
		$this->load->view('post_login/main');
		$tableData['data'] = $this->StationaryM->f_get_adv_mrlist();
		$this->load->view('payment/table_adv_ver', $tableData);
		$this->load->view('post_login/footer');
	}
    public function add_payment_adv_ver()
	{
		$this->load->view('post_login/main');
		$select = array('id','trans_dt');
        $data['vendors'] = $this->StationaryM->f_get_particulars('md_stn_supplier',NULL,NULL,0);
        $data['projects'] = $this->StationaryM->f_get_particulars('md_stn_project',NULL,NULL,0);
        $data['banks'] = $this->StationaryM->f_get_particulars('md_bank',NULL,NULL,0);
        $comission_rate   = $this->StationaryM->f_select('md_parameters',array('param_value'),array('sl_no'=>1),1);
        $comm  = $comission_rate->param_value;
        $value_forcalculation = 100+$comm;
        $data['vfc']   =  $value_forcalculation;
		$this->load->view('payment/add_advance_version',  $data);
		$this->load->view('post_login/footer');
	}
    public function js_get_unpaid_salebill(){

        $vendor_id = $this->input->get('vendor_id');
        $customer_id = $this->input->get('customer_id');
        $select = array('s_bill_no','bulk_trans_id','sum(s_bill_amt)');
        $result = $this->StationaryM->f_get_particulars('td_stn_pbsb_dtls',$select,array('project_cd'=>$customer_id,'vendor_id'=>$vendor_id,'bill_status'=>'0','1 group by s_bill_no,bulk_trans_id' =>NULL),0);
        echo json_encode($result);
    }
    public function js_get_salebill_detail(){
        $bulk_trans_id = $this->input->get('bulk_trans_id');
        $result = $this->StationaryM->f_get_particulars('td_stn_pbsb_dtls',NULL,array('bulk_trans_id'=>$bulk_trans_id),0);
        echo json_encode($result);
    }

    public function savemr_adv_ver(){
            
		if($this->session->userdata('loggedin'))
		{
			$updated_by   =  $this->session->userdata('loggedin')->user_name; 
		}
		$updated_dt       =     date('y-m-d H:i:s');
		if($this->input->post('id') ==''){
		
			if($_SERVER['REQUEST_METHOD']=="POST")
			{
                $bulk_trans_id  =  $this->input->post('bulk_trans_id');
                $bill_amt_dtls  =  $this->StationaryM->f_get_particulars('td_stn_pbsb_dtls',array('sum(s_bill_amt) s_bill_amt','sum(s_cgst) s_cgst','sum(p_bill_amt) p_bill_amt'),array('bulk_trans_id'=>$bulk_trans_id,"1 group by bulk_trans_id"=>NULL),1);
              
                $trans_dt              =  $_POST['trans_dt'];
                $gross_total           =  $bill_amt_dtls->s_bill_amt;
                $s_cgst                =  $bill_amt_dtls->s_cgst;
                if($_POST['sb_less_amt']  == ''){
			    $sort                  =  0.00;
                }else{
                $sort                  =  $_POST['sb_less_amt'] ? $_POST['sb_less_amt']:0.00;    
                }
                $pb_less_amt           =  $_POST['pb_less_amt'] ? $_POST['pb_less_amt']:0.00;
              //  $s_bill_no             =  $_POST['s_bill_no'] ;
                $tot_gst     = ($s_cgst)*2;
                $less_gst    = 0.00;
                $rate             = substr((($sort*100)/$gross_total),0,7);
                $less_gst += round($tot_gst-(($tot_gst*$rate)/100));
                $tot_less_calculate_gst= $gross_total-$sort-$less_gst;
                $margin = round(($tot_less_calculate_gst*100)/107);
                $add_gst  =round($less_gst-(($less_gst*100)/107));
                $tot_pur_amt = $bill_amt_dtls->p_bill_amt; 
                $pur_less_amt = round($_POST['pb_less_amt']);

                $vendor_id = $this->input->post('vendor_id');
                $sqlacc = $this->db->query("SELECT acc_code FROM md_stn_supplier where sl_no = $vendor_id ");
                $acc    = $sqlacc->row();
                $acccode = $acc->acc_code;
                $debit_bank= $this->StationaryM->f_get_particulars('md_bank',NULL,array('sl_no'=>$this->input->post('debit_bank')),1);


                //   Getting Customer Acc code   ***   //
                $customer_id = $this->input->post('customer_id');
                $sqlacustomer = $this->db->query("SELECT acc_code FROM md_stn_project where project_cd =$customer_id  ");
                $customer    = $sqlacustomer->row();
                $customer_acccode = $customer->acc_code;
                $tot_sale_amt = $bill_amt_dtls->s_bill_amt;
                $sale_less_amt = round($_POST['sb_less_amt']);

                $pur_api_data = array(
                    "br_nm"=> "SMBK",
                    "trans_dt"=> $_POST['trans_dt'],
                    "br_cd"=> "342",
                    "trans_do"=> $this->input->post('id'),
                    "unit_id"=> 1,
                    'cr_acc_code'=> $acccode,
                    'dr_cc_code'=>$debit_bank->acc_code,
                    "tot_amt"=>round($tot_pur_amt-$pur_less_amt),
                    "rem"=>"GOV SALE PAYMENT TEST",
                    "created_dt"=> date('y-m-d H:i:s'),
                    "created_by"=> $this->session->userdata('loggedin')->user_name
                );
                 $this->ApiVoucher->f_vendorpayment_jouranl($pur_api_data);
                //print_r($pur_api_data);
                 $credit_bank= $this->StationaryM->f_get_particulars('md_bank',NULL,array('sl_no'=>$this->input->post('credit_bank')),1);
                 $sale_api_data = array(
                    "br_nm"=> "SMBK",
                    "trans_dt"=> $_POST['trans_dt'],
                    "br_cd"=> "342",
                    "trans_do"=> $this->input->post('id'),
                    "unit_id"=> 1,
                    'cr_acc_code'=>$credit_bank->acc_code,
                    'dr_cc_code'=> $customer_acccode,
                    "tot_amt"=>round($tot_sale_amt-$sale_less_amt),
                    "rem"=>"GOV SALE PAYMENT TEST",
                    "created_dt"=> date('y-m-d H:i:s'),
                    "created_by"=> $this->session->userdata('loggedin')->user_name
                );
                // print_r($sale_api_data);
                  $this->ApiVoucher->f_customerpayment_jouranl($sale_api_data);
             //die();
                $data =  array('trans_dt' => $_POST['trans_dt'],
                               'bulk_trans_id'=>$bulk_trans_id,
                               'vendor_id' => $_POST['vendor_id'],
                               'project_cd' => $this->input->post('customer_id'),
                                'sb_less_amt' => $sort,
                                'pb_less_amt' => $pb_less_amt,
                                'less_gst' => $less_gst,
                                'margin' => $margin,
                                'add_gst' => $add_gst,
                                'bill_status' => '1',
                                'created_by' =>$updated_by,
                                'created_dt'=>$updated_dt);            
                $this->db->insert('td_stn_pbsb_payment',$data);
                $paymentkey = $this->db->insert_id();
                // for($j=0; $j<count($_POST['s_bill_no']); $j++)
                // {
                // $value = array( 'payment_key'  => $paymentkey,
                //                 's_bill_no'    => $s_bill_no[$j],
                //                 'created_by'   => $updated_by,
                //                 'created_dt'   => $updated_dt
                //                 );
                // $this->db->insert('td_stn_pbsb_payment_details', $value);
                  //  Updating Bill Status
                $udata = array('bill_status'=>'1');
                $this->db->where('bulk_trans_id', $bulk_trans_id);
                $this->db->update('td_stn_pbsb_dtls',$udata);  
                 //  Updating Bill Status
              //  }
				$debit_bank            =  $_POST['debit_bank'];   //  Bank Accounmt For vendor Payment
				$mr_no                 =  $_POST['mr_no'];
				$mr_dt                 =  $_POST['mr_dt'];
                $bank                  =  $_POST['credit_bank'];
				$trans_mode            =  $_POST['trans_mode'];
				$pay_dt                =  $_POST['pay_dt'];
                $mr_amt                =  $_POST['mr_amt'];
				$amt                   =  $_POST['amt'];
				$created_by            =  $updated_by;
				$created_dt            =  $updated_dt;
				$Unit_count            =  count($mr_no);
				$this->StationaryM->mr_detail_entry($paymentkey,$trans_dt,$mr_no,$mr_dt,$bank,$acc_no,$trans_mode,$pay_dt,$mr_amt,$amt,$Unit_count,$created_by,$created_dt);
                $purchase_payment_api_data =array();
                $sale_payment_api_data = array();
				echo "<script> alert('Successfully Saved');
				document.location= 'payment_adv_ver' </script>";
			}
			else
			{
				echo "<script> alert('Sorry! Select Again.');
				document.location= 'payment_adv_ver' </script>";
			}
		
		}else{
			
			$this->payment_adv_ver();
		}
	}

    public function edit_payment_adv_ver($payment_key)
	{
		$this->load->view('post_login/main');
		$select = array('id','trans_dt');
        $data['vendors'] = $this->StationaryM->f_get_particulars('md_stn_supplier',NULL,NULL,0);
        $data['banks'] = $this->StationaryM->f_get_particulars('md_bank',NULL,NULL,0);
        $data['vendor_pay'] = $this->StationaryM->f_get_particulars('td_stn_pbsb_payment',NULL,array('id' => $payment_key),1);
        $where = array('a.s_bill_no = d.s_bill_no' => NULL,'d.project_cd = b.project_cd' => NULL,'a.payment_key' => $payment_key);
        $data['purchase_sale_details'] = $this->StationaryM->f_select('td_stn_pbsb_payment_details a,td_stn_pbsb_dtls d,md_stn_project b',NULL,$where,0);
        $data['mr_details']     =  $this->StationaryM->f_select('td_stn_pbsb_mrdetail a,md_bank b',array('a.*','b.bank_name'),array('a.bank = b.sl_no' => NULL,
        'a.payment_key' => $payment_key),0);
        $data['projects'] = $this->StationaryM->f_get_particulars('md_stn_project',NULL,NULL,0);
		$this->load->view('payment/edit_advance_version', $data);
		$this->load->view('post_login/footer');
	}

    public function edit_pay_adv_ver(){
            
		if($this->session->userdata('loggedin'))
		{
			$updated_by   =  $this->session->userdata('loggedin')->user_name; 
		}
		$updated_dt       =     date('y-m-d H:i:s');
		
		
			if($_SERVER['REQUEST_METHOD']=="POST")
			{
                $vendor_id = $this->input->post('vendor_id');
                $sqlacc = $this->db->query("SELECT acc_code FROM md_stn_supplier where sl_no = $vendor_id ");
                $acc    = $sqlacc->row();
                $acccode = $acc->acc_code;

                $pur_api_data = array(
                    "br_nm"=> "SMBK",
                    "trans_dt"=> $_POST['trans_dt'],
                    "br_cd"=> "342",
                    "trans_do"=> $this->input->post('id'),
                    'cr_acc_code'=> $acccode,
                    'dr_cc_code'=>'24',
                    "tot_amt"=>array_sum($_POST['p_bill_amt']),
                    "rem"=>"hfghfhfhfhfhjfjh",
                    "created_dt"=> date('y-m-d H:i:s'),
                    "created_by"=> $this->session->userdata('loggedin')->user_name
                );
                 $this->ApiVoucher->f_vendorpayment_jouranl($pur_api_data);
              
                $paymentkey            = $this->input->post('id');
                $trans_dt              =  $_POST['trans_dt'];
                $gross_total           =  array_sum($_POST['s_bill_amt']); 
				//echo '</br>';
                $s_cgst                =  array_sum($_POST['s_cgst']);
               
                
                    if($_POST['sb_less_amt']  == ''){
                    $sort                  =  0.00;
                    }else{
                    $sort                  =  $_POST['sb_less_amt'] ? $_POST['sb_less_amt']:0.00;    
                    }
                    $pb_less_amt           =  $_POST['pb_less_amt'] ? $_POST['pb_less_amt']:0.00;
                    
                    $tot_gst     = ($s_cgst)*2;
                    $less_gst    = 0.00;
                    $rate             = substr((($sort*100)/$gross_total),0,7);
                    $less_gst += round($tot_gst-(($tot_gst*$rate)/100));
                    $tot_less_calculate_gst= $gross_total-$sort-$less_gst;
                    $confed_margin = round($tot_less_calculate_gst*.06);
                    $add_gst  =round($less_gst-($less_gst*.06));
					$data =  array('trans_dt' => $_POST['trans_dt'],
                                    'sb_less_amt' => $sort,
                                    'pb_less_amt' => $pb_less_amt,
                                    'less_gst' => $less_gst,
                                    'confed_margin' => $confed_margin,
                                    'add_gst' => $add_gst,
                                    'updated_by' =>$updated_by,
                                    'updated_dt'=>$updated_dt);                
                    $this->StationaryM->f_edit('td_stn_pbsb_payment',$data,array('id'=>$paymentkey));
                   if(isset($_POST['s_bill_no'])){
                    
						$s_bill_no             =  $_POST['s_bill_no'] ;
						for($j=0; $j<count($_POST['s_bill_no']); $j++)
						{
						$value = array( 'payment_key'  => $paymentkey,
										's_bill_no'    => $s_bill_no[$j],
										'created_by'   => $updated_by,
										'created_dt'   => $updated_dt
										);
						$this->db->insert('td_stn_pbsb_payment_details', $value);
						//  Updating Bill Status
						$udata = array('bill_status'=>'1');
						$this->db->where('s_bill_no', $s_bill_no[$j]);
						$this->db->update('td_stn_pbsb_dtls',$udata);  
						//  Updating Bill Status
						}
                }else{
				   
				   $data =  array('trans_dt' => $_POST['trans_dt'],
                                   'add_gst' => $this->input->post('add_gst'),
                                   'updated_by' =>$updated_by,
                                   'updated_dt'=>$updated_dt);                
                    $this->StationaryM->f_edit('td_stn_pbsb_payment',$data,array('id'=>$paymentkey));
				   
				}
				if(isset($_POST['mr_no']) > 0){
				$mr_no                 =  $_POST['mr_no'];
				$mr_dt                 =  $_POST['mr_dt'];
                $bank                  =  $_POST['bank'];
                $acc_no                =  $_POST['acc_no'];
				$trans_mode            =  $_POST['trans_mode'];
				$pay_dt                =  $_POST['pay_dt'];
                $mr_amt                =  $_POST['mr_amt'];
				$amt                   =  $_POST['amt'];
				$created_by            =  $updated_by;
				$created_dt            =  $updated_dt;
				$Unit_count            =  count($mr_no);
                
                    $this->StationaryM->mr_detail_entry($paymentkey,$trans_dt,$mr_no,$mr_dt,$bank,$acc_no,$trans_mode,$pay_dt,$mr_amt,$amt,$Unit_count,$created_by,$created_dt);
                }

                $data =  array('bill_status' => $this->input->post('bill_status'),
                                'updated_by' =>$updated_by,
                                'updated_dt'=>$updated_dt);                
                 $this->StationaryM->f_edit('td_stn_pbsb_payment',$data,array('id'=>$paymentkey));
                 if($this->input->post('bill_status') == '1'){
                    $pur_api_data = array(
                        "br_nm"=> "SMBK",
                        "trans_dt"=> $_POST['trans_dt'],
                        "br_cd"=> "342",
                        "trans_do"=> $this->input->post('id'),
                        'cr_acc_code'=> $acccode,
                        'dr_cc_code'=>'24',
                        "tot_amt"=>array_sum($_POST['p_bill_amt']),
                        "rem"=>"hfghfhfhfhfhjfjh",
                        "created_dt"=> date('y-m-d H:i:s'),
                        "created_by"=> $this->session->userdata('loggedin')->user_name
                    );
                    $this->ApiVoucher->f_vendorpayment_jouranl($pur_api_data);
                 }
				 
				echo "<script> alert('Successfully Saved');
				document.location= 'payment_adv_ver' </script>";
			}
			else
			{
				echo "<script> alert('Sorry! Select Again.');
				document.location= 'payment_adv_ver' </script>";
			}
		
		
	}

    //   *********   Code Start for Product Master by lokesh on 30/05/2023/    ********    //
    public function productlist()
    {
        $data['products'] = $this->StationaryM->f_select('md_product',NULL,NULL,0);
        $this->load->view('post_login/main');
        $this->load->view('product/productlist',$data);
        $this->load->view('post_login/footer');
    }
    public function addproduct()
    {
        $this->load->view('post_login/main');
        $this->load->view('product/add');
        $this->load->view('post_login/footer');
    }
    public function addNewproduct(){

        $this->form_validation->set_rules('prod_name', 'Product name', 'required');
        $this->form_validation->set_rules('hsn_code', 'Hsn code', 'required');

        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('msg','<div class="alert alert-danger" role="alert">'.validation_errors().'</div>');          
        }else{
            $data =  array(
                'prod_name' => $this->input->post('prod_name'),
                'hsn_code'  => $this->input->post('hsn_code'),
                'comp_name' => $this->input->post('comp_name'),
                'created_by' =>$this->session->userdata('loggedin')->user_name,
                'created_dt'=>date('y-m-d H:i:s')
                ); 
            $this->StationaryM->f_insert('md_product',$data);
           
            $this->session->set_flashdata('msg','<div class="alert alert-success" role="alert">Product Added Successfully</div>');  
        } 
      redirect('stationary/productlist');
    }
    public function productedit($id){

        $data['products'] = $this->StationaryM->f_select('md_product',NULL,array('id'=>$id),1);
        $this->load->view('post_login/main');
        $this->load->view('product/edit',$data);
        $this->load->view('post_login/footer');
    }

    public function updateproduct(){

        $this->form_validation->set_rules('prod_name', 'Product name', 'required');
        $this->form_validation->set_rules('hsn_code', 'Hsn code', 'required');

        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('msg','<div class="alert alert-danger" role="alert">'.validation_errors().'</div>');          
        }else{
            $data =  array(
                'prod_name' => $this->input->post('prod_name'),
                'hsn_code'  => $this->input->post('hsn_code'),
                'comp_name' => $this->input->post('comp_name'),
                'modified_by' =>$this->session->userdata('loggedin')->user_name,
                'modified_dt'=>date('y-m-d H:i:s')
                ); 
            $this->StationaryM->f_edit('md_product',$data,array('id'=> $this->input->post('id')));
          
            $this->session->set_flashdata('msg','<div class="alert alert-success" role="alert">Product Updated Successfully</div>');  
        } 
      redirect('stationary/productlist');
    }

    //    **** Code for bank master  ****   //
    public function banklist()
    {
        $this->load->view('post_login/main');
        $data['data'] = $this->StationaryM->f_select('md_bank',NULL,NULL,0);
        $this->load->view('bank/banklist', $data);
        $this->load->view('post_login/footer');
    }
    public function addbank()
    {   
        if($_SERVER['REQUEST_METHOD']=="POST")
        {
            $this->form_validation->set_rules('bank_name', 'Product name', 'required');
            $this->form_validation->set_rules('ac_no', 'Account code', 'required');
            $this->form_validation->set_rules('ifsc', 'IFSC', 'required');
    
            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('error','<div class="alert alert-danger" role="alert">'.validation_errors().'</div>');          
            }else{
                $data =  array(
                    'bank_name'    => $this->input->post('bank_name'),
                    'branch_name'  => $this->input->post('branch_name'),
                    'ac_no'        => $this->input->post('ac_no'),
                    'ifsc'         => $this->input->post('ifsc'),
                    'modified_by'  => $this->session->userdata('loggedin')->user_name,
                    'modified_dt'  => date('y-m-d H:i:s')
                    ); 
                $this->db->insert('md_bank',$data);
                $this->session->set_flashdata('success','Product Updated Successfully');  
            } 
            redirect('stationary/banklist');

        }else{
            $this->load->view('post_login/main');
            $this->load->view('bank/add_bank');
            $this->load->view('post_login/footer');
        }
    }
    public function editbank($id){

        $data['bank'] = $this->StationaryM->f_select('md_bank',NULL,array('sl_no'=>$id),1);
        $this->load->view('post_login/main');
        $this->load->view('bank/edit_bank',$data);
        $this->load->view('post_login/footer');
    }

    public function updatebank(){

        $this->form_validation->set_rules('bank_name', 'Product name', 'required');
        $this->form_validation->set_rules('ac_no', 'Account code', 'required');
        $this->form_validation->set_rules('ifsc', 'IFSC', 'required');

        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('msg','<div class="alert alert-danger" role="alert">'.validation_errors().'</div>');          
        }else{
            $data =  array(
                'bank_name'    => $this->input->post('bank_name'),
                'branch_name'  => $this->input->post('branch_name'),
                'ac_no'        => $this->input->post('ac_no'),
                'ifsc'         => $this->input->post('ifsc'),
                'modified_by'  => $this->session->userdata('loggedin')->user_name,
                'modified_dt'  => date('y-m-d H:i:s')
                );  
            $this->StationaryM->f_edit('md_bank',$data,array('sl_no'=> $this->input->post('id')));
          
            $this->session->set_flashdata('msg','<div class="alert alert-success" role="alert">Product Updated Successfully</div>');  
        } 
      redirect('stationary/banklist');
    }    
    

}

?>