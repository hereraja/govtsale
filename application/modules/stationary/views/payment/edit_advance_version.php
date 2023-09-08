<div class="wraper">      
	<div class="col-md-12 container form-wraper" style="margin-left: 0%;">
		<form method="POST" id="form" role="form" name="add_form" action="<?php echo site_url("stationary/edit_pay_adv_ver");?>"  >
		        <input type="hidden" name="id" value="<?php if(isset($vendor_pay->id)) echo $vendor_pay->id ;?>" >
				<input type="hidden" name="vendor_id" value="<?php if(isset($vendor_pay->vendor_id)) echo $vendor_pay->vendor_id ;?>" >
				<div class="form-header">
						<h4>Payment Entry</h4>
				</div>
				<div class="form-group row">
					<label for="td_sw_pbsb_detail_id" class="col-sm-1 col-form-label">Vendor<font color="red">*</font></label>
					<div class="col-sm-3">
					<select name="" id="vendor_id" class="form-control " required disabled>
					<option value="">Select Vendor</option>
								<?php   
									foreach($vendors as $key1){
								?>
										<option value="<?php echo $key1->sl_no; ?>"  <?php if($vendor_pay->vendor_id ==$key1->sl_no) { echo 'selected'; } ?> ><?php echo $key1->name; ?></option>
								<?php
									} 
								?>
				    </select>
					</div>
					<label for="td_sw_pbsb_detail_id" class="col-sm-1 col-form-label">Customer<font color="red">*</font></label>
					<div class="col-sm-3">
					<select name="customer_id" id="customer_id" class="form-control" required disabled>
					<option value="">Select Customer</option>
								<?php   
									foreach($projects as $pro){
								?>
										<option value="<?php echo $pro->project_cd; ?>" <?php if($vendor_pay->project_cd ==$pro->project_cd) { echo 'selected'; } ?> ><?php echo $pro->name; ?></option>
								<?php
									} 
								?>
				    </select>
					</div>
					<label for="trans_dt" class="col-sm-1 col-form-label">Date.<font color="red">*</font></label>
					<div class="col-sm-3">
					<input  type="date" name="trans_dt" class="form-control trans_date" id="trans_date" value="<?php if(isset($vendor_pay->trans_dt)) echo $vendor_pay->trans_dt ;?>" required>
					</div>
				</div>
				<div class="form-group row" >
					<div class="col-sm-12">
					<table class="table table-striped table-bordered table-hover"  id="bill_table">
					<tr>
					<th style="width:100px">sale bill no</th>
					<th style="width:110px">sale bill dt</th>
					<th>Sale bill Amount</th>
					<th>sale cgst</th>
					<th>sale Sgst</th>
					<th>Sale Total</th>
					<th>Pur bill no</th>
					<th>Pur bill dt</th>
					<th>Pur bill Amount</th>
					<th> cgst</th>
					<th> Sgst</th>
					<th>Pur Total</th>
					<th>
                            <button class="btn btn-success" type="button" id="addrow1" style= "border-left: 10px" data-toggle="tooltip" data-original-title="Add Row" data-placement="bottom"><i class="fa fa-plus" aria-hidden="true"></i></button></th>
                        </th>
					</tr>
					<tbody id="show_sale_purchase">
					<?php $i = 0 ;$tot_qty = 0.00;$sbill_cgst=0.00;$tot_pb_amt = 0.00;$tot_sb_amt = 0.00;$tot_qty = 0.00;$sb_less_amt =0.00;$pb_gst = 0.00;
					foreach($purchase_sale_details as $key){?>
						<tr>
                               
                                <td><?php echo ($key->s_bill_no); ?></td>
                                <td><?php echo date("d.m.y",strtotime($key->s_bill_dt)); ?></td>
                                <td><?php echo($key->s_taxable_value); ?></td>
								<td><?php echo($key->s_cgst); $sbill_cgst +=$key->s_cgst; ?></td>
								<td><?php echo($key->s_sgst); ?></td>
								<td><?php echo($key->s_bill_amt); $tot_sb_amt += $key->s_bill_amt;?></td>
                                <td><?php echo($key->p_bill_no); ?></td>
                                <td><?php echo date("d.m.y",strtotime($key->p_bill_dt)); ?></td> 								
                                <td><?php echo($key->p_taxable_value); ?></td>
								<td><?php echo($key->p_cgst);  ?></td>
								<td><?php echo($key->p_sgst	);  ?></td>
								<td><?php echo($key->p_bill_amt); $tot_pb_amt += $key->p_bill_amt; ?></td>
                                <td><?php //echo($key->name); ?></td>
                                
                            </tr>
				    <?php }?>
					<input type="hidden" name="s_cgst[]" class="s_cgst" value="<?=$sbill_cgst?>" >	
					<input type="hidden" name="s_bill_amt[]" class="s_bill_amt" value="<?=$tot_sb_amt?>" >
					<input type="hidden" name="p_bill_amt[]" class="p_bill_amt" value="<?=$tot_pb_amt?>" >

					</tbody>
					<tfooter>
					<tr><td colspan="3" ></td><td colspan="2" style="text-align: right;">Total:</td><td id="st">0.00</td><td colspan="5"></td><td id="pt">0.00</td></tr>
		            <tr><td colspan="3" ></td><td colspan="2" style="text-align: right;">Less Amount:</td><td><input type="text" id="sb_less_amt" class="form-control sb_less_amt" name="sb_less_amt" value="<?=$vendor_pay->sb_less_amt?>" >
				    </td><td colspan="5"><td><input type="text" class="form-control pb_less_amt" name="pb_less_amt" value="<?=$vendor_pay->pb_less_amt?>"></td></tr>
	                <tr><td colspan="3" ></td><td colspan="2" style="text-align: right;">Total:</td><td id="stotamt"><?=$tot_sb_amt?></td><td colspan="5"></td><td id="ptotamt"><?=$tot_pb_amt?></td>
				     <td><button type="button" class="btn btn-success" id='cal'>CAL</button></td>
				     </tr>
					<tr><td>Add Gst:</td>
						<td><input type="text" class="form-control" name="add_gst" value="<?=$vendor_pay->add_gst?>"></td>
					</tr>	
					</tfooter>		
					</table>
					<div class="col-sm-12">
						<div class="col-6">
							<label for="exampleInputName1">Create Final Payment Notesheet:<span class="requiredfield">*</span></label><br>
							<input type="radio" name="bill_status" value="0" <?php if ($vendor_pay->bill_status == '0' ) echo "checked"; ?>>
							<label for="Yes">Unlock Payment</label>
							<input type="radio"  name="bill_status" value="1" <?php if ($vendor_pay->bill_status == '1' ) echo "checked"; ?>>
							<label for="No">Lock Payment</label>
						</div>
					</div>
					<span style="color:red">NOTE: Please click on CAL button after selecting all bill.<span>
						<input type="hidden" id="bill_counter" value="0">
					</div>
				
				</div>
				<div class="form-header">
				<h4>MR details</h4>
				</div>
				<table class= "table table-striped table-bordered table-hover">
				<thead>
					<th style= "text-align: center">MR No.</th>  
					<th style= "text-align: center">MR Date</th>  
					<th style= "text-align: center">Bank</th> 
					<th style= "text-align: center">Account No</th>
					<th style= "text-align: center">Pay Type</th>
					<th style= "text-align: center">Pay Date.</th>
					<th style= "text-align: center">MR Amount.</th>
					<th style= "text-align: center">Effective Amount.</th>
					<th><?php if(!isset($bill_details)) { ?>
						<button class="btn btn-success" type="button" id="addrow" style= "border-left: 10px" data-toggle="tooltip" data-original-title="Add Row" data-placement="bottom"><i class="fa fa-plus" aria-hidden="true"></i></button>
						<?php } ?>
					</th>
				</thead>
				<hr>
					<tbody id= "intro">
					<?php $i = 0 ;
					      $tot_amnt_cr = 0.00;
                          $mr_amt = 0.00;
                        foreach($mr_details as $key)
                        {
                        ?>
                            <tr style="text-align:center">
                                <td><?php echo($key->mr_no); ?></td>
                                <td><?php echo date("d.m.y",strtotime($key->mr_dt)); ?></td>
								<td><?php echo($key->bank_name); ?></td>
								<td><?php echo($key->acc_no); ?></td>
                                <td><span style="text-transform: uppercase;"><?php echo($key->trans_mode); ?></span></td>
                                <td><?php echo date("d.m.y",strtotime($key->pay_dt)); ?></td>
                                <td><?php echo ($key->mr_amt); $mr_amt += $key->mr_amt;  ?></td>
                                <td><?php echo ($key->amt); $tot_amnt_cr += $key->amt;  ?></td>
                           
                            </tr>

                    <?php
                        }
                        ?>
						<input type="hidden" name=""  class="form-control mr_amt" id="mr_amt" value="<?=$mr_amt?>" >
						<input type="hidden" name=""  class="form-control mramt" id="amt" value="<?=$tot_amnt_cr?>" >   
					
					</tbody>
					<tfoot>
						<tr>
							<td colspan='6' style="text-align: right;">Total</td>
							<td><span id='mrtot'><?=$mr_amt?></span></td><td><span id='effectamt'><?=$tot_amnt_cr?></span></td>
						</tr>
					</tfoot>
				</table>
				
				<div class="form-group row">
					<div class="col-sm-10">
					<input type="hidden" id="mr_counter" value="1">
						<input type="submit" class="btn btn-info" value="Save" />
					</div>
				</div>
			</form>
	</div>
</div>

<script>

	$(document).ready(function(){
		 
		$('#mode').on( "change", function(){
			var mode = $(this).val();
			if(mode == "neft" || mode == "cheque")
			{
				$('#refNo').show();
			}
			else if(mode == "cash" || mode == "0" )
			{
				$('#refNo').hide();
			}
		});

	});

</script> 

<!-- for addrow in table -->
<script>

$(document).ready(function(){
	var y=0;
    $("#addrow").click(function()
    {
		var y = parseInt($('#mr_counter').val());
		var newElement= '<tr>'
			+'<td><input type="text" name="mr_no[]" id="mr_no" class="form-control mr_no " id="mr_no" required>'
			+'</td>'
			+'<td><input type="date" name="mr_dt[]" id="mr_dt" class="form-control required " id="mr_dt" required>'
			+'</td>'
			+'<td><select name="bank[]" id="bank"  class="form-control"  required><option value="">Select Bank</option>'
							<?php foreach($banks as $bkey) { ?>
								+'<option value="<?=$bkey->sl_no?>"><?=$bkey->bank_name?></option>'
							  <?php } ?>
			+'</select></td>'
			+'<td><select name="acc_no[]" id="acc_no"  class="form-control"  required><option value="">Select</option><option value="0456">0456</option><option value="5729">5729</option><option value="1146">1146</option><option value="2309">2309</option><option value="0851">0851</option></select></td>'
			+'<td>'
				+'<select name="trans_mode[]" id="trans_mode" class= "form-control" required>'
				+'<option value="">Select mode</option>'
			+'<option value="cash">Cash</option>'
			+'<option value="neft">NEFT</option>'
			+'<option value="cheque">Cheque</option>'
				+'<select>'
			+'</td>'
			+'<td><input type="date" name="pay_dt[]"  class="form-control" id="pay_dt" required>'
			+'</td>'
			+'<td><input type="text" name="mr_amt[]"  class="form-control mr_amt" id="mr_amt" value="" required>'
			+'</td>'			
			+'<td><input type="text" name="amt[]"  class="form-control mramt" id="amt" required>'
			+'</td>'
			 +'<td>'
				+'<button class="btn btn-danger removeRow" type= "button" data-toggle="tooltip" data-original-title="Remove Row" data-placement="bottom" id="removeRow"><i class="fa fa-remove" aria-hidden="true"></i></button>'
			+'</td>'
			+'</tr>';
					
		
		if($('#mr_counter').val() < 20) {
					y = y + 1;
					$('#mr_counter').val(y);
					$("#intro").append($(newElement));
				}else{
					alert('You have already added 20 row');
				} 
    });  

	$("#intro").on('click', '.removeRow',function(){
            
            $(this).parents('tr').remove();

    });
                            
});


 
</script>

<script>

$('#td_stn_pbsb_detail_id').change(function(){

    var td_sw_pbsb_detail_id = $(this).val();
	var sbamt = 0.00;var pbamt = 0.00;
    $.get('<?php echo site_url("stationary/js_get_salebill_detail");?>',{ td_sw_pbsb_detail_id: td_sw_pbsb_detail_id })
    .done(function(data)
    {
	    var string = '';
		
		$.each(JSON.parse(data), function( index, value ) {
			
			string += '<tr><td>'+value.s_bill_no+'</td><td>'+value.s_bill_dt+'</td><td>'+value.s_cgst+'</td><td>'+value.s_sgst+'</td><td>'+value.s_bill_amt+'</td><td>'+value.p_bill_no+'</td><td>'+value.p_bill_dt+'</td><td>'+value.p_cgst+'</td><td>'+value.p_sgst+'</td><td>'+value.p_bill_amt+'</td></tr>';
            //sbamt += parseFloat(value.s_bill_amt);
			//pbamt += parseFloat(value.p_bill_amt);
        });
		string +='<tr><td colspan="2" style="text-align: right;"></td><td colspan="3" style="text-align: right;">Total:</td><td id="st">'+sbamt+'</td><td></td><td></td><td></td><td></td><td id="pt">'+pbamt+'</td></tr>';
		string +='<tr><td colspan="2" style="text-align: right;"></td><td colspan="3" style="text-align: right;">Less Amount:</td><td><input type="text" id="sb_less_amt" class="form-control sb_less_amt" name="sb_less_amt" value="" ></td><td></td><td></td><td></td><td></td><td><input type="text" class="form-control pb_less_amt" name="pb_less_amt" value="<?php if(isset($bill_detail->pb_less_amt)) echo $bill_detail->pb_less_amt ;?>"></td></tr>';
		string +='<tr><td colspan="2" style="text-align: right;"></td><td colspan="3" style="text-align: right;">Total:</td><td id="stotamt"></td><td></td><td></td><td></td><td></td><td id="ptotamt"></td></tr>';

		$('#show_sale_purchase').html(string);

	})
})
$(document).ajaxComplete(function() {
	$('.sb_less_amt').change(function(){
	var st = $('#st').html();
	var pt = $('#pt').html();
	var	sb_less_amt = $(this).val();
	var pb_less_amt = 0.00;
		$('.pb_less_amt').val(sb_less_amt-(sb_less_amt*.06));
		$('#stotamt').html(st-(sb_less_amt));
		$('#ptotamt').html(pt-(sb_less_amt-(sb_less_amt*.06)));
	})
})
$(document).ready(function(){
	$('#cal').click(function(){
		var sbamt = 0.00;
		var pbamt = 0.00;
	
	$('.s_bill_amt').each(function(){
			sbamt += parseFloat($(this).val() ? $(this).val():0.00);
	});
	$('.p_bill_amt').each(function(){
			pbamt += parseFloat($(this).val() ? $(this).val():0.00);
	});
	    var	sb_less_amt = $('.sb_less_amt').val() ? $('.sb_less_amt').val():0.00;
	    var pb_less_amt = 0.00;
		$('.pb_less_amt').val(sb_less_amt-(sb_less_amt*.06));
		$('.sb_less_amt').val(sb_less_amt);
		$('#st').html(sbamt);
	    $('#pt').html(pbamt);
		$('#stotamt').html((sbamt-(sb_less_amt)).toFixed());
		$('#ptotamt').html((pbamt-(sb_less_amt-(sb_less_amt*.06))).toFixed());

		
	})

})	

 </script>

<script>

$(document).ready(function(){
	
	$("#addrow1").click(function()
	{
		var dist_cd = $('#vendor_id').val();
		var customer_id = $('#customer_id').val();
		var x = parseInt($('#bill_counter').val());
		if(dist_cd > 0 && customer_id > 0){

			$.get('<?php echo site_url("stationary/js_get_sbno_pervendor") ?>', {vendor_id: $('#vendor_id').val(),customer_id:$('#customer_id').val()})
			.done(function(data){
				
				var string = '<option value="">Select</option>';
				$.each(JSON.parse(data), function( index, value ){

					string += '<option value="' + value.s_bill_no + '">' + value.s_bill_no +'</option>';
				})

				var newElement1= '<tr>'
								+'<td id= "s_bill_no" >'
									+'<select name="s_bill_no[]" id="s_bill_no" class= "form-control s_bill_no select2" required>'
										+string
									+'</select>'
								+'</td>'
								+'<td>'
									+'<input type="date" name="s_bill_dt[]" class="s_bill_dt" id="s_bill_dt" style="width:125px" readonly>'
								+'</td>'
								+'<td>'
									+'<input type="text" name="s_taxable[]" class="s_taxable" id="s_taxable" style="width:80px" readonly>'
								+'</td>'
								+'<td>'
									+'<input type="text" name="s_cgst[]" class="form-control required s_cgst" id="s_cgst" readonly>'
								+'</td>'
								+'<td>'
									+'<input type="text" name="s_sgst[]" class="form-control s_sgstb" id="s_sgst" readonly>'
								+'</td>'
								+'<td>'
									+'<input type="text" name="s_bill_amt[]" class="form-control s_bill_amt" id="s_bill_amt" readonly>'
								+'</td>'
								+'<td>'
								+'<input type="text" name="p_bill_no[]" class="form-control p_bill_no" id="p_bill_no" readonly>'
								+'</td>'
								+'<td>'
									+'<input type="date" name="p_bill_dt[]" class="p_bill_dt" id="p_bill_dt" style="width:125px" readonly>'
								+'</td>'
								+'<td>'
									+'<input type="text" name="p_taxable[]" class="p_taxable" id="p_taxable"  style="width:80px" readonly>'
								+'</td>'
								+'<td>'
									+'<input type="text" name="p_cgst[]" class="form-control p_cgst" id="p_cgst" readonly>'
								+'</td>'
								+'<td>'
									+'<input type="text" name="p_sgst[]" class="form-control p_sgst" id="p_sgst" readonly>'
								+'</td>'
								+'<td>'
									+'<input type="text" name="p_bill_amt[]" class="form-control p_bill_amt" id="p_bill_amt" readonly>'
								+'</td>'
								+'<td>'
									+'<button class="btn btn-danger" type= "button" data-toggle="tooltip" data-original-title="Remove Row" data-placement="bottom" id="removeRow1"><i class="fa fa-remove" aria-hidden="true"></i></button>'
								+'</td>'
							+'</tr>';
                if($('#bill_counter').val() < 20) {
					x = x + 1;
					$('#bill_counter').val(x);
					$("#show_sale_purchase").append($(newElement1));
				}else{
					alert('You have already added 20 row');
				}
				
				
				$('.select2').select2();
					$( document ).ready(function() {  
						var pbamt = 0.00;
						var sbamt = 0.00;
						$('.p_bill_amt').each(function(){
									pbamt += parseFloat($(this).val())?parseFloat($(this).val()):0.00;
						});
						$('#pt').html(parseFloat(pbamt));
						$('.s_bill_amt').each(function(){
								sbamt += parseFloat($(this).val())?parseFloat($(this).val()):0.00;
						});
						$('#st').html(parseFloat(sbamt));
					})
				})

		}else{

			alert('Please select a Vendor and Customer properly');
			return false;
		}
															
	});
   
	// Start code to Remove Bill row  
	var a = 0;
	
	$("#show_sale_purchase").on("click","#removeRow1", function(){
		var sbamt = 0.00;
		var pbamt = 0.00;
		var rowCount = $('#bill_table tr').length;
		rowCount = rowCount - 4;
		a = rowCount - 1;
		$(this).parents('tr').remove();
		$('.s_bill_amt').each(function(){
             sbamt += parseFloat($(this).val());
        });
        $('.p_bill_amt').each(function(){
             pbamt += parseFloat($(this).val());
        });
		$('#st').html(sbamt);
		$('#pt').html(pbamt);
		$('#bill_counter').val(a);
	});
	// End code to Remove Bill row  
	
	$("#intro").on("click","#removeRow", function(){
        
		$(this).parents('tr').remove();
		
	});

});


$("#show_sale_purchase").on("change", ".s_bill_no", function(){
var st  = parseFloat($('#st').html());
var pt  = parseFloat($('#pt').html());

var row = $(this).closest('tr');
var s_bill_no = $(this).val();
	$.get('<?php echo site_url("stationary/js_get_sbpb_detail") ?>',{s_bill_no:s_bill_no})
	.done(function(data){

		var value = JSON.parse(data);
		row.find("td:eq(1) input[type='date']").val(value.s_bill_dt);
		row.find("td:eq(2) input[type='text']").val(value.s_taxable_value);
		row.find("td:eq(3) input[type='text']").val(value.s_cgst);
		row.find("td:eq(4) input[type='text']").val(value.s_sgst);
		row.find("td:eq(5) input[type='text']").val(value.s_bill_amt);
		row.find("td:eq(6) input[type='text']").val(value.p_bill_no);
		row.find("td:eq(7) input[type='date']").val(value.p_bill_dt);
		row.find("td:eq(8) input[type='text']").val(value.p_taxable_value);
		row.find("td:eq(9) input[type='text']").val(value.p_cgst);
		row.find("td:eq(10) input[type='text']").val(value.p_sgst);
		row.find("td:eq(11) input[type='text']").val(value.p_bill_amt);
		//$('#st').html(st+parseFloat(value.s_bill_amt));
		//$('#pt').html(parseFloat(pt)+parseFloat(value.p_bill_amt));
	})
	$( document ).ajaxComplete(function() {
		var pbamt = 0.00;
		var sbamt = 0.00;
		$('.p_bill_amt').each(function(){
					pbamt += parseFloat($(this).val());
		});
		$('#pt').html(parseFloat(pbamt));
		$('.s_bill_amt').each(function(){
				sbamt += parseFloat($(this).val());
		});
		$('#st').html(parseFloat(sbamt));
	})

})

$( document ).ready(function() {  
    $("#intro").on("click","#removeRow", function(){
		var mr_amt = 0.00;
		var mramt = 0.00;
		$('.mr_amt').each(function(){
			mr_amt += parseFloat($(this).val());
        });
        $('.mramt').each(function(){
			mramt += parseFloat($(this).val());
        });
		$('#mrtot').html(mr_amt);
		$('#effectamt').html(mramt);
	});
})

$(document).ready(function() {
	$("#intro").on("change",".mr_amt", function(){  

		var mr_amt = 0.00;
		$('.mr_amt').each(function(){
			mr_amt += parseFloat($(this).val());
        });
		
		$('#mrtot').html(mr_amt);
	})
	$("#intro").on("change",".mramt", function(){ 

		var mramt = 0.00;
		$('.mramt').each(function(){
			mramt += parseFloat($(this).val());
        });
		
		$('#effectamt').html(mramt);
	})
})
$("#form").submit(function( event ) {
  //alert( "Handler for .submit() called." );
  var stotamt = parseFloat($('#stotamt').html());
  var effectamt = parseFloat($('#effectamt').html());
  if(stotamt != effectamt){
	alert('Salebill amount and Effective amount not matched');
	//event.preventDefault();
  }
  
});	
</script>