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

<div >
<?php if($_SERVER['REQUEST_METHOD']=="POST") { ?>
    <div class="wraper" id="divToPrint"> 

        <div class="col-lg-12 container contant-wraper">

            <div class="panel-heading">

                <div class="item_body">

                    <div style="text-align:center;">

                        <h3>WEST BENGAL STATE MULTIPURPOSE CONSUMERS' CO-OPERATIVE FEDERATION LTD.</h3>
                        <h3>P-1, Hide Lane, Akbar Mansion, 3rd Floor, Kolkata-700073</h3>
                        <h4><?php
                                foreach($suppliers as $key1)
                                { ?>
                                     <?php  if($key1->sl_no == $supplier_id) echo $key1->vendor_name; ?>
                                <?php
                                } ?>GST Details From: <?php echo date("d-m-y",strtotime($startDt)).' To: '.date("d-m-y",strtotime($endDt)) ; ?> </h4>
                        
                    </div>

                </div>

            </div>

            <br>
            
            <div>

                <table class="table table-bordered" style="width: 100%;">
                    <thead >
                       <tr>
                            <th rowspan='2' style = "vertical-align:middle;text-align: center;">Order No</th> 
                            <th colspan='4' style = "text-align: center">Sale Detail</th>
                            <th colspan='4' style = "text-align: center">Purchase Detail</th> 
                        </tr>
                        <tr>
                            <th style = "text-align: center">Sale Taxable</th> 
                            <th style = "text-align: center">Sale CGST</th>
                            <th style = "text-align: center">Sale SGST</th>
                            <th style = "text-align: center">Sale Amount</th>
                            <th style = "text-align: center">Purchase Taxable</th> 
                            <th style = "text-align: center">Purchase CGST</th>  
                            <th style = "text-align: center">Purchase SGST</th>
                            <th style = "text-align: center">Purchase Amount</th> 
                        </tr>
                    </thead>
                    <tbody style = "text-align: center">

                    <?php  $s_gst = 0.00; $p_gst =0.00;
                        foreach($report as $key)
                        {
                        ?>
                            <tr>
                                <td><?php echo($key->c_order_no); ?></td>
                                <td><?php echo($key->s_taxable_value); ?></td>  
                                <td><?php echo($key->s_cgst); $s_gst +=$key->s_cgst;?></td> 
                                <td><?php echo($key->s_sgst); //$s_gst +=$key->s_sgst;?></td>
                                <td><?php echo($key->s_bill_amt); ?></td>
                                <td><?php echo($key->p_taxable_value); ?></td> 
                                <td><?php echo($key->p_cgst); $p_gst +=$key->p_cgst;?></td>
                                <td><?php echo ($key->p_sgst);//$p_gst +=$key->p_sgst; ?></td>
                                <td><?php echo($key->p_bill_amt); ?></td>
                            </tr>
                    <?php
                        }
                        ?>

                        <tr style="font-weight:700">
                            <td >
                                <strong>TOTAL:</strong>
                            </td>
                            <td>Sale GST </td>
                            <td  colspan="2"  style="text-align: center;">
                                <?php echo round(($s_gst*2)); ?>
                            </td>
                            <td></td>
                            <td>Purchase GST</td>
                            <td  colspan="2"  style="text-align: center;">
                                <?php echo round(($p_gst*2)); ?>
                            </td>
                            <td></td>
                        </tr> 
                    </tbody>
                </table>
            </div>
        </div>
    
    </div>
    <div class="modal-footer">

    <button class="btn btn-primary" type="button" onclick="location.href='<?php echo base_url('index.php/sw/gstrpt');?>'">Back</button>

    <button class="btn btn-primary" type="button" onclick="printDiv();">Print</button>

    </div>
    <?php } else { ?>

        <div class="wraper">      

<div class="col-md-6 container form-wraper">

    <form role="form" method="POST" action= "<?php echo site_url('sw/gstrpt') ?>" >
        <div class="form-header">
            
            <h4>Date Wise Collection Report</h4>
        
        </div>
        <div class="form-group row">
            <label for="trans_dt" class="col-sm-2 col-form-label">Select Supplier.<font color="red">*</font></label>
			<div class="col-sm-6">
					<select name="supplier_id" id="supplier_id" class="form-control" required>
                            <option value="">Select Supplier</option>
                            <?php
                                foreach($suppliers as $key1)
                                { ?>
                                    <option value="<?php echo $key1->sl_no; ?>" <?php if(isset($bill_detail->supplier_id)) { if($bill_detail->supplier_id == $key1->sl_no) echo "selected" ; }?>><?php echo $key1->vendor_name; ?></option>
                                <?php
                                } ?>
                        </select> 
			</div>
        </div>

        <div class="form-group row">
            <label for="s_bill_dt" class="col-sm-2 col-form-label">From Date:<font color="red">*</font></label>
            
            <div class="col-sm-4">
                <input type="date" class="form-control" name="fr_dt" value=""  required/>
            </div>

            <label for="s_bill_dt" class="col-sm-2 col-form-label">To Date:<font color="red">*</font></label>
            
            <div class="col-sm-4">
                <input type="date" class="form-control" name="to_dt" value="<?php echo date('Y-m-d');?>" />
            </div>
        </div>
        <div class="form-group row">
            
        </div>
        <div class="form-group row">
            <label for="order_dt" class="col-sm-2 col-form-label">Gst Rate:<font color="red">*</font></label>
            <div class="col-sm-4">
                <select class="form-control" name="gst">
                <option value=''>Select</option>
                <option value='5'>5</option>
                <option value='12'>12</option>
                <option value='18'>18</option>

                </select>
                
            </div>
        </div>

        <div class="form-group row">

            <div class="col-sm-10">

                <button type="submit" class="btn btn-primary" >GO<i class="fa fa-angle-double-right fa-fw "></i></button>

            </div>

        </div>

    </form>

        
</div>

</div>

    <?php } ?>    


</div>


