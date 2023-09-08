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
    <h2>West Bengal State Multipurpose Consumers' Co-operative Federation Ltd.
    <span>P1 HideLane,Akabar Mansion,Kolkata-700073</span>
	<span></span>
	</h2>

	<div class="printTop023">
	<div class="leftNo">No: <?php if(isset($money_rec->no)) { echo $money_rec->no; } ?></div>
	<div class="rightDate">Dated: <?php if(isset($money_rec->trans_dt)) { echo date("d/m/Y",strtotime($money_rec->trans_dt)); } ?></div>
	</div>
	<div class="printTop023">
	<div class="rightDate"><strong></strong></div>
	</div>
	<div class="printTop023">
	<div class="leftNo"><strong class="italic">Received with thanks from </strong><?php if(isset($money_rec->received_from)) { echo $money_rec->received_from; } ?></div>
	<div class="rightDate"></div>
	</div>
	<div class="printTop023">
	<div class="rightDate"><strong></strong></div>
	</div>
	<div class="printTop023">
	<div class="leftNo"><strong class="italic">The sum of rupee </strong><?php if(isset($money_rec->amt)) { echo getIndianCurrency($money_rec->amt); } ?></div>
	</div>
	<div class="billTxtArea">
	<?php   
	?>
	<p><strong class="italic">by Cash/ Cheque/ Draft. </strong> <?php if(isset($money_rec->reff_detail)) { echo $money_rec->reff_detail; } ?></p></br>	
			
	</div>
	<div class="billTxtArea">
	<?php   
	?>
	<p><strong class="italic">against </strong> <?php if(isset($money_rec->against)) { echo $money_rec->against; } ?> <strong class="italic">Account </strong>  </p></br>	
			
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