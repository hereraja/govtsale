<script>

    function printDiv() {
        var divToPrint=document.getElementById('divToPrint');

        var WindowObject=window.open('','Print-Window');
        WindowObject.document.open();
        WindowObject.document.writeln('<!DOCTYPE html>');
        WindowObject.document.writeln('<html><head><title></title><style type="text/css">');
        WindowObject.document.writeln('@media print { .center { text-align: center;}' +
            '                                         .inline { display: inline; }' +
									  '@page  { margin-top: 3cm   }' +
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
            <?php
			$tot_pay = 0.00;
			$order_number = '';
			$project_name = '';
			$c_order_no = array_unique(array_column($purchase_sale_details,'c_order_no'));
			$projects = array_unique(array_column($purchase_sale_details,'name'));
			$order_number = implode(",", $c_order_no);
			$project_name = implode(",", $projects);
			
			?>
            <p style="font-size:16px"><?php 
            if(isset($vendor->name)) { echo $vendor->name; }?> has submitted following bills for payment against supply of stationery goods to <?=$project_name?> office order no .- <?=$order_number?> </p>
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

                    <?php $i = 0 ;$tot_qty = 0.00;$tot_pb_amt = 0.00;$tot_sb_amt = 0.00;$tot_qty = 0.00;$sb_less_amt =0.00;$pb_gst = 0.00;
                        foreach($purchase_sale_details as $key)
                        {    $pb_gst += $key->p_cgst;
                        ?>
                            <tr>
                                <td><?php echo ++$i; ?></td>
                                <td><?php echo ($key->s_bill_no); ?></td>
                                <td><?php echo date("d.m.y",strtotime($key->s_bill_dt)); ?></td>
                                <td><?php echo($key->s_bill_amt); $tot_sb_amt += $key->s_bill_amt;?></td>
                                <td><?php echo($key->p_bill_no); ?></td>
                                <td><?php echo date("d.m.y",strtotime($key->p_bill_dt)); ?></td> 								
                                <td><?php echo($key->p_bill_amt); $tot_pb_amt += $key->p_bill_amt; ?></td>
                                <td><?php echo($key->name); ?></td>
                                
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
								  <td >Short Received</td>
                                  <td><?php if(isset($vendor->sb_less_amt)) { echo round($vendor->sb_less_amt); }?></td>
								  <td></td>
								  <td></td>
								  <td><?php if(isset($vendor->pb_less_amt)) { echo round($vendor->pb_less_amt); }?></td>
								  <td></td>
							</tr>
						    <tr>
								<td colspan='3'>Total</td>
                                <td><?php echo round($tot_sb_amt -round($vendor->sb_less_amt)); ?></td>
							    <td colspan='2'></td>
								<td><?php echo round($tot_pb_amt -round($vendor->pb_less_amt)); ?></td>
								<td></td>
							</tr>
                    
                    </tbody>
					

                </table>

            </div>
			<br>
			<h4>We have Receive Payment from above office through NEFT</h4>
			<br>
			<div>

                <table class="table table-bordered" style="width:90%;margin-left:5%" id="htmltable">
                  
                    <thead style = "text-align: center">
                        <tr>
                            <td>M.R.No </td>  
                            <td>Date</td>
                            <td>Mode of payment</td>
                            <td>Name of the Bank</td>
                            <td>Account No</td>
                            <td>Encashed Date</td>
                            <td>MR Amount</td>
                            <td>Effective Amount</td>
                        <!--    <td>Net Amount</td> -->
                           
                            
                        </tr>
                    </thead>

                    <tbody style = "text-align: center">

                    <?php $i = 0 ;
					      $tot_amnt_cr = 0.00;
                          $mr_amt = 0.00;
                        foreach($mr_details as $key)
                        {
                        ?>
                            <tr>
                                <td><?php echo($key->mr_no); ?></td>
                                <td><?php echo date("d.m.y",strtotime($key->mr_dt)); ?></td>
                                <td><span style="text-transform: uppercase;"><?php echo($key->trans_mode); ?></span></td>
                                <td><?php echo($key->bank_name); ?></td>
                                <td>..<?php echo($key->acc_no); ?></td>
                                <td><?php echo date("d.m.y",strtotime($key->pay_dt)); ?></td>
                                <td><?php echo ($key->mr_amt); $mr_amt += $key->mr_amt;  ?></td>
                                <td><?php echo ($key->amt); $tot_amnt_cr += $key->amt;  ?></td>
                           
                            </tr>

                    <?php
                        }
                        ?>
                        <tr><td colspan='6'>Total</td><td><?=$mr_amt?></td><td><?=$tot_amnt_cr?></td></tr>
                    </tbody>

                </table>

            </div>
         <br><br>
         <?php 	$payment = $tot_amnt_cr- (round($tot_sb_amt*.01)); ?>
        <p style="font-size:18px;word-wrap: break-word;"> As per above mentioned bills are checked and verified with challan,M.R etc. An amount of Rs.<?=$tot_amnt_cr?> Received through NEFT.Which is made towards supplier of taxable & nontaxable item vide sale bill Sl.No 
        
         <?php  $sllemgth = ''; $k = 1; 
         foreach($purchase_sale_details as $key) { 
            $sllemgth .= $k++.',';
             ?>
                          
            <?php }
            echo rtrim($sllemgth,",");
			?></p>
		 <p style="margin-bottom:5%"></p>              					
           
                   

         <p style="font-size:16px">So the payment made as follows</p>  
            <!-- <table class="table" style="margin: 0px auto;">
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
						   <td>Confed Margin(6%)</td>
						   <td style="padding-left:20px"><?php if(isset($vendor->margin)){ echo $vendor->margin;}  ?></td>
					    </tr>
						<tr> 
						   <td></td>
						   <td></td>
						   <td style="padding-left:20px"><?php echo $tot_sb_amt-$sb_less_amt-($vendor->less_gst)-($vendor->margin);  ?></td>
					    </tr>
				<?php if($pb_gst > 1 ) { ?>
						<tr> 
						   <td>Add </td>
						   <td>Gst</td>
						   <td style="padding-left:20px"><?php if(isset($vendor->add_gst)){ echo $vendor->add_gst;}  ?></td>
					    </tr>
				<?php } ?>
						<tr> 
						   <td></td>
						   <td></td>
						   <td style="padding-left:20px">
							   <?php  ?>
							<?php 
							   if($pb_gst > 1 ) {
							   echo $tot_sb_amt-$sb_less_amt-($vendor->less_gst)-($vendor->margin)+($vendor->add_gst);
							$tot_pay = $tot_sb_amt-$sb_less_amt-($vendor->less_gst)-($vendor->margin)+($vendor->add_gst);
							   }else{
								   
							   // echo $tot_sb_amt-$sb_less_amt-($vendor->less_gst)-($vendor->margin);
							$tot_pay = $tot_sb_amt-$sb_less_amt-($vendor->less_gst)-($vendor->margin);
								   
							   }
							   ?>
							</td>
					    </tr>
				   </table> -->
            </div>

            <div class="col-lg-12 container contant-wraper" style="margin-top:0px">
            <p style="font-size:20px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;So,Payment may be consider for Rs <?=number_format($tot_sb_amt,2)?> (<?=getIndianCurrency($tot_sb_amt)?>) Only in favour of <?php if(isset($vendor->name)) { echo $vendor->name; }?>Subject to approval of CEO.<br>&nbsp;&nbsp;&nbsp;&nbsp;<p>
          
            <p style="text-align:center;font-size:18px">Place for Signature.</p>
           </div>
    </div>
</div>

   <div class="modal-footer">

                <button class="btn btn-primary" type="button" onclick="location.href='<?php echo base_url('index.php/stationary/payment');?>'">Back</button>
                <?php if($vendor->bill_status == 1 ) { ?>
               <button class="btn btn-primary" type="button" onclick="printDiv();">Print</button>
               <?php } ?>
           </div>



<script type="text/javascript">
    $(function () {
        $("#btnExport").click(function () {
            $("#htmltable").table2excel({
                filename: "Delivery Details From: <?php //echo date("d-m-Y", strtotime($startDt)).' To '.date("d-m-Y", strtotime($endDt) );?>.xls"
            });
        });
    });
</script>