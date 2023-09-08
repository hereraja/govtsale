<div class="wraper">      
	<div class="col-md-12 container form-wraper" style="margin-left: 0%;">
		<form method="POST" id="form" role="form" name="add_form" action="<?php //echo site_url("stationary/updatebill");?>" onsubmit="return validate()" >
		        <?php foreach($sbpb_list as $key)  ?>
		<input type="hidden" name="id" value="<?php if(isset($sbpb->id)) echo $sbpb->id ;?>" >
				<div class="form-header">
						<h4>Bill Entry</h4>
				</div>
				<div class="form-group row">

					<label for="trans_dt" class="col-sm-1 col-form-label">Date.<font color="red">*</font></label>
					<div class="col-sm-3">
					<input  type="date" name="trans_dt" class="form-control trans_date" id="trans_date" value="<?php if(isset($key->trans_dt)) echo $key->trans_dt ;?>"  required>
					</div>
					<label for="trans_dt" class="col-sm-1 col-form-label"> Supplier.<font color="red">*</font></label>
					<div class="col-sm-3">
					<select name="supplier_id" id="supplier_id" class="form-control autoUnit_cls" required>
                            <option value="">Select Supplier</option>
                            <?php
                                foreach($suppliers as $key1)
                                { ?>
                                    <option value="<?php echo $key1->sl_no; ?>" <?php if(isset($key->vendor_id)) { if($key->vendor_id == $key1->sl_no) echo "selected" ; }?>><?php echo $key1->name; ?></option>
                                <?php
                                } ?>
                                
                        </select> 
					</div>
					<label for="project" class="col-sm-1 col-form-label"> Project.<font color="red">*</font></label>
					<div class="col-sm-3">
						<select name="project" id="project" class="form-control select2" required  >
						<option value="">Select Project</option>
						<?php
							foreach($projects as $key1){
						?>
								<option value="<?php echo $key1->project_cd; ?>" <?php if(isset($key->project_cd)) { if($key->project_cd == $key1->project_cd) echo "selected" ; }?>><?php echo $key1->name; ?></option>
						<?php
							} 
						?>
						</select>
					</div>		


				</div>
				<div class="form-group row">
					
				    <label for="trans_dt" class="col-sm-1 col-form-label">Sale bill Date.<font color="red">*</font></label>
					<div class="col-sm-3">
					<input  type="date" name="trans_dt" class="form-control trans_date" id="trans_date" value="<?php if(isset($key->s_bill_dt)) echo $key->s_bill_dt ;?>"  readonly>
					</div>
					<label for="trans_dt" class="col-sm-1 col-form-label">Sale bill NO.<font color="red">*</font></label>
					<div class="col-sm-3">
					<input  type="text" name="" class="form-control" id="" value="<?php if(isset($key->s_bill_no)) echo $key->s_bill_no ;?>" readonly>
					</div>
				</div>		
				<div class="form-header">
				<h4>Bills</h4>
				</div>
				<div style='overflow-x: scroll;overflow-y: hidden;white-space:nowrap;'>
				<table class="table" >
					<thead>
						<tr>
						    <th >Product</th>
							
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
					<?php     $S_taxable_tot = 0;
					          $S_cgst_tot = 0;
							  $S_tot = 0;
							  $p_taxable_tot = 0;
					          $p_cgst_tot = 0;
							  $p_tot = 0;
					
					foreach($sbpb_list as $sbpb){   ?>
						<tr>
							
							<td style="width:80px">
							<?php if(isset($sbpb->prod_name)) echo ucfirst($sbpb->prod_name) ;?>
						   </td>
						
							<td><input type="text"  class="form-control s_value"  name="s_taxable_value" style="width:80px" required value='<?php if(isset($sbpb->s_taxable_value)) echo $sbpb->s_taxable_value; $S_taxable_tot +=$sbpb->s_taxable_value; ?>'></td>
							<td><input type="text"  class="form-control gst_rate"  name="gst_rate" style="width:60px" required value='<?php if(isset($sbpb->gst_rate)) echo $sbpb->gst_rate ;?>'></td>
							<td><input type="text"  class="form-control s_cgst"  name="s_cgst" style="width:60px" required value='<?php if(isset($sbpb->s_cgst)) echo $sbpb->s_cgst ; $S_cgst_tot +=$sbpb->s_cgst ; ?>'></td>
							<td><input type="text"  class="form-control s_sgst"  name="s_sgst" style="width:60px"  required value='<?php if(isset($sbpb->s_sgst)) echo $sbpb->s_sgst ;?>'></td>
							<td><input type="text"  class="form-control s_bill_amt"  name="s_bill_amt"  style="width:80px" required value='<?php if(isset($sbpb->s_bill_amt)) echo $sbpb->s_bill_amt ; $S_tot+= $sbpb->s_bill_amt ;?>'></td>
							<td><input type="text"  class="form-control p_bill_no"   style="width:100px" name="p_bill_no"   required value='<?php if(isset($sbpb->p_bill_no)) echo $sbpb->p_bill_no ;?>'></td>
							<td><input type="date"  class="form-control p_bill_dt"   style="width:155px" name="p_bill_dt"   required value='<?php if(isset($sbpb->p_bill_dt)) echo $sbpb->p_bill_dt ;?>'></td>
							<td><input type="text"  class="form-control p_value"  name="p_taxable_value" style="width:80px" required value='<?php if(isset($sbpb->p_taxable_value	)) echo $sbpb->p_taxable_value ; $p_taxable_tot +=$sbpb->p_taxable_value;?>'></td>
							<td><input type="text"  class="form-control p_cgst"  name="p_cgst" style="width:60px" required value='<?php if(isset($sbpb->p_cgst)) echo $sbpb->p_cgst ; $p_cgst_tot +=$sbpb->p_cgst ;?>'></td>
							<td><input type="text"  class="form-control p_sgst"  name="p_sgst"  style="width:60px" required value='<?php if(isset($sbpb->p_sgst)) echo $sbpb->p_sgst ;?>'></td>
							<td><input type="text"  class="form-control p_bill_amt"  name="p_bill_amt" style="width:100px" required value='<?php if(isset($sbpb->p_bill_amt)) echo $sbpb->p_bill_amt ; $p_tot+= $sbpb->p_bill_amt ;?>'></td>
							<td></td>
						</tr>

						<?php  } ?>

						<tr style="text-align:center;font-weight:bold">
                               <td >Total</td>
							   <td><?=$S_taxable_tot?></td>
							   <td></td>
							   <td><?=$S_cgst_tot?></td>
							   <td><?=$S_cgst_tot?></td>
							  
							   <td><?=$S_tot?></td>
							   <td></td>
							   <td></td>
							   <td><?=$p_taxable_tot?></td>
							  
							   <td><?=$p_cgst_tot?></td>
							   <td><?=$p_cgst_tot?></td>
							   <td><?=$p_tot?></td>

						</tr>
					</tbody>
					
				</table>
				</div>
				<div class="form-group row">
					<?php //if($sbpb->bill_status == 0) { ?>
					<div class="col-sm-10">
						<!-- <input type="submit" class="btn btn-info" value="Save" /> -->
					</div>
					<?php //} ?>

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

    ' <option value="<?php echo $key1->project_cd; ?>">'+'"<?php echo $key1->name; ?>"'+'</option> ' +

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
					'<select name="project[]" id="project'+count+'" style="width:140px"class="form-control" required><option value="">Select Project</option>'+
					'<?php foreach($projects as $key1){ ' +
			    '?> ' +
				' <option value="<?php echo $key1->project_cd; ?>">'+'<?php echo $key1->name; ?>'+'</option> ' +
			    '<?php } ' +
			    '?> ' +
                '</select>'+
            '</td>'
			+'<td><input type="text" class="form-control order_no" style="width:150px" name="order_no[]" id="order_no" required></td>'
            +'<td><input type="text" class="form-control s_bill_no"  style="width:100px" name="s_bill_no[]" id="s_bill_no" required></td>'
            +'<td><input type="date" class="form-control s_bill_dt"  style="width:155px" name="s_bill_dt[]" required></td>'
			+'<td><input type="text"  class="form-control s_value"  name="s_taxable_value[]" style="width:80px" value="0.00" required></td>'
			+'<td><input type="text"  class="form-control gst_rate"  name="gst_rate[]" style="width:60px" value="0.00" required></td>'
			+'<td><input type="text"  class="form-control s_cgst"  name="s_cgst[]"  required></td>'
			+'<td><input type="text"  class="form-control s_sgst"  name="s_sgst[]"  required></td>'
            +'<td><input type="text" class="form-control s_bill_amt" name="s_bill_amt[]" required></td>'
            +'<td><input type="text" class="form-control p_bill_no"  style="width:100px" name="p_bill_no[]" required></td>' 
            +'<td><input type="date" class="form-control p_bill_dt"  style="width:155px" name="p_bill_dt[]" required></td>'
			+'<td><input type="text"  class="form-control p_value"  name="p_taxable_value[]" style="width:80px" value="0.00" required></td>'
			+'<td><input type="text"  class="form-control p_cgst"  name="p_cgst[]"  required></td>'
			+'<td><input type="text"  class="form-control p_sgst"  name="p_sgst[]"  required></td>'
            +'<td><input type="text" class="form-control p_bill_amt" name="p_bill_amt[]" required></td>'
            +'<td><button type="button" class="btn btn-danger removeRow"><i class="fa fa-remove"></i></button></td>'
          +'</tr>';
 
$('#intro2').append(row);
//$('#order_no'+count, '#intro2').select2();
$('#project'+count, '#intro2').select2();
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
    ///  **** Code Start For Sale bill calculation  ***  /// 
	
	// $('#intro2').on('change', '.s_bill_amt', function(){
		// var s_bill_amt = 0 ;
		
		// $('.s_bill_amt').each(function(){
		// s_bill_amt += parseFloat($(this).val()) ? parseFloat($(this).val()) : 0.00;  // Or this.innerHTML, this.innerText   
		// });
		// $('.tot_s_bill').val(s_bill_amt);
	// });
	
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
		row.find('td:eq(10) :input').val(s_bill_dt);
	
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
	 //p_sgst
		var row       = $(this).closest('tr');
		var s_value    = parseFloat($(this).val())? parseFloat($(this).val()) :0.00;
		row.find('td:eq(11) :input').val((s_value-(s_value*.06)).toFixed());
		
    })
	
	$('#intro2').on('change', '.gst_rate', function(){
	 //p_sgst
		var row       = $(this).closest('tr');
	    var  tot_s_bill = 0;
		var  tot_p_bill = 0;
		var  gst_rate = 0;
		
		var svalue    = parseFloat(row.find('td:eq(4) :input').val());
		gst_rate      = parseFloat($(this).val())? parseFloat($(this).val()) :0.00;
		var s_sgst    = parseFloat(((svalue*(gst_rate/100))/2).toFixed());
		var s_cgst    = parseFloat(((svalue*(gst_rate/100))/2).toFixed());
		row.find('td:eq(6) :input').val(s_sgst);
		row.find('td:eq(7) :input').val(s_sgst);
		row.find('td:eq(12) :input').val((s_sgst-(s_sgst*.06)).toFixed());
		row.find('td:eq(13) :input').val(s_sgst-(s_sgst*.06).toFixed());
		row.find('td:eq(8) :input').val((s_cgst+svalue+s_sgst).toFixed());
		row.find('td:eq(14) :input').val(((s_cgst+svalue+s_sgst)-((s_cgst+svalue+s_sgst)*.06)).toFixed());
		
		$('.s_bill_amt').each(function(){
		tot_s_bill += parseFloat($(this).val()) ? parseFloat($(this).val()) : 0.00;  // Or this.innerHTML, this.innerText   
		});
		$('.sb_tot_amt').val((tot_s_bill).toFixed());
		
		$('.p_bill_amt').each(function(){
		tot_p_bill += parseFloat($(this).val()) ? parseFloat($(this).val()) : 0.00;  // Or this.innerHTML, this.innerText   
		});
		$('.tot_p_bill').val((tot_p_bill).toFixed());
		$('.tot_s_bill').val((tot_s_bill).toFixed());
		$('.pb_tot_amt').val((tot_p_bill).toFixed());
    })
 
</script>