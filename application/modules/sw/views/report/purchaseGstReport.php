<style>
    table {
        border-collapse: collapse;
    }

    table, td, th {
        border: 1px solid #dddddd;

        padding: 6px 5px;

        font-size: 11px;
    }

    th {

        text-align: center;

    }

    tr:hover {background-color: #f5f5f5;}

</style>
<script>

    function printDiv() {
		
        var divToPrint=document.getElementById('divToPrint');
        var WindowObject=window.open('','Print-Window');
        WindowObject.document.open();
        WindowObject.document.writeln('<!DOCTYPE html>');
        WindowObject.document.writeln('<html><head><title></title><style type="text/css">');
        WindowObject.document.writeln('@media print { .center { text-align: center;}' +
            '                                         .inline { display: inline; }' +
			'.col-sm-3{width:25%; float:left;}'+
			'.col-sm-9 {width:75%; float:left;}'+
            '.logoTextSecRight h2 {font-size: 16px;line-height:20px;color:#252525;font-family:"Roboto", sans-serif;margin:0;padding:0;}'+
			'.logoTextSecRight h2 span{font-size:14px;color:#252525;margin:0;padding:0;}'+
			'table{border-collapse: collapse;}'+
			'table, td, th {border: 1px solid #dddddd;padding:6px 5px;font-size:11px;color:#252525;}'+
			'th {text-align:center;}'+
			'.logoTextSecRight h3{font-size: 13px;color: #0680cd;margin:0;padding:0;}'+
            '                                         .underline { text-decoration: underline; }' +
            '                                         .left { margin-left: 315px;} ' +
            '                                         .right { margin-right: 375px; display: inline; }' +
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

	<?php   if( $_SERVER['REQUEST_METHOD']=="POST" )   {       ?>

    <div class="wraper"> 

        <div class="col-lg-12 container contant-wraper">

			<div class="printHeaderNew">
           
				
			<div class="col-sm-3 float-left logoCustom"><img style="height:60px" src=<?php echo base_url("/confed.jpg");?> /></div>

            <div class="col-sm-9 float-left logoTextSecRight">
                                    <h2>West Bengal State Multipurpose Consumers' Co-operative Federation Ltd.<span>

                                        P-1,Hide Lane,Akbar Mansion 3rd Floor,Kolkata - 700073</span></h2>
									<h3>SGST,CGST Report From: <?php echo date("d-m-y",strtotime($startDt)).' To: '.date("d-m-y",strtotime($endDt)) ; ?> </h3>

            </div>

            <br>
            
            

<!--                <table class="table table-striped" style="width: 100%;" id='htmltable'>-->
				<table style="width: 100%;" id="example">
                    <?php /*?> <caption><hr><?php echo 'Order No.: '.$order_no.' DT '.date("d-m-y",strtotime($order_dt)); ?></caption>
                    <caption><?PHP echo 'Item: '.strtoupper($item); ?><hr></caption> <?php */?>
                    <thead>
                        <tr>
                            
                            <th>Purchase Date</th> 
							<th>project</th>
                            <th>Order no</th>		
                            <th>Supplier </th>							
                            <th>Item</th>
                            <th>SGST</th>
                            <th>CGST</th>
							<th>Total amt</th>
                            
                            
                        </tr>
                    </thead>

                    <tbody style = "text-align: center">

                    <?php 
                        foreach($data as $key)
                        {
                        ?>
                            <tr>
                        
                                <td><?php echo date("d-m-y",strtotime($key->purchase_dt)); ?></td> 
                                <td><?php echo($key->cdpo); ?></td> 
								<td><?php echo($key->order_no); ?></td>
								<td><?php echo($key->vendor_name); ?></td>
                                <td><?php echo($key->item_name); ?></td>
                                <td><?php echo ($key->cgst); ?></td>
                                <td><?php echo($key->sgst); ?></td>
								<td><?php echo($key->tot_amnt); ?></td>
                                
                            </tr>

                    <?php
                        }
                        ?>
                    
                    </tbody>
                </table>

            
			
			</div>
        </div>
    
    </div>
	

</div>


<div class="modal-footer">

    <button class="btn btn-primary" type="button" onclick="location.href='<?php echo base_url('index.php/sw/oilPaymentReport');?>'">Back</button>

    <button class="btn btn-primary" type="button" onclick="printDiv();">Print</button>
    <button class="btn btn-primary" type="button" id="btnExport" >Excel</button>

</div>

<?php }else{  ?>

<div class="wraper">      

    <div class="col-md-6 container form-wraper">

        <form role="form" method="POST" action= "<?php echo site_url('sw/getgstReport') ?>" >
            <div class="form-header">
                
                <h4>Date Wise Purchase Gst Report</h4>
            
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
						<input type="date" name="to_date" class="form-control" required value="">
					</div>
					
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
<script type="text/javascript">
    $(function () {
        $("#btnExport").click(function () {
            $("#htmltable").table2excel({
                filename: "SGST,CGST Report From: <?php echo date("d-m-y",strtotime($startDt)).' To: '.date("d-m-y",strtotime($endDt)) ; ?>.xls"
            });
        });
    });
</script>