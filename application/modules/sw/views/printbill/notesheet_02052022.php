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

                        <h3></h3>

                        <h3></h3>
                        
                    </div>

                </div>

            </div>
			<br>
			<p><?php 
            if(isset($vendor->vendor_name)) { echo $vendor->vendor_name; }?> has submitted following bills for payment against SUPPLIES OF ICDS FOOD STUFF to the ICDS Projects in the district of <?php if(isset($val->district_name)) { echo $val->district_name; }?> as per details below:-</p>
            <br>
          
            <div>

                <table class="table table-striped" style="width: 100%;" id="htmltable">
                  
                    <thead style = "text-align: center">
                        <tr>
                            
                            <td>SL No </td> 
                            <td>SALE BILL NO</td>
                            <td>DATE</td>
                            <td>BILL AMOUNT</td> 
                            <td>PBNO</td>  
                            <td>DATE</td>
                            <td>BILL AMOUNT</td>
                            <td>PROJECT</td>
                            
                        </tr>
                    </thead>

                    <tbody style = "text-align: center">

                    <?php $i = 0 ;$tot_qty = 0.00;$tot_pb_amt = 0.00;$tot_sb_amt = 0.00;$tot_qty = 0.00;$sb_less_amt =0.00;
                        foreach($purchase_sale_details as $key)
                        {
                        ?>
                            <tr>
                                <td><?php echo ++$i; ?></td>
                                <td><?php echo ($key->s_bill_no); ?></td>
                                <td><?php echo date("d.m.y",strtotime($key->s_bill_dt)); ?></td>
                                <td><?php echo($key->s_bill_amt); $tot_sb_amt += $key->s_bill_amt;?></td>
                                <td><?php echo($key->p_bill_no); ?></td>
                                <td><?php echo date("d.m.y",strtotime($key->p_bill_dt)); ?></td> 								
                                <td><?php echo($key->p_bill_amt); $tot_pb_amt += $key->p_bill_amt; ?></td>
                                
                                <td><?php echo($key->cdpo); ?></td>
                                
                            </tr>

                    <?php
                        }
                        ?>  
						    <tr><td colspan='3'>Total</td>
							<!--	<td><?php //echo $tot_qty; ?></td>  -->
                                <td><?php echo $tot_sb_amt; ?></td>
							    <td colspan='2'></td>
                                <td><?php echo $tot_pb_amt; ?></td>
								<td></td>
							     
							</tr>
							<tr>
							      <td></td>
								  <td></td>
								  <td >Shortage</td>
                                  <td><?php if(isset($vendor->sb_less_amt)) { echo $vendor->sb_less_amt; }?></td>
								  <td></td>
								  <td></td>
								  <td><?php if(isset($vendor->pb_less_amt)) { echo $vendor->pb_less_amt; }?></td>
								  <td></td>
							</tr>
						    <tr>
								<td colspan='3'>Total</td>
                                <td><?php echo $tot_sb_amt -($vendor->sb_less_amt); ?></td>
							    <td colspan='2'></td>
								<td><?php echo $tot_pb_amt -($vendor->pb_less_amt); ?></td>
								<td></td>
							</tr>
                    
                    </tbody>
					

                </table>

            </div>
			<br>
			<p style="text-align:center; font-size:14px;">Confed W.B. has received payment from the CDPO through the RTGS as per delails below:-</p>
			<br>
			<div>

                <table class="table table-bordered" style="width:80%;margin-left:5%" id="htmltable">
                  
                    <thead style = "text-align: center">
                        <tr>
                            <td>M.R.No </td>  
                            <td>DATE</td>
                            <td>NAME OF THE BANK</td>
                            <td>Amount Credited</td>
                            <td>Date of Credit</td>
						<!-- 	<td>Project</td>-->
                            
                        </tr>
                    </thead>

                    <tbody style = "text-align: center">

                    <?php $i = 0 ;
					      $tot_amnt_cr = 0.00;
                        foreach($mr_details as $key)
                        {
                        ?>
                            <tr>
                                <td><?php echo($key->mr_no); ?></td>
                                <td><?php echo date("d.m.y",strtotime($key->mr_dt)); ?></td>
                                <td><?php echo($key->bank_name); ?></td>
                                <td><?php echo ($key->amt); $tot_amnt_cr += $key->amt;  ?></td>
                                <td><?php echo date("d.m.y",strtotime($key->pay_dt)); ?></td>
                            <!--     <td><?php //if(isset($key->project)) echo $key->project; ?></td> -->
                                
                            </tr>

                    <?php
                        }
                        ?>
                        <tr><td colspan='3'>Total</td><td><?=$tot_amnt_cr?></td></tr>
                    </tbody>

                </table>

            </div>
			

         <br>
		 <p style="margin-bottom:5%"></p>              					
            <?php 	$payment = $tot_amnt_cr- (round($tot_sb_amt*.01)); ?>
                   

           
            <table class="table" style="margin: 0px auto;">
					    <tr><td> </td>
						   <td>Sale Value </td>
						   <td style="padding-left:20px"> <?php echo $tot_sb_amt; ?></td>
					    </tr>
						<tr> 
						   <td> </td>
						   <td>Short if any</td>
						   <td style="padding-left:20px"><?php if(isset($vendor->sb_less_amt)) { echo $vendor->sb_less_amt; 
                            $sb_less_amt = $vendor->sb_less_amt; }?></td>
					    </tr>
						<tr> 
						   <td> </td>
						   <td>MR Value</td>
						   <td style="padding-left:20px"><?php echo $tot_sb_amt-$sb_less_amt;  ?></td>
					    </tr>
						<tr> 
						   <td>Less </td>
						   <td>Gst</td>
						   <td style="padding-left:20px"><?php if(isset($vendor->less_gst)){ echo $vendor->less_gst;}  ?></td>
					    </tr>
						<tr> 
						   <td> </td>
						   <td></td>
						   <td style="padding-left:20px"><?php echo $tot_sb_amt-$sb_less_amt-$vendor->less_gst;  ?></td>
					    </tr>
						<tr> 
						   <td>Less </td>
						   <td>Confed Margin(1%)</td>
						   <td style="padding-left:20px"><?php if(isset($vendor->confed_margin)){ echo $vendor->confed_margin;}  ?></td>
					    </tr>
						<tr> 
						   <td></td>
						   <td></td>
						   <td style="padding-left:20px"><?php echo $tot_sb_amt-$sb_less_amt-($vendor->less_gst)-($vendor->confed_margin);  ?></td>
					    </tr>
						<tr> 
						   <td>Add </td>
						   <td>Gst</td>
						   <td style="padding-left:20px"><?php if(isset($vendor->add_gst)){ echo $vendor->add_gst;}  ?></td>
					    </tr>
						<tr> 
						   <td></td>
						   <td></td>
						   <td style="padding-left:20px"><?php echo $tot_sb_amt-$sb_less_amt-($vendor->less_gst)-($vendor->confed_margin)+($vendor->add_gst);
							$tot_pay = $tot_sb_amt-$sb_less_amt-($vendor->less_gst)-($vendor->confed_margin)+($vendor->add_gst);
						   ?></td>
					    </tr>
				   </table>
		 <p style="margin-left:2%">Now Payment may be considered for Rs. <?=$payment?>/- Subject to approval of C.E.O. put up through A/c's for N.A.</p>	
        </div>
    
    </div>

</div>
   <div class="modal-footer">

                <button class="btn btn-primary" type="button" onclick="location.href='<?php echo base_url('index.php/sw/billShortage');?>'">Back</button>
               <button class="btn btn-primary" type="button" onclick="printDiv();">Print</button>
           </div>



<script type="text/javascript">
    $(function () {
        $("#btnExport").click(function () {
            $("#htmltable").table2excel({
                filename: "Delivery Details From: <?php echo date("d-m-Y", strtotime($startDt)).' To '.date("d-m-Y", strtotime($endDt) );?>.xls"
            });
        });
    });
</script>