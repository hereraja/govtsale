<div class="wraper">      

    <div class="col-md-6 container form-wraper">

        <form method="POST" id="form" action="<?php echo site_url("sw/f_get_oil_paymentSheet");?>"  >
            

            <div class="form-header">
            
                <h4>Give a Payment key</h4>
            
            </div>

            <div class="form-group row">

                <label for="dist_cd" class="col-sm-2 col-form-label">Payment Key:<font color="red">*</font></label>
                <div class="col-sm-8">

                    <input type="text" name= "payment_key" id= "payment_key" class= "form-control required" required>
                      
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