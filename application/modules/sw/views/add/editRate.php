
<div class="wraper">      
    <div class= "row">

        <div class="col-md-10 container form-wraper" style= "margin-left: 100px;">

            <form method="POST" id="form" role="form" name="add_form" action="<?php echo site_url("sw/updateNewRate");?>" onsubmit="return validate()" >
                

                <div class="form-header">
                
                    <h4>Add New Rate</h4>
                
                </div>

                <?php 
                    foreach($data as $key)
                    { ?>

                        <div class="form-group row">

                            <label for="form_dt" class="col-sm-2 col-form-label">Form Date:<font color="red">*</font></label>

                            <div class="col-sm-4">

                                <input type="date" name="from_dt" value= "<?php echo $key->from_dt; ?>" class="form-control required" id="from_dt" required>
                                <span id= "alert1"><font color="red">*Select Proper Date Range</font></span>
                                        
                            </div>
                            <input type="hidden" name="sl_no" value= "<?php echo $key->sl_no; ?>" class="form-control required" id="sl_no" required>


                            <label for="to_dt" class="col-sm-2 col-form-label">To Date:</label>
                            
                            <div class="col-sm-4">

                                <input type="date" name="to_dt" value= "<?php echo $key->to_dt; ?>" class="form-control required" id="to_dt" required>
                                        
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
                                           <!-- <th style= "text-align: center">Margin (Rs.)</th>
                                            <th style= "text-align: center">GST (%)</th> -->

                                            <!-- <th> <button class="btn btn-success" type="button" id="addrow" style= "border-left: 10px" data-toggle="tooltip" data-original-title="Add Row" data-placement="bottom"><i class="fa fa-plus" aria-hidden="true"></i></button> </th> -->
                                        </tr>

                                    </thead>
                                        
                                    <tbody id= "intro">

                                        <tr>

                                            <td width= "300px">
                                            
                                                <select name="hsn_no" id="hsn_no" class="form-control autoUnit_cls" readonly>
                                                
                                                    <option value="<?php echo $key->hsn_no; ?>"><?php echo $key->item_name; ?></option>
                                                    
                                                </select>

                                            </td>
                                            
                                            <td>
                                                
                                                <input type="text" name="unit" value= "<?php echo $key->unit; ?>" class="form-control unit_cls" id="unit" readonly/>
                                                    
                                            </td>

                                            <td>

                                                <input type="text" name="rate" value= "<?php echo $key->rate; ?>" class="form-control" id="rate" />

                                            </td>

                                        <!--    <td>

                                                <input type="text" name="margin" value= "<?php //echo $key->margin; ?>" class="form-control" id="margin" />

                                            </td>

                                            <td>

                                                <input type="text" name="gst" value= "<?php //echo $key->gst; ?>" class="form-control" id="gst" />

                                            </td> -->

                                        </tr>

                                    </tbody>   

                                </table>

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
