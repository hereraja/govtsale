
<div class="wraper">      

<div class="col-md-6 container form-wraper">

    <form method="POST" id="form" role="form" name="add_form" action="<?php echo site_url("stationary/updateNewProject");?>" onsubmit="return validate()" >
        

        <div class="form-header">
        
            <h4>Edit New Project</h4>
        
        </div>
        
        <?php foreach($data1 as $key) { ?>

            <div class="form-group row">

                <label for="form_dt" class="col-sm-2 col-form-label">Project Name<font color="red">*</font></label>

                <div class="col-sm-4">

                    <input type="text" name="name" value= "<?php echo $key->name; ?>" class="form-control required" id="name" required>
                    <input type="hidden" name="project_cd" value= "<?php echo $key->project_cd; ?>" class="form-control required" id="name" required>
                        
                </div>

                <label for="phn_no" class="col-sm-2 col-form-label">Phn No:</label>
                
                <div class="col-sm-4">

                    <input type="text" name="phn_no" value= "<?php echo $key->phn_no; ?>" class="form-control required" id="phn_no">
                            
                </div>

            </div>

            <div class="form-group row">

                <label for="address" class="col-sm-2 col-form-label">Address</label>

                <div class="col-sm-4">

                    <textarea name="address" id="address" class="form-control required" cols="10" rows="2"><?php echo $key->address; ?></textarea>

                </div>

            </div>

            <?php foreach($data2 as $key2){ ?>

                <div class="form-group row">
                    
                    <label for="suppliers" class="col-sm-2 col-form-label">Suppliers<font color="red">*</font></label></th>
                    <div id= "intro">

                        <div class="col-sm-8"> 

                            <select name="supplier_cd[]" id="supplier_cd" class="form-control autoUnit_cls" readonly>
                                <option value="<?php echo $key2->supplier_cd; ?>"><?php echo $key2->name; ?></option>
                                    
                            </select> 

                        </div>

                    </div>
                        
                    <button class="btn btn-success" type="button" id="addrow" style= "border-left: 10px" data-toggle="tooltip" data-original-title="Add Row" data-placement="bottom"><i class="fa fa-plus" aria-hidden="true"></i></button></th>
                    
                </div>

            <?php } ?>

        <?php } ?>

        <div class="form-group row">

            <div class="col-sm-10">

                <input type="submit" class="btn btn-info" value="Save" />

            </div>

        </div>

    </form>

</div>

</div>


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


