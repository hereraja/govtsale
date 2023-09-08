<script>

    function printDiv() {
        var divToPrint=document.getElementById('divToPrint');

        var WindowObject=window.open('','Print-Window');
        WindowObject.document.open();
        WindowObject.document.writeln('<!DOCTYPE html>');
        WindowObject.document.writeln('<html><head><title></title><style type="text/css">');

        WindowObject.document.writeln('td{word-break: break-word; text-align:left;}'+
        'thead td:nth-child(1){width:10%} '+
        'thead td:nth-child(2){width:20%}'+
        'thead td:nth-child(3){width:30%}'+
        'thead td:nth-child(4){width:30%} '+
        'thead td:nth-child(5){width:10%} ');
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

<style>
td{word-break: break-word; text-align:left;}
thead td:nth-child(1){width:10%} 
thead td:nth-child(2){width:20%} 
thead td:nth-child(3){width:30%} 
thead td:nth-child(4){width:30%} 
thead td:nth-child(5){width:10%} 
</style>



<div id="divToPrint">

    <div class="wraper"> 

        <div class="col-lg-12 container contant-wraper">

            <div class="panel-heading">

                <div class="item_body">

                    <div style="text-align:center;">

                        <h3>WEST BENGAL STATE MULTIPURPOSE CONSUMERS' CO-OPERATIVE FEDERATION LTD.</h3>

                        <h3>P-1, Hide Lane, Akbar Mansion, 3rd Floor, Kolkata-700073</h3>

                        <h4>Order Details From: <?php echo date("d-m-y",strtotime($startDt)).' To: '.date("d-m-y",strtotime($endDt)) ; ?> </h4>
                        
                    </div>

                </div>

            </div>

            <br>
            
            <div>
<div style="max-width:1000px; margin:0 auto;">
<table class="table table-striped" style="width: 100%;">
<thead style = "text-align: center">
                        <tr>
                            
                            <td><strong>Date</strong></td>  
                            <td><strong>Confed Order No</strong></td>  
                            <td><strong>Govt. Order No</strong></td>  
                            <td><strong>Project</strong></td>
                            <td><strong>Supplier</strong></td>  
                            <!-- <td>Amount(Rs)</td> -->
                            
                        </tr>
                    </thead>

                    <tbody style = "text-align: center">

                    <?php 
                        foreach($data as $key)
                        {
                        ?>
                            <tr>
                        
                                <td><?php echo date("d-m-y",strtotime($key->c_order_dt)); ?></td> 
                                <td><?php echo($key->c_order_no); ?></td> 
                                <td><?php echo($key->g_order_no); ?></td> 
                                <td><?php echo($key->project); ?></td>
                                <td><?php echo($key->supplier); ?></td>
                                <!-- <td><?php //echo ($key->tot_amount); ?></td> -->
                                
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


</div>


<div class="modal-footer">

    <button class="btn btn-primary" type="button" onclick="location.href='<?php echo base_url('index.php/stationary/orderReport');?>'">Back</button>

    <button class="btn btn-primary" type="button" onclick="printDiv();">Print</button>

</div>
