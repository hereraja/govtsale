<?php

    class Stationary extends MX_Controller
    {
        public function __construct()
        {
			parent::__construct();
            $this->load->model('StationaryM');
            
            if(!isset($this->session->userdata('loggedin')->user_id)){
            
                redirect('User_Login/login');
    
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

                $sl_no              =       $_POST['sl_no'];
                $unit               =       $_POST['unit'];
                
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
                
                $this->StationaryM->addNewSupplier($sl_no, $name, $contact_person, $phn_no, $email, $address, $gst_no, $pan_no, $trd_license, $bank, $accnt_no, $ifsc, $st, $it, $created_by, $created_dt);

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
                
                $this->StationaryM->updateNewSupplier($sl_no, $name, $contact_person, $phn_no, $email, $address, $gst_no, $pan_no, $trd_license, $bank, $accnt_no, $ifsc, $st, $it, $modified_by, $modified_dt);

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

                $project_code = $this->StationaryM->f_get_projectCd_max();
                $project_cd = $project_code->project_cd + 1;

                //echo $project_cd;
                //die;

                $name               =       $_POST['name'];
                $phn_no             =       $_POST['phn_no'];
                $address            =       $_POST['address'];
                $supplier_cd        =       $_POST['supplier_cd'];
                $supplier_no        =       count($supplier_cd);

                //echo count($supplier_cd); die;
                
                $this->StationaryM->addNewProject($project_cd, $name, $phn_no, $address, $supplier_cd, $supplier_no, $created_by, $created_dt);
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


    //************************For Transaction/ Order Section **************************//

        public function supplyOrder()
        {

            $this->load->view('post_login/main');

            $tableData['data'] = $this->StationaryM->f_get_order_table();
            $this->load->view('transaction/order/orderTable', $tableData);

            $this->load->view('post_login/footer');

        }

        public function addOrder()
        {

            $this->load->view('post_login/main');

            $entryData['supplier'] = $this->StationaryM->f_get_supplierData();
            $entryData['projects'] = $this->StationaryM->f_get_projectData();

            $this->load->view('transaction/order/addOrder', $entryData);

            $this->load->view('post_login/footer');

        }

        public function js_get_projectData()
        {

            $result = $this->StationaryM->f_get_projectData();
            echo json_encode($result);

        }

        public function js_get_C_OrderNo_validation() // For JS
        {

            $c_order_no = $this->input->get('c_order_no');
            $result = $this->StationaryM->js_get_C_OrderNo_validation($c_order_no);
            echo json_encode($result);

        }

        public function js_get_suppliersForProject() // For JS
        {

            $project_cd      =      $this->input->get('project_cd');
            $result = $this->StationaryM->js_get_suppliersForProject($project_cd);
            echo json_encode($result);

        }

        public function js_get_supplier_status() //For Js
        {
            $supplier_cd    =       $this->input->get('supplier_cd');
            $order_dt       =       $this->input->get('order_dt');

            $result         =       $this->StationaryM->js_get_supplier_status($supplier_cd,$order_dt);
            echo $result->status;
        }

        public function addNewOrder()
        {

            if($this->session->userdata('loggedin'))
            {
                $created_by   =  $this->session->userdata('loggedin')->user_name; 
            }

            $created_dt       =     date('y-m-d H:i:s');
            
            if($_SERVER['REQUEST_METHOD']=="POST")
            {

                $c_order_dt             =       $_POST['c_order_dt'];
                $c_order_no             =       $_POST['c_order_no'];
                $supplier_cd            =       $_POST['supplier_cd'];

                $g_order_no             =       $_POST['g_order_no'];
                $g_order_dt             =       $_POST['g_order_dt'];
                $project_cd             =       $_POST['project_cd'];

                $remarks                =       $_POST['remarks'];

                $row                    =       count($g_order_no);

               
                $this->StationaryM->addNewOrder($c_order_dt, $c_order_no, $supplier_cd, $g_order_dt, $g_order_no, $project_cd, $remarks, $row, $created_by, $created_dt);
                //$this->StationaryM->addNewOrderDtls($order_no, $item_name, $unit, $qty, $rate, $item_no, $created_by, $created_dt);

                echo "<script> alert('Successfully Submitted');
                document.location= 'supplyOrder' </script>";

            }
            else
            {

                echo "<script> alert('Sorry! Select Again.');
                document.location= 'addOrder' </script>";

            }

        }

        public function deleteOrder()
        {

            $c_order_no = $this->input->get('order_no');
            $c_order_dt = $this->input->get('order_dt');
            $project_cd = $this->input->get('project');

            $this->StationaryM->deleteOrder($c_order_no, $c_order_dt, $project_cd);
            $this->supplyOrder();

        }

        public function editOrder()
        {
            //echo $this->input->get('order_no'); 
            $c_order_no = $this->input->get('order_no');
            $c_order_dt = $this->input->get('order_dt');

            $this->load->view('post_login/main');

            $editData['data1'] = $this->StationaryM->f_get_orderEditData($c_order_no, $c_order_dt);
            $editData['data2'] = $this->StationaryM->f_get_orderEditDataDtls($c_order_no, $c_order_dt);
            $editData['supplier'] = $this->StationaryM->f_get_supplierData();
            $editData['projects'] = $this->StationaryM->f_get_projectData();

            $this->load->view('transaction/order/editOrder', $editData);

            $this->load->view('post_login/footer');

        }


        public function updateOrder()
        {

            if($this->session->userdata('loggedin'))
            {
                $modified_by   =  $this->session->userdata('loggedin')->user_name; 
            }

            $modified_dt       =     date('y-m-d H:i:s');
            
            if($_SERVER['REQUEST_METHOD']=="POST")
            {

                $c_order_dt             =           $_POST['c_order_dt'];
                $c_order_no             =           $_POST['c_order_no'];
                $g_order_dt             =           $_POST['g_order_dt'];
                $g_order_no             =           $_POST['g_order_no'];
                $project_cd             =           $_POST['project_cd'];
                $supplier_cd            =           $_POST['supplier_cd'];


                $remarks                =       $_POST['remarks'];

                $row           =       count($g_order_no);

                $this->StationaryM->updateOrder($c_order_dt, $c_order_no, $g_order_dt, $g_order_no, $project_cd, $supplier_cd, $remarks, $row, $modified_by, $modified_dt);
                //$this->StationaryM->updateOrderDtls($order_no, $item_name, $unit, $qty, $rate, $item_no, $modified_by, $modified_dt);

                echo "<script> alert('Successfully Updated');
                document.location= 'supplyOrder' </script>";

            }
            else
            {

                echo "<script> alert('Sorry! Select Again.');
                document.location= 'editOrder' </script>";

            }

        }

    // **************************** For Bill/ Purchase Bill ********************** //

        public function purchaseBill()
        {

            $this->load->view('post_login/main');

            $tableData['data'] = $this->StationaryM->f_get_pBill_table();
            $this->load->view('bill/pbillTable', $tableData);

            $this->load->view('post_login/footer');

        }

        public function addPurchaseBill()
        {

            $this->load->view('post_login/main');

            $this->load->view('bill/entryPbill');

            $this->load->view('post_login/footer');

        }

        
        public function js_get_order_validationFor_saleBill() // For Js
        {

            $order_no = $this->input->get('order_no');
            $result = $this->StationaryM->js_get_order_validationFor_saleBill($order_no);
            echo json_encode($result);

        }
        
        public function js_get_supplierAsPerOrder() // For JS
        {

            $order_no      =      $this->input->get('order_no');
            $result = $this->StationaryM->js_get_supplierAsPerOrder(trim($order_no));
            echo json_encode($result);

        }


        public function js_get_check_duplicate_billEntry_forDate() // For JS 
        {

            $bill_no      =      $this->input->get('bill_no');
            $bill_dt      =      $this->input->get('bill_dt');

            $result = $this->StationaryM->js_get_check_duplicate_billEntry_forDate($bill_no, $bill_dt);
            echo json_encode($result);

        }


        public function js_get_check_duplicate_saleBillEntry_forDate() // For JS
        {

            $bill_no      =      $this->input->get('bill_no');
            $bill_dt      =      $this->input->get('bill_dt');

            $result = $this->StationaryM->js_get_check_duplicate_saleBillEntry_forDate($bill_no, $bill_dt);
            echo json_encode($result);

        }


        public function js_get_check_PBillNo_forDate() // For JS
        {

            $pb_no          =      $this->input->get('pb_no');
            $order_no       =      $this->input->get('order_no');

            $result = $this->StationaryM->js_get_check_PBillNo_forDate($pb_no, $order_no);
            echo json_encode($result);

        }

        public function js_get_order_validationFor_purchaseBill() // For JS 
        {

            $order_no = $this->input->get('order_no');
            $result = $this->StationaryM->js_get_order_validationFor_purchaseBill($order_no);
            echo json_encode($result);

        }


        public function addNewPBill()
        {

            if($this->session->userdata('loggedin'))
            {
                $created_by   =  $this->session->userdata('loggedin')->user_name; 
            }

            $created_dt       =     date('y-m-d H:i:s');
            
            if($_SERVER['REQUEST_METHOD']=="POST")
            {

                $bill_dt             =          $_POST['bill_dt'];
                $bill_no             =          $_POST['bill_no'];

                $slNo = $this->StationaryM->f_get_slNo_from_purchaseBillDtls($bill_dt, $bill_no);
                $sl_no = $slNo->sl_no+1;

                $order_no            =          $_POST['order_no'];
                $nt                  =          $_POST['nt'];
                $non_tax             =          $_POST['non_tax'];

                $gst_per             =          $_POST['gst_per'];
                $sub_amnt            =          $_POST['sub_amnt'];
                $cgst_val            =          $_POST['cgst_val'];
                $sgst_val            =          $_POST['sgst_val'];

                $row                 =          count($gst_per);

                $total               =          $_POST['total'];
                
                $this->StationaryM->addNewPBill($bill_dt, $bill_no, $order_no, $nt, $non_tax, $total, $created_by, $created_dt );
                $this->StationaryM->addNewPBillDtls($sl_no, $bill_dt, $bill_no, $gst_per, $sub_amnt, $cgst_val, $sgst_val, $created_by, $created_dt, $row );
                
                echo "<script> alert('Successfully Submitted');
                document.location= 'purchaseBill' </script>";

            }
            else
            {
                echo "<script> alert('Sorry! Select Again.');
                document.location= 'addPurchaseBill' </script>";
            }

        }


        public function editPBill()
        {

            $bill_no = $this->input->get('bill_no');
            $bill_dt = $this->input->get('bill_dt');
            
            $this->load->view('post_login/main');

            $editData['data1'] = $this->StationaryM->f_get_edit_pBillData($bill_no, $bill_dt);
            $editData['data2'] = $this->StationaryM->f_get_edit_pBillDtlsData($bill_no, $bill_dt);
            $orderNo = $this->StationaryM->f_get_pBillEdit_orderNo($bill_no, $bill_dt);
            //echo $orderNo->order_no; die;
            $order_no = $orderNo->order_no;
            $editData['supplier'] = $this->StationaryM->js_get_supplierAsPerOrder($order_no);
            //echo ($editData['supplier']->name); die;
            $this->load->view('bill/editPBill', $editData);

            $this->load->view('post_login/footer');

        }

        public function updatePBill()
        {

            if($this->session->userdata('loggedin'))
            {
                $modified_by    =  $this->session->userdata('loggedin')->user_name; 
                $created_by     =  $this->session->userdata('loggedin')->user_name; 
            }

            $modified_dt        =     date('y-m-d H:i:s');
            $created_dt         =     date('y-m-d H:i:s');
            
            if($_SERVER['REQUEST_METHOD']=="POST")
            {

                $bill_dt             =       $_POST['bill_dt'];
                $bill_no             =       $_POST['bill_no'];
                $order_no            =       $_POST['order_no'];
                $nt                  =       $_POST['nt'];
                $non_tax             =       $_POST['non_tax'];
                
                $gst_per             =       $_POST['gst_per'];
                $sub_amnt            =       $_POST['sub_amnt'];
                $cgst_val            =       $_POST['cgst_val'];
                $sgst_val            =       $_POST['sgst_val'];

                $total               =       $_POST['total'];
                $row                 =       count($gst_per);
                
                
                // At first purchase details table will be deleted then re inserted--
                $this->StationaryM->deletePBillDtls($bill_no, $bill_dt);

                $slNo = $this->StationaryM->f_get_slNo_from_purchaseBillDtls($bill_dt, $bill_no);
                $sl_no = $slNo->sl_no+1;

                $this->StationaryM->addNewPBillDtls($sl_no, $bill_dt, $bill_no, $gst_per, $sub_amnt, $cgst_val, $sgst_val, $created_by, $created_dt, $row );
                
                $this->StationaryM->updatePBill($bill_dt, $bill_no, $order_no, $nt, $non_tax, $total, $modified_by, $modified_dt );
                
                echo "<script> alert('Successfully Updated');
                document.location= 'purchaseBill' </script>";

            }
            else
            {
                echo "<script> alert('Sorry! Select Again.');
                document.location= 'editPBill' </script>";
            }

        }


        public function deletePBill()
        {

            $bill_no = $this->input->get('bill_no');
            $bill_dt = $this->input->get('bill_dt');
            
            $this->StationaryM->deletePBill($bill_no, $bill_dt);
            $this->StationaryM->deletePBillDtls($bill_no, $bill_dt);
            
            $this->purchaseBill();

        }



    // FOR Bill / Sale Bill -----

        public function saleBill()
        {

            $this->load->view('post_login/main');

            $tableData['data'] = $this->StationaryM->f_get_sBill_table();
            $this->load->view('bill/sbillTable', $tableData);

            $this->load->view('post_login/footer');

        }

        public function addSaleBill()
        {

            $this->load->view('post_login/main');

            $this->load->view('bill/entrysbill');            

            $this->load->view('post_login/footer');

        }

        public function addNewSBill()
        {

            if($this->session->userdata('loggedin'))
            {
                $created_by   =  $this->session->userdata('loggedin')->user_name; 
            }

            $created_dt       =     date('y-m-d H:i:s');
            
            if($_SERVER['REQUEST_METHOD']=="POST")
            {

                $bill_dt            =       $_POST['bill_dt'];
                $bill_no            =       $_POST['bill_no'];

                $slNo = $this->StationaryM->f_get_slNo_from_sBillDtls($bill_dt, $bill_no);
                $sl_no = $slNo->sl_no+1;

                $order_no           =       $_POST['order_no'];
                $pb_no              =       $_POST['pb_no'];
                $nt                 =       $_POST['nt'];
                $non_tax            =       $_POST['non_tax'];

                $gst_per            =       $_POST['gst_per'];
                $sub_amnt           =       $_POST['sub_amnt'];
                $cgst_val           =       $_POST['cgst_val'];
                $sgst_val           =       $_POST['sgst_val'];

                $total              =       $_POST['total'];

                $row              =       count($gst_per);
                
                $this->StationaryM->addNewSBill($bill_dt, $bill_no, $order_no, $pb_no, $nt, $non_tax, $total, $created_by, $created_dt );
                
                $this->StationaryM->addNewSBillDtls($sl_no, $bill_dt, $bill_no, $gst_per, $sub_amnt, $cgst_val, $sgst_val, $created_by, $created_dt, $row );

                echo "<script> alert('Successfully Submitted');
                document.location= 'saleBill' </script>";

            }
            else
            {
                echo "<script> alert('Sorry! Select Again.');
                document.location= 'addSaleBill' </script>";
            }

        }


        public function editsBill()
        {

            $bill_no = $this->input->get('bill_no');
            $bill_dt = $this->input->get('bill_dt');
            
            $this->load->view('post_login/main');

            $editData['data1'] = $this->StationaryM->f_get_edit_sBillData($bill_no, $bill_dt);
            $editData['data2'] = $this->StationaryM->f_get_edit_sBillDtlsData($bill_no, $bill_dt);
            $orderNo = $this->StationaryM->f_get_edit_sBillOrderNo($bill_no, $bill_dt);
            $order_no = $orderNo->order_no;
            $editData['supplier'] = $this->StationaryM->js_get_supplierAsPerOrder($order_no);

            $this->load->view('bill/editSbill', $editData);

            $this->load->view('post_login/footer');

        }

        public function updateSBill()
        {

            if($this->session->userdata('loggedin'))
            {
                $modified_by   =  $this->session->userdata('loggedin')->user_name; 
                $created_by   =  $this->session->userdata('loggedin')->user_name; 
            }

            $modified_dt       =     date('y-m-d H:i:s');
            $created_dt       =     date('y-m-d H:i:s');
            
            if($_SERVER['REQUEST_METHOD']=="POST")
            {

                $bill_dt             =       $_POST['bill_dt'];
                $bill_no             =       $_POST['bill_no'];
                // $pb_no               =       $_POST['$pb_no'];
                $slNo  = $this->StationaryM->f_get_slNo_from_sBillDtls($bill_dt, $bill_no);
                
                $sl_no = $slNo->slno+1;

                $order_no            =       $_POST['order_no'];
                $nt                  =       $_POST['nt'];
                $non_tax             =       $_POST['non_tax'];
                
                $gst_per             =       $_POST['gst_per'];
                $sub_amnt            =       $_POST['sub_amnt'];
                $cgst_val            =       $_POST['cgst_val'];
                $sgst_val            =       $_POST['sgst_val'];

                $total               =       $_POST['total'];
                $row                 =       count($gst_per);
                
                $this->StationaryM->updateSBill($bill_dt, $bill_no, $order_no, $nt, $non_tax, $total, $modified_by, $modified_dt );
                
                // Firstly deleting saleBillDtls then inserting as new
                $this->StationaryM->deleteSBillDtls($bill_no, $bill_dt);
                $this->StationaryM->updateSBillDtls($sl_no, $bill_dt, $bill_no, $gst_per, $sub_amnt, $cgst_val, $sgst_val, $created_by, $created_dt, $row );
                
                echo "<script> alert('Successfully Updated');
                document.location= 'saleBill' </script>";

            }
            else
            {
                echo "<script> alert('Sorry! Select Again.');
                document.location= 'editsBill' </script>";
            }

        }


        public function deletesBill()
        {

            $bill_no = $this->input->get('bill_no');
            $bill_dt = $this->input->get('bill_dt');
            
            $this->StationaryM->deletesBill($bill_no, $bill_dt);
            $this->StationaryM->deleteSBillDtls($bill_no, $bill_dt);

            $this->saleBill();

        }


    // ******************** For Report ******************** //
                            //Order Report//

        public function orderReport()
        {

            $this->load->view('post_login/main');

            $this->load->view('report/orderDateRange');

            $this->load->view('post_login/footer');

        }

        public function getOrderReport()
        {

            if($_SERVER['REQUEST_METHOD']=="POST")
            {
                $datefilter     =       $_POST['datefilter'];

                $splittedstring = explode("  ",$datefilter);
                
                $startDt = $splittedstring[0];
                $endDt = $splittedstring[1];

                //echo $startDt.' $ '.$endDt; die;
               
                $this->load->view('post_login/main');

                $showData['data'] = $this->StationaryM->f_get_orderReportData($startDt, $endDt);
                //$showData['amount'] = $this->StationaryM->f_get_orderReportAmount($startDt, $endDt);
                $showData['startDt'] = $startDt;
                $showData['endDt'] = $endDt;

                $this->load->view('report/orderReport', $showData);
                $this->load->view('post_login/footer');

            }

        }


        // ********************** For Bill Report ********************* //

        public function billReport()
        {

            $this->load->view('post_login/main');

            $this->load->view('report/billDateRange');

            $this->load->view('post_login/footer');

        }

        public function getBillReport()
        {

            if($_SERVER['REQUEST_METHOD']=="POST")
            {
                $datefilter     =       $_POST['datefilter'];

                $splittedstring = explode("  ",$datefilter);
                
                $startDt = $splittedstring[0];
                $endDt = $splittedstring[1];

                //echo $startDt.' $ '.$endDt; die;
               
                $this->load->view('post_login/main');

                $showData['data'] = $this->StationaryM->f_get_billReportData($startDt, $endDt);
                $showData['order_num'] = $this->StationaryM->f_get_billReport_orderNo_count($startDt, $endDt);
                $showData['pb_amount'] = $this->StationaryM->f_get_billReport_totPBill_amount($startDt, $endDt);
                $showData['tot_sub_amt'] = $this->StationaryM->f_get_bill_sub_total($startDt, $endDt);
                $showData['totSb_amount'] = $this->StationaryM->f_get_billReport_totSBill_amount($startDt, $endDt);
                
                $showData['startDt'] = $startDt;
                $showData['endDt'] = $endDt;

                $this->load->view('report/billReport', $showData);
                $this->load->view('post_login/footer');

            }

        }

    //**************** For transaction/collection Section ****************//

        public function collection()
        {

            $this->load->view('post_login/main');

            $tableData['data'] = $this->StationaryM->f_get_billCollectionData();
            $this->load->view('transaction/collection/table', $tableData);

            $this->load->view('post_login/footer');

        }


        public function addCollectionBill()
        {

            $this->load->view('post_login/main');

            $entryData['projects'] = $this->StationaryM->f_get_projectData();   
            $entryData['supplier'] = $this->StationaryM->f_get_supplierData();
            $this->load->view('transaction/collection/add', $entryData);

            $this->load->view('post_login/footer');

        }

        public function addNewCollection()
        {

            if($this->session->userdata('loggedin'))
            {
                $created_by   =  $this->session->userdata('loggedin')->user_name; 
            }

            $created_dt       =     date('y-m-d H:i:s');
            
            if($_SERVER['REQUEST_METHOD']=="POST")
            {
                $slNo = $this->StationaryM->f_get_collection_lnk_no();
                $sl_no = $slNo->sl_no + 1;
                $trans_dt          =       $_POST['trans_dt'];
                $project           =       $_POST['project'];
                // $order_no       =       $_POST['order_no'];
                // $bill_no        =       $_POST['bill_no'];
                $supplier          =       $_POST['supplier'];
                $mode              =       $_POST['mode'];
                $mr_no             =       $_POST['mr_no'];
                $amount            =       $_POST['amount'];
                $chq_no            =       $_POST['chq_no'];
                $remarks           =       $_POST['remarks'];
                $Unit_count        =       count($mr_no);  
                $this->StationaryM->addNewCollection($sl_no,$trans_dt, $project,$supplier, $mode,$chq_no  , $mr_no, $amount, $remarks, $created_by, $created_dt, $Unit_count );
                // $this->db->last_query();
                // die();
                // print_r($slNo );
                // die();
                echo "<script> alert('Successfully Saved');
                document.location= 'collection' </script>";

            }
            else
            {
                echo "<script> alert('Sorry! Select Again.');
                document.location= 'addCollectionBill' </script>";
            }

        }


        public function js_get_collection_orderForProject()// For JS
        {

            $project_cd      =      $this->input->get('project_cd');
            $result = $this->StationaryM->js_get_collection_orderForProject($project_cd);
            echo json_encode($result);

        }

        public function js_get_collection_billForOrder() // For JS
        {

            $order_no      =      $this->input->get('order_no');
            $result = $this->StationaryM->js_get_collection_billForOrder($order_no);
            echo json_encode($result);

        }

        public function js_get_collection_amountForBill() // For JS
        {

            $bill_no = $this->input->get('bill_no');
            $result  = $this->StationaryM->js_get_collection_amountForBill($bill_no);
            echo json_encode($result);

        }


        public function editBillCollection($lnk_sl_no)
        {

            $this->load->view('post_login/main');

            $editData['data']       = $this->StationaryM->f_get_billCollection_editData($lnk_sl_no);  
             $editData['project']    = $this->StationaryM->f_get_billCollectionEdit_project($lnk_sl_no);  
             $editData['supplier']    = $this->StationaryM->f_get_billCollectionEdit_supplier($lnk_sl_no);  
            // $editData['saleAmount'] = $this->StationaryM->f_get_billCollectionEdit_saleAmount($sl_no);  

            $this->load->view('transaction/collection/edit', $editData);

            $this->load->view('post_login/footer');

        }


        public function updateCollection()
        {

            if($this->session->userdata('loggedin'))
            {
                $modified_by   =  $this->session->userdata('loggedin')->user_name; 
            }

            $modified_dt       =     date('y-m-d H:i:s');
            
            if($_SERVER['REQUEST_METHOD']=="POST")
            {
               

                $sl_no                =       $_POST['sl_no'];
                $trans_dt             =       $_POST['trans_dt'];
                // $order_no          =       $_POST['order_no'];
                // $bill_no           =       $_POST['bill_no'];
                $supplier             =       $_POST['supplier'];
                $project              =       $_POST['project'];
                $mode                 =       $_POST['mode'];
                $mr_no                =       $_POST['mr_no'];
                $amount               =       $_POST['amount'];
                $remarks              =       $_POST['remarks'];
                
                // print_r($lnk_sl_no );
                // die();
                $this->StationaryM->updateCollection( $lnk_sl_no  ,$sl_no, $trans_dt, $supplier, $project, $mode, $mr_no, $amount, $remarks );
                
                echo "<script> alert('Successfully Updated');
                document.location= 'collection' </script>";

            }
            else
            {
                echo "<script> alert('Sorry! Select Again.');
                document.location= 'collection' </script>";
            }

        }


        public function deleteBillCollection($lnk_sl_no)
        {
            $this->StationaryM->deleteBillCollection($lnk_sl_no);
            $this->collection();

        }



    // ******************** For Transaction / Payment ********************** //

        public function payment()
        {

            $this->load->view('post_login/main');

            $tableData['data'] = $this->StationaryM->f_get_payment_tableData();              
            $this->load->view('transaction/payment/table', $tableData);

            $this->load->view('post_login/footer');

        }


        public function addPaymentBill()
        {

            $this->load->view('post_login/main');
            $bank['bank'] = $this->StationaryM->f_get_bankName();
            $entryData['projects'] = $this->StationaryM->f_get_projectData();   
            // $this->load->view('transaction/payment/add', $entryData);
              $data=array_merge($bank, $entryData);
              $this->load->view('transaction/payment/add',  $data);

            $this->load->view('post_login/footer');

        }



        public function js_get_payment_orderForProject() // For JS
        {

            $project_cd = $this->input->get('project_cd');
            $result = $this->StationaryM->js_get_payment_orderForProject($project_cd);
            echo json_encode($result);

        }

        public function js_get_Payment_supplierForBill() // For JS
        {

            $order_no      =      $this->input->get('order_no');
            $result = $this->StationaryM->js_get_Payment_supplierForBill($order_no);
            echo json_encode($result);

        }

        public function js_get_payment_billForOrder()
        {

            $order_no      =      $this->input->get('order_no');
            $result = $this->StationaryM->js_get_payment_billForOrder($order_no);
            echo json_encode($result);

        }

        public function js_get_payment_amountForBill() // For JS
        {

            $bill_no    =   $this->input->get('bill_no');
            $result = $this->StationaryM->js_get_payment_amountForBill($bill_no);
            echo json_encode($result);

        }
  public function js_get_mrno() // For JS
        {
             $mr_no = $this->input->get('mr_no');
            $result= $this->StationaryM->js_get_mrno($mr_no);
        
            echo json_encode($result);

        }
        public function js_get_s_p_data() // For JS
        {
            
             $s_bill_no = $this->input->get('s_bill_no');
             
              $result= $this->StationaryM->js_get_s_p_data($s_bill_no);
        // echo $this->db->last_query();
        // die();
            echo json_encode($result);

        }



        public function addNewPayment()
        {
            $bank['data'] = $this->StationaryM->f_get_bankName();
            $ref_no = $this->StationaryM->f_get_stn_pay_max();
            $ref_no = $ref_no->ref_no + 1;
            //  print_r($bank );
            //  die();
            if($this->session->userdata('loggedin'))
            {
                $created_by   =  $this->session->userdata('loggedin')->user_name; 
            }

            $created_dt       =     date('y-m-d H:i:s');
            
            if($_SERVER['REQUEST_METHOD']=="POST")

            {   $file_name         = $_POST['file_name'];
                $page_no           = $_POST['page_no'];
                $bank              = $_POST['bank'];
                $tot_s_bill        = $_POST['tot_s_bill'];
                $tot_p_bill        = $_POST['tot_p_bill'];
                $s_bill_less_amt   = $_POST['s_bill_less_amt'];
                $p_bill_less_amt   = $_POST['p_bill_less_amt'];

                $order_no          =       $_POST['order_no'];
                $project           =       $_POST['project'];
                $Unit_count        =       count($order_no); 
                
                $mr_no             =       $_POST['mr_no'];
                $mr_dt             =       $_POST['mr_dt'];
                $chq_type          =       $_POST['chq_type'];
                $chq_dt            =       $_POST['chq_dt'];
                $amt               =       $_POST['amt'];
                $Unit_count1       =       count($mr_no); 

                $s_bill_no         =       $_POST['s_bill_no'];
                $s_bill_dt         =       $_POST['s_bill_dt'];
                $s_bill_amt        =       $_POST['s_bill_amt'];
                $p_bill_no         =       $_POST['p_bill_no'];
                $p_bill_dt         =       $_POST['p_bill_dt'];
                $p_bill_amt        =       $_POST['p_bill_amt'];
                $Unit_count2       =       count($s_bill_no); 
                // $ref_no            =       $ref_no;
                // $remarks           =       $_POST['remarks'];
                $this->StationaryM->addNewbankPayment( $file_name,$page_no,$bank, $ref_no,$tot_s_bill,$tot_p_bill,$s_bill_less_amt,$p_bill_less_amt);
                $this->StationaryM->addNewPayment( $order_no,$project, $ref_no,$Unit_count);
                $this->StationaryM->addNewmrPayment( $mr_no,$mr_dt ,$chq_type,$chq_dt ,$amt, $ref_no,$Unit_count1);
                $this->StationaryM->addNewbillPayment( $s_bill_no,$s_bill_dt ,$s_bill_amt,$p_bill_no ,$p_bill_dt,$p_bill_amt, $ref_no,$Unit_count2);
                
                echo "<script> alert('Successfully Saved');
                document.location= 'payment' </script>";

            }
            else
            {
                echo "<script> alert('Sorry! Select Again.');
                document.location= 'addPaymentBill' </script>";
            }

        }


        public function editBillPayment($ref_no)
        {

            $this->load->view('post_login/main');
            $bank['bank1'] = $this->StationaryM->f_get_bankName();
            $editData['bank'] = $this->StationaryM->f_get_bank_editData($ref_no); 
            $editData['data'] = $this->StationaryM->f_get_payment_editData($ref_no); 
            $editData['data'] = $this->StationaryM->f_get_payment_tableData($ref_no);
            $editData['mr']   = $this->StationaryM->f_get_mr_editData($ref_no);     
            $editData['s_p_bill'] = $this->StationaryM->f_stn_spbill_editData($ref_no);
            $editData['supplier'] = $this->StationaryM->f_get_payment_supplier_editData($ref_no);
              // $editData['billAmount'] = $this->StationaryM->f_get_billAmount_editData($bill_no); 
             // $order_no = $this->StationaryM->f_get_payment_orderNo($sl_no, $bill_no);
             
            // $editData['project'] = $this->StationaryM->f_get_payment_project_editData($ref_no); 
            
            $this->load->view('transaction/payment/edit', $editData);

            $this->load->view('post_login/footer');

        }


        public function updateBillPayment()
        {

            if($this->session->userdata('loggedin'))
            {
                $modified_by   =  $this->session->userdata('loggedin')->user_name; 
            }

            // $modified_dt       =     date('y-m-d H:i:s');
            
            if($_SERVER['REQUEST_METHOD']=="POST")
            {
                $ref_no            = $_POST['ref_no'];
                $file_name         = $_POST['file_name'];
                $page_no           = $_POST['page_no'];
                $bank              = $_POST['bank'];
                $tot_s_bill        = $_POST['tot_s_bill'];
                $tot_p_bill        = $_POST['tot_p_bill'];
                $s_bill_less_amt   = $_POST['s_bill_less_amt'];
                $p_bill_less_amt   = $_POST['p_bill_less_amt'];

                $order_no          = $_POST['order_no'];
                $project           = $_POST['project'];
                $Unit_count        = count($order_no); 
                
                $mr_no             = $_POST['mr_no'];
                $mr_dt             = $_POST['mr_dt'];
                $chq_type          = $_POST['chq_type'];
                $chq_dt            = $_POST['chq_dt'];
                $amt               = $_POST['amt'];
                $Unit_count1       = count($mr_no); 

                $s_bill_no         = $_POST['s_bill_no'];
                $s_bill_dt         = $_POST['s_bill_dt'];
                $s_bill_amt        = $_POST['s_bill_amt'];
                $p_bill_no         = $_POST['p_bill_no'];
                $p_bill_dt         = $_POST['p_bill_dt'];
                $p_bill_amt        = $_POST['p_bill_amt'];
                $Unit_count2       = count($s_bill_no);
                
                $this->StationaryM->updateNewbankPayment( $file_name,$page_no,$bank, $ref_no,$tot_s_bill,$tot_p_bill,$s_bill_less_amt,$p_bill_less_amt);
                // echo $this->db->last_query();
                // die();
                $this->StationaryM->updateNewPayment( $order_no,$project, $ref_no,$Unit_count);
                //              echo $this->db->last_query();
                // die();
                $this->StationaryM->updateNewmrPayment( $mr_no,$mr_dt ,$chq_type,$chq_dt ,$amt, $ref_no,$Unit_count1);
                $this->StationaryM->updateNewbillPayment( $s_bill_no,$s_bill_dt ,$s_bill_amt,$p_bill_no ,$p_bill_dt,$p_bill_amt, $ref_no,$Unit_count2);
                echo "<script> alert('Successfully Updated');
                document.location= 'payment' </script>";

            }
            else
            {
                echo "<script> alert('Sorry! Select Again.');
                document.location= 'payment' </script>";
            }

        }

        public function deleteBillPayment( $ref_no)
        {

            $this->StationaryM->deleteBillPayment($ref_no);
            $this->payment();

        }

    // ****************** For Report/ Collection Report ****************** //
    
        public function collectionReport()
        {

            $this->load->view('post_login/main');

            $this->load->view('report/collectionSelect');

            $this->load->view('post_login/footer');

        }


        public function getCollectionReport()
        {

            if($_SERVER['REQUEST_METHOD']=="POST")
            {
                $datefilter     =       $_POST['datefilter'];

                $splittedstring = explode("  ",$datefilter);
                
                $startDt = $splittedstring[0];
                $endDt = $splittedstring[1];

                $reportData['data'] = $this->StationaryM->f_get_collection_reportData($startDt, $endDt);
                $reportData['total'] = $this->StationaryM->f_get_totCollection_Data($startDt, $endDt);
                $reportData['startDt'] = $startDt;
                $reportData['endDt'] = $endDt;

                $this->load->view('post_login/main');

                $this->load->view('report/collectionReport', $reportData);

                $this->load->view('post_login/footer');

            }

        }

        public function paymentReport()
        {

            $this->load->view('post_login/main');

            $this->load->view('report/paymentSelect');

            $this->load->view('post_login/footer');

        }


        public function getPaymentReport()
        {

            if($_SERVER['REQUEST_METHOD']=="POST")
            {
                $datefilter     =       $_POST['datefilter'];

                $splittedstring = explode("  ",$datefilter);
                
                $startDt = $splittedstring[0];
                $endDt = $splittedstring[1];

                $reportData['data'] = $this->StationaryM->f_get_payment_reportData($startDt, $endDt);
                $reportData['total'] = $this->StationaryM->f_get_totPayment_Data($startDt, $endDt);
                $reportData['startDt'] = $startDt;
                $reportData['endDt'] = $endDt;

                $this->load->view('post_login/main');

                $this->load->view('report/paymentReport', $reportData);

                $this->load->view('post_login/footer');

            }


        }

    /*********************** For Report/ Supplier Details ************************/
        public function supplierReport()
        {

            $this->load->view('post_login/main');

            $reportData['data'] = $this->StationaryM->f_get_supplierDetails();
            $this->load->view('report/supplierDetails', $reportData);

            $this->load->view('post_login/footer');

        }

    /****************** For Renewal Status Report  ***************/

        public function renewalReport()
        {

            $this->load->view('post_login/main');

            $reportData['data'] = $this->StationaryM->f_get_renewalData();
            $this->load->view('report/renewalReport', $reportData);

            $this->load->view('post_login/footer');

        }


        public function byDateRenReport()
        {

            $this->load->view('post_login/main');

            $curr_dt = date('Y-m-d');
            $reportData['data'] = $this->StationaryM->f_get_byDateRenReport($curr_dt);
            $this->load->view('report/byDateRenewal', $reportData);

            $this->load->view('post_login/footer');

        }

    /********** For Project Details Report **********/

        public function projectReport()
        {

            $this->load->view('post_login/main');

            $reportData['data'] = $this->StationaryM->f_get_projectReportData();
            $this->load->view('report/projectReport', $reportData);

            $this->load->view('post_login/footer');

        }

        




    }

?>