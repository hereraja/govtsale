
<div class="wraper">  

    <div class= "row">
    
        <div class="col-md-10 container form-wraper" style="margin-left: 100px;">
        
            <form method="POST" id="form" role="form" name="add_form" action="<?php echo site_url("sw/addNewRate");?>" onsubmit="return validate()" >
                

                <div class="form-header">
                
                    <h4>Add New Rate</h4>
                
                </div>

                <div class="form-group row">

                    <label for="form_dt" class="col-sm-2 col-form-label">Form Date:<font color="red">*</font></label>

                    <div class="col-sm-4">

                        <input type="date" name="from_dt" class="form-control required" id="from_dt" required>
                        <span id= "alert1"><font color="red">*Select Proper Date Range</font></span>
                                
                    </div>

                    <label for="to_dt" class="col-sm-2 col-form-label">To Date:</label>
                    
                    <div class="col-sm-4">

                        <input type="date" name="to_dt" class="form-control required" id="to_dt" required>
                                
                    </div>

                </div>

                <div class="row" style ="margin: 5px;">

                    <div class="form-group">

                        <table class="table table-striped table-bordered table-hover">
                                
                            <thead>
                                
                                <tr>
                                    <th style= "text-align: center">Item</th>
                                    <th style= "text-align: center">Unit</th>
                                    <th style= "text-align: center">Rate (Rs.)</th>
                                <!--    <th style= "text-align: center">Margin (Rs.)</th>
                                    <th style= "text-align: center">GST (%)</th> -->

                                    <th><button class="btn btn-success" type="button" id="addrow" style= "border-left: 10px" data-toggle="tooltip" data-original-title="Add Row" data-placement="bottom"><i class="fa fa-plus" aria-hidden="true"></i></button> </th>
                                </tr>

                            </thead>
                                
                            <tbody id= "intro">

                                <tr>

                                    <td width= "300px">
                                    
                                        <select name="hsn_no[]" id="hsn_no" class="form-control autoUnit_cls">
                                            <option value="">Select Item</option>
                                            <?php
                                                foreach($data as $key1)
                                                { ?>
                                                    <option value="<?php echo $key1->hsn_no; ?>"><?php echo $key1->item_name; ?></option>
                                                <?php
                                                } ?>
                                                
                                        </select>

                                    </td>
                                    
                                    <td>
                                        
                                        <input type="text" name="unit[]" class="form-control unit_cls" id="unit" readonly/>
                                            
                                    </td>

                                  <td>
                                        <input type="text" name="rate[]" class="form-control" id="rate" />
                                    </td>

                                 <!--     <td>
                                        <input type="text" name="margin[]" class="form-control" id="margin" />
                                    </td> 

                                    <td>

                                        <input type="text" name="gst[]" class="form-control" id="gst" />

                                    </td>-->

                                </tr>

                            </tbody>   

                        </table>

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

</div>



<!-- To Check Date Range  -->
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

</script>


<!-- for addrow in table -->
<script>

    $(document).ready(function(){

        $("#addrow").click(function()
        {

            var newElement= '<tr><td><select name="hsn_no[]" id="hsn_no" class="form-control autoUnit_cls"><option value="0">Select Item</option><?php foreach($data as $key1){?><option value="<?php echo ($key1->hsn_no); ?>"><?php echo ($key1->item_name);?><?php } ?></select></td><td> <input type="text" name="unit[]" class="form-control unit_cls" id="unit" readonly/></td><td><input type="text" name="rate[]" class="form-control" id="rate" /></td><td><button class="btn btn-danger" type= "button" data-toggle="tooltip" data-original-title="Remove Row" data-placement="bottom" id="removeRow"><i class="fa fa-remove" aria-hidden="true"></i></button></td></tr>';

            $("#intro").append($(newElement));
                                                                
        });

        // to change the value of total field as per fees field selected by adding rows
        
        $("#intro").on("click","#removeRow", function(){
            $(this).parent().parent().remove();
            $('.amount_cls').change();
        });
    
    });

</script>



<!-- To get unit after selecting product  -->
<script>

    $(document).ready(function()
    {
        $('#intro').on( "change", ".autoUnit_cls", function()
        {
            var hsn_no = $(this).val();
			
            $.get('<?php echo site_url("sw/js_get_productUnit");?>',{ hsn_no: hsn_no })
                                                                            
            .done(function(data)
            {
                //console.log(data);

                var unitData = JSON.parse(data);
                
                //console.log(unitData.unit);

                $('.unit_cls').eq($('.autoUnit_cls').index(this)).val(unitData.unit); 
            
            });

        });

    });

</script>