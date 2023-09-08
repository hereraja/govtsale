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

                        <!-- <h4>Bills Amount From: <?php //echo date("d-m-y",strtotime($startDt)).' To: '.date("d-m-y",strtotime($endDt)) ; ?> </h4> -->
                        
                    </div>

                </div>

            </div>

            <br>
            
            <div>

                <table class="table table-striped" style="width: 100%;">
                    <!-- <caption><hr><?php echo 'Order No.: '.$order_no.' DT '.date("d-m-y",strtotime($order_dt)); ?></caption>
                    <caption><?PHP echo 'Item: '.strtoupper($item); ?><hr></caption> -->
                    <thead style = "text-align: center">
                        <tr>
                            
                            <td>Sl No</td>
                            <td>District</td>
                            <td>Name of Project</td>
                            <td>Total amount</td>
                            <td>Paid amount</td> 
                            <td>Due amount</td>   
                            
                        </tr>
                    </thead>

                    <tbody style = "text-align: center">

                    <?php   $paid_amt = 0.00;$tot_amt = 0;$i = 0; $tot_amts = 0;$paid_amts =0; $tot_dueamt = 0;
                        foreach($paymenttot as $key)
                        {
                        ?>
                            <tr>
                                <td><?php echo ++$i ?></td>
                                <td><?php echo($key->district_name); ?></td>
                                <td><?php echo($key->cdpo); ?></td>
                                <td><?php echo ($key->s_bill_amt); $tot_amt = $key->s_bill_amt; $tot_amts +=$key->s_bill_amt; ?></td>
                                <td><?php 
                                 foreach($paymentmaid as $pmaid)
                                 {
                                    if($key->project_cd == $pmaid->project_cd)
                                    {
                                    echo $pmaid->s_bill_amt; 
                                    $paid_amt = $pmaid->s_bill_amt;
                                    $paid_amts += $pmaid->s_bill_amt;
                                    }
                                }
                                ?></td>
                                <td><?php echo $tot_amt-$paid_amt; $tot_dueamt += $tot_amt-$paid_amt;  ?></td>
                                
                            </tr>

                    <?php
                         $paid_amt = 0.00;$tot_amt = 0;
                        }
                        ?>
                        
                         <tr  style="text-align: center;">
                            <td colspan="3" >
                                <strong>TOTAL:</strong>
                            </td>
                            <td><?=$tot_amts?></td>
                            <td  style="text-align: center;"> <?=$paid_amts?>
                            </td>
                            <td><?=$tot_dueamt?></td>
                        </tr> 
                    
                    </tbody>

                </table>

            </div>

        </div>
    
    </div>
</div>
<div class="modal-footer">

    <button class="btn btn-primary" type="button" onclick="location.href='<?php echo base_url('index.php/sw/swprojectpaystatus');?>'">Back</button>

    <button class="btn btn-primary" type="button" onclick="printDiv();">Print</button>

</div>
<?php  }else {   ?>

<div class="wraper"   style="min-height:500px">      

    <form method="POST" id="form" role="form" name="add_form" action="<?php echo site_url("sw/swprojectpaystatus");?>" onsubmit="return validate()" >

        <div class="col-md-6 container form-wraper">

            <div class="form-header">
                <h4>Select Dates</h4>
            
            </div>  
            <div class="form-group row">
                <label for="dist_cd" class="col-sm-2 col-form-label">District:<font color="red">*</font></label>
                <div class="col-sm-4">

                    <select name="dist_cd" id="dist_cd" class= "form-control required" required>
                        <option value="0">Select District</option>
                        <?php
                            foreach($dist as $data)
                            { 
                            ?>
                                <option value="<?php echo ($data->district_code); ?>"><?php echo ($data->district_name); ?></option>
                        <?php
                            }
                            ?>
                    </select>
                    
                </div>
            </div>

           <div class="form-group row">
			    <div class="col-md-6" style="margin-top:20px">
				
						<label for="from_date" class="col-sm-4 col-form-label">From Date:</label>
						<div class="col-sm-8">
							<input type="date" name="from_date" class="form-control" required value="">
						</div>
						
				</div>
				<div class="col-md-6" style="margin-top:20px">
												
					<label for="to_date" class="col-sm-4 col-form-label">To Date:</label>
					<div class="col-sm-8">
						<input type="date" name="to_date" class="form-control" required value="<?=date("Y-m-d")?>">
					</div>
					
				</div>
            
            </div>

            <div class="form-group row">

                <div class="col-sm-10">

                    <input type="submit" class="btn btn-info" value="Go" />

                </div>

            </div>

        </div>

    </form>

</div>

<?php } ?>



