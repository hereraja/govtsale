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

                        <h4>Bill Details  <?php //echo date("d-m-y",strtotime($startDt)).' To: '.date("d-m-y",strtotime($endDt)) ; ?> </h4>
                        
                    </div>

                </div>

            </div>

            <br>

                <table class="table table-striped" style="width: 100%;">
                    <!-- <caption><hr><?php //echo 'Order No.: '.$order_no.' DT '.date("d-m-y",strtotime($order_dt)); ?></caption>
                    <caption><?PHP //echo 'Item: '.strtoupper($item); ?><hr></caption> -->
                    <thead style = "text-align: center">
                        <tr>
                              
                            <th>Order No</th>
                            <th>sale bill No </th> 
							<th>Taxable value</th>
						    <th>Sale CGST</th>  
                            <th>Sale SGST</th>  
                            <th>Sale Amount</th>
                            <th>Purchase Bill</th>
                            <th>Taxable value</th>							
                            <th>Purchase CGST</th>  
                            <th>Purchase SGST</th>  
                            <th>Purchase Amount</th>
                           
                            
                        </tr>
                    </thead>

                    <tbody style = "text-align: center">

                    <?php

                        $tot_salebill = 0;
						$sale_value   = 0.00;
						$tot_purbill  = 0;
                        $sb_less_amt  = 0;
                        $pb_less_amt  = 0;
						$gross        = 0;
						$rate         = 0;

                    ?>

                    <?php 
                        foreach($sale_purchase as $key)
                        {
                        ?>
						<tr>
                          <td><?php if(isset($key->c_order_no)){ echo $key->c_order_no;}?></td>  
						  <td><?php if(isset($key->s_bill_no)){ echo $key->s_bill_no;}?></td>  
						  <td><?php if(isset($key->s_taxable_value)){ echo $key->s_taxable_value;}  ?></td>  
						  <td><?php if(isset($key->s_cgst)){ echo $key->s_cgst;}?></td>  
						  <td><?php if(isset($key->s_sgst)){ echo $key->s_sgst;}?></td>  
						  <td><?php if(isset($key->s_bill_amt)){ echo $key->s_bill_amt; $tot_salebill += $key->s_bill_amt;
									$sale_value += $key->s_bill_amt;
									$gross      += $key->s_bill_amt;
						  }?></td>  
						  <td><?php if(isset($key->p_bill_no)){ echo $key->p_bill_no;}?></td>  
						  <td><?php if(isset($key->p_taxable_value)){ echo $key->p_taxable_value;}?></td>  
						  <td><?php if(isset($key->p_cgst)){ echo $key->p_cgst;}?></td>  
						  <td><?php if(isset($key->p_sgst)){ echo $key->p_sgst;}?></td>  
						  <td><?php if(isset($key->p_bill_amt)){ echo $key->p_bill_amt; $tot_purbill += $key->p_bill_amt; }?></td>  
						</tr>
                    <?php
                        }
                        ?>
                    
                    </tbody>

                    <tfoot style = "text-align: center">

                        <tr>
                         <td>Total</td>
						 <td colspan="4"></td>
						 <td><?php echo $tot_salebill; ?></td>
                         <td colspan="4"></td>
						 <td><?php echo $tot_purbill; ?></td>
                        </tr>
						<tr>
						 <td colspan="3"></td>
						 <td colspan="2">Short received</td>
						 <td><?php if(isset($shortage->sb_less_amt)){ echo $shortage->sb_less_amt; $sb_less_amt =$shortage->sb_less_amt;
						 }  ?></td>
                         <td colspan="4"></td>
						 <td><?php if(isset($shortage->pb_less_amt)){ echo $shortage->pb_less_amt;$pb_less_amt = $shortage->pb_less_amt;}?></td>
                        </tr>
						<tr>
						 <td colspan="3"></td>
						 <td colspan="2"></td>
						 <td><?php echo $tot_salebill-$sb_less_amt; ?></td>
                         <td colspan="4"></td>
						 <td><?php echo $tot_purbill-$pb_less_amt; ?></td>
                        </tr>

                    </tfoot>

                </table>
				
				
				<br>
				<div class="form-header">
				<h4>Less Calculation Rate&nbsp;   <?php echo $rate = substr((100*$sb_less_amt)/$gross,0,7);    ?></h4>
				</div>
				<br>
				<div class="form-group row">
				
				 <table class="table table-striped" style="width: 100%;">
                    <!-- <caption><hr><?php //echo 'Order No.: '.$order_no.' DT '.date("d-m-y",strtotime($order_dt)); ?></caption>
                    <caption><?PHP //echo 'Item: '.strtoupper($item); ?><hr></caption> -->
                    <thead style = "text-align: center">
                        <tr>
						    <th>Gst Rate</th>
							<th>Taxable value</th>
						    <th>GST</th>
                            <th>Total</th>							
                            <th>Taxable value</th>							
                            <th>GST</th>
                            <th>Total</th>							
                        </tr>
                    </thead>

                    <tbody style = "text-align: center">

                    <?php
					    $taxable_amt =0.00;
						$less_taxable_amt = 0.00;
						$tot    =0.00;
						$less_taxable_tot = 0.00;
						$less_cal_tax_value = 0.00;
						$less_cal_gst_value = 0.00;
                        foreach($sale_purchase as $key)
                        {
                        ?>
						<tr>
                          <td><?php if(isset($key->gst_rate)){  echo $key->gst_rate; } ?></td>
						  <td><?php if(isset($key->s_taxable_value)){ echo round(($key->s_taxable_value)-(($key->s_taxable_value*$rate)/100));$less_cal_tax_value = round(($key->s_taxable_value)-(($key->s_taxable_value*$rate)/100)); 
						  $taxable_amt +=$less_cal_tax_value;
						  }?></td>  
						  <td><?php if(isset($key->s_cgst)){
							    echo round(($key->s_cgst+$key->s_sgst)-((($key->s_cgst+$key->s_sgst)*$rate)/100));
							  $less_cal_gst_value = round(($key->s_cgst+$key->s_sgst)-((($key->s_cgst+$key->s_sgst)*$rate)/100));
							  }
							  ?></td>
						  <td><?php echo ($less_cal_tax_value+$less_cal_gst_value); $tot +=($less_cal_tax_value+$less_cal_gst_value); ?></td>	  

						  <td><?php echo round($less_cal_tax_value-($less_cal_tax_value*.06)); $less_taxable_amt +=round($less_cal_tax_value-($less_cal_tax_value*.06)); ?></td>  
						  <td><?php echo round($less_cal_gst_value-($less_cal_gst_value*.06)); ?></td> 
                          <td><?php echo round($less_cal_tax_value-($less_cal_tax_value*.06))+ round($less_cal_gst_value-($less_cal_gst_value*.06)); $less_taxable_tot += round($less_cal_tax_value-($less_cal_tax_value*.06))+ round($less_cal_gst_value-($less_cal_gst_value*.06)); ?></td>							  
						 
						</tr>
                    <?php
					    $less_cal_tax_value=0.00;
						$less_cal_gst_value=0.00;
                        }
                        ?>
						<tr>
						<td>Total</td>
						<td><?=$taxable_amt?></td>
						<td></td>
						<td><?=$tot?></td>
						<td><?=$less_taxable_amt?></td>
						<td></td>
						<td><?=$less_taxable_tot?></td>
						</tr>
                    </tbody>

                  

                </table>

				</div>

        </div>
    </div>


</div>


<div class="modal-footer">

    <button class="btn btn-primary" type="button" onclick="location.href='<?php echo base_url('index.php/stationary/billReport');?>'">Back</button>

    <button class="btn btn-primary" type="button" onclick="printDiv();">Print</button>

</div>
