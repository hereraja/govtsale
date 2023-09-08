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

<?php if($_SERVER['REQUEST_METHOD']=="POST")  {   ?>
<div id="divToPrint">
    <div class="wraper"> 
        <div class="col-lg-12 container contant-wraper">
            <div class="panel-heading">
                <div class="item_body">
                    <div style="text-align:center;">

                        <h3>WEST BENGAL STATE MULTIPURPOSE CONSUMERS' CO-OPERATIVE FEDERATION LTD.</h3>
                        <h3>P-1, Hide Lane, Akbar Mansion, 3rd Floor, Kolkata-700073</h3>
                       
                    </div>
                </div>
            </div>
            <br>
            <div>
            <div class="row">
                <div class="col-md-2"><p><b>Project No.</b></p></div>
                <div class="col-md-4"><p><b><?php
									foreach($projects as $key1){
								   ?>
										 <?php if(isset($sbpb->project_cd)) { if($sbpb->project_cd == $key1->project_cd) echo $key1->name ; }?>
								<?php
									} 
								?></b></p></div>
            </div>
            <div class="row">
                <div class="col-md-2"><p><b>Order No.</b></p></div>
                <div class="col-md-4"><p><b><?php if(isset($sbpb->c_order_no)) echo $sbpb->c_order_no ;?></b></p></div>
            </div>
            <table class="table" >
					<thead>
						<tr>
						    
							<th>S Bill No.</th>
							<th>Date</th>
							<th>value</th>
							<th>GSt rate</th>
							<th>SGST</th>
							<th>CGST</th>
							<th>sale Value</th>
							<th>P Bill No.</th>
							<th>Date</th>
							<th>value</th>
							<th>SGST</th>
							<th>CGST</th>
							<th>Purchase Value</th>
						</tr>
					</thead>
		
					<tbody id="intro2" class="tables">
						<tr>
							<td><?php if(isset($sbpb->s_bill_no)) echo $sbpb->s_bill_no ;?></td>
							<td><?php if(isset($sbpb->s_bill_dt)) echo date('d/m/Y',strtotime($sbpb->s_bill_dt)) ;?></td>
							<td><?php if(isset($sbpb->s_taxable_value)) echo $sbpb->s_taxable_value;?></td>
							<td><?php if(isset($sbpb->gst_rate)) echo $sbpb->gst_rate ;?></td>
							<td><?php if(isset($sbpb->s_cgst)) echo $sbpb->s_cgst ;?></td>
							<td><?php if(isset($sbpb->s_sgst)) echo $sbpb->s_sgst ;?></td>
							<td><?php if(isset($sbpb->s_bill_amt)) echo $sbpb->s_bill_amt ;?></td>
							<td><?php if(isset($sbpb->p_bill_no)) echo $sbpb->p_bill_no ;?></td>
							<td><?php if(isset($sbpb->p_bill_dt)) echo date('d/m/Y',strtotime($sbpb->p_bill_dt)) ;?></td>
							<td><?php if(isset($sbpb->p_taxable_value	)) echo $sbpb->p_taxable_value ;?></td>
							<td><?php if(isset($sbpb->p_cgst)) echo $sbpb->p_cgst ;?></td>
							<td><?php if(isset($sbpb->p_sgst)) echo $sbpb->p_sgst ;?></td>
							<td><?php if(isset($sbpb->p_bill_amt)) echo $sbpb->p_bill_amt ;?></td>
							
						</tr>
					</tbody>
				</table>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">

    <button class="btn btn-primary" type="button" onclick="location.href='<?php echo base_url('index.php/stationary/bill_details');?>'">Back</button>

    <button class="btn btn-primary" type="button" onclick="printDiv();">Print</button>

</div>
<?php  }else {   ?>

<div class="wraper"   style="min-height:500px">      

    <form method="POST" id="form" role="form" name="add_form" action="<?php echo site_url("stationary/bill_details");?>" onsubmit="return validate()" >

        <div class="col-md-6 container form-wraper">

            <div class="form-header">
                <h4>Select Dates</h4>
            
            </div>  

           <div class="form-group row">
			    <div class="col-md-8" style="margin-top:20px">
				
						<label for="from_date" class="col-sm-4 col-form-label">Sale Bill No:<span style="color: #d41c1c;">*</span></label>
						<div class="col-sm-8">
							<input type="text" name="s_bill_no" class="form-control" required value="">
						</div>
						
				</div>
				<div class="col-md-6" style="margin-top:20px">
												
					
				</div>
            
            </div>

            <div class="form-group row">

                <div class="col-sm-10">

                    <input type="submit" class="btn btn-info" value="Submit" />

                </div>

            </div>

        </div>

    </form>

</div>

<?php } ?>



