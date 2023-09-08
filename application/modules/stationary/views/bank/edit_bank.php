<div class="wraper">      

    <div class="col-md-6 container form-wraper">

        <form method="POST" id="form" role="form" name="add_form" action="<?php echo site_url("stationary/updatebank");?>" onsubmit="return validate()" >
        <input type="hidden" name="id" class="form-control" value="<?php if(isset($bank->sl_no)) echo $bank->sl_no; ?>">
            <div class="form-header">
            
                <h4>Add New Bank</h4>
            
            </div>

            <div class="form-group row">

                <label for="item_name" class="col-sm-2 col-form-label">Bank Name:<font color="red">*</font></label>

                <div class="col-sm-10">

                    <input type="text" name="bank_name" class="form-control" id="bank_name" value="<?php if(isset($bank->bank_name)) echo $bank->bank_name; ?>" required>
                            
                </div>

            </div>
            <div class="form-group row">
                <label for="hsn_no" class="col-sm-2 col-form-label">Branch Name:<font color="red">*</font></label>
                <div class="col-sm-10">
                    <input type="text" name="branch_name" class="form-control required" id="branch_name" value="<?php if(isset($bank->bank_name)) echo $bank->branch_name; ?>">
                </div>
            </div>   

            <div class="form-group row">

                <label for="unit" class="col-sm-2 col-form-label">Ac/No:<font color="red">*</font></label>

                <div class="col-sm-4">

                    <input type="text" name="ac_no" class="form-control" id="ac_no" required value="<?php if(isset($bank->ac_no)) echo $bank->ac_no; ?>" >
                    
                </div>

                <label for="unit" class="col-sm-2 col-form-label">IFSC:<font color="red">*</font></label>

                <div class="col-sm-4">
                    <input type="text" name="ifsc" class="form-control required" id="ifsc" required value="<?php if(isset($bank->ifsc)) echo $bank->ifsc; ?>" >
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

