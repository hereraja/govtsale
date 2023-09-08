<div class="wraper">      

    <div class="col-md-6 container form-wraper">

        <form method="POST" id="form" role="form" name="add_form" action="<?php echo site_url("stationary/updateUnit");?>" onsubmit="return validate()" >
            

            <div class="form-header">
            
                <h4>Add New Unit</h4>
            
            </div>

            <div class="form-group row">

                <label for="unit" class="col-sm-2 col-form-label">Unit Name:<font color="red">*</font></label>

                <?php foreach($data as $key){ ?>

                    <div class="col-sm-6">

                        <input type="text" name="unit" value= "<?php echo $key->unit; ?>" class="form-control required" id="unit" required>
                                
                    </div>
                    <input type="hidden" name= "sl_no" value= "<?php echo $key->sl_no; ?>" id= "sl_no" >

                <?php } ?>

            </div>

            <div class="form-group row">

                <div class="col-sm-10">

                    <input type="submit" class="btn btn-info" value="Save" />

                </div>

            </div>

        </form>


    </div>

</div>
