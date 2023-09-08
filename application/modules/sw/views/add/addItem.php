<div class="wraper">      

    <div class="col-md-6 container form-wraper">

        <form method="POST" id="form" role="form" name="add_form" action="<?php echo site_url("sw/addNewItem");?>" onsubmit="return validate()" >
            

            <div class="form-header">
            
                <h4>Add New Item</h4>
            
            </div>

            <div class="form-group row">

                <label for="item_name" class="col-sm-2 col-form-label">Item Name:<font color="red">*</font></label>

                <div class="col-sm-6">

                    <input type="text" name="item_name" class="form-control required" id="item_name" required>
                            
                </div>

            </div>

            <div class="form-group row">
                <label for="hsn_no" class="col-sm-2 col-form-label">HSN Code:<font color="red">*</font></label>
                
                <div class="col-sm-6">

                    <input type="text" name="hsn_no" class="form-control required" id="hsn_no" required>
                            
                </div>

            </div>

            <div class="form-group row">

                <label for="unit" class="col-sm-2 col-form-label">Unit:<font color="red">*</font></label>

                <div class="col-sm-6">

                    <select name="unit" id="unit" class= "form-control required" required>
                        <option value="0">Select Unit</option>
                        <option value="Qnt">Qnt</option>
                        <option value="Kg">Kg</option>
                        <option value="Gm">Gm</option>
                        <option value="Lit">Ltrs</option>
                        <option value="Bag">Bag</option>
                    </select>
                    <span id= "alert1"><font color="red">*Select The Unit</font></span>  
                </div>

            </div>

            <div class="form-group row">

                <div class="col-sm-10">

                    <input type="submit" class="btn btn-info" id= "submit" value="Save" />

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


<!-- Checking duplicate entry -->
<script>

    $(document).ready(function(){

        $('#hsn_no').on("change", function(){

            var hsn_no = $(this).val();
            //console.log(item);
            $.get('<?php echo site_url("sw/js_check_duplicateItem") ?>', {hsn_no : hsn_no})
            .done(function(data){
                //console.log(data);
                var num_row = JSON.parse(data).num_row;
                if(num_row === 0)
                {
                    return true;
                }
                else
                {
                    $('#hsn_no').css('border-color', 'red');
                    $('#submit').prop('disabled', true);
                    return false;
                }
            })

        })

    })

</script> 