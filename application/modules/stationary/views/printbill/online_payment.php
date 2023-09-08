<!doctype html>
<html>
	<head>
	    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">        
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" href="<?php echo base_url("/confed.jpg"); ?>">
		<title>CONFED</title>
	    <link rel="stylesheet" type="text/css" href="<?php echo base_url("/assets/css/challan.css");?>">
	</head>

<body>
	<script>
  function printDiv() {

        var divToPrint = document.getElementById('divToPrint');
        var WindowObject = window.open('', 'Print-Window');
        WindowObject.document.open();
        WindowObject.document.writeln('<!DOCTYPE html>');
        WindowObject.document.writeln('<html><head><title>Test Print</title><style type="text/css">');
        WindowObject.document.writeln('@media print { .center { text-align: center;}' +
'body{padding: 0; margin:0;}' +
'.billPrintWrapper{padding: 15px; color: #333;}' +
'.billPrintWrapper h2{font-size: 22px;color: #333;margin: 0 0 14px 0;padding: 0 0 8px 0;text-align: center;font-weight: 700;line-height: 24px;border-bottom: #ccc solid 1px;}' +
'.billPrintWrapper h2 span{font-size: 16px; font-weight: 400; display: block;}' +

'.billPrintWrapper .printTop023 {margin-bottom: 10px; width: 100%; display: inline-block; color: #333; font-size: 16px;}' +
'.billPrintWrapper .printTop023 .leftNo {float: left; padding: 0 15px;}' +
'.billPrintWrapper .printTop023 .rightDate {float: right; padding: 0 15px;}' +

'.billPrintWrapper .debitLine{margin-bottom: 10px; padding: 0 15px; font-size: 16px;}' +
'.billPrintWrapper .debitLine p{margin: 0; padding: 0;}' +
'.billPrintWrapper .debitLine p span{border-bottom: #000 solid 2px; font-size: 22px; font-weight: 700;}' +
'.billPrintWrapper .billTxtArea{width: 100%; padding: 0 15px;}' +
'.billPrintWrapper .billTxtArea p{margin: 0; padding: 0; font-size: 15px; line-height: 20px;}' +
'.billPrintWrapper .billTxtArea p strong.italic{font-style: italic;}' +
'.billPrintWrapper .priceSec{max-width: 120px;border: #000 solid 1px;padding: 5px;color: #333;margin-top: 6px;font-weight: 700;}' +

'.billPrintWrapper .printBottom{margin:80px 0 0 0; padding: 0 15px; width: 100%; display: inline-block;}' +
'.billPrintWrapper .printBottom .col-md-3{width: 100%; max-width: 33%; padding: 0 0; float: left; box-sizing: border-box;}' +								  
        '} </style>');
        WindowObject.document.writeln('</head><body onload="window.print()">');
        WindowObject.document.writeln(divToPrint.innerHTML);
        WindowObject.document.writeln('</body></html>');
        WindowObject.document.close();
        setTimeout(function () {
            WindowObject.close();
        }, 10);

  }
</script>
	
	<div class="wrapper">
	<div id="divToPrint">
	<div class="billPrintWrapper">
    <h2>West Bengal State Consumers' Co-operative Federation Ltd.
    <span>P1 HideLane,Akabar Mansion,Kolkata-700073</span></h2>
    <?php   $payment_time = '00/00/0000';
	        $payment_time = date('d/m/Y',strtotime($payment_detail->trans_dt)); 
		    $product_detail_string = '';
		    $mr_string = '';
			$mr_date = '';
			$mr_dates= '';  // If Mr Date is different in multiple  //
			$masur_dal_qty = 0;
			$rice_qty = 0;
			$moil_qty = 0;
			$salt_qty = 0;
		   
			foreach($products as $product){
				
			  if($product->item_name == 'MUSUR DAL'){
				  $masur_dal_qty +=$product->del_qty;
			  }
			}
			if($masur_dal_qty > 0){
			$product_detail_string .= '<span>'.$masur_dal_qty.'</span> Qntls. MUSUR DAL & ';
			}
			foreach($products as $product){
				
			  if($product->item_name == 'RICE'){
				  $rice_qty +=$product->del_qty;
			  }
			}
			if($rice_qty > 0){
			$product_detail_string .= '<span>'.$rice_qty.'</span> Qntls. RICE & ';
			}
			foreach($products as $product){
				 
			  if($product->item_name == 'MUSTARD .OIL'){
				  $moil_qty +=$product->del_qty;
			 	  }
			}
			if($moil_qty > 0){
			 $product_detail_string .= '<span>'.$moil_qty.'</span> Qntls. MUSTARD .OIL & ';
			}
			foreach($products as $product){
				 
			  if($product->item_name == 'IODISED SALT'){
				  $salt_qty +=$product->del_qty;
			  }
			}
			if($salt_qty > 0){
			$product_detail_string .= '<span>'.$salt_qty.'</span> Qntls. IODISED SALT & ';
			}  

            foreach($mr_detail as $mr){
				
				$mr_string.= $mr->mr_no.',';
				$mr_date  .= $mr->mr_date.',';
			}

            $mr_date = explode(",", rtrim($mr_date,","));
			$mr_date = array_unique($mr_date);
			foreach($mr_date as $dt){
				
				$mr_dates .= date('d/m/Y',strtotime($dt)).',';
			}
			
			$mr_dates= rtrim($mr_dates,",");			
	?>
	<div class="printTop023">
	<div class="leftNo">No...............</div>
	<div class="rightDate">Dated: <?php //$payment_time;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
	</div>
	<div class="printTop023">
	<div class="rightDate"><strong></strong></div>
	</div>
		
	<div class="debitLine"><p><strong>Debit :</strong> <span>Sundry Creditors </span></p></div>
	<div class="billTxtArea">
	<p>Being the ammount paid to <strong class="italic">"Yourselves" </strong>A/c. <strong class="italic"><?=$payment_detail->vendor_name;?></strong>.through Online  dated <strong class="italic"><?=$payment_time;?> </strong>on <strong class="italic"><?=$payment_detail->bank_name;?></strong>, for supply of
	<?php echo rtrim($product_detail_string," & "); ?> 
	
	vide bill no & date mentioned in note-sheet page No confed Bill No.& date also mentioned in N/sheet page no .... against <strong class="italic">M.R. No.
	
		<?php  echo rtrim($mr_string,","); ?> dated : <?=$mr_dates;?></span></p></br>	
	<p><strong>Rupees:</strong> <strong class="italic"><?php echo getIndianCurrency($amt->tot_payable); ?></strong></p>
    </br>	
			<div class="priceSec">Rs. <?php echo $amt->tot_payable;?> </div>
	</div>
	
	<div class="printBottom">
                    
        <div class="col-md-3">Prepared</div>
		<div class="col-md-3">Deputy Manager</div>
		<div class="col-md-3">Chief Executive Officer</div>

    </div>
		
	</div>
	</div>
		<div style="text-align: center;">

                    <button class="btn btn-primary" type="button" onclick="printDiv();">Print</button>

                </div>
	
		</div>
</body>
</html>