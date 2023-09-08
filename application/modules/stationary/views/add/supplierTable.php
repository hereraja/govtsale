<link rel = "stylesheet" href= "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
<script src= "https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js" ></script>
<script src= "https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js" ></script>
<link rel = "stylesheet" href= "https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />

<!-- For toggle Switch -->
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

<!-- For Toggle Button Style -->
<style>
  .toggle.ios, .toggle-on.ios, .toggle-off.ios { border-radius: 20px; }
  .toggle.ios .toggle-handle { border-radius: 20px; }
</style>


<div class="wraper">      
        
    <div class="row">
        
        <div class="col-lg-9 col-sm-12">

            <h1><strong>Suppliers</strong></h1>

        </div>

    </div>

    <div class="col-lg-12 container contant-wraper">    

        <h3>

            <small><a href="<?php echo site_url("stationary/addSupplier");?>" class="btn btn-primary" style="width: 100px;">Add</a></small>
            <span class="confirm-div" style="float:right; color:green;"></span>

        </h3>

        <table class="table table-striped table-bordered table-hover" id="dataTables-example" style="width:100%;">

            <thead>

                <tr>
                
                    <th>Sl No</th>
                    <th>Supplier</th>
                    <th>Contact Person</th>
                    <th>Phn No</th>
                <!--   <th>Renewal</th>-->
                    <th>Edit</th>
                    <th>Delete</th>
                    
                </tr>

            </thead>

            <tbody class= "tbody">

                <?php
                    $i=1;
                    foreach($data as $key)
                    {
                ?>
                    <tr>

                        <td><?php echo $i; ?></td>
                        <td><?php echo $key->name	; ?></td>
                        <td><?php echo $key->contact_person	; ?></td>
                        <td><?php echo $key->phn_no ?></td> 
                    <!--    <td>
                            <label class="checkbox-inline">
                                <input type="checkbox" name="renewal" <?php echo ($key->renewal == 1)? "checked":""; ?> class="toggle" id="checkbox" data-toggle="toggle" data-size="small" data-onstyle="success" data-offstyle="danger" data-style="ios">
                            </label>
                        </td>  -->
                        <td><a href="<?php echo site_url('stationary/editSupplier/'.$key->sl_no.' '); ?>" ><i class="fa fa-edit fa-fw fa-2x"></i></a></td>
                        <td><a href="<?php echo site_url('stationary/deleteSupplier/'.$key->sl_no.' '); ?>" onclick="return confirm('Are you sure you want to delete this item?');" ><i class="fa fa-trash fa-fw fa-2x"></i></a></td>
                        
                    </tr> 

                <?php
                    $i=$i+1;
                    }
                ?>

            </tbody>

        </table>

    </div>

</div>


<!-- DataTables JavaScript -->
<script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable();
    });
</script>



<!-- For Toggle Switch --> 
<script>

    $('.table tbody').on('click', '.toggle', function(){
        var row = $(this).closest('tr');
        //var col = $(this).closest('td');
       
        var texto = row.find('td:eq(0)').text();
        console.log(texto);

        $.get('<?php echo site_url("stationary/js_get_supplier_cur_RenewalStatus");?>',{ sl_no: texto })
        .done(function(data)
        {
            var cur_status = JSON.parse(data).renewal ; 
            console.log(cur_status);
            
            $.post('<?php echo site_url("stationary/js_edit_supplier_renewalStatus");?>',{ sl_no: texto, cur_status: cur_status })

        });
        

    })
 
</script>