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

                        <h4>Supplier Details: </h4>
                        
                    </div>

                </div>

            </div>

            <br>
            
            <div>

                <table class="table table-striped" style="width: 100%;">
                   
                    <thead style = "text-align: center">
                        <tr>
                            
                            <td>Sl No</td>  
                            <td>Name</td>  
                            <td>Contact Person</td>
                            <td>Address</td>
                            <td>Phone No</td>  
                            <td>Email</td>
                            <td>GST No</td>
                            <td>PAN No</td>
                            <td>Trade License</td>
                            <td>Bank</td>
                            <td>Accnt No</td>
                            <td>IFSC</td>
                            <!-- <td>ST</td>
                            <td>IT</td> -->
                            
                        </tr>
                    </thead>

                    <tbody style = "text-align: center">

                    <?php 
                        $i=1;
                        foreach($data as $key)
                        {
                        ?>
                            <tr>
                                <td><?php echo $i; ?></td> 
                                <td><?php echo($key->name); ?></td> 
                                <td><?php echo($key->contact_person); ?></td>
                                <td><?php echo($key->address);?>
                                <td><?php echo($key->phn_no); ?></td>
                                <td><?php echo ($key->email); ?></td>
                                <td><?php echo ($key->gst_no); ?></td>
                                <td><?php echo ($key->pan_no); ?></td>
                                <td><?php echo ($key->trd_license); ?></td>
                                <td><?php echo ($key->bank); ?></td>
                                <td><?php echo ($key->accnt_no); ?></td>
                                <td><?php echo ($key->ifsc); ?></td>
                                <!-- <td><?php //echo ($key->st); ?></td>
                                <td><?php //echo ($key->it); ?></td> -->
                                
                            </tr>
                    <?php
                        $i++;
                        }
                        ?>
                    
                    </tbody>

                    <tfoot style = "text-align: center">

                        <tr>
                            <td colspan="4" style="text-align: left;">
                                <strong>TOTAL:</strong>
                            </td>
                            <td  style="text-align: center;">
                                <?php echo @$amount->amount; ?>
                                
                            </td>
                        </tr> 

                    </tfoot>

                </table>

            </div>

        </div>
    
    </div>


</div>


<div class="modal-footer">

    <button class="btn btn-primary" type="button" onclick="location.href='<?php echo base_url('index.php/User_Login/main');?>'">Back</button>

    <button class="btn btn-primary" type="button" onclick="printDiv();">Print</button>

</div>
