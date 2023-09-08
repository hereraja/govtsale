<div class="wraper">      

    <div class="col-md-6 container form-wraper">

        <form method="POST" id="form" role="form" name="add_form" action="<?php echo site_url("stationary/addNewproduct");?>" onsubmit="return validate()" >
            
            <div class="form-header">
            
                <h4>Add New Product</h4>
            
            </div>

            <div class="form-group row">
                <label for="item_name" class="col-sm-2 col-form-label">Product Name:<font color="red">*</font></label>
                <div class="col-sm-10">
                    <input type="text" name="prod_name" class="form-control" id="prod_name" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="item_name" class="col-sm-2 col-form-label">HSN Code:<font color="red">*</font></label>
                <div class="col-sm-10">
                    <input type="text" name="hsn_code" class="form-control" id="hsn_code" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="item_name" class="col-sm-2 col-form-label">Company Name:</label>
                <div class="col-sm-10">
                    <input type="text" name="comp_name" class="form-control" id="comp_name" >
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



<!-- To Check empty Field  -->

<!-- 
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

</script> -->

