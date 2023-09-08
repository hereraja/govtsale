<script>

    function printDiv() {
        var divToPrint=document.getElementById('divToPrint');

        var WindowObject=window.open('','Print-Window');
        WindowObject.document.open();
        WindowObject.document.writeln('<!DOCTYPE html>');
        WindowObject.document.writeln('<html><head><title></title><style type="text/css">');


        WindowObject.document.writeln('@media print { .center { text-align: center;}' +
            '                                         .inline { display: inline; }' +
            '                                         .underline { text-decoration: underline; }' +
            '                                         .left { margin-left: 315px;} ' +
            '                                         .right { margin-right: 375px; display: inline; }' +
            '                                          table, th, td { border: 1px solid black; border-collapse: collapse; }' +
            '                                           th, td { padding: 5px; }' +
            '                                         .border { border: 1px solid black; } ' +
            '                                         .bottom { bottom: 5px; width: 100%; position: fixed; ' +
            '                                       ' +
            '                                   } } </style>');
        // WindowObject.document.writeln('<style type="text/css">@media print{p { color: blue; }}');
        WindowObject.document.writeln('</head><body onload="window.print()">');
        WindowObject.document.writeln(divToPrint.innerHTML);
        WindowObject.document.writeln('</body></html>');
        WindowObject.document.close();
        setTimeout(function(){ WindowObject.close();},10);

    }

</script>



<div id="divToPrint">

    <div class="wraper"> 

        <div class="col-lg-12 container contant-wraper">

            <div class="panel-heading">

                <div class="item_body">

                    <div style="text-align:center;">

                        <h3>WEST BENGAL STATE MULTIPURPOSE CONSUMERS' CO-OPERATIVE FEDERATION LTD.</h3>

                        <h3>P-1, Hide Lane, Akbar Mansion, 3rd Floor, Kolkata-700073</h3>

                        <h4>Oil Payment Sheet For: <?php echo $payment_key; ?> </h4>
                        
                    </div>

                </div>

            </div>

            <br>
            
            <div>

                <table class="table table-striped" style="width: 100%;">
                    
                    <thead style = "text-align: center">
                        <tr>
                            
                            <td><strong>Sl No</strong></td>       
                            <td><strong>PB No</strong></td>
                            <td><strong>Date</strong></td>
                            <td><strong>M.Oil</strong></td>
                            <td><strong>Bill Amount</strong></td>
                            <td><strong>SB No</strong></td>
                            <td><strong>Date</strong></td>
                            <td><strong>Bill Amount</strong></td>
                            <td><strong>Project</strong></td>
                            
                        </tr>
                    </thead>

                    <tbody style = "text-align: center">

                    <?php 
                        foreach($table1_data as $key1)
                        {
                        ?>
                            <tr>
                        
                                <td><?php echo ($key1->sl_no); ?></td> 
                                <td><?php echo ($key1->pb_no); ?></td>
                                <td><?php echo date("d-m-y",strtotime($key1->pb_dt)); ?></td> 
                                <td><?php echo ($key1->del_qty); ?></td> 
                                <td><?php echo ($key1->pb_amnt); ?></td>
                                <td><?php echo ($key1->sb_no); ?></td>
                                <td><?php echo date("d-m-y",strtotime($key1->sb_dt)); ?></td>
                                <td><?php echo ($key1->sb_amnt); ?></td>
                                <td><?php echo ($key1->cdpo); ?></td>
                                
                            </tr>

                    <?php
                        }
                        ?>
                    
                    </tbody>


                    <tfoot style = "text-align: center">

                        <?php foreach($table1_footer_totData as $key2)
                        { ?>

                            <tr>
                                <td colspan="3" style="text-align: left;">
                                    <strong>TOTAL:</strong>
                                </td>
                                <td  style="text-align: center;">
                                    <strong><?php echo $key2->del_qty; ?></strong>
                                </td>
                                <td style="text-align: center;">
                                    <strong><?php echo $key2->pb_amnt; ?></strong>
                                </td>
                                <td></td>
                                <td></td>
                                <td style="text-align: center;">
                                    <strong><?php echo $key2->sb_amnt; ?></strong>
                                </td>
                                <td></td>
                            </tr> 

                        <?php } 
                            foreach($table1_footer_data as $key3){
                        ?>

                            <tr>
                            
                                <td colspan="4" style="text-align: left;">
                                    <strong>Shortage:</strong>
                                </td>
                                <td style="text-align: center;">
                                    (-)<?php echo $key3->oil_shortage; ?>
                                </td>
                                <td></td>
                                <td></td>
                                <td style="text-align: center;">
                                    (-)<?php echo $key3->oil_shortage; ?>
                                </td>
                                <td></td>
                                
                            </tr>

                            <tr>
                            
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td style="text-align: center;">
                                    <strong><?php echo $key3->tot_payable; ?></strong>
                                </td>
                                <td></td>
                                <td></td>
                                <td style="text-align: center;">
                                    <strong><?php echo $key3->tot_rcv; ?></strong>
                                </td>
                                <td></td>

                            </tr>

                        <?php } ?>

                    </tfoot>

                </table>

            </div>

            <br>

            <div>
            
                <table class="table table-striped" style="width: 100%;">
                
                    <thead style = "text-align: center">
                    
                        <tr>
                            <td><strong>MR NO</strong></td>
                            <td><strong>Date</strong></td>
                            <td><strong>Bank Name</strong></td>
                            <td><strong>Credited(Rs)</strong></td>
                            <td><strong>M.Oil</strong></td>
                            <td><strong>Credit Date</strong></td>
                            <td><strong>Project</strong></td>
                        </tr>       

                    </thead>

                    <tbody style = "text-align: center">
                        
                        <?php foreach($table2_Data as $key4)
                        { ?>
                        
                            <tr>
                                <td><?php echo $key4->mr_no; ?></td>
                            
                                <td><?php echo $key4->trans_dt; ?></td>
                            
                                <td><?php echo $key4->bank_name; ?></td>
                            
                                <td><?php echo $key4->amnt_cr; ?></td>
                            
                                <td><?php echo $key4->amnt_oil; ?></td>

                                <td><?php echo $key4->cr_dt; ?></td>

                                <td><?php echo $key4->cdpo; ?></td>
                            </tr>
                    
                        <?php } ?>

                    </tbody>
                
                </table>

            </div>

            <br>
            <div class="col-lg-6 container">
                            
                <h5>Less:</h5>
                <table class="table table-striped" style="width: 50%;">
                
                    <thead style = "text-align: center">
                    
                        <tr>
                            <td><strong>Output GST</strong></td>
                            <td><strong>CGST</strong></td>
                            <td><strong>SGST</strong></td>
                        </tr>
                    
                    </thead>

                        <?php 
                        
                            foreach($table3_Data as $key5)
                            {
                                $del_qty = $key5->del_qty; 
                                $del_amount = $table3_gstRate * $del_qty;
                                $gst = $key5->gst;
                                
                                $op_cgst = (((100+$gst)/100)*$del_amount)/2;
                                //echo $ip_cgst; die;
                            }

                        ?>

                    <tbody>
                    
                        <tr>
                            
                        </tr>

                    </tbody>

                </table>

            </div>

            <div class="col-lg-6 container">
                            
                <h5>Commission:</h5>
                <table class="table table-striped" style="width: 50%;">
                
                    <thead style = "text-align: center">
                    
                        <tr>
                            <td><strong>Rate</strong></td>
                            <td><strong>Qty</strong></td>
                            <td><strong>Margin</strong></td>
                        </tr>
                    
                    </thead>

                    <tbody>
                    
                        <tr>
                            
                        </tr>

                    </tbody>

                </table>

            </div>

            <div class="col-lg-6 container">
                            
                <h5>Add:</h5>
                <table class="table table-striped" style="width: 50%;">
                
                    <thead style = "text-align: center">
                    
                        <tr>
                            <td><strong>Input GST</strong></td>
                            <td><strong>CGST</strong></td>
                            <td><strong>SGST</strong></td>
                        </tr>
                    
                    </thead>

                    <tbody>
                    
                        <tr>
                            
                        </tr>

                    </tbody>

                </table>

            </div>


        </div>
    
    </div>

</div>


<div class="modal-footer">

    <button class="btn btn-primary" type="button" onclick="location.href='<?php //echo base_url('index.php/sw/oilPaymentReport');?>'">Back</button>

    <button class="btn btn-primary" type="button" onclick="printDiv();">Print</button>

</div>
