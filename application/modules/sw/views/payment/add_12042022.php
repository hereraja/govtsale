<div class="wraper">      
	<div class="col-md-11 container form-wraper" style="margin-left: 0%;">
		<form method="POST" id="form" role="form" name="add_form" action="<?php echo site_url("sw/savemr");?>" onsubmit="return validate()" >
		        <input type="hidden" name="id" value="<?php if(isset($bill_detail->id)) echo $bill_detail->id ;?>" >
				<div class="form-header">
						<h4>Payment Entry</h4>
				</div>
				<?php if(isset($bill_details)) { foreach($bill_details as $key); } ?> 
				<div class="form-group row">
					<label for="td_sw_pbsb_detail_id" class="col-sm-1 col-form-label">Salebill.<font color="red">*</font></label>
					<div class="col-sm-4">
					<select name="td_sw_pbsb_detail_id" id="td_stn_pbsb_detail_id" class="form-control " required >
					<option value="">Select Salebill</option>
								<?php
									foreach($salebill as $key1){
								?>
										<option value="<?php echo $key1->id; ?>" <?php if(isset($key->td_sw_pbsb_detail_id)) { if($key1->id == $key->td_sw_pbsb_detail_id) echo 'selected';}?>><?php echo $key1->id; ?>-<?php echo date('d/m/Y',strtotime($key1->trans_dt)); ?></option>
								<?php
									} 
								?>
				    </select>
					</div>
					<label for="trans_dt" class="col-sm-1 col-form-label">Date.<font color="red">*</font></label>
					<div class="col-sm-4">
					<input  type="date" name="trans_dt" class="form-control trans_date" id="trans_date" value="<?php if(isset($key->trans_dt)) echo $key->trans_dt ;?>" required>
					</div>
				</div>
				
				<div class="form-group row" >
					<div class="col-sm-12" id="show_sale_purchase">
					</div>	
					
				</div>
				<div class="form-header">
				<h4>MR details</h4>
				</div>
				<table class= "table table-striped table-bordered table-hover">
				<thead>
					<th style= "text-align: center">MR No.</th>  
					<th style= "text-align: center">MR Date</th>  
					<th style= "text-align: center">Pay Type</th>
					<th style= "text-align: center">Pay Date.</th>
					<th style= "text-align: center">Amount.</th>
					<th><?php if(!isset($bill_details)) { ?>
						<button class="btn btn-success" type="button" id="addrow" style= "border-left: 10px" data-toggle="tooltip" data-original-title="Add Row" data-placement="bottom"><i class="fa fa-plus" aria-hidden="true"></i></button>
						<?php } ?>
					</th>
				</thead>
				<hr>
					<?php if(isset($bill_details)) { ?>
					<tbody id="intro2" class="tables">
					<?php   $sb_amt = 0;
							$sb_total = 0;
					        $pb_amt = 0;
							$pb_total = 0;
					       foreach($bill_details as $bill_dtls){ ?>
						<tr>
						<td>
							<input type="text" name="mr_no[]" id="mr_no" class="form-control mr_no"  value="<?php if(isset($bill_dtls->mr_no)) echo $bill_dtls->mr_no ;?>" required>
						</td>
						<td>
							<input type="date" name="mr_dt[]" id="mr_dt" class="form-control"  value="<?php if(isset($bill_dtls->mr_dt)) echo $bill_dtls->mr_dt ;?>"required>
						</td>
						<td>
							<select name="trans_mode[]" id="trans_mode"  class="form-control"  required>
								<option value="">Select mode</option>
								<option value="cash" <?php if('cash' == $bill_dtls->trans_mode) echo 'selected';?>>Cash</option>
								<option value="neft" <?php if('neft' == $bill_dtls->trans_mode) echo 'selected';?>>NEFT</option>
								<option value="cheque" <?php if('cheque' == $bill_dtls->trans_mode) echo 'selected';?>>Cheque</option>
							</select>
					    </td>
						<td>
							<input type="date" name="pay_dt[]"  class="form-control" id="pay_dt" value="<?php if(isset($bill_dtls->pay_dt)) echo $bill_dtls->pay_dt ;?>"required>
						</td>
					    <td>
							<input type="text" name="amt[]"  class="form-control mramt" id="amt" value="<?php if(isset($bill_dtls->amt)) echo $bill_dtls->amt ;?>"required>                            
					    </td>
						   
						</tr>
					<?php } ?>
					</tbody>
					<tfoot>

					</tfoot>
					<?php }else{  ?>	
					
					<tbody id= "intro">
					<tr>
						<td>
							<input type="text" name="mr_no[]" id="mr_no" class="form-control mr_no"  required>
						</td>
						<td>
							<input type="date" name="mr_dt[]" id="mr_dt" class="form-control"  required>
						</td>
						<td>
							<select name="trans_mode[]" id="trans_mode"  class="form-control"  required>
								<option value="0">Select mode</option>
								<option value="cash">Cash</option>
								<option value="neft">NEFT</option>
								<option value="cheque">Cheque</option>
							</select>
					    </td>
						<td>
							<input type="date" name="pay_dt[]"  class="form-control" id="pay_dt" required>
						</td>
					    <td>
							<input type="text" name="amt[]"  class="form-control mramt" id="amt" required>                            
					    </td>
					</tr>
					</tbody>
					<tfoot>
						  
						<tr>
						</tr>
					</tfoot>
					
					<?php } ?>
				</table>
	
				<div class="form-group row">
					<div class="col-sm-10">
                    <?php if(!isset($bill_details)) { ?>
						<input type="submit" class="btn btn-info" value="Save" />
					<?php } ?>
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

    $("#addrow").click(function()
    {
		var newElement= '<tr>'
			+'<td><input type="text" name="mr_no[]" id="mr_no" class="form-control mr_no " id="mr_no" required>'
			+'</td>'
			+'<td><input type="date" name="mr_dt[]" id="mr_dt" class="form-control required " id="mr_dt" required>'
			+'</td>'
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
			+'<td><input type="text" name="amt[]"  class="form-control mramt " id="amt" required>'
			+'</td>'
			 +'<td>'
				+'<button class="btn btn-danger removeRow" type= "button" data-toggle="tooltip" data-original-title="Remove Row" data-placement="bottom" id="removeRow"><i class="fa fa-remove" aria-hidden="true"></i></button>'
			+'</td>'
			+'</tr>';
					
		$("#intro").append($(newElement)); 
    });  
                            
});


  $("#intro").on('click', '.removeRow',function(){
            
            $(this).parents('tr').remove();

    });
</script>

<script>

$('#intro').on('change', '#mr_no', function(){

    var row = $(this).closest('tr');
    var mr_no = row.find('td:eq(0) :input').val();

    $.get('<?php echo site_url("sw/js_get_mrno");?>',{ mr_no: mr_no })
    .done(function(data)
    {
        var result=JSON.parse(data);
        var mr_dt=result.mr_dt;
        var chq_type=result.mode;
        var chq_dt=result.mr_dt;
        var amt=result.amount;

        row.find('td:eq(1) :input').val(mr_dt);
        row.find('td:eq(2) :input').val(chq_type);
        row.find('td:eq(3) :input').val(chq_dt);
        row.find('td:eq(4) :input').val(amt);
        var sum_mr = 0;
	$('.mramt').each(function(){
	   
		sum_mr += parseFloat($(this).val());  // Or this.innerHTML, this.innerText
		// sum += $('#amt').val();
	});

	$('.mr_add_gst').change(function(){

	$('#tot_mr_amt').val(sum_mr + parseFloat($('.mr_add_gst').val()) -  parseFloat($('.mr_less_gst').val()) );
	console.log('hi');
	$tot_mr_amt=$("#tot_mr_amt").val();
	$con_margin = $tot_mr_amt*.06;
	console.log($con_margin);
	$('.confed_margin').val($con_margin);
	$('#tot_mr_amt').val(sum_mr + parseFloat($('.mr_add_gst').val()) -  parseFloat($('.mr_less_gst').val()) - parseFloat($con_margin));
	});

	$('.mr_less_gst').change(function(){

	$('#tot_mr_amt').val(sum_mr + parseFloat($('.mr_add_gst').val()) -  parseFloat($('.mr_less_gst').val()) );
	// console.log('hi');
	$tot_mr_amt=$("#tot_mr_amt").val();
	$con_margin = $tot_mr_amt*.06;
	console.log($con_margin);
	$('.confed_margin').val($con_margin);
	$('#tot_mr_amt').val(sum_mr + parseFloat($('.mr_add_gst').val()) -  parseFloat($('.mr_less_gst').val()) - parseFloat($con_margin ));
	});

	 $('.confed_margin').change(function(){
		$con_margin= $('.confed_margin').val();
	 $('#tot_mr_amt').val(sum_mr + parseFloat($('.mr_add_gst').val()) -  parseFloat($('.mr_less_gst').val()) - parseFloat($con_margin ));
	// // console.log('hi');
	});


	$('.margin_add_gst').change(function(){
		$con_margin= $('.confed_margin').val();
	$margin_add_gst =$('.margin_add_gst').val();
	 $('#tot_mr_amt').val(sum_mr + parseFloat($('.mr_add_gst').val()) -  parseFloat($('.mr_less_gst').val()) - parseFloat($con_margin ) + parseFloat($margin_add_gst));

	});

	$('.margin_less_gst').change(function(){
	$con_margin= $('.confed_margin').val();
	$margin_add_gst =$('.margin_add_gst').val();
	$margin_less_gst=$('.margin_less_gst').val();
	 $('#tot_mr_amt').val(sum_mr + parseFloat($('.mr_add_gst').val()) -  parseFloat($('.mr_less_gst').val()) - parseFloat($con_margin ) + parseFloat($margin_add_gst) - parseFloat($margin_less_gst));

	});

	$("#tot_mr_amt").val(sum_mr) ;  

		});
	 
	 
	  
	})

    </script>


<script>
	$('#intro').on('change', '.mramt', function(){
		var mramt = 0 ;
		
		$('.mramt').each(function(){
			
		   mramt += parseFloat($(this).val()) ? parseFloat($(this).val()) : 0.00;  // Or this.innerHTML, this.innerText   
		   
		});
		$('.tot_mr_amt').val(mramt);
	});
	
	 /// Code For Less Sale bIll Calculation
	$('.mr_add_gst').change(function(){
		
		var mr_add_gst = 0 ;
		var tot_mr_amt  = 0 ;
		
		$('.mramt').each(function(){
		   tot_mr_amt += parseFloat($(this).val()) ? parseFloat($(this).val()) : 0.00;  // Or this.innerHTML, this.innerText   
		});
		mr_add_gst = parseFloat($(this).val()) ? parseFloat($(this).val()) : 0.00;  // Or this.innerHTML, this.innerText   
		
		$('.tot_mr_amt').val(tot_mr_amt + mr_add_gst);
	});
	
	
	$('.mr_less_gst').change(function(){
		
		var mr_less_gst = 0 ;
		var tot_mr_amt  = 0 ;
		
		$('.mramt').each(function(){
		   tot_mr_amt += parseFloat($(this).val()) ? parseFloat($(this).val()) : 0.00;  // Or this.innerHTML, this.innerText   
		});
		mr_less_gst = parseFloat($(this).val()) ? parseFloat($(this).val()) : 0.00;  // Or this.innerHTML, this.innerText   
		
		$('.tot_mr_amt').val(tot_mr_amt - mr_less_gst);
	});
	
	$('.confed_margin').change(function(){
		
		var confed_margin = 0;
		var tot_mr_amt  = 0;
		var mr_less_gst  = parseFloat($('.mr_less_gst').val()) ? parseFloat($('.mr_less_gst').val()) : 0.00;
		
		$('.mramt').each(function(){
		   tot_mr_amt += parseFloat($(this).val()) ? parseFloat($(this).val()) : 0.00;  // Or this.innerHTML, this.innerText   
		});
		confed_margin = parseFloat($(this).val()) ? parseFloat($(this).val()) : 0.00;  // Or this.innerHTML, this.innerText   
		
		$('.tot_mr_amt').val(tot_mr_amt - mr_less_gst- confed_margin);
	});
	
	$('.margin_add_gst').change(function(){
		
		var margin_add_gst = 0;
		var tot_mr_amt  = 0;
		var mr_less_gst  = parseFloat($('.mr_less_gst').val()) ? parseFloat($('.mr_less_gst').val()) : 0.00;
		var confed_margin  = parseFloat($('.confed_margin').val()) ? parseFloat($('.confed_margin').val()) : 0.00;
		
		$('.mramt').each(function(){
		   tot_mr_amt += parseFloat($(this).val()) ? parseFloat($(this).val()) : 0.00;  // Or this.innerHTML, this.innerText   
		});
		margin_add_gst = parseFloat($(this).val()) ? parseFloat($(this).val()) : 0.00;  // Or this.innerHTML, this.innerText   
		
		$('.tot_mr_amt').val(tot_mr_amt - mr_less_gst- confed_margin+margin_add_gst);
	});
	
	$('.margin_less_gst').change(function(){
		
		var margin_less_gst = 0;
		var tot_mr_amt  = 0;
		var mr_less_gst  = parseFloat($('.mr_less_gst').val()) ? parseFloat($('.mr_less_gst').val()) : 0.00;
		var confed_margin  = parseFloat($('.confed_margin').val()) ? parseFloat($('.confed_margin').val()) : 0.00;
		
		$('.mramt').each(function(){
		   tot_mr_amt += parseFloat($(this).val()) ? parseFloat($(this).val()) : 0.00;  // Or this.innerHTML, this.innerText   
		});
		margin_less_gst = parseFloat($(this).val()) ? parseFloat($(this).val()) : 0.00;  // Or this.innerHTML, this.innerText   
		
		$('.tot_mr_amt').val(tot_mr_amt - mr_less_gst- confed_margin - margin_less_gst);
	});
	
	



$('#td_stn_pbsb_detail_id').change(function(){

    var td_sw_pbsb_detail_id = $(this).val();
	var sbamt = 0.00;var pbamt = 0.00;
    $.get('<?php echo site_url("sw/js_get_salebill_detail");?>',{ td_sw_pbsb_detail_id: td_sw_pbsb_detail_id })
    .done(function(data)
    {
	    var string = '<table class="table table-striped table-bordered table-hover"><tr><th>Order No</th><th>sale bill no</th><th>sale bill dt</th><th>sale cgst</th><th>sale Sgst</th><th>Sale bill amt</th><th>Pur bill no</th><th>Pur bill dt</th><th> cgst</th><th> Sgst</th><th>Pur bill amt</th></tr>';
		
		$.each(JSON.parse(data), function( index, value ) {
			
			string += '<tr><td>'+value.c_order_no+'</td><td>'+value.s_bill_no+'</td><td>'+value.s_bill_dt+'</td><td>'+value.s_cgst+'</td><td>'+value.s_sgst+'</td><td>'+value.s_bill_amt+'</td><td>'+value.p_bill_no+'</td><td>'+value.p_bill_dt+'</td><td>'+value.p_cgst+'</td><td>'+value.p_sgst+'</td><td>'+value.p_bill_amt+'</td></tr>';
            sbamt += parseFloat(value.s_bill_amt);
			pbamt += parseFloat(value.p_bill_amt);
        });
		string +='<tr><td colspan="2" style="text-align: right;"></td><td colspan="3" style="text-align: right;">Total:</td><td id="st">'+sbamt+'</td><td></td><td></td><td></td><td></td><td id="pt">'+pbamt+'</td></tr>';
		string +='<tr><td colspan="2" style="text-align: right;"></td><td colspan="3" style="text-align: right;">Less Amount:</td><td><input type="text" id="sb_less_amt" class="form-control sb_less_amt" name="sb_less_amt" value="" ></td><td></td><td></td><td></td><td></td><td><input type="text" class="form-control pb_less_amt" name="pb_less_amt" value="<?php if(isset($bill_detail->pb_less_amt)) echo $bill_detail->pb_less_amt ;?>"></td></tr>';
		string +='<tr><td colspan="2" style="text-align: right;"></td><td colspan="3" style="text-align: right;">Total:</td><td id="stotamt"></td><td></td><td></td><td></td><td></td><td id="ptotamt"></td></tr>';
		string +='</table>';
		
		$('#show_sale_purchase').html(string);

	})
})
$(document).ajaxComplete(function() {
	$('.sb_less_amt').change(function(){
	var st = $('#st').html();
	var pt = $('#pt').html();
	var	sb_less_amt = $(this).val();
	var pb_less_amt = 0.00;
		$('.pb_less_amt').val(sb_less_amt-(sb_less_amt*.01));
		$('#stotamt').html(st-(sb_less_amt));
		$('#ptotamt').html(pt-(sb_less_amt-(sb_less_amt*.01)));
	})
})	

 </script>