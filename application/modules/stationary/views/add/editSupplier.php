<div class="wraper">      

    <div class="col-md-6 container form-wraper">

        <form method="POST" id="form" role="form" name="add_form" action="<?php echo site_url("stationary/updateNewSupplier");?>" onsubmit="return validate()" >
            
            <div class="form-header">
            
                <h4>Edit New Supplier</h4>
            
            </div>

            <?php foreach($data1 as $key){ ?>

                <div class="form-group row">

                    <label for="item_name" class="col-sm-2 col-form-label">Supplier Name:<font color="red">*</font></label>

                    <div class="col-sm-4">

                        <input type="text" name="name" value= "<?php echo $key->name; ?>" class="form-control required" id="name" required>
                        <input type="hidden" name="sl_no" value= "<?php echo $key->sl_no; ?>" class="form-control required" id="name" required>
                                
                    </div>

                    <label for="hsn_no" class="col-sm-2 col-form-label">Contact Person:<font color="red">*</font></label>
                    
                    <div class="col-sm-4">

                        <input type="text" name="contact_person" value= "<?php echo $key->contact_person; ?>" class="form-control required" id="contact_person" >
                                
                    </div>

                </div>

                <div class="form-group row">

                    <label for="unit" class="col-sm-2 col-form-label">Phn No:<font color="red">*</font></label>

                    <div class="col-sm-4">

                        <input type="text" name="phn_no" value= "<?php echo $key->phn_no; ?>" class="form-control required" id="phn_no" >
                        
                    </div>

                    <label for="unit" class="col-sm-2 col-form-label">Email Id</label>

                    <div class="col-sm-4">

                        <input type="text" name="email" value= "<?php echo $key->email; ?>" class="form-control required" id="email" >
                        
                    </div>

                </div>

                <div class="form-group row">

                    <label for="unit" class="col-sm-2 col-form-label">Address</label>

                    <div class="col-sm-10">

                        <textarea name="address" class="form-control required" id="address" cols="40" rows="2"><?php echo $key->address; ?></textarea>

                    </div>

                </div>

                <div class="form-group row">

                    <label for="gst_no" class="col-sm-2 col-form-label">GST No:<font color="red">*</font></label>

                    <div class="col-sm-4">

                        <input type="text" name="gst_no" value= "<?php echo $key->gst_no; ?>" class="form-control required" id="gst_no" required>
                        
                    </div>

                    <label for="pan_no" class="col-sm-2 col-form-label">PAN No<font color="red">*</font></label>

                    <div class="col-sm-4">

                        <input type="text" name="pan_no" value= "<?php echo $key->pan_no; ?>" class="form-control required" id="pan_no" required>
                        
                    </div>
                    
                </div>

                <div class="form-group row">

                    <label for="trd_license" class="col-sm-2 col-form-label">Trade License:<font color="red">*</font></label>

                    <div class="col-sm-4">

                        <input type="text" name="trd_license" value= "<?php echo $key->trd_license; ?>" class="form-control required" id="trd_license" >
                        
                    </div>

                    <label for="bank" class="col-sm-2 col-form-label">Bank Name</label>

                    <div class="col-sm-4">

                        <input type="text" name="bank" value= "<?php echo $key->bank; ?>" class="form-control required" id="bank">
                        
                    </div>
                    
                </div>

                <div class="form-group row">

                    <label for="accnt_no" class="col-sm-2 col-form-label">Account No:<font color="red">*</font></label>

                    <div class="col-sm-4">

                        <input type="text" name="accnt_no" value= "<?php echo $key->accnt_no; ?>" class="form-control required" id="accnt_no" required>
                        
                    </div>

                    <label for="ifsc" class="col-sm-2 col-form-label">IFSC No<font color="red">*</font></label>

                    <div class="col-sm-4">

                        <input type="text" name="ifsc" value= "<?php echo $key->ifsc; ?>" class="form-control required" id="ifsc" required>
                        
                    </div>
                    
                </div>

                <div class="form-group row">

                    <label for="st" class="col-sm-2 col-form-label">ST No</label>

                    <div class="col-sm-4">

                        <input type="text" name="st" value= "<?php echo $key->st; ?>" class="form-control required" id="st">
                        
                    </div>

                    <label for="it" class="col-sm-2 col-form-label">IT No</label>

                    <div class="col-sm-4">

                        <input type="text" name="it" value= "<?php echo $key->it; ?>" class="form-control required" id="it">
                        
                    </div>
                    
                </div>
                <div class="form-group row">

                    <label for="st" class="col-sm-2 col-form-label">Account Head</label>

                    <div class="col-sm-4">

                        <input type="text" name="acc_code" value= "<?php echo $key->acc_code; ?>" class="form-control" id="acc_code" readonly>
                        
                    </div>
                </div>

            <?php } ?>

            <div class="form-group row">

                <div class="col-sm-10">

                    <input type="submit" class="btn btn-info" value="Save" />

                </div>

            </div>

        </form>


    </div>

</div>



