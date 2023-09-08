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

                        <h3></h3><br>
                        <h3></h3><br>
                        <h4></h4>
                        
                    </div>

                </div>

            </div>
			<br>
			<?php
			$tot_pay = 0.00;
			$order_number = '';
			$project_name = '';
			$c_order_no = array_unique(array_column($sale_purchase,'c_order_no'));
			$projects = array_unique(array_column($sale_purchase,'name'));
			$order_number = implode(",", $c_order_no);
			$project_name = implode(",", $projects);
			
			?>
			<p style="font-size:16px"><?php if(isset($shortage->name)){ echo $shortage->name;}  ?> has submitted following bills for payment against supply of stationery goods to <?=$project_name?> office order no .- <?=$order_number?> </p>

            <br>

                <table class="table table-striped" style="width: 100%;">
                    <!-- <caption><hr><?php //echo 'Order No.: '.$order_no.' DT '.date("d-m-y",strtotime($order_dt)); ?></caption>
                    <caption><?PHP //echo 'Item: '.strtoupper($item); ?><hr></caption> -->
                    <thead style = "text-align: center">
                        <tr>
                            <th>Sl No</th>  
                            <th>Order No</th>
                            <th>sale bill No </th> 
							<th>sale bill dt</th>
							<!--<th>value</th> -->
						    <th>Sale CGST</th>  
                            <th>Sale SGST</th>  
                            <th>Sale Amount</th>
                            <th>Purchase Bill</th> 
                            <th>Purchase Date</th> 							
                            <th>Purchase CGST</th>  
                            <th>Purchase SGST</th>  
                            <th>Purchase Amount</th>
                           
                            
                        </tr>
                    </thead>

                    <tbody style = "text-align: center">

                    <?php
						$count = 1 ;
						$count_value = 0;
                        $tot_salebill = 0;
						$sale_value   = 0.00;
						$tot_purbill  = 0;
                        $sb_less_amt  = 0;
                        $pb_less_amt  = 0;

                    ?>

                    <?php 
                        foreach($sale_purchase as $key)
                        {
                        ?>
						<tr>
						  <td><?php echo $count; $count_value +=1; ?></td>
                          <td><?php if(isset($key->c_order_no)){ echo $key->c_order_no;}?></td>  
						  <td><?php if(isset($key->s_bill_no)){ echo $key->s_bill_no;}?></td>  
						  <td><?php if(isset($key->s_bill_dt)){ echo date("d.m.y",strtotime($key->s_bill_dt));}?></td>  
						  <td><?php if(isset($key->s_cgst)){ echo $key->s_cgst;}?></td>  
						  <td><?php if(isset($key->s_sgst)){ echo $key->s_sgst;}?></td>  
						  <td><?php if(isset($key->s_bill_amt)){ echo $key->s_bill_amt; $tot_salebill += $key->s_bill_amt;
									$sale_value += $key->s_bill_amt;
						  }?></td>  
						  <td><?php if(isset($key->p_bill_no)){ echo $key->p_bill_no;}?></td>  
						  <td><?php if(isset($key->p_bill_dt)){ echo date("d.m.y",strtotime($key->p_bill_dt));}?></td>  
						  <td><?php if(isset($key->p_cgst)){ echo $key->p_cgst;}?></td>  
						  <td><?php if(isset($key->p_sgst)){ echo $key->p_sgst;}?></td>  
						  <td><?php if(isset($key->p_bill_amt)){ echo $key->p_bill_amt; $tot_purbill += $key->p_bill_amt; }?></td>  
						</tr>
                    <?php
					$count++;
                        }
                        ?>
						
						<tr>
                         <td colspan="4"></td>
						 <td colspan="2"><b>Total</b></td>
						 <td><?php echo $tot_salebill; ?></td>
                         <td colspan="3"><td>
						 <td><?php echo $tot_purbill; ?></td>
                        </tr>
						<tr>
						 <td colspan="4"></td>
						 <td colspan="2">Short received</td>
						 <td><?php if(isset($shortage->sb_less_amt)){ echo $shortage->sb_less_amt; $sb_less_amt =$shortage->sb_less_amt;
						 }  ?></td>
						 <td colspan="3"></td>
                         <td>Short received</td>
						 <td><?php if(isset($shortage->pb_less_amt)){ echo $shortage->pb_less_amt;$pb_less_amt = $shortage->pb_less_amt;}?></td>
                        </tr>
						<tr>
						 <td colspan="4"></td>
						 <td colspan="2"></td>
						 <td><?php echo $tot_salebill-$sb_less_amt; ?></td>
                         <td colspan="3"><td>
						 <td><?php echo $tot_purbill-$pb_less_amt; ?></td>
                        </tr>
                    
                    </tbody>

                </table>
				
				<div class="form-header">
				<h4>We have Receive Payment from above office through NEFT</h4>
				</div>
				<br>
				<table class="table table-striped" style="width: 100%;">
                    <!-- <caption><hr><?php //echo 'Order No.: '.$order_no.' DT '.date("d-m-y",strtotime($order_dt)); ?></caption>
                    <caption><?PHP //echo 'Item: '.strtoupper($item); ?><hr></caption> -->
                    <thead style = "text-align: center">
                        <tr>
                            <th>MR No</th>
                            <th>Date </th> 
							<th>NEFT</th>
						    <th>Date</th>  
                            <th>Encash Date</th>  
                            <th>Amount</th>                          
                        
                        </tr>
                    </thead>

                    <tbody style = "text-align: center">

                    <?php  $tot_mr = 0 ; 
                        foreach($mr_detail as $key)
                        {
                        ?>
						<tr>
                          <td><?php if(isset($key->mr_no)){ echo $key->mr_no;}?></td>  
						  <td><?php if(isset($key->mr_dt)){ echo date("d.m.y",strtotime($key->mr_dt));}?></td>  
						  <td style="text-transform: uppercase;"><?php if(isset($key->trans_mode)){ echo $key->trans_mode;}?></td>  
						  <td><?php if(isset($key->pay_dt)){ echo date("d.m.y",strtotime($key->pay_dt));}?></td>  
						  <td><?php if(isset($key->pay_dt)){ echo date("d.m.y",strtotime($key->pay_dt));}?></td>  
						  <td><?php if(isset($key->amt)){ echo $key->amt; $tot_mr +=$key->amt; }?></td>
						</tr>
                    <?php
                        }
                        ?>
						<tr>
						  <td colspan="5"></td>
						  <td><?=$tot_mr?></td>
						  
						</tr>
                    
                    </tbody>
				<!--	<tfoot style = "text-align: center">

					</tfoot> -->

                </table>
				<br><br>
				<div class="form-group row">
					
					<div class="col-sm-12">
					As per above mention the bills are checked with challan,M.R. ,Requition etc and found ok.An amount of Rs <?=$tot_mr?> received through NEFT.The NEFT Payment made towards supplies of taxable item vide sale bill no .1 to <?=$count_value?>.as mention above.So the payment made as follows.
					</div>
				</div>
				<br><br>
				<div class="form-group row">
				<div class="col-sm-4"></div>
				<div class="col-sm-8">
				   <table class="table" style="margin: 0px auto;">
					    <tr><td> </td>
						   <td>Sale Value </td>
						   <td style="padding-left:20px"> <?php echo $sale_value; ?></td>
					    </tr>
						<tr> 
						   <td> </td>
						   <td>Short if any</td>
						   <td style="padding-left:20px"><?php echo $sb_less_amt;  ?></td>
					    </tr>
						<tr> 
						   <td> </td>
						   <td>MR Value</td>
						   <td style="padding-left:20px"><?php echo $sale_value-$sb_less_amt;  ?></td>
					    </tr>
						<tr> 
						   <td>Less </td>
						   <td>Gst</td>
						   <td style="padding-left:20px"><?php if(isset($shortage->less_gst)){ echo $shortage->less_gst;}  ?></td>
					    </tr>
						<tr> 
						   <td> </td>
						   <td></td>
						   <td style="padding-left:20px"><?php echo $sale_value-$sb_less_amt-$shortage->less_gst;  ?></td>
					    </tr>
						<tr> 
						   <td>Less </td>
						   <td>Confed Margin(6%)</td>
						   <td style="padding-left:20px"><?php if(isset($shortage->confed_margin)){ echo $shortage->confed_margin;}  ?></td>
					    </tr>
						<tr> 
						   <td></td>
						   <td></td>
						   <td style="padding-left:20px"><?php echo $sale_value-$sb_less_amt-($shortage->less_gst)-($shortage->confed_margin);  ?></td>
					    </tr>
						<tr> 
						   <td>Add </td>
						   <td>Gst</td>
						   <td style="padding-left:20px"><?php if(isset($shortage->add_gst)){ echo $shortage->add_gst;}  ?></td>
					    </tr>
						<tr> 
						   <td></td>
						   <td></td>
						   <td style="padding-left:20px"><?php echo $sale_value-$sb_less_amt-($shortage->less_gst)-($shortage->confed_margin)+($shortage->add_gst);
							$tot_pay = $sale_value-$sb_less_amt-($shortage->less_gst)-($shortage->confed_margin)+($shortage->add_gst);
						   ?></td>
					    </tr>
				   </table>
				</div>
				</div>

        </div>
		<div class="col-lg-12 container contant-wraper" style="margin-top:100px">
		
		<p style="font-size:18px">So,Rs <?=$tot_pay?>(<?=getIndianCurrency($tot_pay)?>) may be paid in favour of <?php if(isset($shortage->name)){ echo $shortage->name;}  ?><br>Put up to CEO through Deputy Manager for necessary approval please.<p>
		
		
		
		<p style="margin-top:400px;font-size:18px">Prepared payment of ,Rs <?=$tot_pay?>(<?=getIndianCurrency($tot_pay)?>) in favour of <?php if(isset($shortage->name)){ echo $shortage->name;}  ?> through payment sheet from Axis Bank Ltd.G.C.Avenue.<p>
		
		<p style="text-align:center">Place for Signature.</p>
		
		
		</div>
    
    </div>


</div>


<div class="modal-footer">

    <button class="btn btn-primary" type="button" onclick="location.href='<?php echo base_url('index.php/stationary/billReport');?>'">Back</button>

    <button class="btn btn-primary" type="button" onclick="printDiv();">Print</button>

</div>
