<div class="wraper">      

    <div class="col-md-6 container form-wraper">

        <form method="POST" id="form" role="form" name="add_form" action="<?php echo site_url("sw/showPWdeliveryReport");?>" onsubmit="return validate()" >
            

            <div class="form-header">
            
                <h4>Select Project</h4>
            
            </div>

            <div class="form-group row">

                <label for="dist_cd" class="col-sm-2 col-form-label">District:<font color="red">*</font></label>
                <div class="col-sm-4">

                    <select name="dist_cd" id="dist_cd" class= "form-control required" required>
                        <option value="0">Select District</option>
                        <?php
                            foreach($dist as $data)
                            { 
                            ?>
                                <option value="<?php echo ($data->district_code); ?>"><?php echo ($data->district_name); ?></option>
                        <?php
                            }
                            ?>
                    </select>
                      
                </div>

                <label for="cdpo_no" class="col-sm-2 col-form-label">Project:<font color="red">*</font></label>
                <div class="col-sm-4">

                    <select name="cdpo_no" id="cdpo_no" class= "form-control required" required>
                        <option value="0">Select Project</option>

                    </select>
                      
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


<!-- To get Project name as per district selection  -->
<script>

    $(document).ready(function()
    {
        $('#dist_cd').on( "change", function()
        {
            //console.log($(this).val());

            $.get('<?php echo site_url("sw/js_get_projectName");?>',{ dist_cd: $(this).val() })
            
            .done(function(data)
            {
                //console.log(data);
                var string = '<option value="0">Select Project</option>';

                $.each(JSON.parse(data), function( index, value ) {

                    string += '<option value="'+value.sl_no +'">'+value.cdpo+'</option>'

                });
                
                $('#cdpo_no').html(string);
            
            });

        });
    });

</script>