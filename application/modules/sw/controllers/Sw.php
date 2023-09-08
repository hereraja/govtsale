<?php
    class Sw extends MX_Controller
    {
        public function __construct()
        {
			parent::__construct();
            $this->load->model('SocialW');
			$this->load->helper('master_helper');
            
            if(!isset($this->session->userdata('loggedin')->user_id)){
            
                redirect(base_url());
    
            }
        }

    // ********************** For Product Master ********************* //
    public function itemEntry()
    {
        $this->load->view('post_login/main');
        $tableData['data'] = $this->SocialW->f_get_item_table();
        $this->load->view('add/itemTable', $tableData);
        $this->load->view('post_login/footer');
    }

    public function addItem()
    {
        $this->load->view('post_login/main');
        $this->load->view('add/addItem');
        $this->load->view('post_login/footer');
    }

        public function js_check_duplicateItem()
        {
            $hsn_no = $this->input->get('hsn_no');
            $result = $this->SocialW->js_get_check_duplicateItem($hsn_no);
            echo json_encode($result); 
        }

        public function addNewItem()
        {

            if($this->session->userdata('loggedin'))
            {
                $created_by   =  $this->session->userdata('loggedin')->user_name; 
            }

            $created_dt       =     date('y-m-d H:i:s');
            
            if($_SERVER['REQUEST_METHOD']=="POST")
            {

                $item_name = $_POST['item_name'];
                $hsn_no = $_POST['hsn_no'];
                $unit = $_POST['unit'];
                
                $this->SocialW->addNewItem($hsn_no, $item_name, $unit, $created_by, $created_dt);

                echo "<script> alert('Successfully Submitted');
                document.location= 'itemEntry' </script>";

            }
            else
            {

                echo "<script> alert('Sorry! Select Again.');
                document.location= 'addItem' </script>";

            }


        }

        public function editItemEntry($hsn_no)
        {

            $this->load->view('post_login/main');

            $editData['data'] = $this->SocialW->f_get_item_editData($hsn_no);
            $this->load->view('add/editItem', $editData);

            $this->load->view('post_login/footer');

        }

        public function updateNewItem()
        {

            if($this->session->userdata('loggedin'))
            {
                $modified_by   =  $this->session->userdata('loggedin')->user_name; 
            }

            $modified_dt       =     date('y-m-d H:i:s');
            
            if($_SERVER['REQUEST_METHOD']=="POST")
            {

                $item_name = $_POST['item_name'];
                $hsn_no = $_POST['hsn_no'];
                $unit = $_POST['unit'];

                $this->SocialW->updateNewItem($hsn_no, $item_name, $unit, $modified_by, $modified_dt);

                echo "<script> alert('Successfully Updated');
                document.location= 'itemEntry' </script>";

            }
            else
            {

                echo "<script> alert('Sorry! Select Again.');
                document.location= 'addItem' </script>";

            }

        }

        // ***************** For Project Master ****************** //

        public function projectEntry()
        {

            $this->load->view('post_login/main');

            $tableData['data'] = $this->SocialW->f_get_projectData();
            $this->load->view('add/projectTable', $tableData);

            $this->load->view('post_login/footer');

        }

        public function addProject()
        {

            $this->load->view('post_login/main');

            $distData['dist'] = $this->SocialW->f_get_distData();
            $this->load->view('add/addProject', $distData);

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

                $slNo = $this->SocialW->f_get_projectSlNo_max();
                $sl_no = $slNo->sl_no + 1;
                //echo $sl_no; die;

                $cdpo = $_POST['cdpo'];
                $dist_cd = $_POST['dist_cd'];
                $contact_no = $_POST['contact_no'];
                $address = $_POST['address'];
                
                $this->SocialW->addNewProject($sl_no, $cdpo, $dist_cd, $contact_no, $address, $created_by, $created_dt);
                echo "<script> alert('Successfully Submitted');
                document.location= 'projectEntry' </script>";

            }
            else
            {
                echo "<script> alert('Sorry! Select Again.');
                document.location= 'addProject' </script>";

            }
        }

        public function editProjectEntry()
        {
            $sl_no = $this->input->get('sl_no');
            $cdpo = $this->input->get('cdpo');
            $this->load->view('post_login/main');
            $editData['data'] = $this->SocialW->f_get_project_distData($sl_no, $cdpo);
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
                $sl_no = $_POST['sl_no'];
                $cdpo = $_POST['cdpo'];
                $dist_cd = $_POST['dist_cd'];
                $contact_no = $_POST['contact_no'];
                $address = $_POST['address'];
                
                $this->SocialW->updateNewProject($sl_no, $cdpo, $dist_cd, $contact_no, $address, $modified_by, $modified_dt);
                echo "<script> alert('Successfully Updated');
                document.location= 'projectEntry' </script>";
            }
            else
            {
                echo "<script> alert('Sorry! Select Again.');
                document.location= 'projectEntry' </script>";
            }
        }

    //**************** For Rate Master ********************//

        public function rateEntry()
        {
			
			if($_SERVER['REQUEST_METHOD']=="POST")
            {
                $from_dt = $this->input->post('from_date');
                $to_dt   = $this->input->post('to_date');
                $this->load->view('post_login/main');
				$tableData['data'] = $this->SocialW->f_get_rateChartData($from_dt,$to_dt);
                $this->load->view('add/rateTable', $tableData);
                $this->load->view('post_login/footer');

            }else{
				
				$from_dt = START_SESSION_YEAR;
			    $to_dt   = END_SESSION_YEAR;
				$this->load->view('post_login/main');
				$tableData['data'] = $this->SocialW->f_get_rateChartData($from_dt,$to_dt);
				$this->load->view('add/rateTable', $tableData);
				$this->load->view('post_login/footer');
            }

        }

        public function addRate()
        {

            $this->load->view('post_login/main');

            $productData['data'] = $this->SocialW->f_get_rateChart_productData();
            $this->load->view('add/addRate', $productData);

            $this->load->view('post_login/footer');

        }

        public function js_get_productUnit() // For JS
        {

            $hsn_no      =      $this->input->get('hsn_no');

            $result = $this->SocialW->js_get_productUnit($hsn_no);
            echo json_encode($result);

        }

        public function addNewRate()
        {

            if($this->session->userdata('loggedin'))
            {
                $created_by   =  $this->session->userdata('loggedin')->user_name; 
            }

            $created_dt       =     date('y-m-d H:i:s');
            
            if($_SERVER['REQUEST_METHOD']=="POST")
            {

                $slNo = $this->SocialW->f_get_rateChartSlNo_max();
                $sl_no = $slNo->sl_no + 1;

                $from_dt        =       $_POST['from_dt'];
                $to_dt          =       $_POST['to_dt'];
                $hsn_no         =       $_POST['hsn_no'];
                $unit           =       $_POST['unit'];
                $rate           =       $_POST['rate'];
                $margin         =       '0.00';
                $gst            =       '0';

                $rate_count         =     count($rate);

                $this->SocialW->addNewRate($sl_no, $from_dt, $to_dt, $hsn_no, $unit, $rate, $created_by, $created_dt, $rate_count);

                echo "<script> alert('Successfully Submitted');
                document.location= 'rateEntry' </script>";
            
            }
            else
            {

                echo "<script> alert('Sorry! Select Again.');
                document.location= 'addRate' </script>";

            }

        }

        public function editRateEntry()
        {

            $sl_no = $this->input->get('sl_no');
            $hsn_no = $this->input->get('hsn_no');

            $this->load->view('post_login/main');

            $editData['data'] = $this->SocialW->f_get_rate_editData($sl_no, $hsn_no);
            //echo "<pre>";
            //var_dump($editData['data']); die;
            $this->load->view('add/editRate', $editData);

            $this->load->view('post_login/footer');

        }

        public function updateNewRate()
        {

            if($this->session->userdata('loggedin'))
            {
                $modified_by   =  $this->session->userdata('loggedin')->user_name; 
            }

            $modified_dt       =     date('y-m-d H:i:s');
            
            if($_SERVER['REQUEST_METHOD']=="POST")
            {

                $sl_no          =       $_POST['sl_no'];

                $from_dt        =       $_POST['from_dt'];
                $to_dt          =       $_POST['to_dt'];
                $hsn_no         =       $_POST['hsn_no'];
                $unit           =       $_POST['unit'];
                $rate           =       $_POST['rate'];
                $margin         =       '0.00';
                $gst            =       '0';

                //$rate_count         =     count($rate);

                $this->SocialW->updateNewRate($sl_no, $from_dt, $to_dt, $hsn_no, $unit, $rate, $margin, $gst, $modified_by, $modified_dt);

                echo "<script> alert('Successfully Updated');
                document.location= 'rateEntry' </script>";
            
            }
            else
            {

                echo "<script> alert('Sorry! Select Again.');
                document.location= 'rateEntry' </script>";

            }


        }


    // ****************** For Vendor Master ***************** //

        public function vendorEntry()
        {

            $this->load->view('post_login/main');

            $tableData['data'] = $this->SocialW->f_get_vendorData();
            $this->load->view('add/vendorTable', $tableData);

            $this->load->view('post_login/footer');

        }

        public function addVendor()
        {

            $this->load->view('post_login/main');

            $this->load->view('add/addVendor');

            $this->load->view('post_login/footer');

        }

        public function addNewVendor()
        {

            if($this->session->userdata('loggedin'))
            {
                $created_by   =  $this->session->userdata('loggedin')->user_name; 
            }

            $created_dt       =     date('y-m-d H:i:s');
            
            if($_SERVER['REQUEST_METHOD']=="POST")
            {

                $slNo = $this->SocialW->f_get_vendorSlNo_max();
                $sl_no = $slNo->sl_no + 1;
                //echo $sl_no; die;

                $vendor_name = $_POST['vendor_name'];
                $contact_no = $_POST['contact_no'];
                $email_id = $_POST['email_id'];
                $address = $_POST['address'];
                
                $this->SocialW->addNewVendor($sl_no, $vendor_name, $contact_no, $email_id, $address, $created_by, $created_dt);

                echo "<script> alert('Successfully Submitted');
                document.location= 'vendorEntry' </script>";

            }
            else
            {

                echo "<script> alert('Sorry! Select Again.');
                document.location= 'addVendor' </script>";

            }

        }

        public function editVendorEntry()
        {

            $sl_no = $this->input->get('sl_no');
            $this->load->view('post_login/main');

            $editData['data'] = $this->SocialW->f_get_vendor_editData($sl_no);
            //echo "<pre>";
            //var_dump($editData['data']); die;
            $this->load->view('add/editVendor', $editData);

            $this->load->view('post_login/footer');

        }

        public function updateNewVendor()
        {

            if($this->session->userdata('loggedin'))
            {
                $modified_by   =  $this->session->userdata('loggedin')->user_name; 
            }

            $modified_dt       =     date('y-m-d H:i:s');
            
            if($_SERVER['REQUEST_METHOD']=="POST")
            {

                
                $sl_no = $_POST['sl_no'];
                
                $vendor_name = $_POST['vendor_name'];
                $contact_no = $_POST['contact_no'];
                $email_id = $_POST['email_id'];
                $address = $_POST['address'];
                
                $this->SocialW->updateNewVendor($sl_no, $vendor_name, $contact_no, $email_id, $address, $modified_by, $modified_dt);

                echo "<script> alert('Successfully Updated');
                document.location= 'vendorEntry' </script>";

            }
            else
            {

                echo "<script> alert('Sorry! Select Again.');
                document.location= 'vendorEntry' </script>";

            }

        }

    /////////////////////////////////////////////////////////////////////////////////
    // *********************** For Transaction Part ****************************** //
    /////////////////////////////////////////////////////////////////////////////////

        public function supplyOrderEntry()
        {
           if($_SERVER['REQUEST_METHOD']=="POST")
            {
                $from_dt = $this->input->post('from_date');
                $to_dt   = $this->input->post('to_date');
                $this->load->view('post_login/main');
                $tableData['data'] = $this->SocialW->f_get_supplyOrder_tableData($from_dt,$to_dt);
                $this->load->view('transaction/orderTable', $tableData);
                $this->load->view('post_login/footer');

            }else{
				
				$from_dt = START_SESSION_YEAR;
			    $to_dt   = END_SESSION_YEAR;
                $this->load->view('post_login/main');
				$tableData['data'] = $this->SocialW->f_get_supplyOrder_tableData($from_dt,$to_dt);
                $this->load->view('transaction/orderTable', $tableData);
                $this->load->view('post_login/footer');

            }

        }

        public function addSupplyOrder()
        {

            $this->load->view('post_login/main');
            $addData['dist'] = $this->SocialW->f_get_distData();
            $addData['item'] = $this->SocialW->f_get_rateChart_productData();
            $this->load->view('transaction/addOrder', $addData);
            $this->load->view('post_login/footer');

        }

        public function js_get_order_projectName() //FOR JS
        {

            $order_no      =      $this->input->get('order_no');
            $result = $this->SocialW->js_get_order_projectName($order_no);
            echo json_encode($result);

        }

        public function js_get_orderNo_forNewOrderEntry() // For JS
        {

            $order_no = $this->input->get('order_no');

            $result = $this->SocialW->js_get_orderNo_forNewOrderEntry($order_no);
            echo json_encode($result);

        }

        public function js_get_order_details_forexistOrder_entry() // For JS
        {

            $order_no = $this->input->get('order_no');
            $result = $this->SocialW->js_get_order_details_forexistOrder_entry($order_no);
            echo json_encode($result);

        }

        public function addNewOrder()
        {

            if($this->session->userdata('loggedin'))
            {
                $created_by   =  $this->session->userdata('loggedin')->user_name; 
            }

            $created_dt       =     date('y-m-d H:i:s');

            $modified_by = '';
            $modified_dt = '';
            
            if($_SERVER['REQUEST_METHOD']=="POST")
            {

                $slNo = $this->SocialW->f_get_orderSlNo_max();
                $sl_no = $slNo->sl_no + 1;                

                $order_dt    =  $_POST['order_dt'];
                $order_no    =  $_POST['order_no'];
                $dist_cd     =  $_POST['dist_cd'];
                $project_no  =  $_POST['project_no'];
                $hsn_no      =  $_POST['hsn_no'];
                $unit        =  $_POST['unit'];
                $allot_qty   =  $_POST['allot_qty'];

                $item_count         =     count($hsn_no);
				
				$row_count = $this->db->get_where('td_sw_supply_order', array('order_no =' => $order_no))->num_rows();
				
			//	if ($row_count > 0)
			//	{
			//		echo "<script> alert('Order No Already Exist');
			//		document.location= 'supplyOrderEntry' </script>";
			//	}else{

					$this->SocialW->addNewOrder($sl_no, $order_dt, $order_no, $dist_cd, $project_no, $hsn_no, $allot_qty, $item_count, $created_by, $created_dt, $modified_by, $modified_dt);

					echo "<script> alert('Successfully Added');
					document.location= 'supplyOrderEntry' </script>";
			//	}
            }
            else
            {

                echo "<script> alert('Sorry! Select Again.');
                document.location= 'addSupplyOrder' </script>";

            }

        }

        public function editOrderEntry()
        {

            $order_no   =   $this->input->get('order_no');
            $order_dt   =   $this->input->get('order_dt');
            $project_no   =   $this->input->get('project_no');

            $this->load->view('post_login/main');

            $editData['data1'] = $this->SocialW->f_get_orderEditData($order_no, $order_dt, $project_no);
            $editData['data2'] = $this->SocialW->f_get_orderEdit_allotment($order_no, $order_dt, $project_no);
            $this->load->view('transaction/editOrder', $editData);

            $this->load->view('post_login/footer');

        }

        public function updateNewOrder()
        {

            if($this->session->userdata('loggedin'))
            {
                $modified_by   =  $this->session->userdata('loggedin')->user_name; 
            }

            $modified_dt       =     date('y-m-d H:i:s');

            $created_by = '';
            $created_dt = '';
			$select = array('created_by','created_dt');
            
            if($_SERVER['REQUEST_METHOD']=="POST")
            {

                $slNo = $this->SocialW->f_get_orderSlNo_max();
                $sl_no = $slNo->sl_no + 1;  
                				

                $order_dt    =  $_POST['order_dt'];
                $order_no    =  $_POST['order_no'];
                $dist_cd     =  $_POST['dist_cd'];
                $project_no  =  $_POST['project_no'];

                $hsn_no      =  $_POST['hsn_no'];
                $unit        =  $_POST['unit'];
                $allot_qty   =  $_POST['allot_qty'];

                $item_count         =     count($hsn_no);
				$where = array('order_no'=>$order_no,'project_no'=>$project_no,'order_dt'=>$order_dt);
				$created_data = $this->SocialW->f_select('td_sw_supply_order', $select, $where, 1);
				$created_by = $created_data->created_by;
                $created_dt = $created_data->created_dt;
                
                $this->SocialW->deleteOrderEntry($order_no, $order_dt, $project_no);
            
                $this->SocialW->addNewOrder($sl_no, $order_dt, $order_no, $dist_cd, $project_no, $hsn_no, $allot_qty, $item_count, $created_by, $created_dt, $modified_by, $modified_dt);

               // $this->supplyOrderEntry();
				echo "<script> alert('Successfully Updated');
					document.location= 'supplyOrderEntry' </script>";

            }

        }

        public function deleteOrderEntry()
        {

            $order_no       =       $this->input->get('order_no');
            $order_dt       =       $this->input->get('order_dt');
            $project_no     =       $this->input->get('project_no');
            $this->SocialW->deleteOrderEntry($order_no, $order_dt, $project_no);
            $this->supplyOrderEntry();

        }


    // ******************* For Delivery Section ********************* //

        public function projectDelivery()
        {
			
			if($_SERVER['REQUEST_METHOD']=="POST")
            {
                $from_dt = $this->input->post('from_date');
                $to_dt   = $this->input->post('to_date');
				$this->load->view('post_login/main');
                $tableData['data'] = $this->SocialW->f_get_delivery_tableData($from_dt,$to_dt);
				$this->load->view('transaction/deliveryTable', $tableData);
				$this->load->view('post_login/footer');

            }else{
				
				$from_dt = START_SESSION_YEAR;
			    $to_dt   = END_SESSION_YEAR;
                $this->load->view('post_login/main');
				$tableData['data'] = $this->SocialW->f_get_delivery_tableData($from_dt,$to_dt);
				$this->load->view('transaction/deliveryTable',$tableData);
				$this->load->view('post_login/footer');

            }

        }

        public function addDelivery()
        {
            $this->load->view('post_login/main');
            $addData['dist'] = $this->SocialW->f_get_distData();
            $addData['item'] = $this->SocialW->f_get_rateChart_productData();
            $addData['vendor'] = $this->SocialW->f_get_vendor_deliveryData();
            $this->load->view('transaction/addDelivery', $addData);
            $this->load->view('post_login/footer');
        }

        public function js_get_delivery_orderNo() // For JS
        {

            $dist_cd      =      $this->input->get('dist_cd');
            $project_no   =      $this->input->get('project_no');

            $result = $this->SocialW->js_get_delivery_orderNo($dist_cd, $project_no);
            echo json_encode($result);

        }

        public function js_get_delivery_orderDetailsData() // For JS 
        {

            $order_no = $this->input->get('order_no');

            $result = $this->SocialW->js_get_delivery_orderDetailsData($order_no);
            echo json_encode($result);

        }

        public function js_get_delivery_previousDeliveryDetailsData() // For JS 
        {

            $dist_cd = $this->input->get('dist_cd');
            $project_no = $this->input->get('project_no');
            $order_no = $this->input->get('order_no');

            $result = $this->SocialW->js_get_delivery_previousDeliveryDetailsData($order_no);
            echo json_encode($result);

        }

        public function js_get_price_asSBillNo() // For js
        {

            $sBill_data           =       $this->input->get('sBill_data');
            $order_no             =       $this->input->get('order_no');  
            //$challanData        =       explode(',',$challans);
            //$challan_no         =       count($challanData);
            
            $value = $this->SocialW->js_get_price_asSBillNo($sBill_data, $order_no);

            echo json_encode($value);

        }


        public function js_get_salePrice_asChallanNo() // For JS
        {

            $challan_data           =       $this->input->get('challan_data');

            $value = $this->SocialW->js_get_salePrice_asChallanNo($challan_data);
            echo json_encode($value);

        }

        public function js_get_item_asPer_orderPorject() // For js
        {

            $order_no    =   $this->input->get('order_no');

            $result = $this->SocialW->js_get_item_asPer_orderPorject($order_no);
            echo json_encode($result);

        }


        public function js_get_delivery_allotQty() // FOR JS
        {

            $order_no       =      $this->input->get('order_no');
            $hsn_no         =      $this->input->get('hsn_no');
            $cdpo_no        =      $this->input->get('cdpo_no');

            $result = $this->SocialW->js_get_delivery_allotQty($order_no, $cdpo_no, $hsn_no);
            echo json_encode($result);

        }

        public function js_get_deliveredQty_asPer_orderItem() // For JS
        {

            $order_no       =      $this->input->get('order_no');
            $cdpo_no       =      $this->input->get('cdpo_no');
            $hsn_no         =      $this->input->get('hsn_no');

            $result = $this->SocialW->js_get_deliveredQty_asPer_orderItem($order_no, $cdpo_no, $hsn_no);
            echo json_encode($result);

        }

        public function js_get_marginGST_forProduct_priceCalculation() // For JS 
        {

            $hsn_no = $this->input->get('hsn_no');
            $del_dt = $this->input->get('del_dt');

            $result = $this->SocialW->js_get_marginGST_forProduct_priceCalculation($hsn_no, $del_dt);
            echo json_encode($result);

        }

        public function addNewDelivery()
        {

            if($this->session->userdata('loggedin'))
            {
                $created_by   =  $this->session->userdata('loggedin')->user_name; 
            }
            $created_dt       =     date('y-m-d H:i:s');

            if($_SERVER['REQUEST_METHOD']=="POST")
            {

                $slNo = $this->SocialW->f_get_deliverySlNo_max();
                $sl_no = $slNo->sl_no + 1;
                
                $trans_dt       =       $_POST['trans_dt'];

                $transCd = $this->SocialW->f_get_deliveryTransCd_max($trans_dt);
                $trans_cd = $transCd->trans_cd + 1;
                //echo $trans_cd; die;

                $dist_cd        =       $_POST['dist_cd'];
                $cdpo_no        =       $_POST['project_no'];
                $order_no       =       $_POST['order_no'];
                $hsn_no         =       $_POST['hsn_no'];
                $challan_no     =       $_POST['challan_no'];
                $del_qty        =       $_POST['del_qty'];
                $purchase_dt    =       $_POST['purchase_dt'];
                $vendor_cd      =       $_POST['vendor_cd'];
                $pb_no          =       $_POST['pb_no'];
                $cgst           =       $_POST['cgst'];
                $sgst           =       $_POST['sgst'];
                $tax_val        =       $_POST['tax_val'];
                $tot_amnt       =       $_POST['tot_amnt'];

                $this->SocialW->addNewDelivery( $sl_no, $trans_dt, $trans_cd, $dist_cd, $order_no, $cdpo_no, $challan_no, $hsn_no, $del_qty, $vendor_cd, $purchase_dt, $pb_no, $tax_val, $cgst, $sgst, $tot_amnt, $created_by, $created_dt );

                echo "<script> alert('Successfully Submitted');
                document.location= 'projectDelivery' </script>";

            }
            else
            {
                echo "<script> alert('Sorry! Try Again.');
                document.location= 'addDelivery' </script>";

            }

        }

        public function editDeliveryEntry()
        {

            $sl_no      =   $this->input->get('sl_no');
            $trans_dt   =   $this->input->get('trans_dt');
            $trans_cd   =   $this->input->get('trans_cd');
            //echo $sl_no; echo $trans_cd; die;
            
            $editData['data'] = $this->SocialW->f_get_delivery_editData($sl_no, $trans_dt, $trans_cd);
            $editData['allotQty'] = $this->SocialW->f_get_delivery_allotQtyData($sl_no, $trans_dt, $trans_cd);
            $editData['tot_delQty'] = $this->SocialW->f_get_delivery_tot_delQtyData($sl_no, $trans_dt, $trans_cd);
            //var_dump($editData['tot_delQty']); die;

            $undeliveredData['details'] = $this->SocialW->f_get_edit_undeliveredDetails($sl_no, $trans_dt, $trans_cd);
            $getData = $undeliveredData['details'][0];
            $order_no = $getData->order_no;
            $dist_cd = $getData->dist_cd;
            $cdpo_no = $getData->cdpo_no;
            $hsn_no = $getData->hsn_no;
            $undeliveredData['totDelQty'] = $this->SocialW->f_get_edit_alreadyDelivered_qTy($order_no, $dist_cd, $cdpo_no, $hsn_no, $trans_dt, $trans_cd);
            $already_del_qty = $undeliveredData['totDelQty']->del_qty;
            if($already_del_qty)
            {
                $editData['already_del_qty'] = $already_del_qty;
            }
            else
            {
                $editData['already_del_qty'] = 0 ;
            }

            $this->load->view('post_login/main');

            $this->load->view('transaction/editDelivery', $editData);

            $this->load->view('post_login/footer');

        }

        public function updateNewDelivery()
        {

            if($this->session->userdata('loggedin'))
            {
                $modified_by   =  $this->session->userdata('loggedin')->user_name; 
            }

            $modified_dt       =     date('y-m-d H:i:s');
            if($_SERVER['REQUEST_METHOD']=="POST")
            {            

                $trans_dt       =       $_POST['trans_dt'];
                $trans_cd       =       $_POST['trans_cd'];
                $sl_no          =       $_POST['sl_no'];

                $del_qty        =       $_POST['del_qty'];
                $purchase_dt    =       $_POST['purchase_dt'];
                $pb_no          =       $_POST['pb_no'];
                $cgst           =       $_POST['cgst'];
                $sgst           =       $_POST['sgst'];
                $tax_val        =       $_POST['tax_val'];
                $tot_amnt       =       $_POST['tot_amnt'];

                $this->SocialW->updateNewDelivery( $sl_no, $trans_dt, $trans_cd, $del_qty, $purchase_dt, $pb_no, $tax_val, $cgst, $sgst, $tot_amnt, $modified_by, $modified_dt );

                echo "<script> alert('Successfully Updated');
                document.location= 'projectDelivery' </script>";

            }
            else
            {
                echo "<script> alert('Sorry! Try Again.');
                document.location= 'projectDelivery' </script>";

            }

        }

        public function deleteDeliveryEntry()
        {

            $sl_no      =   $this->input->get('sl_no');
            $trans_dt   =   $this->input->get('trans_dt');
            $trans_cd   =   $this->input->get('trans_cd');

            $this->SocialW->f_delete_delivery($trans_dt, $trans_cd);
            $this->projectDelivery();

        }


    // ********************* For Sale Section ********************* //

        public function sale()
        {
            			
			if($_SERVER['REQUEST_METHOD']=="POST")
            {
                $from_dt = $this->input->post('from_date');
                $to_dt   = $this->input->post('to_date');
				$this->load->view('post_login/main');
				$tableData['data'] = $this->SocialW->f_get_sale_tableData($from_dt,$to_dt);
				$this->load->view('transaction/saleTable', $tableData);
				$this->load->view('post_login/footer');

            }else{
				
				$from_dt = START_SESSION_YEAR;
			    $to_dt   = END_SESSION_YEAR;
                $this->load->view('post_login/main');
				$tableData['data'] = $this->SocialW->f_get_sale_tableData($from_dt,$to_dt);
				$this->load->view('transaction/saleTable', $tableData);
				$this->load->view('post_login/footer');
            }

        }

        public function addSale()
        {

            $this->load->view('post_login/main');

            $addData['dist'] = $this->SocialW->f_get_distData();
            $addData['item'] = $this->SocialW->f_get_rateChart_productData();
            $this->load->view('transaction/addSale', $addData);

            $this->load->view('post_login/footer');

        }

        public function js_get_sale_challanNo() // For JS
        {

            $dist_cd        =      $this->input->get('dist_cd');
            $project_no     =      $this->input->get('project_no');
            $order_no       =      $this->input->get('order_no');

            $result = $this->SocialW->js_get_sale_challanNo($dist_cd, $project_no, $order_no );
            echo json_encode($result);

        }

        public function js_get_item_forSale_orderChallan() // For JS
        {

            $dist_cd = $this->input->get('dist_cd');
            $project_no = $this->input->get('project_no');
            $order_no = $this->input->get('order_no');
            $challan = $this->input->get('challan');

            $result = $this->SocialW->js_get_item_forSale_orderChallan($dist_cd, $project_no, $order_no, $challan );
            echo json_encode($result);

        }

        public function js_get_sale_delQty() // For JS
        {

            $dist_cd        =      $this->input->get('dist_cd');
            $project_no     =      $this->input->get('project_no');
            $order_no       =      $this->input->get('order_no');
            $challan_no     =      $this->input->get('challan_no');
            $hsn_no         =      $this->input->get('hsn_no');

            $result = $this->SocialW->js_get_sale_delQty($dist_cd, $project_no, $order_no, $challan_no, $hsn_no );
            echo json_encode($result);

        }

        public function js_get_sale_deliveryInfoTableData_challan() // For JS 
        {

            $order_no = $this->input->get('order_no');
            
            $result = $this->SocialW->js_get_sale_deliveryInfoTableData_challan($order_no);
            echo json_encode($result);

        }

        public function js_get_sale_calculation_perChallan() // For JS
        {

            $challan_no = $this->input->get('challan_no');
            $order_no = $this->input->get('order_no');
            $result = $this->SocialW->f_get_transDt_hsnNo_perChallanNo($challan_no, $order_no);
            $trans_dt = $result[0]->trans_dt;
            $hsn_no = $result[0]->hsn_no;
            $del_qty = $result[0]->del_qty;
            $result1 = $this->SocialW->js_get_marginGST_forProduct_priceCalculation($hsn_no, $trans_dt);
            $sendData['details'] = $result1;
            $sendData['delQty'] = $del_qty;

            echo json_encode($sendData);

        }

        public function js_check_sale_duplicate_billEntry() // For JS
        {

            $challan_no = $this->input->get('challan_no');
            $order_no = $this->input->get('order_no');
            $bill_no = $this->input->get('bill_no');
            $result = $this->SocialW->js_check_sale_duplicate_billEntry($order_no, $challan_no, $bill_no);
            echo json_encode($result);

        }

        public function js_get_sale_challan_nos() // For JS
        {

            $order_no = $this->input->get('order_no');
            // $dist_cd = $this->input->get('dist_cd');
            // $project_no = $this->input->get('project_no');
            $result = $this->SocialW->js_get_sale_challan_nos($order_no);
            echo json_encode($result);

        }

        public function js_get_sale_itemPer_challan()// For JS
        {

            $challan_no = $this->input->get('challan_no');
            $order_no = $this->input->get('order_no');
            
            $result = $this->SocialW->js_get_sale_itemPer_challan($challan_no, $order_no);
            echo json_encode($result);

        }

        public function js_get_sale_delQty_perChallan() // For JS 
        {

            $challan_no = $this->input->get('challan_no');
            $order_no = $this->input->get('order_no');

            $result = $this->SocialW->js_get_sale_delQty_perChallan($challan_no, $order_no);
            echo json_encode($result);

        }

        public function js_get_payment_saleBillDtls() // For JS
        {

            $order_no = $this->input->get('order_no');
            $result = $this->SocialW->js_get_payment_saleBillDtls($order_no);
            echo json_encode($result);

        }

        public function js_get_payment_purchaseBillDtls() // For JS
        {

            $order_no = $this->input->get('order_no');
            $result = $this->SocialW->js_get_payment_purchaseBillDtls($order_no); 
            echo json_encode($result);

        }

        public function js_get_payment_districtProject_forOrder()
        {

            $order_no = $this->input->get('order_no');
            $result = $this->SocialW->js_get_payment_districtProject_forOrder($order_no);
            echo json_encode($result);

        }

        public function addSaleEntry()
        {

            if($this->session->userdata('loggedin'))
            {
                $created_by   =  $this->session->userdata('loggedin')->user_name; 
            }

            $created_dt       =     date('y-m-d H:i:s');
            
            if($_SERVER['REQUEST_METHOD']=="POST")
            {

                
                $slNo = $this->SocialW->f_get_saleSlNo_max();
                $sl_no = $slNo->sl_no + 1;
                $trans_dt       =       $_POST['trans_dt'];

                $transCd = $this->SocialW->f_get_saleTransCd_max($trans_dt);
                $trans_cd = $transCd->trans_cd + 1;

                $dist_cd       =       $_POST['dist_cd'];
                $cdpo_no       =       $_POST['project_no'];
                $order_no      =       $_POST['order_no'];
                $challan_no    =       $_POST['challan_no'];
                $hsn_no        =       $_POST['hsn_no'];
                $del_qty       =       $_POST['del_qty'];
                $sale_dt       =       $_POST['sale_dt'];
                $bill_no       =       $_POST['bill_no'];
                $cgst          =       $_POST['cgst'];
                $sgst          =       $_POST['sgst'];
                $tax_val       =       $_POST['tax_val'];
                $tot_amnt      =       $_POST['tot_amnt'];
               

                $this->SocialW->addSaleEntry( $sl_no, $trans_dt, $trans_cd, $dist_cd, $cdpo_no, $order_no, $challan_no, $hsn_no, $sale_dt, $bill_no, $cgst, $sgst, $tax_val, $tot_amnt, $created_by, $created_dt );

                echo "<script> alert('Successfully Submitted');
                document.location= 'sale' </script>";
            }
            else
            {
                echo "<script> alert('Sorry! Try Again.');
                document.location= 'addSale' </script>";

            }

        }

        public function editSaleEntry()
        {

            $sl_no  =   $this->input->get('sl_no');
            $trans_dt  =   $this->input->get('trans_dt');
            $trans_cd  =   $this->input->get('trans_cd');
            $this->load->view('post_login/main');
            $editData['data'] = $this->SocialW->f_get_sale_editData($sl_no, $trans_dt, $trans_cd);
            // $delQty = $this->SocialW->f_get_sale_delQty_editData($sl_no, $trans_dt, $trans_cd);
            // $editData['data1'] = $delQty->del_qty;
            $editData['data1'] = $this->SocialW->f_get_sale_delQty_editData($sl_no, $trans_dt, $trans_cd);
            //echo $editData['data1']; die;
            $this->load->view('transaction/saleEdit', $editData);
            $this->load->view('post_login/footer');
            
        }

        public function deleteSaleEntry()
        {

            $sl_no  =   $this->input->get('sl_no');
            $trans_dt  =   $this->input->get('trans_dt');
            $trans_cd  =   $this->input->get('trans_cd');
            $this->SocialW->f_delete_saleData($sl_no, $trans_dt, $trans_cd);
            $this->sale();

        }

    // **************** For Report Section **************************** //

        public function saleReport()
        {

            $this->load->view('post_login/main');
            $this->load->view('report/saleDateSelection');
            $this->load->view('post_login/footer');

        }

        public function f_get_dw_SaleReport()
        {

            if($_SERVER['REQUEST_METHOD']=="POST")
            {
                $startDt        = $this->input->post('from_date');
                $endDt          = $this->input->post('to_date');
               
                $this->showDWSaleReport($startDt, $endDt);
                
            }

        }


        public function showDWSaleReport($startDt, $endDt)
        {

            $reportData['data']  = $this->SocialW->showDWSaleReport($startDt, $endDt);
            $reportData['startDt'] = $startDt;
            $reportData['endDt'] = $endDt;
            $reportData['total']  = $this->SocialW->show_total_saleReport($startDt, $endDt);

            //var_dump($reportData['data']); die;

            $this->load->view('post_login/main');
            $this->load->view('report/saleDWReport', $reportData);
            $this->load->view('post_login/footer');

        }

        public function oilPaymentReport()
        {

            $this->load->view('post_login/main');
            $this->load->view('report/oilPaymentSelection');
            $this->load->view('post_login/footer');

        }

        public function f_get_dateRange_oilPayment()
        {

            if($_SERVER['REQUEST_METHOD']=="POST")
            {
				$startDt        = $this->input->post('from_date');
                $endDt          = $this->input->post('to_date');
                $report_data['data'] = $this->SocialW->f_get_dw_oilPayment_repData($startDt, $endDt);
                $report_data['startDt'] = $startDt;
                $report_data['endDt'] = $endDt;
                $this->load->view('post_login/main');
                $this->load->view('report/oilPaymentReport', $report_data);
                $this->load->view('post_login/footer');
            
            }

        }

        public function oilSheetSelection()
        {

            $this->load->view('post_login/main');
            $this->load->view('report/oilSheetSelection');
            $this->load->view('post_login/footer');

        }

        public function f_get_oil_paymentSheet()
        {

            if($_SERVER['REQUEST_METHOD']=="POST")
            {

                $payment_key = $_POST['payment_key'];
                $hsn_no = '1514';
                $result['payment_key'] = $payment_key;
                $result['table1_data'] = $this->SocialW->f_get_oil_payment_dtls($payment_key, $hsn_no);
                $result['table1_footer_data'] = $this->SocialW->f_get_oil_payment_shortage_dtls($payment_key);
                $result['table1_footer_totData'] = $this->SocialW->f_get_oil_payment_total($payment_key, $hsn_no);
                // For Table-2
                $result['table2_Data'] = $this->SocialW->f_get_oil_paymentDtls_data($payment_key);
                // For Table-3:
                $get_paymentSheet_gstDt = $this->SocialW->get_paymentSheet_gstDt($payment_key);
                $trans_dt = $get_paymentSheet_gstDt->trans_dt;
                $result['table3_gstRate'] = $this->SocialW->f_get_oil_payment_gstRate($trans_dt, $hsn_no);
                $result['table3_Data'] = $this->SocialW->f_get_oil_payment_gstDtls($payment_key, $hsn_no, $trans_dt);
                $this->load->view('post_login/main');
                $this->load->view('report/oilPaymentSheet', $result);
                $this->load->view('post_login/footer');

            } 

        }


        public function purchaseReport()
        {

            $this->load->view('post_login/main');
            $this->load->view('report/purchaseDateSelection');
            $this->load->view('post_login/footer');

        }

        public function f_get_dw_purchaseReport()
        {

            if($_SERVER['REQUEST_METHOD']=="POST")
            {
               
				$startDt        = $this->input->post('from_date');
                $endDt          = $this->input->post('to_date');
                $this->showDWPurchaseReport($startDt, $endDt);
                
            }

        }

        public function showDWPurchaseReport($startDt, $endDt)
        {

            $reportData['data']  = $this->SocialW->showDWPurchaseReport($startDt, $endDt);
            $reportData['startDt'] = $startDt;
            $reportData['endDt'] = $endDt;
            $reportData['total']  = $this->SocialW->show_total_purchaseReport($startDt, $endDt);
            // echo "<pre>";
            // var_dump($reportData['data']); die;
            $this->load->view('post_login/main');
            $this->load->view('report/purchaseDWReport', $reportData);
            $this->load->view('post_login/footer');

        }

    ////// *************************** Bill / Collection Section ****************************** /////
        
        public function billCollection()
        {
			
			if($_SERVER['REQUEST_METHOD']=="POST")
            {
                $from_dt = $this->input->post('from_date');
                $to_dt   = $this->input->post('to_date');
                $this->load->view('post_login/main');
                $tableData['data'] = $this->SocialW->get_bill_tableData($from_dt,$to_dt);
                $this->load->view('bill/paymentTable', $tableData);
                $this->load->view('post_login/footer');

            }else{
				
				$from_dt = START_SESSION_YEAR;
			    $to_dt   = END_SESSION_YEAR;
                $this->load->view('post_login/main');
				$tableData['data'] = $this->SocialW->get_bill_tableData($from_dt,$to_dt);
                $this->load->view('bill/paymentTable', $tableData);
                $this->load->view('post_login/footer');

            }

        }
		
		public function bill_payment($payment_key)
        {
			$payment_mode           = $this->SocialW->get_payment_mode($payment_key);
			if($payment_mode == 'O'){
				
				$data['payment_detail'] = $this->SocialW->get_payment_detail_for_challan($payment_key);
				$data['products']  = $this->SocialW->get_product_detail_for_challan($payment_key);
				$data['mr_detail']      = $this->SocialW->get_mr_detail_for_challan($payment_key);
				$data['amt']            = $this->SocialW->get_amt($payment_key);
				$this->load->view('challan/online_payment',$data);
			}else if($payment_mode == 'F'){
				
				$data['payment_detail'] = $this->SocialW->get_payment_detail_for_challan($payment_key);
				$data['products']  = $this->SocialW->get_product_detail_for_challan($payment_key);
				$data['mr_detail']      = $this->SocialW->get_mr_detail_for_challan($payment_key);
				$data['amt']            = $this->SocialW->get_amt($payment_key);
				$this->load->view('challan/offline_payment',$data);
			}
        }
		
		public function purchase_voucher($payment_key)
        {
				$data['payment_detail'] = $this->SocialW->get_payment_detail_for_challan($payment_key);
				$data['product_mr_no']  = $this->SocialW->get_product_detail_for_challan($payment_key);
				$data['mr_detail']      = $this->SocialW->get_mr_detail_for_challan($payment_key);
				$data['amt']            = $this->SocialW->get_amt($payment_key);
				$this->load->view('challan/purchase_voucher',$data);
        }
		
		public function sale_voucher($payment_key)
        {
			$data['payment_detail'] = $this->SocialW->get_payment_detail_for_challan($payment_key);
			$data['mr_detail']      = $this->SocialW->get_mr_detail_for_challan($payment_key);
			$data['amt']            = $this->SocialW->get_amt($payment_key);
			$this->load->view('challan/sale_voucher',$data);
        }

        public function js_get_pb_no_list(){

            $project_id = $this->input->get('project_id');
            $result = $this->SocialW->js_get_pb_no_list($project_id);
            echo json_encode($result);

        }

        public function js_get_purchase_sale_detail(){

            $pb_no = $this->input->get('pb_no');
            $result = $this->SocialW->js_get_purchase_sale_detail($pb_no);
            echo json_encode($result);
        }

        public function js_get_pb_sb_detail(){
            $challan_no = explode("-",$this->input->get('challan_no'))[0];
			$pb_no      = explode("-",$this->input->get('challan_no'))[1];
            $result     = $this->SocialW->js_get_pb_sb_detail($challan_no,$pb_no);
            echo json_encode($result);
        }

         public function js_get_sb_no_detail(){

            $sb_no = $this->input->get('sb_no');
            $result = $this->SocialW->js_get_sb_no_detil($sb_no);
            echo json_encode($result);

        }

        public function js_get_Payment_purchaseAmount_forbillNo_date()
        {

            $pb_no = $this->input->get('pb_no');
            $pb_dt = $this->input->get('pb_dt');

            $challanDtls['result'] = $this->SocialW->f_get_challan_forPBNO($pb_no, $pb_dt);
            $data = $challanDtls['result'][0];

            $challan_no = $data->challan_no;
            $cdpo_no = $data->cdpo_no;
            $order_no = $data->order_no;
            $dist_cd = $data->dist_cd;

            //var_dump($challan_no); die;

            $result = $this->SocialW->js_get_Payment_purchaseSaleAmount_forBillNoDate($challan_no, $cdpo_no, $order_no);
            echo json_encode($result);
            
        }

    ///////////////////////////////// For Shortage ///////////////////////////////////////////////
        public function billShortage()
        {

			if($_SERVER['REQUEST_METHOD']=="POST")
            {
                $from_dt = $this->input->post('from_date');
                $to_dt   = $this->input->post('to_date');
                $this->load->view('post_login/main');
                $tableData['data'] = $this->SocialW->f_get_shortageDtls_tableData($from_dt,$to_dt);
                $this->load->view('bill/shortageTable', $tableData);
                $this->load->view('post_login/footer');

            }else{
				
				$from_dt = START_SESSION_YEAR;
			    $to_dt   = END_SESSION_YEAR;
                $this->load->view('post_login/main');
				$tableData['data'] = $this->SocialW->f_get_shortageDtls_tableData($from_dt,$to_dt);
                $this->load->view('bill/shortageTable', $tableData);
                $this->load->view('post_login/footer');

            }

        }

        public function js_get_mrNo_perPaymentKey() // For JS
        {

            $payment_key = $this->input->get('payment_key');
            $result = $this->SocialW->js_get_mrNo_perPaymentKey($payment_key);
            echo json_encode($result);

        }

        public function js_get_vender_comment(){

            $vendor_sl = $this->input->get('vendor_sl');
            $result = $this->SocialW->js_get_vender_comment($vendor_sl);
            echo json_encode($result);

        }

        public function js_get_shortage_bankName_for_addRow() // For JS
        {

            $result = $this->SocialW->f_get_bankName();
            echo json_encode($result);

        }

        public function js_get_billAmounts_for_paymentKey()
        {

            $payment_key = $this->input->get('payment_key');
            $result = $this->SocialW->js_get_billAmounts_for_paymentKey($payment_key);
            echo json_encode($result);

        }

        public function addPaymentDetails()
        {

            if($this->session->userdata('loggedin'))
            {
                $created_by   =  $this->session->userdata('loggedin')->user_name; 
            }
            $created_dt       =     date('y-m-d H:i:s');

            if($_SERVER['REQUEST_METHOD']=="POST")
            {

                $trans_dt       =       $_POST['trans_dt'];

                $slNo = $this->SocialW->f_get_maxSlNo_paymentDtls($trans_dt);
                $sl_no = $slNo->sl_no + 1;

                $payment_key        =        $_POST['payment_key'];
				$payment_mode       =        $_POST['payment_mode'];
                $shortage           =        $_POST['shortage'];
               // $oil_shortage       =        $_POST['oil_shortage'];
                $tot_payable        =        $_POST['tot_payable'];
                $tot_rcv            =        $_POST['tot_rcv'];
                $vremarks           =        $_POST['vremarks'];
                $remarks            =        $_POST['remarks'];
                $commission         =        $_POST['commission'];
                $vendor             =        $_POST['vendor'];
				$cdpo               =        $_POST['cdpo'];
                $mr_no              =        $_POST['mr_no'];
				$mr_date            =        $_POST['mr_date'];
                $bank               =        $_POST['bank'];
                $amnt_cr            =        $_POST['amnt_cr'];
                $amnt_oil           =        $_POST['amnt_oil'];
                $cr_dt              =        $_POST['cr_dt'];
                $row                =        count($mr_no);

                $this->SocialW->addPaymentDetails($sl_no,$payment_key,$payment_mode,$trans_dt,$cdpo,$mr_no,$mr_date,$bank, $amnt_cr, $amnt_oil, $cr_dt, $created_by, $created_dt, $row);

                $this->SocialW->addShortageDtls($trans_dt,$payment_key,$payment_mode,$shortage,$tot_payable,$tot_rcv,$remarks,$vendor,$vremarks,$commission, $created_by, $created_dt);

                echo "<script> alert('Successfully Submitted');
                document.location= 'billShortage' </script>";

            }
            else
            {
                echo "<script> alert('Sorry! Try again..');
                document.location= 'billShortage' </script>";
            }

        }

        public function editShortageEntry()
        {

            $trans_dt = $this->input->get('trans_dt');
            $payment_key = $this->input->get('key');
            $editData['data1'] = $this->SocialW->f_get_shortageDtls_editData($trans_dt, $payment_key);
            $editData['data2'] = $this->SocialW->f_get_shortageDtls_totAmnt_editData($payment_key);
            $editData['data3'] = $this->SocialW->f_get_paymentDtls_editData($trans_dt, $payment_key);
            $editData['data4'] = $this->SocialW->f_get_bankName();
            $editData['vendor']= $this->SocialW->f_get_vendorData();
            $editData['project'] = $this->SocialW->f_get_projectData();			
            $this->load->view('post_login/main');
            $this->load->view('bill/editShortage', $editData);
            $this->load->view('post_login/footer');

        }


        public function updateShortageEntry()
        {

            if($this->session->userdata('loggedin'))
            {
                $modified_by   =  $this->session->userdata('loggedin')->user_name; 
            }
            $modified_dt       =     date('y-m-d H:i:s');

            if($_SERVER['REQUEST_METHOD']=="POST")
            {

                $trans_dt           =     $_POST['trans_dt'];
                $payment_key        =     $_POST['payment_key'];
				$payment_mode       =     $_POST['payment_mode'];
                $shortage           =     $_POST['shortage'];
                $tot_payable        =     $_POST['tot_payable'];
                $tot_rcv            =     $_POST['tot_rcv'];
                $commission         =     $_POST['commission'];
                $remarks            =     $_POST['remarks'];
				$vremarks           =     $_POST['vremarks'];
				$vendor             =     $_POST['vendor'];
                $sl_no              =     $_POST['sl_no'];
                $mr_no              =     $_POST['mr_no'];
                $amnt_cr            =     $_POST['amnt_cr'];
                $amnt_oil           =     $_POST['amnt_oil'];
                $cr_dt              =     $_POST['cr_dt'];
                $bank               =     $_POST['bank'];
                $row                =     count($sl_no);

                $this->SocialW->updateShortageEntry($payment_key,$payment_mode,$trans_dt, $shortage,$tot_payable, $tot_rcv, $commission,$vendor,$vremarks,$remarks, $modified_by, $modified_dt );
                $this->SocialW->updatePaymentDtlsEntry($sl_no, $payment_key, $trans_dt, $mr_no, $amnt_cr, $amnt_oil, $cr_dt, $bank, $modified_by, $modified_dt, $row );

                echo "<script> alert('Successfully Updated');document.location= 'billShortage' </script>";
			

            }
            else
            {
                echo "<script> alert('Sorry! Try again..');
                document.location= 'billShortage' </script>";
            }

        }


        public function deleteShortageEntry()
        {

            $trans_dt       =       $this->input->get('trans_dt');
            $payment_key    =       $this->input->get('key');
            
            $this->SocialW->deleteShortageEntry($trans_dt, $payment_key);
            $this->SocialW->deletePaymentDtlsEntry($trans_dt, $payment_key);

            redirect('sw/billShortage');

        }

    ///////////////////////////////// Report/ Date Wise Delivery Report ///////////////////////////

        public function dwDeliveryReport()
        {

            $this->load->view('post_login/main');
            $this->load->view('report/deliveryDateSelection');
            $this->load->view('post_login/footer');

        }

        public function f_get_dw_deliveryReport()
        {

            if($_SERVER['REQUEST_METHOD']=="POST")
            {
				$startDt        = $this->input->post('from_date');
                $endDt          = $this->input->post('to_date');
               
                $this->showDWDdeliveryReport($startDt, $endDt);
                
            }

        }

        public function showDWDdeliveryReport($startDt, $endDt)
        {

            $this->load->view('post_login/main');

            $showData['data'] = $this->SocialW->f_get_deliveryRepData($startDt, $endDt);
            $showData['startDt'] = $startDt;
            $showData['endDt'] = $endDt;

            $fileName = 'Delivery Details From: '.$startDt.' To: '.$endDt.'.xlsx';  
            $data = $this->SocialW->f_get_deliveryRepData($startDt, $endDt);
            $this->load->view('report/deliveryDWreport', $showData);
            $this->load->view('post_login/footer');


        }

       // For Project Wise Delivery Report //

        public function pwDeliveryReport()
        {

            $this->load->view('post_login/main');
            $entryData['dist'] = $this->SocialW->f_get_distData();
            $this->load->view('report/deliveryProjectSelection', $entryData);
            $this->load->view('post_login/footer');

        }


        public function js_get_projectName() // For JS
        {

            $disCd = $this->input->get('dist_cd');
            $dist_data = $this->SocialW->js_get_projectName($disCd);
            echo json_encode($dist_data);


        }

    public function showPWdeliveryReport()
    {

            if($_SERVER['REQUEST_METHOD']=="POST")
            {

                $dist_cd    =   $_POST['dist_cd'];
                $cdpo_no    =   $_POST['cdpo_no'];

                $showData['data'] = $this->SocialW->f_get_pwDeliveryData($dist_cd, $cdpo_no);
                $showData['dist'] = $this->SocialW->f_get_pwDeliveryDist($dist_cd);
                $showData['project'] = $this->SocialW->f_get_pwDeliveryProject($dist_cd, $cdpo_no);

                $this->load->view('post_login/main');
                $this->load->view('report/deliveryPwReport', $showData);
                $this->load->view('post_login/footer');

            }

    }


    // For Supplier wise delivery report -- 
    public function swDeliveryReport()
    {

        $this->load->view('post_login/main');

        $entryData['data'] = $this->SocialW->f_get_supplierData();
        $this->load->view('report/deliveryVendorSelection', $entryData);

        $this->load->view('post_login/footer');

    }

    public function showDeliveryPWreport()
    {
        if($_SERVER['REQUEST_METHOD']=="POST")
        {
            $vendor_cd      =       $_POST['vendor_cd'];
            $startDt        = $this->input->post('from_date');
            $endDt          = $this->input->post('to_date');

            $reportData['data1'] = $this->SocialW->f_get_deliveryReport_dtls($startDt, $endDt, $vendor_cd);
            $reportData['vendor'] = $this->SocialW->f_get_delRep_supplierName($vendor_cd);
            $reportData['start_dt'] = $startDt;
            $reportData['end_dt'] = $endDt;
            
            $this->load->view('post_login/main');
            $this->load->view('report/deliverySWreport', $reportData);
            $this->load->view('post_login/footer');   
        }
    }


    // For Project Wise Shortage Report //
       
        public function pwShortageReport()
        {
            $this->load->view('post_login/main');
            $entryData['dist'] = $this->SocialW->f_get_distData();
            $this->load->view('report/shortageProjectSelection', $entryData);
            $this->load->view('post_login/footer');

        }


        public function showPWshortageReport()
        {

            if($_SERVER['REQUEST_METHOD']=="POST")
            {
                $dist_cd    =   $_POST['dist_cd'];
                $cdpo_no    =   $_POST['cdpo_no'];
                $showData['data'] = $this->SocialW->f_get_pwShortageData($dist_cd, $cdpo_no);
                $showData['total'] = $this->SocialW->f_get_pwShortageTotData($dist_cd, $cdpo_no);
                $showData['dist'] = $this->SocialW->f_get_pwDeliveryDist($dist_cd); // reuse
                $showData['project'] = $this->SocialW->f_get_pwDeliveryProject($dist_cd, $cdpo_no); // reuse
                $this->load->view('post_login/main');
                $this->load->view('report/shortagePwReport', $showData);
                $this->load->view('post_login/footer');

            }

        }


    // For Date Wise Revenew Report //

        public function dwRevenew()
        {
            $this->load->view('post_login/main');
            $this->load->view('report/revenewDateSelection');
            $this->load->view('post_login/footer');
        }

        
        public function f_get_dw_revenewReport()
        {
            if($_SERVER['REQUEST_METHOD']=="POST")
            {
                $datefilter     =       $_POST['datefilter'];
                $splittedstring = explode("  ",$datefilter);
                $startDt = $splittedstring[0];
                $endDt = $splittedstring[1];
                $this->load->view('post_login/main');
                $showData['data'] = $this->SocialW->f_get_dwRevenewRepData($startDt, $endDt);
                $showData['total'] = $this->SocialW->f_get_dwTotRevenewData($startDt, $endDt);
                $showData['startDt'] = $startDt;
                $showData['endDt'] = $endDt;
                $this->load->view('report/revenewDWreport', $showData);
                $this->load->view('post_login/footer');
            }

        }
		
		public function getgstReport()
        {
            if($_SERVER['REQUEST_METHOD']=="POST")
            {
				$startDt        = $this->input->post('from_date');
                $endDt          = $this->input->post('to_date');
                $this->load->view('post_login/main');
                $showData['data'] = $this->SocialW->f_get_purchasegstreport($startDt, $endDt);
                $showData['startDt'] = $startDt;
                $showData['endDt'] = $endDt;
                $this->load->view('report/purchaseGstReport', $showData);
                $this->load->view('post_login/footer');
            }else{
				
				$this->load->view('post_login/main');
                $this->load->view('report/purchaseGstReport');
                $this->load->view('post_login/footer');
			}

        }

    // Project Wise Revenew //

        public function pwRevenew()
        {
            $this->load->view('post_login/main');
            $entryData['dist'] = $this->SocialW->f_get_distData();
            $this->load->view('report/revenewProjectSelection',$entryData);
            $this->load->view('post_login/footer');
        }

        public function showPWrevenewReport()
        {

            if($_SERVER['REQUEST_METHOD']=="POST")
            {
                $dist_cd    =   $_POST['dist_cd'];
                $cdpo_no    =   $_POST['cdpo_no'];
                $showData['data'] = $this->SocialW->f_get_pwRevenewData($dist_cd, $cdpo_no);
                $showData['total'] = $this->SocialW->f_get_pwRevenewTotData($dist_cd, $cdpo_no);
                $showData['dist'] = $this->SocialW->f_get_pwDeliveryDist($dist_cd); // reuse
                $showData['project'] = $this->SocialW->f_get_pwDeliveryProject($dist_cd, $cdpo_no); // reuse

                $this->load->view('post_login/main');
                $this->load->view('report/revenewPwReport', $showData);
                $this->load->view('post_login/footer');
            }

        }

        public function createExcel() {

            $fileName = 'employee.xlsx';  
            $employeeData = $this->SocialW->f_get_vendorData();
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setCellValue('A1', 'Date');
            $sheet->setCellValue('B1', 'District');
            $sheet->setCellValue('C1', 'CDPO');
            $sheet->setCellValue('D1', 'Order No');
            $sheet->setCellValue('E1', 'Challan No');
            $sheet->setCellValue('F1', 'Bill No ');       
            $rows = 2;
            foreach ($employeeData as $val){
                $sheet->setCellValue('A' . $rows, 'ddd');
                $sheet->setCellValue('B' . $rows, 'ddd');
                $sheet->setCellValue('C' . $rows, 'ddd');
                $sheet->setCellValue('D' . $rows, 'ddd');
                $sheet->setCellValue('E' . $rows, 'ddd');
                $sheet->setCellValue('F' . $rows, 'ddd');
                $rows++;
            } 
            $writer = new Xlsx($spreadsheet);
            $writer->save("upload/".$fileName);
            header("Content-Type: application/vnd.ms-excel");
            redirect(base_url()."/upload/".$fileName);              
        }
		
		////        Money Receipt List for Social Welfare          ///  
		
		public function money_receipt_list()     
        {
			
			$type    = 'SW';     //  Here SW represent Social welfare  Department   //
			
			if($_SERVER['REQUEST_METHOD']=="POST")
            {
                $from_dt = $this->input->post('from_date');
                $to_dt   = $this->input->post('to_date');
                $this->load->view('post_login/main');
                $tableData['data'] = $this->SocialW->get_money_receipt_list($from_dt,$to_dt,$type);
                $this->load->view('money_receipt/money_receipt_list', $tableData);
                $this->load->view('post_login/footer');

            }else{
				
				$from_dt = START_SESSION_YEAR;
			    $to_dt   = END_SESSION_YEAR;
                $this->load->view('post_login/main');
				$tableData['data'] = $this->SocialW->get_money_receipt_list($from_dt,$to_dt,$type);
                $this->load->view('money_receipt/money_receipt_list', $tableData);
                $this->load->view('post_login/footer');

            }

        }

		public function money_receipt(){
			
            if($_SERVER['REQUEST_METHOD']=="POST")
            {
                $data_array = array(
				
				   'type'           => 'SW',
				   'no'             => $this->input->post('no'),
				   'trans_dt'       => $this->input->post('trans_dt'),
				   'received_from'  => $this->input->post('received_from'),
				   'reff_detail'    => $this->input->post('reff_detail'),
				   'against'        => $this->input->post('against'),
				   'amt'            => $this->input->post('amt'),
				   'created_by'     => $this->session->userdata('loggedin')->user_name,
				   'created_dt'     => date('y-m-d H:i:s')
				   
				);
				
			    $id = $this->SocialW->f_insert('td_money_receipt',$data_array);
				
				if(isset($id)){
					
					echo "<script> alert('Successfully Added');
					document.location= 'sw/money_receipt_list' </script>";
					
				}else{
					
					echo "<script> alert('Some thing went wrong');
					document.location= 'sw/money_receipt_list' </script>";
					
				}
				

            }else{

                $this->load->view('post_login/main');
                $this->load->view('money_receipt/money_receipt');
                $this->load->view('post_login/footer');
				
			}
			
		}
		///   Code to Ecit Money Receipt         ///
		public function money_receipt_edit(){
			
            if($_SERVER['REQUEST_METHOD']=="POST")
            {
                $data_array = array(
				
				   'type'           => 'SW',
				   'no'             => $this->input->post('no'),
				   'trans_dt'       => $this->input->post('trans_dt'),
				   'received_from'  => $this->input->post('received_from'),
				   'reff_detail'    => $this->input->post('reff_detail'),
				   'against'        => $this->input->post('against'),
				   'amt'            => $this->input->post('amt'),
				   'modified_by'     => $this->session->userdata('loggedin')->user_name,
				   'modified_dt'     => date('y-m-d H:i:s')
				   
				);
				$where  = array('id' => base64_decode($this->input->post('id')));
				$this->SocialW->f_edit('td_money_receipt',$data_array,$where);
                
                echo "<script> alert('Successfully Updated');
				document.location= 'sw/money_receipt_list' </script>";

            }else{
				
				$id = base64_decode($this->input->get('key'));
				$data['money_rec'] = $this->SocialW->f_select('td_money_receipt',NULL,array('id'=>$id),1);
                $this->load->view('post_login/main');
                $this->load->view('money_receipt/money_receipt',$data);
                $this->load->view('post_login/footer');	
			}
		}
		
		public function deleteMoneyreceipt()
        {
            $id       = base64_decode($this->input->get('key'));
            $this->db-> where('id', $id);
            $this->db-> delete('td_money_receipt');
            $this->money_receipt_list();
        }
		
		public function money_receipt_print()
        {
			$id       = base64_decode($this->input->get('key'));
		    $data['money_rec'] = $this->SocialW->f_select('td_money_receipt',NULL,array('id'=>$id,'type'=>'SW'),1);
		    $this->load->view('challan/money_receipt',$data);	
        }

        public function gstReport()
        {
            if($_SERVER['REQUEST_METHOD']=="POST")
            {
				$startDt        = $this->input->post('from_date');
                $endDt          = $this->input->post('to_date');
                $this->load->view('post_login/main');
                $showData['data'] = $this->SocialW->f_get_pursalegst($startDt, $endDt);
                $showData['startDt'] = $startDt;
                $showData['endDt'] = $endDt;
                $this->load->view('report/pursaleGstReport', $showData);
                $this->load->view('post_login/footer');
            }else{
				
				$this->load->view('post_login/main');
                $this->load->view('report/pursaleGstReport');
                $this->load->view('post_login/footer');
			}

        }


    ///******** Code Start at 05/04/2022   For modified version of ICDS   // 

    public function bills()
    {
        $this->load->view('post_login/main');
        $tableData['data'] = $this->SocialW->f_get_bill_data();
        $this->load->view('bill/table', $tableData);
        $this->load->view('post_login/footer');
    }

    public function add_bill()
    {
        $this->load->view('post_login/main');
        $data['suppliers'] = $this->SocialW->f_select('md_sw_vendor',NULL,NULL,0);
        $data['projects']  = $this->SocialW->f_select('md_sw_project',array('sl_no','cdpo'),NULL,0);
        $data['product']   = $this->SocialW->f_select('md_sw_product',array('item_name','hsn_no'),NULL,0);
        $this->load->view('bill/add',$data);
        $this->load->view('post_login/footer');

    }

    public function js_get_sbno(){
        $s_bill_no = trim($this->input->get('s_bill_no'));
        $sbnumber = $this->db->get_where('td_sw_pbsb_details',array('s_bill_no ='=>$s_bill_no))->num_rows();
        $data['cnt'] = $sbnumber;
        echo json_encode($data);
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
			    $tot_taxable_amt = 0;
				$tot_cgst        = 0;
				$tot_sgst        = 0;
				$gross_total     = 0;
				$rate            = 0;
                $trans_dt               =  $_POST['trans_dt'];
				$project               =  $_POST['project'];
                $vendor                =  $_POST['supplier_id'];
				$order_no              =  $_POST['order_no'];
                $hsn_no                =  $_POST['hsn_no'];
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
			    $tot_taxable_amt       = array_sum($_POST['s_bill_amt']);
				$gross_total           = $tot_taxable_amt;
				
				$this->SocialW->bill_detail_entry($trans_dt,$project,$vendor,$order_no,$hsn_no,$s_bill_no,$s_bill_dt,$s_taxable_value,$gst_rate,$s_cgst,$s_sgst, $s_bill_amt,$p_bill_no,$p_bill_dt,$p_taxable_value,$p_cgst,$p_sgst,$p_bill_amt,$Unit_count,$gross_total);
				
				echo "<script> alert('Successfully Saved');
				document.location= 'bills' </script>";

			}
			else
			{
				echo "<script> alert('Sorry! Select Again.');
				document.location= 'bills' </script>";
			}
		
		}else{
			
			$data_array   = array(
								"trans_dt"             => $_POST['trans_dt'],
								"supplier_id"          => $_POST['supplier_id'],
								"sb_less_amt"          => $_POST['sb_less_amt'],
								"pb_less_amt"          => $_POST['pb_less_amt'],
								"s_bill_add_amt"       => $_POST['s_bill_add_amt'],
								"p_bill_add_amt"       => $_POST['p_bill_add_amt'],
								"s_bill_round_off"     => $_POST['s_bill_round_off'],
								"p_bill_round_off"     => $_POST['p_bill_round_off'],
								"s_bill_add_rnd_off"   => $_POST['s_bill_add_rnd_off'],
								"p_bill_add_rnd_off"   => $_POST['p_bill_add_rnd_off'],
								"updated_by"           => $created_by,
								"updated_dt"           => $created_dt
								);
			$where	= array('id' => $this->input->post('id'));			
				$sort   =  $_POST['sb_less_amt'];				
				$this->StationaryM->f_edit('td_stn_pbsb_detail', $data_array,$where);
			    $tot_taxable_amt = 0;
				$tot_cgst        = 0;
				$tot_sgst        = 0;
				$gross_total     = 0;
				$rate            = 0;
				$td_stn_pbsb_detail_id =  $this->input->post('id');
				$td_stn_pbsb_details_id = $this->input->post('td_stn_pbsb_details_id');
				$project               =  $_POST['project'];
				$order_no              =  $_POST['order_no'];
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
			    $tot_taxable_amt       = array_sum($_POST['s_bill_amt']);
				$gross_total           = $tot_taxable_amt;
				
				$this->SocialW->bill_detail_update($td_stn_pbsb_detail_id,$td_stn_pbsb_details_id,$project,$order_no,$s_bill_no,$s_bill_dt,$s_taxable_value,$gst_rate,$s_cgst,$s_sgst, $s_bill_amt,$p_bill_no,$p_bill_dt,$p_taxable_value,$p_cgst,$p_sgst,$p_bill_amt,$Unit_count,$gross_total);
				
				echo "<script> alert('Updated Successfully');
				document.location= 'bills' </script>";
		}
			
	}

    public function editbill($id){
            $this->load->view('post_login/main');
            $data['suppliers'] = $this->SocialW->f_select('md_sw_vendor',NULL,NULL,0);
            $data['projects'] = $this->SocialW->f_select('md_sw_project',array('sl_no','cdpo'),NULL,0);
            $data['product']   = $this->SocialW->f_select('md_sw_product',array('item_name','hsn_no'),NULL,0);
			$data['orders'] = $this->SocialW->f_select('td_stn_order',NULL,NULL,0);
			$data['bill_detail'] = $this->SocialW->f_select('td_sw_pbsb_details', $select=NULL,array('id'=>$id ) , 1);
            $data['bill_details'] = $this->SocialW->f_select('td_sw_pbsb_details', $select=NULL,array('id'=>$id ), 0);
			$query = $this->db->get_where('td_stn_pbsb_mr',array('td_stn_pbsb_detail_id ='=>$id ))->result();
			
			if (count($query) > 0)
			{
				$data['mr_entry_status'] = 1;
			}else{
				$data['mr_entry_status'] = 0;
			}
			
            $this->load->view('bill/edit',  $data);
            $this->load->view('post_login/footer');
    }
    public function editswbill(){
	
	         $id= $this->input->post('id');
             $data = array(
                'trans_dt'               =>  $_POST['trans_dt'],
				'project_cd'               =>  $_POST['project'],
                'vendor_id'                =>  $_POST['supplier_id'],
				'c_order_no'              =>  $_POST['order_no'],
                'hsn_no'                =>  $_POST['hsn_no'],
				's_bill_no'             =>  $_POST['s_bill_no'],
				's_bill_dt'             =>  $_POST['s_bill_dt'],
				's_taxable_value'       =>  $_POST['s_taxable_value'],
				'gst_rate'              =>  $_POST['gst_rate'],
				's_cgst'                =>  $_POST['s_cgst'],
				's_sgst'                =>  $_POST['s_sgst'],
				's_bill_amt'            =>  $_POST['s_bill_amt'],
				'p_bill_no'             =>  $_POST['p_bill_no'],
				'p_bill_dt'             =>  $_POST['p_bill_dt'],
				'p_taxable_value'       =>  $_POST['p_taxable_value'],
				'p_cgst'                =>  $_POST['p_cgst'],
				'p_sgst'                =>  $_POST['p_sgst'],
				'p_bill_amt'            =>  $_POST['p_bill_amt']
              );
		
		     $this->db->where('id', $id);
             $this->db->update('td_sw_pbsb_details', $data);
		
			redirect(base_url().'index.php/sw/editbill/'.$id, 'refresh');
    }
		
    public function deletebill($id){
        
        $this->SocialW->f_delete('td_sw_pbsb_details',array('id'=>$id,'bill_status'=>'0'));
        $this->bills();
        
    }
    //   ***   Payment section               ***  ///
    public function payment()
	{
		$this->load->view('post_login/main');
		$tableData['data'] = $this->SocialW->f_get_mrlist();
		$this->load->view('payment/table', $tableData);
		$this->load->view('post_login/footer');
	}
    public function js_get_sbno_pervendor() // For JS
    {
        $vendor_id = $this->input->get('vendor_id');
        $result = $this->SocialW->f_select('td_sw_pbsb_details',array('s_bill_no'),array('vendor_id ='=>$vendor_id,'bill_status ='=>'0'),0);
        echo json_encode($result);

    }
    public function js_get_sbpb_detail(){

        $s_bill_no = $this->input->get('s_bill_no');
        $result = $this->SocialW->f_select('td_sw_pbsb_details',NULL,array('s_bill_no ='=>$s_bill_no),1);
        echo json_encode($result);

    }
    
    public function get_sort_calculation_detail($id){
	
		$this->load->view('post_login/main');
		$select = array('a.*','b.name');
		$where = array('a.project_cd = b.project_cd' => NULL,'td_sw_pbsb_detail_id' => $id);
		$data['sale_purchase'] = $this->SocialW->f_select('td_sw_pbsb_details a,md_stn_project b',$select,$where,0);
		$selects = array('a.*','b.name');
		$wheres = array('a.supplier_id = b.sl_no' => NULL,'a.id' => $id);
		$data['shortage'] = $this->SocialW->f_select('td_sw_pbsb_detail a,md_stn_supplier b',$selects,$wheres,1);
		$data['mr_detail'] = $this->SocialW->f_select('td_sw_pbsb_mr',NULL,array('payment_key' => $id),0);
		$this->load->view('payment/viewdetail',$data);
		$this->load->view('post_login/footer');
	}
	
	public function get_sort_calculation($id){
	
		$this->load->view('post_login/main');
		$where = array('a.s_bill_no = b.s_bill_no' => NULL,'a.payment_key' => $id);
		$data['sale_purchase'] = $this->SocialW->f_select('td_sw_pbsb_payment_details a,td_sw_pbsb_details b',NULL,$where,0);
		$data['shortage'] = $this->SocialW->f_select('td_sw_pbsb_payment',NULL,array('id' => $id),1);
		$data['mr_detail'] = $this->SocialW->f_select('td_sw_pbsb_mr',NULL,array('payment_key' => $id),0);
		$this->load->view('payment/calculation',$data);
		$this->load->view('post_login/footer');
	}
	
	public function add_payment()
	{
		$this->load->view('post_login/main');
		$select = array('id','trans_dt');
        $data['vendors'] = $this->SocialW->f_select('md_sw_vendor',NULL,NULL,0);
        $data['banks'] = $this->SocialW->f_select('md_bank',NULL,array('1 order by bank_name asc'=>NULL),0);
		$this->load->view('payment/add',  $data);
		$this->load->view('post_login/footer');
	}
	public function js_get_salebill_detail(){
		
		$td_stn_pbsb_detail_id = $this->input->get('td_sw_pbsb_detail_id');
		$where = array('td_sw_pbsb_detail_id' => $td_stn_pbsb_detail_id);
		$data = $this->SocialW->f_select('td_sw_pbsb_details',NULL,$where,0);
		echo json_encode($data);
	}
	public function editpayment($id)
	{
		$this->load->view('post_login/main');
		$select = array('id','trans_dt');
		$data['salebill'] = $this->SocialW->f_select('td_sw_pbsb_detail',$select,NULL,0);
		$data['bill_details'] = $this->SocialW->f_select('td_sw_pbsb_mr', $select=NULL,array('td_sw_pbsb_detail_id'=>$id ), 0);
		$this->load->view('payment/add', $data);
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
                $sort                  =  $_POST['sb_less_amt'];    
                }
                $pb_less_amt           =  $_POST['pb_less_amt'];
                $s_bill_no             =  $_POST['s_bill_no'];
                $tot_gst     = ($s_cgst)*2;
                $less_gst    = 0.00;
                $rate             = substr((($sort*100)/$gross_total),0,7);
                $less_gst += round($tot_gst-(($tot_gst*$rate)/100));
                $tot_less_calculate_gst= $gross_total-$sort-$less_gst;
                $confed_margin = round($tot_less_calculate_gst*.01);
                $add_gst  =round($less_gst-($less_gst*.01));
        
                $data =  array('trans_dt' => $_POST['trans_dt'],
                               'vendor_id' => $_POST['vendor_id'],
                                'sb_less_amt' => $sort,
                                'pb_less_amt' => $pb_less_amt,
                                'less_gst' => $less_gst,
                                'confed_margin' => $confed_margin,
                                'add_gst' => $add_gst,
                                'created_by' =>$updated_by,
                                'created_dt'=>$updated_dt);
                $this->db->insert('td_sw_pbsb_payment',$data);

                $paymentkey = $this->db->insert_id();
                
                for($j=0; $j<count($_POST['s_bill_no']); $j++)
                {
                $value = array( 'payment_key'  => $paymentkey,
                                's_bill_no'    => $s_bill_no[$j],
                                'created_by'   => $updated_by,
                                'created_dt'   => $updated_dt
                                );
                $this->db->insert('td_sw_pbsb_payment_details', $value);
                  //  Updating Bill Status
                $udata = array('bill_status'=>'1');
                $this->db->where('s_bill_no', $s_bill_no[$j]);
                $this->db->update('td_sw_pbsb_details',$udata);  
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
			  
				$this->SocialW->mr_detail_entry($paymentkey,$trans_dt,$mr_no,$mr_dt,$bank,$acc_no,$trans_mode,$pay_dt,$mr_amt,$amt,$Unit_count,$created_by,$created_dt);
                
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
		
	public function deletepayment($id){
		
		$this->SocialW->f_delete('td_sw_pbsb_mr',array('payment_key'=>$id));
        $this->SocialW->f_delete('td_sw_pbsb_payment',array('id'=>$id));
        $this->SocialW->f_delete('td_sw_pbsb_payment_details',array('payment_key'=>$id));
		$this->payment();
	}

    public function notesheet($payment_key)
    {
        $where = array('a.vendor_id = b.sl_no' => NULL,'a.id' => $payment_key);
        $data['vendor'] = $this->SocialW->f_select('td_sw_pbsb_payment a,md_sw_vendor b',array('a.*','b.vendor_name'),$where,1);
        $where = array('a.s_bill_no = d.s_bill_no' => NULL,'d.project_cd = b.sl_no' => NULL,'d.hsn_no = c.hsn_no' => NULL,'a.payment_key' => $payment_key);
        $data['purchase_sale_details'] = $this->SocialW->f_select('td_sw_pbsb_payment_details a,td_sw_pbsb_details d,md_sw_project b,md_sw_product c',NULL,$where,0);
        
        $selects =array('a.*','b.bank_name');
        $wheres = array('a.bank = b.sl_no' => NULL,
                       'a.payment_key' => $payment_key);
        $data['mr_details']     =  $this->SocialW->f_select('td_sw_pbsb_mr a,md_bank b',$selects,$wheres,0);
        
        $this->load->view('post_login/main');
        $this->load->view('printbill/notesheet',$data);
        $this->load->view('post_login/footer');
    }
    public function get_voucher($id){

        $this->load->view('post_login/main');
        $selects = array('a.*','b.vendor_name');
        $wheres = array('a.vendor_id = b.sl_no' => NULL,'a.id' => $id);
        $data['shortage'] = $this->SocialW->f_select('td_sw_pbsb_payment a,md_sw_vendor b',$selects,$wheres,1);
        $where = array('a.s_bill_no = b.s_bill_no' => NULL,'a.payment_key' => $id);
        $data['sale_purchase'] = $this->SocialW->f_select('td_sw_pbsb_payment_details a,td_sw_pbsb_details b',NULL,$where,0);
		$select =array('a.*','b.bank_name');
        $data['mr_detail'] = $this->SocialW->f_select('td_sw_pbsb_mr a,md_bank b',$select,array('a.bank = b.sl_no' => NULL,'payment_key' => $id),0);
        $this->load->view('payment/voucher',$data);
        $this->load->view('post_login/footer');
    }
    /// ******** Code End of Payment system   // 

    public function swprojectpaystatus()
    {
        if($_SERVER['REQUEST_METHOD']=="POST")  {
        $fr_dt  = $this->input->post('from_date');
        $to_dt  = $this->input->post('to_date');
        $dist_cd  = $this->input->post('dist_cd');
        $data['paymenttot'] = $this->SocialW->f_get_totpaymentprojectwise($fr_dt,$to_dt,$dist_cd);
        $data['paymentmaid'] = $this->SocialW->f_get_paymentmaidprojectwise($fr_dt,$to_dt);
        $data['startDt']  = $fr_dt;
        $data['endDt']  = $to_dt;
        $this->load->view('post_login/main');
        $this->load->view('report/icdsproj_payment',$data);
        $this->load->view('post_login/footer');
        }else{
            $distData['dist'] = $this->SocialW->f_get_distData();
            $this->load->view('post_login/main');
            $this->load->view('report/icdsproj_payment',$distData);
            $this->load->view('post_login/footer');
        }

    }
    public function swvendorpaystatus()
    {
        if($_SERVER['REQUEST_METHOD']=="POST")  {
        $fr_dt  = $this->input->post('from_date');
        $to_dt  = $this->input->post('to_date');
        $dist_cd  = $this->input->post('dist_cd');
        $data['paymenttot'] = $this->SocialW->f_get_totpaymentvendorwise($fr_dt,$to_dt,$dist_cd);
        $data['paymentmaid'] = $this->SocialW->f_get_paymentmaidprojectwise($fr_dt,$to_dt);
        $data['startDt']  = $fr_dt;
        $data['endDt']  = $to_dt;
        $this->load->view('post_login/main');
        $this->load->view('report/icdsvendor_payment',$data);
        $this->load->view('post_login/footer');
        }else{
            $distData['dist'] = $this->SocialW->f_get_distData();
            $this->load->view('post_login/main');
            $this->load->view('report/icdsvendor_payment',$distData);
            $this->load->view('post_login/footer');
        }

    }

    public function gstrpt(){

        if($_SERVER['REQUEST_METHOD']=="POST")
        {
            $supplier_id =  $this->input->post('supplier_id');
            $startDt     =  $_POST['fr_dt'];
            $endDt       =  $_POST['to_dt'];
            $gstrt       =  $_POST['gst'];
            $Data['report'] = $this->SocialW->gst_report($supplier_id,$startDt, $endDt,$gstrt);
            $Data['startDt'] = $startDt;
            $Data['endDt'] = $endDt;
            $Data['supplier_id'] = $supplier_id;
            $Data['suppliers'] = $this->SocialW->f_select('md_sw_vendor',NULL,NULL,0);
            $this->load->view('post_login/main');
            $this->load->view('report/gstreport', $Data);
            $this->load->view('post_login/footer');

        }else{

            $data['suppliers'] = $this->SocialW->f_select('md_sw_vendor',NULL,NULL,0);
            $this->load->view('post_login/main');
            $this->load->view('report/gstreport',$data);
            $this->load->view('post_login/footer');

        }
    }


}

?>