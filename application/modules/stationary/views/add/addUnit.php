<div class="wraper">      

    <div class="col-md-6 container form-wraper">

        <form method="POST" id="form" role="form" name="add_form" action="<?php echo site_url("stationary/addNewUnit");?>" onsubmit="return validate()" >
            

            <div class="form-header">
            
                <h4>Add New Unit</h4>
            
            </div>

            <div class="form-group row">

                <label for="unit" class="col-sm-2 col-form-label">Unit Name:<font color="red">*</font></label>

                <div class="col-sm-6">

                    <input type="text" name="unit" class="form-control required" id="unit" required>
                            
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
