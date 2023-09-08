<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class StationaryM extends CI_Model
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('ApiVoucher');
         
        }

    public function f_get_particulars($table_name, $select=NULL, $where=NULL, $flag=NULL) {
            
            if(isset($select)) {
                $this->db->select($select);
            }

            if(isset($where)) {
                $this->db->where($where);
            }

            $result		=	$this->db->get($table_name);

            if($flag == 1) {
                return $result->row();
            }else {
                return $result->result();
            }
    }
    public function f_select($table, $select = NULL, $where = NULL, $type=NULL)
    {
        if (isset($select)) {
            $this->db->select($select);
        }

        if (isset($where)) {
            $this->db->where($where);
        }

        $value = $this->db->get($table);

        if ($type == 1) {
            return $value->row();
        } else {
            return $value->result();
        }
    }
    //For Editing row
    public function f_edit($table_name, $data_array, $where) {
        $this->db->where($where);
        $this->db->update($table_name, $data_array);
        $updated_status = $this->db->affected_rows();
        if($updated_status):
            return 1;
        else:
            return 0;
        endif;
    }
    
    //For Deliting row

    public function f_delete($table_name, $where) {
        $this->db->delete($table_name, $where);
        return;

    }
    public function f_insert($table_name, $data_array) {

        $this->db->insert($table_name, $data_array);

        return ;

    }

    //For Inserting Multiple Row

    public function f_insert_multiple($table_name, $data_array){
        $this->db->insert_batch($table_name, $data_array);
        return;

    }

   
     public function f_get_insert_ac_code($data_array) {
        $db2 = $this->load->database('findb', TRUE);
        $result = $db2->insert('md_achead', $data_array);
        $id = $db2->insert_id();
        return $id; 
    }

    // ************************ For Unit Master *************************** //

    public function f_get_unit_table()
    {
        $sql = $this->db->query(" SELECT * FROM md_stn_unit ");
        return $sql->result();
    }

    public function f_get_unitSlNo_max()
    {
        $sql = $this->db->query(" SELECT MAX(sl_no) AS sl_no FROM md_stn_unit ");
        return $sql->row();
    }

    public function addNewUnit($sl_no, $unit, $created_by, $created_dt)
    {
        $value = array('sl_no' => $sl_no,
                    'unit' => $unit,
                    'created_by' => $created_by,
                    'created_dt' => $created_dt );
        $this->db->insert('md_stn_unit',$value);
    }

    public function f_get_unit_editData($sl_no)
    {
        $sql = $this->db->query(" SELECT * FROM md_stn_unit WHERE sl_no = $sl_no ");
        return $sql->result();
    }


    public function updateUnit($sl_no, $unit, $modified_by, $modified_dt)
    {
        $value = array( 'unit' => $unit,
                        'modified_by' => $modified_by,
                        'modified_dt' => $modified_dt );
                    
        $this->db->where('sl_no',$sl_no);
        $this->db->update('md_stn_unit',$value);
    }

    public function deleteUnit($sl_no)
    {
        $sql = $this->db->query(" DELETE FROM md_stn_unit WHERE sl_no = $sl_no ");
    }

    // ************************** For Supplier Master ********************** //

    public function f_get_supplier_table()
    {
        $sql = $this->db->query(" SELECT * FROM md_stn_supplier ");
        return $sql->result();
    }

    public function js_edit_supplier_renewalStatus($sl_no, $cur_status) // For JS
    {
        if($cur_status == 0)
        {
            $sql = $this->db->query(" UPDATE md_stn_supplier SET renewal = 1 WHERE sl_no = $sl_no ");
        }
        elseif($cur_status ==1)
        {
            $sql = $this->db->query(" UPDATE md_stn_supplier SET renewal = 0 WHERE sl_no = $sl_no ");
        }
    }
        public function js_get_supplier_cur_RenewalStatus($sl_no)
        {

            $sql = $this->db->query(" SELECT renewal FROM md_stn_supplier WHERE sl_no = $sl_no ");
            return $sql->row();

        }

        public function f_get_supplierSlNo_max()
        {

            $sql = $this->db->query(" SELECT MAX(sl_no) AS sl_no FROM md_stn_supplier "); 
            return $sql->row();

        }
        public function f_get_stn_pay_max()
        {

            $sql = $this->db->query(" SELECT MAX(ref_no) AS ref_no FROM td_stn_payment_new "); 
            return $sql->row();
 
        }
        public function addNewSupplier($sl_no, $name, $contact_person, $phn_no, $email, $address, $gst_no, $pan_no, $trd_license, $bank, $accnt_no, $ifsc, $st, $it,$acc_code,$created_by, $created_dt)
        {

            $value = array('sl_no' => $sl_no,
                        'name' => $name,
                        'acc_code' => $acc_code,
                        'contact_person' => $contact_person,
                        'phn_no' => $phn_no,
                        'email' => $email,
                        'address' => $address,
                        'gst_no' => $gst_no,
                        'pan_no' => $pan_no,
                        'trd_license' => $trd_license,
                        'bank' => $bank,
                        'accnt_no' => $accnt_no,
                        'ifsc' => $ifsc,
                        'st' => $st,
                        'it' => $it,
                        'created_by' => $created_by,
                        'created_dt' => $created_dt );
            
            $this->db->insert('md_stn_supplier',$value);                        

        }

        public function f_get_supplierEditData($sl_no)
        {

            $sql = $this->db->query(" SELECT * FROM md_stn_supplier WHERE sl_no = $sl_no ");
            return $sql->result();

        }

        public function updateNewSupplier($sl_no, $name, $contact_person, $phn_no, $email, $address, $gst_no, $pan_no, $trd_license, $bank, $accnt_no, $ifsc, $st, $it,$modified_by, $modified_dt)
        {

            $value = array(
                        'name' => $name,
                        'contact_person' => $contact_person,
                        'phn_no' => $phn_no,
                        'email' => $email,
                        'address' => $address,
                        'gst_no' => $gst_no,
                        'pan_no' => $pan_no,
                        'trd_license' => $trd_license,
                        'bank' => $bank,
                        'accnt_no' => $accnt_no,
                        'ifsc' => $ifsc,
                        'st' => $st,
                        'it' => $it,
                        'modified_by' => $modified_by,
                        'modified_dt' => $modified_dt );
            
            $this->db->where('sl_no',$sl_no);
            $this->db->update('md_stn_supplier',$value);

        }

        public function deleteSupplier($sl_no)
        {
            $sql = $this->db->query(" DELETE FROM md_stn_supplier WHERE sl_no = $sl_no ");
        }



        // ******************** For Project Master ******************* // 

        public function f_get_projects_table()
        {

            $sql = $this->db->query("  SELECT a.project_cd, a.name, a.phn_no, GROUP_CONCAT(c.name) AS supplier 
                                    FROM md_stn_project a, md_stn_project_dtls b, md_stn_supplier c 
                                    WHERE a.project_cd = b.project_cd
                                    AND b.supplier_cd = c.sl_no
                                    GROUP BY a.project_cd, a.name, a.phn_no
                                    ORDER BY a.project_cd ");
                                    
            return $sql->result();

        }

        public function f_get_suppliersData()
        {

            $sql = $this->db->query(" SELECT sl_no, name FROM md_stn_supplier ");
            return $sql->result();

        }

        public function f_get_projectCd_max()
        {

            $sql = $this->db->query(" SELECT MAX(project_cd) AS project_cd FROM md_stn_project ");
            return $sql->row();

        }

        public function addNewProject($project_cd,$acc_code, $name, $phn_no, $address, $supplier_cd, $supplier_no, $created_by, $created_dt)
        {

            $value = array('project_cd' => $project_cd,
                            'acc_code' => $acc_code,
                            'name' => $name,
                            'phn_no' => $phn_no,
                            'address' => $address,
                            'created_by' => $created_by,
                            'created_dt' => $created_dt );
            
            $this->db->insert('md_stn_project',$value); 

        }

        public function addNewProjectDtls($project_cd, $name, $phn_no, $address, $supplier_cd, $supplier_no, $created_by, $created_dt)
        {

            for($i=0; $i<$supplier_no; $i++)
            {
                $value = array('project_cd' => $project_cd,
                        'supplier_cd' => $supplier_cd[$i],
                        'created_by' => $created_by,
                        'created_dt' => $created_dt );
            
                $this->db->insert('md_stn_project_dtls',$value); 
            }

        }

        public function f_get_projectEditData($project_cd)
        {

            $sql = $this->db->query(" SELECT * FROM md_stn_project WHERE project_cd = '$project_cd' ");
            return $sql->result();

        }

        public function f_get_projectDetailsEditData($project_cd)
        {

            $sql = $this->db->query(" SELECT a.supplier_cd, b.name FROM md_stn_project_dtls a, md_stn_supplier b 
                                    WHERE a.supplier_cd = b.sl_no AND a.project_cd = '$project_cd' ");
            return $sql->result();

        }

        public function updateNewProject($project_cd,$name, $phn_no, $address, $supplier_cd, $supplier_no, $modified_by, $modified_dt)
        {

            $value = array( 
                            'name' => $name,
                            'phn_no' => $phn_no,
                            'address' => $address,
                            'modified_by' => $modified_by,
                            'modified_dt' => $modified_dt );
                            
            $this->db->where('project_cd',$project_cd);
            $this->db->update('md_stn_project',$value);

        }

        public function deleteProject($project_cd)
        {
            $sql = $this->db->query(" DELETE FROM md_stn_project WHERE project_cd = $project_cd ");
        }

        public function deleteProjectDtls($project_cd)
        {
            $sql = $this->db->query(" DELETE FROM md_stn_project_dtls WHERE project_cd = $project_cd ");
        }


    // *********************** For Transaction/ Order Section ************************ //


        public function f_get_order_table()
        {

            $sql = $this->db->query("SELECT a.project_cd, a.c_order_no, a.c_order_dt, b.name AS supplier, c.name AS project   
                                    FROM td_stn_order a, md_stn_supplier b, md_stn_project c
                                    WHERE a.supplier_cd = b.sl_no 
                                    AND a.project_cd = c.project_cd 
                                    GROUP BY a.c_order_no, a.c_order_dt, b.name, c.name, a.project_cd ");
            return $sql->result();

        }

        public function f_get_supplierData()
        {

            $sql = $this->db->query(" SELECT sl_no, name FROM md_stn_supplier  ");
            return $sql->result();

        }

        public function f_get_projectData()
        {

            $sql = $this->db->query(" SELECT * FROM md_stn_project order by name");
            return $sql->result();

        }

        public function js_get_C_OrderNo_validation($c_order_no)
        {

            $sql = $this->db->query(" SELECT COUNT( * ) AS num_row FROM `td_stn_order` WHERE c_order_no = '$c_order_no' ");
            return $sql->row();

        }

        public function js_get_suppliersForProject($project_cd)
        {

            $sql = $this->db->query(" SELECT a.supplier_cd, b.name FROM md_stn_project_dtls a, md_stn_supplier b
                                    WHERE a.supplier_cd = b.sl_no 
                                    AND a.project_cd = $project_cd
                                    order by b.name");
            return $sql->result();

        }

        public function js_get_supplier_status($supplier_cd,$order_dt)
        {
            $sql    =   $this->db->query("select status from td_stm_renewal
                                          where  supp_no        = $supplier_cd
                                          and    effective_dt   = (select max(effective_dt)
                                                                   from   td_stm_renewal
                                                                   where  supp_no        = $supplier_cd)                                   
                                          and    sl_no          =  (select max(sl_no)
                                                                    from   td_stm_renewal
                                                                    where  effective_dt <='$order_dt'
                                                                    and    supp_no = $supplier_cd)
                                          ");   
            return $sql->row(); 
        }


        public function addNewOrder($c_order_dt, $c_order_no, $supplier_cd, $g_order_dt, $g_order_no, $project_cd, $remarks, $row, $created_by, $created_dt)
        {

            for($i= 0; $i<$row; $i++)
            {
                $value = array('g_order_dt' => $g_order_dt[$i],
                        'g_order_no' => $g_order_no[$i],
                        'g_sl_no' => $i, 
                        'c_order_dt' => $c_order_dt,
                        'c_order_no' => $c_order_no,
                        'project_cd' => $project_cd[$i],
                        'supplier_cd' => $supplier_cd,
                        // 'tot_amount' => $tot_amount,
                        'remarks' => $remarks,
                        'created_by' => $created_by,
                        'created_dt' => $created_dt );
            
                $this->db->insert('td_stn_order',$value);

            }

        }
        public function deleteOrder($c_order_no, $c_order_dt, $project_cd)
        {
            $sql = $this->db->query(" DELETE FROM td_stn_order WHERE c_order_no = '$c_order_no' AND c_order_dt = '$c_order_dt' AND project_cd = '$project_cd' ");
        }

        // public function deleteOrderDtls($order_no)
        // {
        //     $sql = $this->db->query(" DELETE FROM td_stn_order_dtls WHERE order_no = '$order_no' ");
        // }

        public function f_get_orderEditData($c_order_no, $c_order_dt)
        {

            $sql = $this->db->query(" SELECT DISTINCT c_order_dt, c_order_no, supplier_cd, tot_amount, remarks
                                    FROM td_stn_order 
                                    WHERE c_order_no = '$c_order_no'
                                    AND c_order_dt = '$c_order_dt'
                                            ");
                                     
            return $sql->result();

        }

        public function f_get_orderEditDataDtls($c_order_no, $c_order_dt)
        {

            $sql = $this->db->query(" SELECT a.g_order_no, a.g_order_dt, a.project_cd, b.name 
                                    FROM td_stn_order a, md_stn_project b 
                                    WHERE a.project_cd = b.project_cd
                                    AND a.c_order_no = '$c_order_no' 
                                    AND a.c_order_dt = '$c_order_dt'
                                    ORDER BY a.sl_no  ");

            return $sql->result();

        }

        public function updateOrder($c_order_dt, $c_order_no, $g_order_dt, $g_order_no, $project_cd, $supplier_cd, $remarks, $row, $modified_by, $modified_dt)
        {
            $sql = $this->db->query(" DELETE FROM td_stn_order WHERE c_order_no = '$c_order_no' AND c_order_dt = '$c_order_dt' ");
            
            for($i= 0; $i< $row; $i++)
            {
                $value = array( 'g_order_dt' => $g_order_dt[$i],
                                'g_order_no' => $g_order_no[$i],
                                'c_order_dt' => $c_order_dt,
                                'c_order_no' => $c_order_no,
                                'project_cd' => $project_cd[$i],
                                'supplier_cd' => $supplier_cd,
                                //'tot_amount' => $tot_amount,
                                'remarks' => $remarks,
                                'modified_by' => $modified_by,
                                'modified_dt' => $modified_dt );
                            
                //$this->db->where('order_dt',$order_dt);
                //$this->db->where('c_order_no',$c_order_no);
                $this->db->insert('td_stn_order',$value);
            }

        }

    // **************************** For Bill/ Purchase Bill ********************** //

    
        public function f_get_pBill_table()
        {

            $sql = $this->db->query(" SELECT distinct a.bill_no,a.bill_dt,a.order_no,c.name ,a.total FROM td_stn_purchaseBill a, td_stn_order b ,md_stn_supplier c where  a.order_no=b.c_order_no and b.supplier_cd=c.sl_no ");
            return $sql->result();

        }

        public function js_get_supplierAsPerOrder($order_no)
        {

            $sql = $this->db->query(" SELECT b.name FROM td_stn_order a, md_stn_supplier b 
                                    WHERE a.supplier_cd = b.sl_no AND a.c_order_no = '$order_no' ");
            return $sql->row();

        }

        public function js_get_check_duplicate_billEntry_forDate($bill_no, $bill_dt)
        {

            $sql = $this->db->query(" SELECT COUNT(*) AS num_row FROM td_stn_purchaseBill WHERE bill_no = '$bill_no' AND bill_dt = '$bill_dt' ");
            return $sql->row();

        }

        public function js_get_check_PBillNo_forDate($pb_no, $order_no)
        {

            $sql = $this->db->query(" SELECT COUNT(*) AS num_row FROM td_stn_purchaseBill WHERE bill_no = '$pb_no' AND order_no = '$order_no' ");
            return $sql->row();

        }

        public function js_get_order_validationFor_purchaseBill($order_no)
        {

            $sql = $this->db->query(" SELECT COUNT(*) AS num_row FROM td_stn_order WHERE c_order_no = '$order_no' ");
            return $sql->row();

        }

        public function js_get_order_validationFor_saleBill($order_no)
        {

            $sql = $this->db->query(" SELECT COUNT(*) AS num_row FROM td_stn_order WHERE c_order_no = '$order_no' ");
            return $sql->row();

        }


        public function f_get_slNo_from_purchaseBillDtls($bill_dt, $bill_no)
        {

            $sql = $this->db->query(" SELECT MAX(sl_no) AS sl_no FROM td_stn_pbill_dtls WHERE bill_dt = '$bill_dt' AND bill_no = '$bill_no' ");
            return $sql->row();

        }

        public function addNewPBill($bill_dt, $bill_no, $order_no, $nt, $non_tax, $total, $created_by, $created_dt )
        {

            $value = array( 'bill_dt' => $bill_dt,
                            'bill_no' => $bill_no,
                            'order_no' => $order_no,
                            'nt' => $nt,
                            'non_tax' => $non_tax,
                            'total' => $total,
                            'created_by' => $created_by,
                            'created_dt' => $created_dt );
                
    
            $this->db->insert('td_stn_purchaseBill', $value);

        }

        public function addNewPBillDtls($sl_no, $bill_dt, $bill_no, $gst_per, $sub_amnt, $cgst_val, $sgst_val, $created_by, $created_dt, $row )
        {

            for($i=0; $i<$row; $i++)
            {

                $value = array('sl_no' => $sl_no+$i,
                                'bill_dt' => $bill_dt,
                                'bill_no' => $bill_no,
                                'gst_per' => $gst_per[$i],
                                'sub_amnt' => $sub_amnt[$i],
                                'cgst_val' => $cgst_val[$i],
                                'sgst_val' => $sgst_val[$i],
                                'created_by' => $created_by,
                                'created_dt' => $created_dt );

                $this->db->insert('td_stn_pbill_dtls', $value);

            }

        }

        public function f_get_edit_pBillData($bill_no, $bill_dt)
        {

            $sql = $this->db->query(" SELECT bill_dt, bill_no, order_no, nt, non_tax, total
                                    FROM td_stn_purchaseBill WHERE bill_no = '$bill_no' AND bill_dt = '$bill_dt' ");
                                    
            return $sql->result();

        }

        public function f_get_pBillEdit_orderNo($bill_no, $bill_dt)
        {

            $sql = $this->db->query(" SELECT order_no FROM td_stn_purchaseBill WHERE
                                    bill_no = '$bill_no' AND bill_dt = '$bill_dt' ");
            return $sql->row();

        }

        public function f_get_edit_pBillDtlsData($bill_no, $bill_dt)
        {

            $sql = $this->db->query(" SELECT sl_no, gst_per, sub_amnt, cgst_val, sgst_val FROM td_stn_pbill_dtls WHERE bill_dt = '$bill_dt' AND bill_no = '$bill_no' ");
            return $sql->result();

        }

        public function updatePBill($bill_dt, $bill_no, $order_no, $nt, $non_tax, $total, $modified_by, $modified_dt )
        {
            
            $value = array( 'bill_dt' => $bill_dt,
                            'order_no' => $order_no,
                            'nt' => $nt,
                            'non_tax' => $non_tax,
                            'total' => $total,
                            'modified_by' => $modified_by,
                            'modified_dt' => $modified_dt );
                
            $this->db->where('bill_no', $bill_no);
            $this->db->where('bill_dt', $bill_dt);
            $this->db->update('td_stn_purchaseBill', $value);

        }


        public function deletePBill($bill_no, $bill_dt)
        {

            $sql = $this->db->query(" DELETE FROM td_stn_purchaseBill WHERE bill_no = '$bill_no' AND bill_dt = '$bill_dt' ");

        }

        public function deletePBillDtls($bill_no, $bill_dt)
        {

            $sql = $this->db->query(" DELETE FROM td_stn_pbill_dtls WHERE bill_no = '$bill_no' AND bill_dt = '$bill_dt' ");

        }


        // FOR Bill / Sale Bill -----

        public function f_get_sBill_table()
        {

            $sql = $this->db->query(" SELECT distinct  a.bill_no, a.bill_dt, a.order_no,c.name, a.total FROM td_stn_saleBill a,td_stn_order b ,md_stn_supplier c 
            where  a.order_no=b.c_order_no and b.supplier_cd=c.sl_no ");
            
            return $sql->result();

        }


        public function js_get_check_duplicate_saleBillEntry_forDate($bill_no, $bill_dt)
        {

            $sql = $this->db->query(" SELECT COUNT(*) AS num_row FROM td_stn_saleBill WHERE bill_no = '$bill_no' AND bill_dt = '$bill_dt' ");
            return $sql->row();

        }


        public function f_get_slNo_from_sBillDtls($bill_dt, $bill_no)
        {

            $sql = $this->db->query(" SELECT ifnull(MAX(sl_no),0)slno FROM td_stn_sBillDtls WHERE bill_no = '$bill_no' AND bill_dt = '$bill_dt' ");
            return $sql->row();

        }

        public function addNewSBill($bill_dt, $bill_no, $order_no, $pb_no, $nt, $non_tax, $total, $created_by, $created_dt )
        {

            $value = array('bill_dt' => $bill_dt,
                            'bill_no' => $bill_no,
                            'order_no' => $order_no,
                            'pb_no' => $pb_no,
                            'nt' => $nt,
                            'non_tax' => $non_tax,
                            'total' => $total,
                            'created_by' => $created_by,
                            'created_dt' => $created_dt );

            $this->db->insert('td_stn_saleBill', $value);              

        }

        public function addNewSBillDtls($sl_no, $bill_dt, $bill_no, $gst_per, $sub_amnt, $cgst_val, $sgst_val, $created_by, $created_dt, $row )
        {

            for($i=0; $i<$row; $i++)
            {
                $value = array('sl_no' => $sl_no+$i,
                                'bill_dt' => $bill_dt,
                                'bill_no' => $bill_no,
                                'gst_per' => $gst_per[$i],
                                'sub_amnt' => $sub_amnt[$i],
                                'cgst_val' => $cgst_val[$i],
                                'sgst_val' => $sgst_val[$i],
                                'created_by' => $created_by,
                                'created_dt' => $created_dt );

                $this->db->insert('td_stn_sBillDtls', $value);

            }

        }

        public function f_get_edit_sBillData($bill_no, $bill_dt)
        {

            $sql = $this->db->query(" SELECT bill_dt, bill_no,pb_no, order_no, nt, non_tax, total
                                    FROM td_stn_saleBill WHERE bill_no = '$bill_no' AND bill_dt = '$bill_dt'  ");
            return $sql->result();

        }

        public function f_get_edit_sBillDtlsData($bill_no, $bill_dt)
        {

            $sql = $this->db->query(" SELECT gst_per, sub_amnt, cgst_val, sgst_val FROM td_stn_sBillDtls WHERE bill_no = '$bill_no' AND bill_dt = '$bill_dt' ");
            return $sql->result();

        }

        public function f_get_edit_sBillOrderNo($bill_no, $bill_dt)
        {

            $sql = $this->db->query(" SELECT order_no FROM td_stn_saleBill WHERE
                                    bill_no = '$bill_no' AND bill_dt = '$bill_dt' ");
            return $sql->row();

        }

       
        public function updateSBill($bill_dt, $bill_no, $order_no, $nt, $non_tax, $total, $modified_by, $modified_dt )
        {
                           
            $value = array('order_no'   => $order_no,
                           'nt'         => $nt,
                           'non_tax'    => $non_tax, 
                           'total'      => $total,
                           'modified_by' => $modified_by,
                           'modified_dt' => $modified_dt);

            $this->db->where('bill_no', $bill_no);
            $this->db->where('bill_dt', $bill_dt);
            $this->db->update('td_stn_saleBill', $value);   

        }

        public function updateSBillDtls($sl_no, $bill_dt, $bill_no, $gst_per, $sub_amnt, $cgst_val, $sgst_val, $created_by, $created_dt, $row )
        {

            for($i=0; $i<$row; $i++)
            {
                $value = array('sl_no'       => $sl_no+$i,
                                'bill_no'    => $bill_no,
                                'bill_dt'    => $bill_dt,
                                'gst_per'    => $gst_per[$i],
                                'sub_amnt'   => $sub_amnt[$i],
                                'cgst_val'   => $cgst_val[$i],
                                'sgst_val'   => $sgst_val[$i],
                                'created_by' => $created_by,
                                'created_dt' => $created_dt );

                $this->db->insert('td_stn_sBillDtls', $value);

            }

        }

        public function deletesBill($bill_no, $bill_dt)
        {

            $sql = $this->db->query(" DELETE FROM td_stn_saleBill WHERE bill_no = '$bill_no' AND bill_dt = '$bill_dt' ");

        }

        public function deleteSBillDtls($bill_no, $bill_dt)
        {

            $sql = $this->db->query(" DELETE FROM td_stn_sBillDtls WHERE bill_no = '$bill_no' AND bill_dt = '$bill_dt' ");

        }


        // ********************* For Order Report ***************** //

        public function f_get_orderReportData($startDt, $endDt)
        {

            $sql = $this->db->query("SELECT DISTINCT a.c_order_dt, a.c_order_no, GROUP_CONCAT(CONCAT(a.g_order_no) ORDER BY a.c_order_no ) AS g_order_no, a.tot_amount, b.name AS project, c.name AS supplier 
                                    FROM td_stn_order a, md_stn_project b, md_stn_supplier c 
                                    WHERE a.project_cd = b.project_cd AND a.supplier_cd = c.sl_no
                                    AND a.c_order_dt >= '$startDt' AND a.c_order_dt <= '$endDt'
                                    GROUP BY a.c_order_no, a.c_order_dt, a.tot_amount, b.name, c.name ");
            return $sql->result();

        }

        // public function f_get_orderReportAmount($startDt, $endDt)
        // {

        //     $sql = $this->db->query(" SELECT SUM(tot_amount) AS amount FROM td_stn_order 
        //                             WHERE c_order_dt >= '$startDt' AND c_order_dt <= '$endDt' ");
        //     return $sql->row();

        // }

        public function f_get_billReportData($startDt, $endDt)
        {

            $sql = $this->db->query(" SELECT DISTINCT a.order_no, a.bill_no AS pb, a.bill_dt AS pB_dt, a.total AS p_total, SUM(b.cgst_val) AS tot_p_cgst, SUM(b.sgst_val) AS tot_p_sgst, c.bill_no AS sb, c.total AS s_total, SUM(d.cgst_val) AS tot_s_cgst, SUM(d.sgst_val) AS tot_s_sgst 
            ,(select  sum(f.total)as dd from td_stn_purchaseBill f  where f.order_no=c.order_no) AS p_subtot,
            (select DISTINCT h.name from td_stn_order g,md_stn_supplier h where g.c_order_no=c.order_no and g.supplier_cd=h.sl_no)AS supplier
                                    FROM td_stn_purchaseBill a, td_stn_pbill_dtls b, td_stn_saleBill c, td_stn_sBillDtls d 
                                    WHERE a.order_no = c.order_no
                                    AND a.bill_no = c.pb_no
                                    AND a.bill_no = b.bill_no
                                    AND a.bill_dt = b.bill_dt
                                    AND c.bill_no = d.bill_no
                                    AND d.bill_dt = d.bill_dt 
                                    AND a.bill_dt >= '$startDt'
                                    AND a.bill_dt <= '$endDt'
                                    GROUP BY a.bill_no, a.bill_dt, a.order_no, a.total, c.bill_no, c.total ");

            return $sql->result();

        }


        public function f_get_bill_sub_total($startDt, $endDt)
        {
            $sql = $this->db->query("SELECT DISTINCT a.order_no,sum( a.total) AS p_total
                                    FROM td_stn_purchaseBill a, td_stn_pbill_dtls b, td_stn_saleBill c, td_stn_sBillDtls d 
                                    WHERE a.order_no = c.order_no
                                    AND a.bill_no = c.pb_no
                                    AND a.bill_no = b.bill_no
                                    AND a.bill_dt = b.bill_dt
                                    AND c.bill_no = d.bill_no
                                    AND d.bill_dt = d.bill_dt 
                                    AND a.bill_dt >= '$startDt'
                                    AND a.bill_dt <= '$endDt'
                                    GROUP BY a.order_no");
        }
        public function f_get_billReport_orderNo_count($startDt, $endDt)
        {

            $sql = $this->db->query(" SELECT COUNT(*) AS count FROM 
                                    (SELECT DISTINCT a.order_no, a.bill_no AS pb, a.bill_dt AS pB_dt, a.total AS p_total, SUM(b.cgst_val) AS tot_p_cgst, SUM(b.sgst_val) AS tot_p_sgst, c.bill_no AS sb, c.total AS s_total, SUM(d.cgst_val) AS tot_s_cgst, SUM(d.sgst_val) AS tot_s_sgst                                     
                                    FROM td_stn_purchaseBill a, td_stn_pbill_dtls b, td_stn_saleBill c, td_stn_sBillDtls d  
                                    WHERE a.order_no = c.order_no
                                    AND a.bill_no = c.pb_no
                                    AND a.bill_no = b.bill_no
                                    AND a.bill_dt = b.bill_dt
                                    AND c.bill_no = d.bill_no
                                    AND d.bill_dt = d.bill_dt 
                                    AND a.bill_dt >= '$startDt'
                                    AND a.bill_dt <= '$endDt'
                                    GROUP BY a.bill_no, a.bill_dt, a.order_no, a.total, c.bill_no, c.total ) X 
                                    WHERE 1 GROUP BY order_no  ");

            return $sql->row();

        }


        public function f_get_billReport_totPBill_amount($startDt, $endDt)
        {

            $sql = $this->db->query(" SELECT SUM(total) AS pb_tot FROM td_stn_purchaseBill 
                                    WHERE bill_dt >= '$startDt'
                                    AND bill_dt <= '$endDt' ");
                                     
            return $sql->row();

        }

        public function f_get_billReport_totSBill_amount($startDt, $endDt)
        {

            $sql = $this->db->query(" SELECT SUM(total) AS sb_tot FROM td_stn_saleBill
                                    WHERE bill_dt >= '$startDt'
                                    AND bill_dt <= '$endDt' ");
                                     

            return $sql->row();

        }

    // ***************** For Transaction / Collection ******************* //

        public function f_get_billCollectionData()
        {

            $sql = $this->db->query(" SELECT distinct lnk_sl_no ,trans_dt,b.name as supplier,sum(amount) as amount
             FROM td_stn_collection a,md_stn_supplier b where a.supplier=b.sl_no group by lnk_sl_no ,trans_dt,b.name");
            return $sql->result();

        }

        public function f_get_billCollectionMrno()
        {

            $sql = $this->db->query(" SELECT distinct lnk_sl_no ,trans_dt,mr_no 
                                      FROM td_stn_collection");
            return $sql->result();

        }

        public function js_get_collection_billForOrder($order_no) // For JS
        {

            $sql = $this->db->query(" SELECT bill_no FROM td_stn_saleBill WHERE order_no = '$order_no' ");
            return $sql->result();

        }

        public function js_get_collection_amountForBill($bill_no) // For JS
        {

            $sql = $this->db->query(" SELECT tot_amount FROM td_stn_saleBill WHERE bill_no = '$bill_no' ");
            return $sql->row();

        }

        public function f_get_billCollection_editData($lnk_sl_no)
        {

            $sql = $this->db->query("select sl_no, project,
            trans_dt,supplier,amount,mode,mr_no,remarks,created_by,created_dt,lnk_sl_no
            from  td_stn_collection 
            where lnk_sl_no = $lnk_sl_no ");

            return $sql->result();

        }


        public function f_get_billCollectionEdit_project($lnk_sl_no)
        {

            $sql = $this->db->query(" SELECT c.name AS project FROM td_stn_collection a, md_stn_project c
                                        WHERE a.project = c.project_cd
                                         AND a.lnk_sl_no = $lnk_sl_no");

            return $sql->row();

        }

        public function f_get_billCollectionEdit_supplier($lnk_sl_no)
        {

            $sql = $this->db->query(" SELECT c.name AS supplier FROM td_stn_collection a, md_stn_supplier c
                                        WHERE a.supplier = c.sl_no
                                         AND a.lnk_sl_no = $lnk_sl_no");
                                //   AND a.bill_no = '$bill_no'  

            return $sql->row();

        }


        public function f_get_billCollectionEdit_saleAmount($lnk_sl_no)
        {

            $sql = $this->db->query(" SELECT b.tot_amount FROM td_stn_collection a, td_stn_saleBill b
                                    WHERE a.order_no = b.order_no
                                    AND a.bill_no = b.bill_no
                                    AND a.sl_no = $lnk_sl_no");
                                    /*AND a.bill_no = '$bill_no'*/ 
            return $sql->row();

        }

        public function updateCollection($value,$where)
        {
            
                $this->db->set($value);

                $this->db->where($where);
            
                $this->db->update('td_stn_collection');
            
        }
        public function f_get_payment_tableData()
        {

            $sql = $this->db->query(" SELECT * FROM td_stn_bank_file_dtls ");
            return $sql->result();

        }

        public function js_get_payment_orderForProject($project_cd) // FOR JS 
        {

            $sql = $this->db->query(" SELECT DISTINCT b.order_no FROM td_stn_order a, td_stn_purchaseBill b WHERE a.c_order_no = b.order_no
                                    AND a.project_cd = $project_cd ");
            return $sql->result();

        }

        public function js_get_Payment_supplierForBill($order_no) // For JS
        {

            $sql = $this-> db->query(" SELECT b.name AS supplier FROM td_stn_order a, md_stn_supplier b
                                    WHERE a.supplier_cd = b.sl_no AND a.c_order_no = '$order_no' ");
            return $sql->row();

        }

        public function js_get_payment_billForOrder($order_no) // For JS
        {

            $sql = $this->db->query(" SELECT bill_no FROM td_stn_purchaseBill WHERE order_no = '$order_no' ");
            return $sql->result();

        }

        public function js_get_payment_amountForBill($bill_no) // For JS
        {

            $sql = $this->db->query(" SELECT tot_amount AS amount FROM td_stn_purchaseBill WHERE bill_no = '$bill_no' ");
            return $sql->row();

        }
        public function js_get_mrno($mr_no) // For JS
        {
           $sql= "SELECT trans_dt AS mr_dt,mode,amount AS amount FROM td_stn_collection WHERE mr_no = '$mr_no' ";
        //    die();
           $data = $this->db->query($sql);
           
            return $data->row();

        }
        public function js_get_s_p_data($s_bill_no) // For JS
        {
           $sql= "SELECT a.bill_no AS s_bill_no ,a.bill_dt as s_bill_dt,a.total as s_bill_amt,
                    b.bill_no as p_bill_no,b.bill_dt as p_bill_dt ,b.total as p_bill_amt FROM td_stn_saleBill a ,td_stn_purchaseBill b where a.pb_no=b.bill_no
                    and a.bill_no= '$s_bill_no' ";
        //    die();
           $data = $this->db->query($sql);
           
            return $data->row();

        }

        public function f_get_bankName()
        {

             $sql = $this->db->query("SELECT bank_name, sl_no FROM md_bank");
            
            return $sql->result();
            // print_r($sql);
            // die();
        }
       
        public function addNewbankPayment($file_name,$page_no,$bank, $ref_no,$tot_s_bill,$tot_p_bill,$s_bill_less_amt,$p_bill_less_amt,$s_bill_add_amt,$p_bill_add_amt,$p_bill_round_off,$s_bill_round_off,$s_bill_add_rnd_off,$p_bill_add_rnd_off, $mr_add_gst,$mr_less_gst,$confed_margin,$margin_add_gst ,$margin_less_gst,$tot_mr_amt)
        {

            $value = array( 'file_name'           => $file_name,
                            'page_no'             => $page_no,
                            'bank'                => $bank,
                            'ref_no'              => $ref_no,
                            'tot_s_bill'          => $tot_s_bill,
                            'tot_p_bill'          => $tot_p_bill,
                            's_bill_less_amt'     => $s_bill_less_amt,
                            'p_bill_less_amt'     => $p_bill_less_amt,
                            's_bill_add_amt'      => $s_bill_add_amt,
                            'p_bill_add_amt'      => $s_bill_add_amt,
                            'p_bill_less_rnd_off' => $p_bill_round_off,
                            's_bill_less_rnd_off' => $s_bill_round_off,
                            's_bill_add_rnd_off'  => $s_bill_add_rnd_off,
                            'p_bill_add_rnd_off'  => $s_bill_add_rnd_off,
                            'mr_add_gst'          => $mr_add_gst,
                            'mr_less_gst'         => $mr_less_gst,
                            'confed_margin'       => $confed_margin,
                            'margin_add_gst'      => $margin_add_gst,
                            'margin_less_gst'     => $margin_less_gst,
                             'tot_mr_amt'         => $tot_mr_amt);
            
            $this->db->insert('td_stn_bank_file_dtls',$value);

        }

        public function addNewPayment( $order_no,$project, $ref_no,$Unit_count)
        {
            for($j=0; $j<$Unit_count ; $j++)
            {
            $value = array( 'order_no' => $order_no[$j],
                            'project' => $project[$j],
                            'ref_no' => $ref_no);
            
            $this->db->insert('td_stn_payment_new', $value);  
            // echo $last->db->query();
            //     die();            
            }
        }

        public function addNewmrPayment( $mr_no,$mr_dt ,$pay_type,$pay_dt ,$amt,$ref_no,$Unit_count1)
        {
            for($j=0; $j<$Unit_count1 ; $j++)
            {
            $value = array( 'mr_no'    => $mr_no[$j],
                            'mr_dt'    => $mr_dt[$j],
                            'chq_type' => $pay_type[$j],
                            'chq_dt'   => $pay_dt[$j],
                            'amt'      => $amt[$j],
                            'ref_no'   => $ref_no );
            
            $this->db->insert('td_stn_pay_mr', $value);  
            // echo $last->db->query();
            //     die();            
            }
        }

        public function addNewbillPayment( $s_bill_no,$s_bill_dt ,$s_bill_amt,$p_bill_no ,$p_bill_dt,$p_bill_amt, $ref_no,$Unit_count2)
        {
            for($j=0; $j<$Unit_count2 ; $j++)
            {
            $value = array( 's_bill_no'    => $s_bill_no[$j],
                            's_bill_dt'    => $s_bill_dt[$j],
                            's_bill_amt'   => $s_bill_amt[$j],
                            'p_bill_no'    => $p_bill_no[$j],
                            'p_bill_dt'    => $p_bill_dt[$j],
                            'p_bill_amt'   => $p_bill_amt[$j],
                            'ref_no'       => $ref_no );
            
            $this->db->insert('td_stn_pay_s_p_bill', $value);  
            // echo $last->db->query();
            //     die();            
            }
        }

        public function f_get_bank_editData($ref_no)
        {

            $sql = $this->db->query(" SELECT * FROM td_stn_bank_file_dtls WHERE ref_no =$ref_no");
            return $sql->result();

        }
        
        public function f_get_payment_editData($ref_no)
        {

            $sql = $this->db->query(" SELECT * FROM td_stn_payment_new WHERE ref_no =$ref_no");
            return $sql->result();

        }
        public function f_get_mr_editData($ref_no)
        {

            $sql = $this->db->query(" SELECT * FROM td_stn_pay_mr WHERE ref_no =$ref_no ");
            return $sql->result();

        }
        public function f_get_payment_supplier_editData($ref_no)
        {

            $sql = $this->db->query("SELECT  b.project_cd, b.name as project,a.order_no as order_no FROM td_stn_payment_new a, md_stn_project b WHERE
                                    a.project = b.project_cd AND
                                    a.ref_no = $ref_no");
            return $sql->result();
        }
        public function f_stn_spbill_editData($ref_no)
        {

            $sql = $this->db->query("SELECT  * FROM td_stn_pay_s_p_bill  
                                       WHERE ref_no = $ref_no");
            return $sql->result();
        }
        public function f_get_billAmount_editData($bill_no)
        {

            $sql = $this->db->query(" SELECT tot_amount FROM td_stn_purchaseBill WHERE bill_no = '$bill_no' ");
            return $sql->row();

        }

        public function f_get_payment_orderNo($sl_no, $bill_no)
        {

            $sql = $this->db->query(" SELECT order_no FROM td_stn_payment WHERE sl_no = $sl_no AND bill_no = '$bill_no' ");
            return $sql->row();

        }

        public function f_get_payment_project_editData($order_no)
        {

            $sql = $this->db->query(" SELECT b.name FROM td_stn_order a, md_stn_project b WHERE 
                                    a.project_cd = b.project_cd AND 
                                    a.c_order_no = '$order_no' ");
            return $sql->row();

        }

        public function updateNewbankPayment($file_name,$page_no,$bank, $ref_no,$tot_s_bill,$tot_p_bill,$s_bill_less_amt,$p_bill_less_amt,$s_bill_add_amt,$p_bill_add_amt, $s_bill_less_rnd_off, $p_bill_less_rnd_off,$s_bill_add_rnd_off,$p_bill_add_rnd_off,$mr_add_gst,$tot_mr_amt)
        {

            // for($i=0; $i<$item_no; $i++)
            // {
                $value = array( 'file_name'       => $file_name,
                                'page_no'         => $page_no,
                                'bank'            =>$bank,
                                'ref_no'          =>$ref_no,
                                'tot_s_bill'      => $tot_s_bill,
                                'tot_p_bill'      => $tot_p_bill,
                                's_bill_less_amt' => $s_bill_less_amt,
                                'p_bill_less_amt' => $s_bill_less_amt ,
                                's_bill_add_amt'  => $s_bill_add_amt,
                                'p_bill_add_amt'  => $p_bill_add_amt,
                                's_bill_less_rnd_off'=>$s_bill_round_off, 
                                'p_bill_less_rnd_off'=>$p_bill_round_off,
                                's_bill_add_rnd_off' =>$s_bill_add_rnd_off,
                                'p_bill_add_rnd_off' =>$p_bill_add_rnd_off,
                                'mr_add_gst'      =>$mr_add_gst,
                                'mr_less_gst'     =>$mr_less_gst,
                                'tot_mr_amt'      =>$tot_mr_amt);
                $this->db->where('ref_no',$ref_no);
                $this->db->update('td_stn_bank_file_dtls',$value);
            // }

        }
       
        public function  updateNewPayment( $order_no,$project, $ref_no,$Unit_count)
        {

            for($i=0; $i<$Unit_count; $i++)
            {
                $value = array( 'order_no' => $order_no[$i] );
                            
                $this->db->where('ref_no',$ref_no);
                $this->db->update('td_stn_payment_new',$value);
            }

        }
        
        public function updateNewmrPayment( $mr_no,$mr_dt ,$chq_type,$chq_dt ,$amt, $ref_no,$Unit_count1)
        {

            for($i=0; $i<$Unit_count1; $i++)
            {
                $value = array( 'mr_no' => $mr_no[$i],
                                'mr_dt' => $mr_dt[$i],
                                'chq_type' => $chq_type[$i],
                                'chq_dt' => $chq_dt[$i],
                                'amt' => $amt[$i] );
                            
                $this->db->where('ref_no',$ref_no);
                $this->db->update('td_stn_pay_mr',$value);
            }

        }

       
        public function  updateNewbillPayment( $s_bill_no,$s_bill_dt ,$s_bill_amt,$p_bill_no ,$p_bill_dt,$p_bill_amt, $ref_no,$Unit_count2)
 
        {

            for($i=0; $i<$Unit_count2; $i++)
            {
                $value = array( 's_bill_no' => $s_bill_no[$i],
                                's_bill_dt' => $s_bill_dt[$i],
                                's_bill_amt' => $s_bill_amt[$i],
                                'p_bill_no' => $p_bill_no[$i],
                                'p_bill_amt' => $p_bill_amt[$i] );
                            
                $this->db->where('ref_no',$ref_no);
                $this->db->update('td_stn_pay_s_p_bill',$value);
            }

        }
        public function deleteBillPayment($ref_no)
        {

            $sql  = $this->db->query(" DELETE FROM td_stn_bank_file_dtls WHERE ref_no = '$ref_no'");
            $sql1 = $this->db->query(" DELETE FROM td_stn_payment_new    WHERE ref_no = '$ref_no'");
            $sql2 = $this->db->query(" DELETE FROM td_stn_pay_s_p_bill   WHERE ref_no = '$ref_no'");
            $sql3 = $this->db->query(" DELETE FROM td_stn_pay_mr         WHERE ref_no = '$ref_no'");
        }

        public function f_get_collection_reportData($startDt, $endDt)
        {

            $sql = $this->db->query(" SELECT a.trans_dt, a.order_no, a.bill_no, a.amount, a.mode, b.tot_amount, c.name FROM
                                    td_stn_collection a, td_stn_order b, md_stn_project c WHERE
                                    a.order_no = b.c_order_no AND
                                    b.project_cd = c.project_cd AND
                                    a.trans_dt >= '$startDt' AND a.trans_dt <= '$endDt'  ");
            return $sql->result();

        }

        public function f_get_totCollection_Data($startDt, $endDt)
        {

            $sql = $this->db->query(" SELECT SUM(amount) AS amount FROM td_stn_collection WHERE 
                                    trans_dt >= '$startDt' AND trans_dt <= '$endDt' ");
            return $sql->row();

        }

        public function f_get_payment_reportData($startDt, $endDt)
        {

            $sql = $this->db->query(" SELECT a.trans_dt, a.order_no, a.bill_no, a.part, a.amount, a.mode, c.name FROM
                                    td_stn_payment a, td_stn_order b, md_stn_supplier c WHERE
                                    a.order_no = b.c_order_no AND
                                    b.supplier_cd = c.sl_no AND
                                    a.trans_dt >= '$startDt' AND a.trans_dt <= '$endDt' ");
            return $sql->result();

        }

        public function f_get_totPayment_Data($startDt, $endDt)
        {

            $sql = $this->db->query(" SELECT SUM(amount) AS amount FROM td_stn_payment WHERE trans_dt >= '$startDt' AND trans_dt <= '$endDt' ");
            return $sql->row();

        }

        public function f_get_supplierDetails()
        {

            $sql = $this->db->query(" SELECT * FROM md_stn_supplier
                                      where renewal = 1 ");
            return $sql->result();

        }

        public function f_get_renewalData()
        {

            $sql = $this->db->query(" SELECT sl_no, name, contact_person, renewal FROM md_stn_supplier ");
            return $sql->result();

        }
        

        public function f_get_byDateRenReport($curr_dt)
        {

            $sql = $this->db->query(" SELECT * FROM `td_stm_renewal` 
                                    WHERE effective_dt <= (SELECT max(effective_dt)
                                    from   td_stm_renewal
                                    where  effective_dt <= '$curr_dt') ");

            return $sql->result();

        }


        public function f_get_projectReportData()
        {

            $sql = $this->db->query(" SELECT a.name AS project, a.phn_no, a.address, GROUP_CONCAT(c.name) AS suppliers 
                                    FROM md_stn_project a, md_stn_project_dtls b, md_stn_supplier c
                                    WHERE a.project_cd = b.project_cd
                                    AND b.supplier_cd = c.sl_no 
                                    GROUP BY a.name, a.phn_no, a.address ");
            
            return $sql->result();

        }
		
    public function f_get_bill_data(){
        
        $sql = $this->db->query("select a.trans_dt ,b.td_stn_pbsb_detail_id,sum(b.s_bill_amt) as s_bill_amt,sum(b.p_bill_amt) as p_bill_amt 
                FROM td_stn_pbsb_detail a,td_stn_pbsb_details b 
                where a.id = b.td_stn_pbsb_detail_id
                group by b.td_stn_pbsb_detail_id order by a.trans_dt desc");
                
        return $sql->result();
    }
		
    public function bill_detail_update($td_stn_pbsb_detail_id,$td_stn_pbsb_details_id,$project,$order_no,$s_bill_no,$s_bill_dt,$s_taxable_value,$gst_rate,$s_cgst,$s_sgst, $s_bill_amt,$p_bill_no,$p_bill_dt,$p_taxable_value,$p_cgst,$p_sgst,$p_bill_amt,$Unit_count,$gross_total,$sort,$rate)
    {
			$tot_gst   = 0;
			$less_gst = 0;
			$tot_less_calculate_gst  = 0;
			$confed_margin = 0 ;
			$after_confed_margin  = 0 ;
			$add_gst  = 0;
            for($j=0; $j<$Unit_count ; $j++)
            {
			$where = array( 'td_stn_pbsb_details_id'  => $td_stn_pbsb_details_id[$j],
							'td_stn_pbsb_detail_id'  => $td_stn_pbsb_detail_id );	
            $value = array( 
							'project_cd'    => $project[$j],
							'c_order_no'    => $order_no[$j],
							's_bill_no'     => $s_bill_no[$j],
                            's_bill_dt'     => $s_bill_dt[$j],
							's_taxable_value' => $s_taxable_value[$j],
							'gst_rate'      => $gst_rate[$j],
							's_cgst'        => $s_cgst[$j],
							's_sgst'        => $s_sgst[$j],
                            's_bill_amt'    => $s_bill_amt[$j],
                            'p_bill_no'     => $p_bill_no[$j],
                            'p_bill_dt'     => $p_bill_dt[$j],
							'p_taxable_value' => $p_taxable_value[$j],
							'p_cgst'        => $p_cgst[$j],
							'p_sgst'        => $p_sgst[$j],
                            'p_bill_amt'    => $p_bill_amt[$j],
                            'modified_by'    => $this->session->userdata('loggedin')->user_name,
							'modified_dt'    => date('y-m-d H:i:s')							);
            $tot_gst   = $s_cgst[$j]+$s_sgst[$j];
			$less_gst += round($tot_gst-(($tot_gst*$rate)/100));
			$this->db->where($where);
			$this->db->update('td_stn_pbsb_details', $value);			
            }
			
			$tot_less_calculate_gst= $gross_total-$sort-$less_gst;
			$confed_margin = round($tot_less_calculate_gst*.06);
            $add_gst  =round($less_gst-($less_gst*.06));
			
			$data =  array('less_gst' => $less_gst ,
							'confed_margin' => $confed_margin ,
							'add_gst' => $add_gst ,
			               );
			$this->db->where('id',$td_stn_pbsb_detail_id);
			$this->db->update('td_stn_pbsb_detail',$data);
    }
    public function mr_detail_entry($paymentkey,$trans_dt,$mr_no,$mr_dt,$bank,$acc_no,$trans_mode,$pay_dt,$mr_amt,$amt,$Unit_count,$created_by,$created_dt)
    {
        for($j=0; $j<$Unit_count ; $j++)
        {
        $value = array( 'payment_key'  => $paymentkey,
                        'trans_dt'      => $trans_dt,
                        'mr_no'         => $mr_no[$j],
                        'mr_dt'         => $mr_dt[$j],
                        'bank'          => $bank,
                        'trans_mode'    => $trans_mode[$j],
                        'pay_dt'        => $pay_dt[$j],
                        'mr_amt'        => $mr_amt[$j],
                        'amt'           => $amt[$j],
                        'created_by'    => $created_by,
                        'created_dt'    => $created_dt
                        );
        $this->db->insert('td_stn_pbsb_mrdetail', $value);  
        }
    }

    //For selecting row

    public function gst_report($supplier_id,$startDt,$endDt,$gstrt)
    {   $and = '';
        if($gstrt !=''){
        $and .= "and a.gst_rate='$gstrt' ";
        }

        $sql = $this->db->query("SELECT a.c_order_no,SUM(a.s_taxable_value) s_taxable_value,SUM(a.s_cgst) s_cgst ,SUM(a.s_sgst) s_sgst,SUM(a.s_bill_amt) s_bill_amt,SUM(a.p_taxable_value) p_taxable_value,SUM(a.p_cgst) p_cgst,SUM(a.p_sgst) p_sgst,SUM(a.p_bill_amt) p_bill_amt  FROM td_stn_pbsb_dtls a,td_stn_pbsb_payment_details b
        WHERE a.s_bill_no = b.s_bill_no
        AND a.vendor_id ='$supplier_id'
        and a.s_bill_dt >= '$startDt' 
        AND a.s_bill_dt <= '$endDt' $and group by a.c_order_no");
        return $sql->result();

    }

    public function bill_detail_entry($trans_dt,$project,$vendor_id,$product,$s_bill_no,$s_bill_dt,$qty,$s_taxable_value,$gst_rate,$s_cgst,$s_sgst, $s_bill_amt,$p_bill_no,$p_bill_dt,$p_taxable_value,$p_cgst,$p_sgst,$p_bill_amt,$Unit_count)
    {
        $error ='';
        $sql = $this->db->query("SELECT ifnull(max(`bulk_trans_id`),0)bulk_trans_id FROM `td_stn_pbsb_dtls`");
        $trans_do =  $sql->row();
        $bulk_trans_id = ($trans_do->bulk_trans_id) + 1;
        $sqlacc = $this->db->query("SELECT acc_code FROM md_stn_supplier where sl_no = $vendor_id ");
        $acc    = $sqlacc->row();
        $acccode = $acc->acc_code;
        $sqldracc = $this->db->query("SELECT acc_code FROM md_stn_project where project_cd = $project ");
       $dracc    = $sqldracc->row();
       $draccode = $dracc->acc_code;
       if($acccode != ''  &&  $draccode != ''){ 
        $pur_api_data = array(
            "br_nm"=> "SMBK",
            "trans_dt"=> $trans_dt,
            "br_cd"=> "337",
            "trans_do"=> $bulk_trans_id,
            "unit_id" => 1,
            'cr_acc_code'=> $acccode,
            "cgst"=> array_sum($p_cgst),
            "sgst"=> array_sum($p_cgst),
            "tot_amt"=>array_sum($p_bill_amt),
            "taxable_amt"=>array_sum($p_taxable_value),
            "rem"=>"GOVT TRANSACTION",
            "created_dt"=> date('y-m-d H:i:s'),
            "created_by"=> $this->session->userdata('loggedin')->user_name
        );
        $this->ApiVoucher->f_purchase_jouranl($pur_api_data);
       
        $sale_api_data = array(
            "br_nm"=> "SMBK",
            "trans_dt"=> $trans_dt,
            "br_cd"=> "337",
            "trans_do"=> $bulk_trans_id,
            "unit_id" => 1,
            'dr_acc_code'=> $draccode,
            "cgst"=> array_sum($s_cgst),
            "sgst"=> array_sum($s_cgst),
            "tot_amt"=>array_sum($s_bill_amt),
            "taxable_amt"=>array_sum($s_taxable_value),
            "rem"=>"GOVT TRANSACTION",
            "created_dt"=> date('y-m-d H:i:s'),
            "created_by"=> $this->session->userdata('loggedin')->user_name
        );
        
        $this->ApiVoucher->f_sale_jouranl($sale_api_data);
        for($j=0; $j<$Unit_count ; $j++)
        {
        $value = array('trans_dt'       => $trans_dt,
                        'bulk_trans_id' => $bulk_trans_id,
                        'project_cd'    => $project,
                        'vendor_id'     => $vendor_id,
                        'prod_id'       => $product[$j],
                        's_bill_no'     => $s_bill_no[$j],
                        's_bill_dt'     => $s_bill_dt[$j],
                        'qty'           => $qty[$j],
                        's_taxable_value'  => $s_taxable_value[$j],
                        'gst_rate'      => $gst_rate[$j],
                        's_cgst'        => $s_cgst[$j],
                        's_sgst'        => $s_sgst[$j],
                        's_bill_amt'    => $s_bill_amt[$j],
                        'p_bill_no'     => $p_bill_no[$j],
                        'p_bill_dt'     => $p_bill_dt[$j],
                        'p_taxable_value'  => $p_taxable_value[$j],
                        'p_cgst'        => $p_cgst[$j],
                        'p_sgst'        => $p_sgst[$j],
                        'p_bill_amt'    => $p_bill_amt[$j],
                        'created_by'    => $this->session->userdata('loggedin')->user_name,
                        'created_dt'    => date('y-m-d H:i:s')
                    );

                $this->db->insert('td_stn_pbsb_dtls', $value);      
            // $query = $this->db->get_where('td_stn_pbsb_dtls', array('s_bill_no' => $s_bill_no[$j]));
            // $count = $query->num_rows();
            // if ($count === 0) {
            // $query = $this->db->insert('td_stn_pbsb_dtls', $value); 
            // }else{
            //     $error .=$s_bill_no[$j].',';
            // }
                    
         }
        }else{
            $error ='Account code not found';
        }

        return $error;
    }
    public function f_get_mrlist(){
		
		$sql = $this->db->query("SELECT sum(a.amt) as amt,a.trans_dt,b.id,`c`.`name` FROM `td_stn_pbsb_mrdetail` `a`, `td_stn_pbsb_payment` `b`, `md_stn_supplier` `c` WHERE `a`.`payment_key` = `b`.`id` AND `b`.`vendor_id` = `c`.`sl_no`  group by a.trans_dt,b.id,c.name order by a.trans_dt desc");
		return $sql->result();
		
	}
    public function f_get_adv_mrlist(){
		
		$sql = $this->db->query("SELECT sum(a.amt) as amt,a.trans_dt,b.id,`c`.`name` FROM `td_stn_pbsb_mrdetail` `a`, `td_stn_pbsb_payment` `b`, `md_stn_supplier` `c` WHERE `a`.`payment_key` = `b`.`id` AND `b`.`vendor_id` = `c`.`sl_no` and b.bill_status='0' group by a.trans_dt,b.id,c.name order by a.trans_dt desc");
		return $sql->result();
		
	}
    public function f_get_totpaymentprojectwise($fr_dt,$to_dt){
		
		$sql = $this->db->query("SELECT sum(a.s_bill_amt) as s_bill_amt,b.name as vendor_name,a.vendor_id FROM td_stn_pbsb_dtls a left join md_stn_supplier b on b.sl_no = a.vendor_id WHERE a.trans_dt >= '$fr_dt' and a.trans_dt <= '$to_dt' group by a.vendor_id,b.name order by vendor_name asc");
		return $sql->result();
	}
    public function f_get_paymentmaidprojectwise($fr_dt,$to_dt){
		
		$sql = $this->db->query("SELECT sum(s_bill_amt) as s_bill_amt,vendor_id FROM td_stn_pbsb_dtls  WHERE bill_status ='1' AND
        trans_dt >= '$fr_dt' and trans_dt <= '$to_dt' group by vendor_id");
		return $sql->result();
		
	}
    public function f_get_totpaymentvendorwise($fr_dt,$to_dt){
		
		$sql = $this->db->query("SELECT sum(a.s_taxable_value) as s_taxable_value,sum(a.s_cgst) as s_cgst,sum(a.s_sgst) as s_sgst,sum(a.s_bill_amt) as s_bill_amt,sum(a.p_taxable_value) as p_taxable_value,sum(a.p_cgst) as p_cgst,sum(a.p_bill_amt) as p_bill_amt,b.name as vendor_name,a.vendor_id FROM td_stn_pbsb_dtls a left join md_stn_supplier b on b.sl_no = a.vendor_id WHERE a.trans_dt >= '$fr_dt' and a.trans_dt <= '$to_dt' group by a.vendor_id,b.name order by name asc");
		return $sql->result();
	}
}

?>