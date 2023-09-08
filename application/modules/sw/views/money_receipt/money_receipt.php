<div class="wraper">      

    <div class= "row">

        <div class="col-md-12 container form-wraper" style= "margin-left: 0%;">
               <?php 
			    $url ='';
			    if(isset($money_rec->id)  && $money_rec->id!= NULL){
				   $url = "sw/money_receipt_edit";
			    }else{
					
					$url = "sw/money_receipt";
			    }
			   ?>
            <form method="POST" id="form" role="form" name="add_form" action="<?php echo site_url($url);?>" onsubmit="return validate()" >
                <input type="hidden" name="id" value="<?php if(isset($money_rec->id)) { echo base64_encode($money_rec->id); } ?>">
                <div class="form-header">
                
                    <h4>Add New Money Receipt </h4>
                
                </div>
				
				<div class="form-group row">
					
					<label for="trans_date" class="col-sm-2 col-form-label">Date:<font color= "red">*</font></label>
					<div class="col-sm-4">
                    <input type="date" name= "trans_dt" id= "trans_dt" class= "form-control" value="<?=date('Y-m-d')?>" required>
					</div>
					
					<label for="No" class="col-sm-2 col-form-label">Number(No):<font color= "red">*</font></label>
					<div class="col-sm-4">
                    <input type="number" name= "no" id= "no" class= "form-control" value="<?php if(isset($money_rec->no)) { echo $money_rec->no ; } ?>" required>
					</div>

                </div>

                <div class="form-group row">

                    <label for="received_from" class="col-sm-2 col-form-label">Received From:<font color= "red">*</font></label>

                    <div class="col-sm-10">
                        
                        <input type="text" name= "received_from" id="received_from" class= "form-control" value="<?php if(isset($money_rec->received_from)) { echo $money_rec->received_from; } ?>" required>
                        
                    </div>

                </div>

                <div class="form-group row">
                    
                    <label for="reff_detail" class="col-sm-2 col-form-label">Refrence Detail<font color= "red">*</font></label>
                    <div class="col-sm-4">
                        <input type="text" name= "reff_detail" id= "reff_detail" class= "form-control" value="<?php if(isset($money_rec->reff_detail)) { echo $money_rec->reff_detail; } ?>" required>
                    </div>
					
					<label for="tot_payable" class="col-sm-2 col-form-label">Against<font color= "red">*</font></label>
                    <div class="col-sm-4">
                        <input type="text" name="against" id="against" class= "form-control" value="<?php if(isset($money_rec->against)) { echo $money_rec->against ; } ?>" required>
                    </div>  

                </div>
				<div class="form-group row">

					<label for="tot_payable" class="col-sm-2 col-form-label">Total Payable(Rs)<font color= "red">*</font></label>
                    <div class="col-sm-4">
                        <input type="text" name= "amt" id= "amt" class= "form-control" value="<?php if(isset($money_rec->amt)) { echo $money_rec->amt ; } ?>" required>
                    </div>  

                </div>
				
                <div class="form-group row">

                    <div class="col-sm-10">
                        <input type="submit" class="btn btn-info" value="Save" />
                    </div>

                </div>

            </form>

        </div>

    </div>

</div>