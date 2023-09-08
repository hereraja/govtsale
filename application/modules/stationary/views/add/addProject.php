
<div class="wraper">      

    <div class="col-md-6 container form-wraper">

        <form method="POST" id="form" role="form" name="add_form" action="<?php echo site_url("stationary/addNewProject");?>" >
            

            <div class="form-header">
            
                <h4>Add New Project</h4>
            
            </div>

            <div class="form-group row">

                <label for="form_dt" class="col-sm-2 col-form-label">Project Name<font color="red">*</font></label>

                <div class="col-sm-8">

                    <input type="text" name="name" class="form-control required" id="name" required>
                          
                </div>

            </div>

            <div class="form-group row">

                <label for="phn_no" class="col-sm-2 col-form-label">Phn No:</label>
                
                <div class="col-sm-8">

                    <input type="text" name="phn_no" class="form-control required" id="phn_no">
                            
                </div>

            </div>

            <div class="form-group row">

                <label for="address" class="col-sm-2 col-form-label">Address</label>

                <div class="col-sm-8">

                    <textarea name="address" id="address" class="form-control required" cols="10" rows="2"></textarea>
    
                </div>

            </div>

            <div class="form-group row">
                
                <label for="suppliers" class="col-sm-2 col-form-label">Suppliers<font color="red">*</font></label></th>
                <div id= "intro">   

                    <div class="col-sm-8"> 

                        <select name="supplier_cd[]" id="supplier_cd" class="form-control autoUnit_cls" required>
                            <option value="">Select Supplier</option>
                            <?php
                                foreach($data as $key1)
                                { ?>
                                    <option value="<?php echo $key1->sl_no; ?>"><?php echo $key1->name; ?></option>
                                <?php
                                } ?>
                                
                        </select> 

                    </div>

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



<!-- To Check Date Range  -->
<!--
<script>

    $("#alert1").hide();    
    var from_dt    =   document.forms["add_form"]["from_dt"];
    var to_dt    =   document.forms["add_form"]["to_dt"];    
    
    function validate()
    {
        if(from_dt.value > to_dt.value)
        {
            from_dt.style.border = "1px solid red";
            to_dt.style.border = "1px solid red";
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


<!-- for addrow in table -->
<!-- <script>

    $(document).ready(function(){

        $("#addrow").click(function()
        {

            var newElement= '<div id= "intro"><div class="col-sm-8"><select name="supplier_cd[]" id="supplier_cd" class="form-control  required><option value="0">Select Suppliers</option><?php foreach($data as $key1){?><option value="<?php echo ($key1->sl_no); ?>"><?php echo ($key1->name);?><?php } ?></option></select></div><button class="btn btn-danger" type= "button" data-toggle="tooltip" data-original-title="Remove Row" data-placement="bottom" id="removeRow"><i class="fa fa-remove" aria-hidden="true"></i></button></div>';

            $("#intro").append($(newElement));
                                                                
        });

        // to change the value of total field as per fees field selected by adding rows
        
        $("#intro").on("click","#removeRow", function(){
            $(this).parent().remove();
            //$('.amount_cls').change();
        });
    
    });

</script> -->



<!-- To get unit after selecting product  -->
<!--
<script>

    $(document).ready(function()
    {
        $('#intro').on( "change", ".autoUnit_cls", function()
        {
            
            $.get('<?php //echo site_url("sw/js_get_productUnit");?>',{ hsn_no: $('#hsn_no').val() })
                                                                            
            .done(function(data)
            {
                //console.log(data);

                var unitData = JSON.parse(data);
                
                //console.log(unitData.unit);

                $('.unit_cls').eq($('.autoUnit_cls').index(this)).val(unitData.unit); 
            
            });

        });

    });

</script> --> 