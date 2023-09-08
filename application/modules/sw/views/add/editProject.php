<div class="wraper">      

    <div class="col-md-6 container form-wraper">

        <form method="POST" id="form" role="form" name="add_form" action="<?php echo site_url("sw/updateNewProject");?>" onsubmit="return validate()" >
            

            <div class="form-header">
            
                <h4>Add New Project</h4>
            
            </div>

            <?php 
                foreach($data as $key)
                { ?>

                    <div class="form-group row">

                        <label for="cdpo" class="col-sm-2 col-form-label">Project Name:<font color="red">*</font></label>

                        <div class="col-sm-6">

                            <input type="text" name="cdpo" value= "<?php echo $key->cdpo; ?>" class="form-control required" id="cdpo" required>
                                    
                        </div>
                        <input type="hidden" name="sl_no" value= "<?php echo $key->sl_no; ?>" class="form-control required" id="sl_no" required>

                    </div>

                    
                    <div class="form-group row">

                        <label for="dist_cd" class="col-sm-2 col-form-label">District:<font color="red">*</font></label>

                        <div class="col-sm-6">

                            <select name="dist_cd" id="dist_cd" class= "form-control required" required>
                                <option value="<?php echo $key->dist_cd; ?>"><?php echo $key->district_name; ?></option>
                                
                            </select>
                            <span id= "alert1"><font color="red">*Select The District</font></span>  
                        </div>

                    </div>

                    <div class="form-group row">
                        <label for="contact_no" class="col-sm-2 col-form-label">Contact No:</label>
                        
                        <div class="col-sm-6">

                            <input type="text" name="contact_no" value= "<?php echo $key->contact_no; ?>" class="form-control required" id="contact_no" >
                                    
                        </div>

                    </div>

                    <div class="form-group row">
                        <label for="address" class="col-sm-2 col-form-label">Address:</label>
                        
                        <div class="col-sm-6">

                            <textarea name="address" id="address" class="form-control required" cols="30" rows="2" ><?php echo $key->address; ?></textarea>
                                    
                        </div>

                    </div>

                <?php
                } ?>


            <div class="form-group row">

                <div class="col-sm-10">

                    <input type="submit" class="btn btn-info" value="Save" />

                </div>

            </div>

        </form>


    </div>

</div>



<!-- To Check empty Field  -->

<script>

    var dist_cd    =   document.forms["add_form"]["dist_cd"];
    $("#alert1").hide();
    
    function validate()
    {
        if(dist_cd.value == "0")
        {
            unit.style.border = "1px solid red";
            //total.focus();
            $("#alert1").show();

            return false;
        }
        else
        {
            return true;
        }

    }

</script>
