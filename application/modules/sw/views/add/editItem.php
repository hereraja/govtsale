<div class="wraper">      

    <div class="col-md-6 container form-wraper">

        <form method="POST" id="form" role="form" name="add_form" action="<?php echo site_url("sw/updateNewItem");?>" onsubmit="return validate()" >
            

            <div class="form-header">
            
                <h4>Add New Item</h4>
            
            </div>

            <?php foreach($data as $key)
                { ?>

                    <div class="form-group row">

                        <label for="item_name" class="col-sm-2 col-form-label">Item Name:<font color="red">*</font></label>

                        <div class="col-sm-6">

                            <input type="text" name="item_name" value= "<?php echo $key->item_name; ?>" class="form-control required" id="item_name" required>
                                    
                        </div>

                    </div>

                    <div class="form-group row">
                        <label for="hsn_no" class="col-sm-2 col-form-label">HSN Code:<font color="red">*</font></label>
                        
                        <div class="col-sm-6">

                            <input type="text" name="hsn_no" value= "<?php echo $key->hsn_no; ?>" class="form-control required" id="hsn_no" readonly>
                                    
                        </div>

                    </div>

                    <div class="form-group row">

                        <label for="unit" class="col-sm-2 col-form-label">Unit:<font color="red">*</font></label>

                        <div class="col-sm-6">

                            <select name="unit" id="unit" class= "form-control required" required>
                                <option value="Qnt" <?php if($key->unit=='Qnt') echo 'selected'; ?>>Qnt</option>
                                <option value="Kg" <?php if($key->unit=='Kg') echo 'selected'; ?>>Kg</option>
                                <option value="Gm" <?php if($key->unit=='Gm') echo 'selected'; ?>>Gm</option>
                                <option value="Lit" <?php if($key->unit=='Lit') echo 'selected'; ?>>Ltrs</option>
                                <option value="Bag" <?php if($key->unit=='Bag') echo 'selected'; ?>>Bag</option>
                            </select>
                            <span id= "alert1"><font color="red">*Select The Unit</font></span>  
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

    var unit    =   document.forms["add_form"]["unit"];
    $("#alert1").hide();
    
    function validate()
    {
        if(unit.value == "0")
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
