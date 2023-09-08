<?php 
/*********************************************************************************************** *
/* Model for API connection bentween FErtilizer and Finance modulev                              *
 * Transactions is fertilizer module and corresponding accounting voucher in Finance Module      *
 *************************************************************************************************/

class ApiVoucher extends CI_Model{

    /**Function for Company Advance Payment in HO */


    function f_purchase_jouranl($data){
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://bkpczwccsl.com/finance/index.php/api_voucher/gov_pur_voucher',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
            "data": '.json_encode($data).'
            }',
        
            CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Cookie: ci_session=eieqmu6gupm05pkg5o78jqbq97jqb22g'
            ),
        ));
        
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }
    function f_sale_jouranl($data){
     
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://bkpczwccsl.com/finance/index.php/api_voucher/gov_sale_voucher',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
            "data": '.json_encode($data).'
            }',
        
            CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Cookie: ci_session=eieqmu6gupm05pkg5o78jqbq97jqb22g'
            ),
        ));
        
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }
    function f_vendorpayment_jouranl($data){
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://bkpczwccsl.com/finance/index.php/api_voucher/vendorpayment_jouranl',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
            "data": '.json_encode($data).'
            }',
        
            CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Cookie: ci_session=eieqmu6gupm05pkg5o78jqbq97jqb22g'
            ),
        ));
        
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }
    function f_customerpayment_jouranl($data){
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://bkpczwccsl.com/finance/index.php/api_voucher/customerpayment_jouranl',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
            "data": '.json_encode($data).'
            }',
        
            CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Cookie: ci_session=eieqmu6gupm05pkg5o78jqbq97jqb22g'
            ),
        ));
        
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    function f_delete_gov_transaction_jouranl($data){
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://bkpczwccsl.com/finance/index.php/api_voucher/delete_gov_transaction_jouranl',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
            "data": '.json_encode($data).'
            }',
        
            CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Cookie: ci_session=eieqmu6gupm05pkg5o78jqbq97jqb22g'
            ),
        ));
        
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

}
