<div class="wraper">      
	<div class="col-md-12 container form-wraper" style="margin-left: 0%;">
		<form method="POST" id="form" role="form" name="add_form" action="<?php echo site_url("stationary/savebill");?>" onsubmit="return validate()" >
		        <input type="hidden" name="id" value="<?php if(isset($bill_detail->id)) echo $bill_detail->id ;?>" >
				<div class="form-header">
						<h4>Bill Entry</h4>
				</div>
				<div class="form-group row">
					<label for="trans_dt" class="col-sm-1 col-form-label">Date.<font color="red">*</font></label>
					<div class="col-sm-3">
					<input  type="date" name="trans_dt" class="form-control trans_date" id="trans_date" value="<?php if(isset($bill_detail->trans_dt)) echo $bill_detail->trans_dt ;?>"  required>
					</div>
					<label for="trans_dt" class="col-sm-1 col-form-label">Supplier.<font color="red">*</font></label>
					<div class="col-sm-3">
					<select name="supplier_id" id="supplier_id" class="form-control autoUnit_cls" required>
                            <option value="">Select Supplier</option>
                            <?php
                                foreach($suppliers as $key1)
                                { ?>
                                    <option value="<?php echo $key1->sl_no; ?>" <?php if(isset($bill_detail->supplier_id)) { if($bill_detail->supplier_id == $key1->sl_no) echo "selected" ; }?>><?php echo $key1->name; ?></option>
                                <?php
                                } ?>
                                
                        </select> 
					</div>
					<label for="trans_dt" class="col-sm-1 col-form-label">Customer<font color="red">*</font></label>
					<div class="col-sm-3">
					        <select name="project" id="project" class="form-control select2" required >
								<option value="">Select Project</option>
								<?php
									foreach($projects as $key1){
								?>
										<option value="<?php echo $key1->project_cd; ?>"><?php echo $key1->name; ?></option>
								<?php
									} 
								?>
						    </select>
					</div>
				</div>
				<div class="form-header">
				<h4>Bills</h4>
				</div>
				<div style='overflow-x: scroll;overflow-y: hidden;white-space:nowrap;'>
				<table class="table">
					<thead>
						<tr>
							<th>Product</th>
							<th>HSN CODE</th>
							<th>S Bill No.</th>
							<th>Date</th>
							<th>Qty.</th>
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
							<th>
							<?php if(!isset($bill_details)) { ?>
							<button type="button" class="btn btn-success addAnotherrow"><i class="fa fa-plus"></i></button>
							<?php } ?>
							
							</th>
						</tr>
					</thead>
					<?php if(isset($bill_details)) { ?>
					<tbody id="intro2" class="tables">
					<?php   $sb_amt = 0;
							$sb_total = 0;
					        $pb_amt = 0;
							$pb_total = 0;
					       foreach($bill_details as $bill_dtls){ ?>
						<tr>
							<td>
							<input type="hidden" name="td_stn_pbsb_details_id[]" value="<?php if(isset($bill_dtls->td_stn_pbsb_details_id)) echo $bill_dtls->td_stn_pbsb_details_id ;?>" >
							<select name="project[]" id="project" class="form-control " required  style="width:150px">
								<option value="">Select Project</option>
								<?php
									foreach($projects as $key1){
								?>
										<option value="<?php echo $key1->project_cd; ?>" <?php if($key1->project_cd == $bill_dtls->project_cd) echo 'selected';?>><?php echo $key1->name; ?></option>
								<?php
									} 
								?>
						        </select>
							</td>
							<td><input type="text"  class="form-control order_no"  id="order_no" style="width:150px"  name="order_no[]" value="<?php if(isset($bill_dtls->c_order_no)) echo $bill_dtls->c_order_no ;?>"  required></td>
							<td><input type="text"  class="form-control s_bill_no"  id="s_bill_no" style="width:100px"  name="s_bill_no[]"  value="<?php if(isset($bill_dtls->s_bill_no)) echo $bill_dtls->s_bill_no ;?>" required></td>
							<td><input type="date"  class="form-control s_bill_dt"   style="width:150px" name="s_bill_dt[]"  value="<?php if(isset($bill_dtls->s_bill_dt)) echo $bill_dtls->s_bill_dt ;?>" required></td>
							<td><input type="text"  class="form-control s_value"  name="s_taxable_value[]" style="width:80px" value="<?php if(isset($bill_dtls->s_taxable_value)) echo $bill_dtls->s_taxable_value ;?>" required></td>
							<td><input type="text"  class="form-control gst_rate"  name="gst_rate[]" style="width:60px" value="<?php if(isset($bill_dtls->gst_rate)) echo $bill_dtls->gst_rate ;?>" required></td>
							<td><input type="text"  class="form-control s_cgst"  name="s_cgst[]" style="width:60px" value="<?php if(isset($bill_dtls->s_cgst)) echo $bill_dtls->s_cgst ;?>" required></td>
							<td><input type="text"  class="form-control s_sgst"  name="s_sgst[]" style="width:60px" value="<?php if(isset($bill_dtls->s_sgst)) echo $bill_dtls->s_sgst ;?>" required></td>
							<td><input type="text"  class="form-control s_bill_amt"  name="s_bill_amt[]" value="<?php if(isset($bill_dtls->s_bill_amt)) {echo $bill_dtls->s_bill_amt ; $sb_amt+=$bill_dtls->s_bill_amt ; }?>" required></td>
							<td><input type="text"  class="form-control p_bill_no"   style="width:100px" name="p_bill_no[]"  value="<?php if(isset($bill_dtls->p_bill_no)) echo $bill_dtls->p_bill_no ;?>" required></td>
							<td><input type="date"  class="form-control p_bill_dt"   style="width:150px" name="p_bill_dt[]" value="<?php if(isset($bill_dtls->p_bill_dt)) echo $bill_dtls->p_bill_dt ;?>"  required></td>
							<td><input type="text"  class="form-control p_value"  name="p_taxable_value[]" style="width:80px" value="<?php if(isset($bill_dtls->p_taxable_value)) echo $bill_dtls->p_taxable_value ;?>" required></td>
							<td><input type="text"  class="form-control p_cgst"  name="p_cgst[]" style="width:60px" value="<?php if(isset($bill_dtls->p_cgst)) echo $bill_dtls->p_cgst ;?>" required ></td>
							<td><input type="text"  class="form-control p_sgst"  name="p_sgst[]"  style="width:60px" value="<?php if(isset($bill_dtls->p_sgst)) echo $bill_dtls->p_sgst ;?>"required></td>
							<td><input type="text"  class="form-control p_bill_amt"  name="p_bill_amt[]" value="<?php if(isset($bill_dtls->p_bill_amt)) { echo $bill_dtls->p_bill_amt; $pb_amt+=$bill_dtls->p_bill_amt; }?>" required></td>
							<td></td>
						   
						</tr>
					<?php } ?>
					</tbody>
					<tfoot>
						
						<tr>
							<td colspan="4" style="text-align: right;"></td>
							<td colspan="4" style="text-align: right;">Less Amount:</td>
							<td><input type="text" id="sb_less_amt" class="form-control sb_less_amt" name="sb_less_amt" value="<?php if(isset($bill_detail->sb_less_amt)) echo $bill_detail->sb_less_amt ;?>" ></td>
											   <td></td><td></td><td></td>
							<td></td><td></td>
							<td><input type="text" class="form-control pb_less_amt" name="pb_less_amt" value="<?php if(isset($bill_detail->pb_less_amt)) echo $bill_detail->pb_less_amt ;?>"></td>
							<td></td><td></td><td></td>
						</tr>
						<tr>
						    <td colspan="4"></td>
                            <td colspan="4" style="text-align: right;">Add Amount:</td>
							<td><input type="text" id="s_bill_add_amt" class="form-control s_bill_add_amt" name="s_bill_add_amt" value="<?php if(isset($bill_detail->s_bill_add_amt)) echo $bill_detail->s_bill_add_amt ;?>"></td>
							<td></td>
							<td colspan="4" ></td>
							<td><input  colspan="5" type="text" class="form-control p_bill_add_amt" name="p_bill_add_amt" value="<?php if(isset($bill_detail->p_bill_add_amt)) echo $bill_detail->p_bill_add_amt ;?>"></td>

						</tr>
						<tr>
						   <td colspan="4"></td>
						   <td colspan="4" style="text-align: right;">Less Round Off:</td>
							<td><input type="text" id="s_bill_round_off" class="form-control s_bill_round_off" name="s_bill_round_off" value="<?php if(isset($bill_detail->s_bill_round_off)) echo $bill_detail->s_bill_round_off ;?>"></td>
							<td></td>
							<td colspan="4"></td>
							<td><input   type="text" class="form-control p_bill_round_off" name="p_bill_round_off" value="<?php if(isset($bill_detail->p_bill_round_off)) echo $bill_detail->p_bill_round_off ;?>"></td>

						</tr>
						<tr>
						    <td colspan="4"></td>
						    <td colspan="4" style="text-align: right;">Add Round Off:</td>
							<td><input type="text" id=s_bill_add_rnd_off class="form-control s_bill_add_rnd_off" name="s_bill_add_rnd_off" value="<?php if(isset($bill_detail->s_bill_add_rnd_off)) echo $bill_detail->s_bill_add_rnd_off ;?>"></td>
							<td></td>
							<td colspan="4"></td>
							<td><input   type="text" class="form-control p_bill_add_rnd_off" name="p_bill_add_rnd_off" value="<?php if(isset($bill_detail->p_bill_add_rnd_off)) echo $bill_detail->p_bill_add_rnd_off ;?>"></td>

						</tr>
						<tr>
							<td>Total:</td>
							<td colspan="7">
							<td ><input type="text" style="width:100px;text-align: left;" class="form-control tot_s_bill" id="tot_s_bill" name="tot_s_bill" value="<?php echo $sb_amt-$bill_detail->sb_less_amt;?>" readonly>
							</td>
							 </td>
							 <td colspan="5" >
							<td><input type="text" style="width:100px;text-align: left;" class="form-control tot_p_bill" id="tot_p_bill" name="tot_p_bill" value="<?php echo $pb_amt-$bill_detail->pb_less_amt;?>" readonly></td>
						   
							<td></td></td>
							<td></td>
							<td></td>
							
						</tr>

					</tfoot>
					<?php }else{  ?>	
					
					<tbody id="intro2" class="tables">
						<tr>
							<td><select name="product[]" id="product" class="form-control select2 product" required  style="width:140px">
								<option value="">Select Product</option>
								<?php
									foreach($products as $prod){
								?>
										<option value="<?php echo $prod->id; ?>"><?php echo $prod->prod_name; ?></option>
								<?php
									} 
								?>
						        </select>
							</td>
							<td><input type="text"  class="form-control hsn_code"  id="hsn_code" style="width:100px"  name="hsn_code[]"  value="" readonly></td>
							<td><input type="text"  class="form-control s_bill_no"  id="s_bill_no" style="width:100px"  name="s_bill_no[]"  required></td>
							<td><input type="date"  class="form-control s_bill_dt"   style="width:130px" name="s_bill_dt[]"   required></td>
							<td><input type="text"  class="form-control qty"  name="qty[]" style="width:60px" value="" required></td>
							<td><input type="text"  class="form-control s_value"  name="s_taxable_value[]" style="width:80px" value="0.00" required></td>
							<td><input type="text"  class="form-control gst_rate"  name="gst_rate[]" style="width:60px" value="0.00" required></td>
							<td><input type="text"  class="form-control s_cgst"  name="s_cgst[]" style="width:60px" value="0.00" required></td>
							<td><input type="text"  class="form-control s_sgst"  name="s_sgst[]" style="width:60px" value="0.00"  required></td>
							<td><input type="text"  class="form-control s_bill_amt"  name="s_bill_amt[]"  style="width:100px" required></td>
							<td><input type="text"  class="form-control p_bill_no"   style="width:100px" name="p_bill_no[]"   required></td>
							<td><input type="date"  class="form-control p_bill_dt"   style="width:130px" name="p_bill_dt[]"   required></td>
							<td><input type="text"  class="form-control p_value"  name="p_taxable_value[]" style="width:80px" value="0.00" required></td>
							<td><input type="text"  class="form-control p_cgst"  name="p_cgst[]" style="width:60px" required></td>
							<td><input type="text"  class="form-control p_sgst"  name="p_sgst[]"  style="width:60px" required></td>
							<td><input type="text"  class="form-control p_bill_amt"  name="p_bill_amt[]" style="width:100px" required></td>
							<td></td>
						</tr>
					
					</tbody>
					<tfoot>
						<tr>
							<td colspan="3"></td>
							<td ><strong>Total</strong></td>
							<td></td>
							<td><input type="text" id="saletaxable_totamt" class="form-control saletaxable_totamt" name="saletaxable_totamt" value="" readonly></td>
							<td></td>
							<td><input type="text" id="scgst_totamt" class="form-control scgst_totamt" name="scgst_totamt" value="" readonly></td>
							<td><input type="text" id="ssgst_totamt" class="form-control ssgst_totamt" name="ssgst_totamt" value="" readonly></td>
							<td><input type="text" id="sb_tot_amt" class="form-control sb_tot_amt" name="sb_tot_amt" value="" readonly></td>
							<td></td>
							<td colspan="1"></td>
							<td><input type="text" id="purtaxable_totamt" class="form-control purtaxable_totamt" name="purtaxable_totamt" value="" readonly></td>
							<td><input type="text" id="pcgst_totamt" class="form-control pcgst_totamt" name="pcgst_totamt" value="" readonly></td>
							<td><input type="text" id="psgst_totamt" class="form-control psgst_totamt" name="psgst_totamt" value="" readonly></td>
							<td><input type="text" id="pb_tot_amt" class="form-control pb_tot_amt" name="pb_tot_amt" style="width:100px" value="" readonly></td>
							<td></td><td></td><td></td>
						</tr>

					</tfoot>
					
					<?php } ?>
				</table>
				</div>
				<div class="form-group row">
				</div>
				<div class="form-group row">
				</div>
				<div class="form-group row">
				
					
					<div class="col-sm-10">
                    
						<input type="submit" class="btn btn-info" value="Save" />
					
					</div>
					
				

				</div>

			</form>


	</div>

</div>


<script>

$(document).ready(function()
{   
    $('#refNo').hide();
    // <!-- To get Order No as per Project Selected  -->
    $('#project_cd').on( "change", function()
    {
        $.get('<?php echo site_url("stationary/js_get_collection_orderForProject");?>',{ project_cd: $(this).val() })
        .done(function(data)
        {
            var string = '<option value="0">Select Order</option>';
            $.each(JSON.parse(data), function( index, value ) {
                string += '<option value="'+value.order_no +'">'+value.order_no+'</option>'
            });
            $('#order_no').html(string);            
        });

    });

    // To show or hide the Ref No section -->  
    $('#mode').on( "change", function()
    {

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

$('.addAnother').click(function(){

let row = '<tr>' +
          
           
          '<td>'+ 
        '<select name="project[]" id="project" style="width:200px"class="form-control required" ><option value="">Select Project</option>'+
        
        '<?php foreach($projects as $key1){ ' +

'?> ' +

    ' <option value="<?php echo $key1->project_cd; ?>">'+'"<?php echo str_replace("'","",$key1->name); ?>"'+'</option> ' +

'<?php } ' +
'?> ' +
        '</select>'+
         '</td>'+
          '<td><input type="text" class="form-control order_no" name="order_no[]" required></td>'
          +'<td>'
          +'<button class="btn btn-danger removeRow" type= "button" data-toggle="tooltip" data-original-title="Remove Row" data-placement="bottom" id="removeRow"><i class="fa fa-remove" aria-hidden="true"></i></button>'
          +'</td>'
          '</tr>';

$('#intro1').append(row);

});
  var count = 1 ;
$('.addAnotherrow').click(function(){
	 count++;
	

let row = '<tr>' +
			'<td>'+ 
					'<select name="product[]" id="product'+count+'" style="width:140px"class="form-control product" required><option value="">Select Product</option>'+
					'<?php foreach($products as $prod){ ' +
			    '?> ' +
				' <option value="<?php echo $prod->id; ?>">'+'<?php echo str_replace("'","",$prod->prod_name); ?>'+'</option> ' +
			    '<?php } ' +
			    '?> ' +
                '</select>'+
            '</td>'
			+'<td><input type="text" class="form-control hsn_code" style="width:100px" name="hsn_code[]" id="hsn_code" readonly></td>'
            +'<td><input type="text" class="form-control s_bill_no"  style="width:100px" name="s_bill_no[]" id="s_bill_no" required></td>'
            +'<td><input type="date" class="form-control s_bill_dt"  style="width:130px" name="s_bill_dt[]" required></td>'
			+'<td><input type="text"  class="form-control qty"  name="qty[]" style="width:60px" value="" required></td>'
			+'<td><input type="text"  class="form-control s_value"  name="s_taxable_value[]" style="width:80px" value="0.00" required></td>'
			+'<td><input type="text"  class="form-control gst_rate"  name="gst_rate[]" style="width:60px" value="0.00" required></td>'
			+'<td><input type="text"  class="form-control s_cgst"  name="s_cgst[]"  required></td>'
			+'<td><input type="text"  class="form-control s_sgst"  name="s_sgst[]"  required></td>'
            +'<td><input type="text" class="form-control s_bill_amt" name="s_bill_amt[]" required></td>'
            +'<td><input type="text" class="form-control p_bill_no"  style="width:100px" name="p_bill_no[]" required></td>' 
            +'<td><input type="date" class="form-control p_bill_dt"  style="width:130px" name="p_bill_dt[]" required></td>'
			+'<td><input type="text"  class="form-control p_value"  name="p_taxable_value[]" style="width:80px" value="0.00" required></td>'
			+'<td><input type="text"  class="form-control p_cgst"  name="p_cgst[]"  required></td>'
			+'<td><input type="text"  class="form-control p_sgst"  name="p_sgst[]"  required></td>'
            +'<td><input type="text" class="form-control p_bill_amt" name="p_bill_amt[]" style="width:100px" required></td>'
            +'<td><button type="button" class="btn btn-danger removeRow"><i class="fa fa-remove"></i></button></td>'
          +'</tr>';
 
$('#intro2').append(row);
//$('#order_no'+count, '#intro2').select2();
$('#product'+count, '#intro2').select2();
});
                            
});


  $("#intro").on('click', '.removeRow',function(){
            
            $(this).parents('tr').remove();

        });

  $("#intro1").on('click', '.removeRow',function(){
            
            $(this).parents('tr').remove();
           
        });

        $("#intro2").on('click', '.removeRow',function(){
            
            $(this).parents('tr').remove();
 
        });

</script>


<script>
	$(document).ready(function(){ 
	$("#intro2").on('change','.s_bill_no11',function(){ 
		var row = $(this).closest('tr');
		var cnts = 0;
		sbno = $(this).val();
		$.get("<?php echo site_url("stationary/js_get_sbno");?>"
			,{s_bill_no:$(this).val() }
			).done(function(data){
			var cnt = JSON.parse(data);
			if(cnt.cnt > 0){
				alert('This Sellbill number already exist');
				row.css("background","red");
			}else{
				//$( document ).ajaxComplete(function() {
					$('.s_bill_no').each(function(){
					if(sbno == parseFloat($(this).val())){
						cnts++;
					}
					});
					if(cnts > 1){
						alert('duplicate data');
						row.css("background","red");
					}else{
						row.css("background","");
					}
					
				//})
			}
		});
    });

	$("#intro2").on('change','.product',function(){ 
		var row = $(this).closest('tr');
		var cnts = 0;
		$.get("<?php echo site_url("stationary/js_get_hsncode");?>"
			,{prod_id:$(this).val() }
			).done(function(data){
			var cnt = JSON.parse(data);
			row.find('td:eq(1) .hsn_code').val(cnt);
		});
    });

})
    ///  **** Code Start For Sale bill calculation  ***  /// 
	
	
	
	 /// Code For Less Sale bIll Calculation
	$('.sb_less_amt').change(function(){
		
		var sb_less_amt = 0 ;
		var tot_s_bill  = 0 ;
		$('.s_bill_amt').each(function(){
		tot_s_bill += parseFloat($(this).val()) ? parseFloat($(this).val()) : 0.00;  // Or this.innerHTML, this.innerText   
		});
		sb_less_amt = parseFloat($(this).val()) ? parseFloat($(this).val()) : 0.00;  // Or this.innerHTML, this.innerText   
		
		$('.pb_less_amt').val((sb_less_amt-(sb_less_amt*.06)).toFixed());
		var tot_p_bill = 0;
		$('.p_bill_amt').each(function(){
		tot_p_bill += parseFloat($(this).val()) ? parseFloat($(this).val()) : 0.00;  // Or this.innerHTML, this.innerText   
		});
		$('.tot_p_bill').val((tot_p_bill-(sb_less_amt-(sb_less_amt*.06))).toFixed());
		
		$('.tot_s_bill').val((tot_s_bill-sb_less_amt).toFixed());
	});
	/// Code For Add Sale bIll Calculation
	$('.s_bill_add_amt').change(function(){
		
		var s_bill_add_amt = 0 ;
		var tot_s_bill  = 0 ;
		$('.s_bill_amt').each(function(){
		tot_s_bill += parseFloat($(this).val()) ? parseFloat($(this).val()) : 0.00;  // Or this.innerHTML, this.innerText   
		});
		s_bill_add_amt = parseFloat($(this).val()) ? parseFloat($(this).val()) : 0.00;  // Or this.innerHTML, this.innerText   
		
		$('.tot_s_bill').val(tot_s_bill + s_bill_add_amt);
	});
	
	$('.s_bill_round_off').change(function(){
		
		var s_bill_round_off = 0 ;
		var tot_s_bill  = 0 ;
		$('.s_bill_amt').each(function(){
		tot_s_bill += parseFloat($(this).val()) ? parseFloat($(this).val()) : 0.00;  // Or this.innerHTML, this.innerText   
		});
		s_bill_round_off = parseFloat($(this).val()) ? parseFloat($(this).val()) : 0.00;  // Or this.innerHTML, this.innerText   
		
		$('.tot_s_bill').val(tot_s_bill - s_bill_round_off);
	});
	
	$('.s_bill_add_rnd_off').change(function(){
		
		var s_bill_add_rnd_off = 0 ;
		var tot_s_bill  = 0 ;
		$('.s_bill_amt').each(function(){
		tot_s_bill += parseFloat($(this).val()) ? parseFloat($(this).val()) : 0.00;  // Or this.innerHTML, this.innerText   
		});
		s_bill_add_rnd_off = parseFloat($(this).val()) ? parseFloat($(this).val()) : 0.00;  // Or this.innerHTML, this.innerText   
		$('.tot_s_bill').val(tot_s_bill + s_bill_add_rnd_off);
	});
	
	 /// Code For Less Purchase bIll Calculation
	$('.pb_less_amt').change(function(){
		
		var pb_less_amt = 0 ;
		var tot_p_bill  = 0 ;
		$('.p_bill_amt').each(function(){
		    tot_p_bill += parseFloat($(this).val()) ? parseFloat($(this).val()) : 0.00;  // Or this.innerHTML, this.innerText 
		});

		pb_less_amt = parseFloat($(this).val()) ? parseFloat($(this).val()) : 0.00;  // Or this.innerHTML, this.innerText   
		
		$('.tot_p_bill').val(tot_p_bill-pb_less_amt);
	});
	$('.p_bill_add_amt').change(function(){
		
		var p_bill_add_amt = 0 ;
		var tot_p_bill  = 0 ;
		$('.p_bill_amt').each(function(){
		    tot_p_bill += parseFloat($(this).val()) ? parseFloat($(this).val()) : 0.00;  // Or this.innerHTML, this.innerText 
		});
		p_bill_add_amt = parseFloat($(this).val()) ? parseFloat($(this).val()) : 0.00;  // Or this.innerHTML, this.innerText   
		
		$('.tot_p_bill').val(tot_p_bill + p_bill_add_amt);
	});
	$('.p_bill_round_off').change(function(){
		
		var p_bill_round_off = 0 ;
		var tot_p_bill  = 0 ;
		$('.p_bill_amt').each(function(){
		    tot_p_bill += parseFloat($(this).val()) ? parseFloat($(this).val()) : 0.00;  // Or this.innerHTML, this.innerText 
		});
		p_bill_round_off = parseFloat($(this).val()) ? parseFloat($(this).val()) : 0.00;  // Or this.innerHTML, this.innerText   
		
		$('.tot_p_bill').val(tot_p_bill - p_bill_round_off);
	});
	$('.p_bill_add_rnd_off').change(function(){
		
		var p_bill_add_rnd_off = 0;
		var tot_p_bill  = 0 ;
		$('.p_bill_amt').each(function(){
		    tot_p_bill += parseFloat($(this).val()) ? parseFloat($(this).val()) : 0.00;  // Or this.innerHTML, this.innerText 
		});
		p_bill_add_rnd_off = parseFloat($(this).val()) ? parseFloat($(this).val()) : 0.00;  // Or this.innerHTML, this.innerText   
		
		$('.tot_p_bill').val(tot_p_bill+p_bill_add_rnd_off);
	});
	

    $('#intro2').on('change', '.p_bill_dt', function(){
	 
		var row       = $(this).closest('tr');
		var s_bill_dt = row.find('td:eq(3) :input').val();
		var p_bill_dt = $(this).val();
		
		if( s_bill_dt != '' ){
			if(new Date(s_bill_dt) < new Date(p_bill_dt))
			{
				alert('Purchase date can not be greater than Sale Date');
				row.find('td:eq(6) :input').val('');
			}else{
				
				
			}
		}else{
			alert('Please select Sale bill date');
			row.find('td:eq(6) :input').val('');
		}
	
    })	

    $('#intro2').on('change', '.s_bill_dt', function(){     //    Code for salebill date to purchase bill date
	 
		var row       = $(this).closest('tr');
		var s_bill_dt = $(this).val();
		row.find('td:eq(11) :input').val(s_bill_dt);
	
    })
	
	//  ***** Start Input Effect on Sale bill Amount      //

    $('#intro2').on('change', '.s_bill_amt', function(){
	 
		var row       = $(this).closest('tr');
		var tot_s_bill = 0;
		var sb_less_amt = 0 ;
		var p_less_amt = 0 ;
		var s_bill_amt = $(this).val();
		sb_less_amt = parseFloat($('.sb_less_amt').val()) ? parseFloat($('.sb_less_amt').val()) : 0.00;
		p_less_amt  = parseFloat($('.pb_less_amt').val()) ? parseFloat($('.pb_less_amt').val()) : 0.00;
		row.find('td:eq(14) :input').val((s_bill_amt-(s_bill_amt*.06)).toFixed());
		var tot_p_bill = 0;
		$('.p_bill_amt').each(function(){
		tot_p_bill += parseFloat($(this).val()) ? parseFloat($(this).val()) : 0.00;  // Or this.innerHTML, this.innerText   
		});
		
		$('.s_bill_amt').each(function(){
		tot_s_bill += parseFloat($(this).val()) ? parseFloat($(this).val()) : 0.00;  // Or this.innerHTML, this.innerText   
		});
		$('.sb_tot_amt').val((tot_s_bill).toFixed());
		$('.tot_s_bill').val((tot_s_bill-sb_less_amt).toFixed());
		$('.pb_tot_amt').val((tot_p_bill).toFixed());
		$('.tot_p_bill').val((tot_p_bill-p_less_amt).toFixed());
	
    })
	
	//  ***** End Input Effect on Sale bill Amount      //
	
	
	//  ***** Start code for total calculation of purchase bill     // 
	
		$('#intro2').on('change', '.p_bill_amt', function(){
			var p_bill_amt = 0 ;
			var p_less_amt = 0 ;
			
			$('.p_bill_amt').each(function(){
			p_bill_amt += parseFloat($(this).val()) ? parseFloat($(this).val()) : 0.00;  // Or this.innerHTML, this.innerText   
			});
			p_less_amt = parseFloat($('.pb_less_amt').val()) ? parseFloat($('.pb_less_amt').val()) : 0.00;
			
			$('.pb_tot_amt').val(p_bill_amt.toFixed());
			$('.tot_p_bill').val((p_bill_amt-p_less_amt).toFixed());
		});
	//  ***** End code for total calculation of purchase bill    //
	
    $('#intro2').on('change', '.s_cgst', function(){
		var  tot      = 0 ;
		var  tot_s_bill = 0;
		var  tot_p_bill = 0;
		
		var row       = $(this).closest('tr');
		var s_cgst    = parseFloat($(this).val())? parseFloat($(this).val()) :0.00;
		var svalue    = parseFloat(row.find('td:eq(4) :input').val());
		row.find('td:eq(12) :input').val(s_cgst-(s_cgst*.06));
		row.find('td:eq(8) :input').val((s_cgst+svalue).toFixed());
		tot = parseFloat(s_cgst+svalue);
		
		row.find('td:eq(14) .p_bill_amt').val((tot-(tot*.06)).toFixed());
		$('.s_bill_amt').each(function(){
		tot_s_bill += parseFloat($(this).val()) ? parseFloat($(this).val()) : 0.00;  // Or this.innerHTML, this.innerText   
		});
		$('.tot_s_bill').val((tot_s_bill).toFixed());
		$('.p_bill_amt').each(function(){
		tot_p_bill += parseFloat($(this).val()) ? parseFloat($(this).val()) : 0.00;  // Or this.innerHTML, this.innerText   
		});
		$('.tot_p_bill').val((tot_p_bill).toFixed());
		$('.tot_s_bill').val((tot_s_bill).toFixed());
		$('.pb_tot_amt').val((tot_p_bill).toFixed());
		
	
    })	
	$('#intro2').on('change', '.s_sgst', function(){
	 //p_sgst
		var row       = $(this).closest('tr');
	    var  tot_s_bill = 0;
		var  tot_p_bill = 0;
		var s_sgst    = parseFloat($(this).val())? parseFloat($(this).val()) :0.00;
		var svalue    = parseFloat(row.find('td:eq(4) :input').val());
		var s_cgst    = parseFloat(row.find('td:eq(6) :input').val());
		row.find('td:eq(13) :input').val(s_sgst-(s_sgst*.06));
		row.find('td:eq(8) :input').val((s_cgst+svalue+s_sgst).toFixed());
		row.find('td:eq(14) :input').val(((s_cgst+svalue+s_sgst)-((s_cgst+svalue+s_sgst)*.06)).toFixed());
		
		$('.s_bill_amt').each(function(){
		tot_s_bill += parseFloat($(this).val()) ? parseFloat($(this).val()) : 0.00;  // Or this.innerHTML, this.innerText   
		});
		$('.tot_s_bill').val((tot_s_bill).toFixed());
		$('.p_bill_amt').each(function(){
		tot_p_bill += parseFloat($(this).val()) ? parseFloat($(this).val()) : 0.00;  // Or this.innerHTML, this.innerText   
		});
		$('.tot_p_bill').val((tot_p_bill).toFixed());
		$('.tot_s_bill').val((tot_s_bill).toFixed());
		$('.pb_tot_amt').val((tot_p_bill).toFixed());
    })
    $('#intro2').on('change', '.s_value', function(){
		
		var row       = $(this).closest('tr');
		var commision_rate       =  <?=$vfc?>;
		var s_value    = parseFloat($(this).val())? parseFloat($(this).val()) :0.00;
		pvalue = parseFloat((s_value*100)/commision_rate).toFixed();
		row.find('td:eq(12) :input').val(pvalue);
		
    })
	
	$('#intro2').on('change', '.gst_rate', function(){
	 //p_sgst
		var row       = $(this).closest('tr');
	    var  tot_s_bill = 0;
		var  tot_p_bill = 0;
		var  gst_rate = 0;
		var saletaxable_totamt = 0;
		var scgst_totamt = 0;
		var ssgst_totamt = 0;
		var purtaxable_totamt = 0;
		var pcgst_totamt = 0;
		var psgst_totamt = 0;
		var pvalue = 0;
		var ptax  = 0; 
		var  commision_rate       =  <?=$vfc?>
		
		var svalue    = parseFloat(row.find('td:eq(5) :input').val());
		gst_rate      = parseFloat($(this).val())? parseFloat($(this).val()) :0.00;
		var s_sgst    = parseFloat(((svalue*(gst_rate/100))/2).toFixed());
		var s_cgst    = parseFloat(((svalue*(gst_rate/100))/2).toFixed());
		pvalue = parseFloat((svalue*100)/commision_rate).toFixed();
		row.find('td:eq(7) :input').val(s_sgst);
		row.find('td:eq(8) :input').val(s_sgst);
		ptax  = parseFloat((pvalue*(gst_rate/100))/2).toFixed();
		row.find('td:eq(13) :input').val(ptax);
		row.find('td:eq(14) :input').val(ptax);
		row.find('td:eq(9) :input').val((s_cgst+svalue+s_sgst).toFixed());
		
		row.find('td:eq(15) :input').val(parseFloat(pvalue) + parseFloat(ptax) + parseFloat(ptax));
		//row.find('td:eq(12) :input').val( pvalue);
		
		$('.s_value').each(function(){
			saletaxable_totamt += parseFloat($(this).val()) ? parseFloat($(this).val()) : 0.00;  // Or this.innerHTML, this.innerText   
		});
		$('.saletaxable_totamt').val((saletaxable_totamt).toFixed());

		$('.s_cgst').each(function(){
			scgst_totamt += parseFloat($(this).val()) ? parseFloat($(this).val()) : 0.00;  // Or this.innerHTML, this.innerText   
		});
		$('.scgst_totamt').val((scgst_totamt).toFixed());

		$('.s_sgst').each(function(){
			ssgst_totamt += parseFloat($(this).val()) ? parseFloat($(this).val()) : 0.00;  // Or this.innerHTML, this.innerText   
		});
		$('.ssgst_totamt').val((ssgst_totamt).toFixed());
		
		$('.s_bill_amt').each(function(){
		tot_s_bill += parseFloat($(this).val()) ? parseFloat($(this).val()) : 0.00;  // Or this.innerHTML, this.innerText   
		});
		$('.sb_tot_amt').val((tot_s_bill).toFixed());



		$('.p_value').each(function(){
			purtaxable_totamt += parseFloat($(this).val()) ? parseFloat($(this).val()) : 0.00;  // Or this.innerHTML, this.innerText   
		});
		$('.purtaxable_totamt').val((purtaxable_totamt).toFixed());
		$('.p_cgst').each(function(){
			pcgst_totamt += parseFloat($(this).val()) ? parseFloat($(this).val()) : 0.00;  // Or this.innerHTML, this.innerText   
		});
		$('.pcgst_totamt').val((pcgst_totamt).toFixed());
		$('.p_sgst').each(function(){
			psgst_totamt += parseFloat($(this).val()) ? parseFloat($(this).val()) : 0.00;  // Or this.innerHTML, this.innerText   
		});
		$('.psgst_totamt').val((psgst_totamt).toFixed());

		$('.p_bill_amt').each(function(){
		tot_p_bill += parseFloat($(this).val()) ? parseFloat($(this).val()) : 0.00;  // Or this.innerHTML, this.innerText   
		});
		$('.tot_p_bill').val((tot_p_bill).toFixed());
		$('.tot_s_bill').val((tot_s_bill).toFixed());
		$('.pb_tot_amt').val((tot_p_bill).toFixed());
    })
	
</script>