<link rel = "stylesheet" href= "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
<script src= "https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js" ></script>
<script src= "https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js" ></script>
<link rel = "stylesheet" href= "https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />


<div class="wraper">      
        
    <div class="row">
        
        <div class="col-lg-9 col-sm-12">

            <h1><strong>Product</strong></h1>

        </div>

    </div>

    <div class="col-lg-12 container contant-wraper">    

        <h3>

            <small><a href="<?php echo site_url("stationary/addproduct");?>" class="btn btn-primary" style="width: 100px;">Add</a></small>
            <span class="confirm-div" style="float:right; color:green;"></span>

        </h3>
        <?php if($this->session->flashdata('msg')) {
                 echo $this->session->flashdata('msg');
        } ?>

        <table class="table table-striped table-bordered table-hover" id="dataTables-example" style="width:100%;">

            <thead>

                <tr>
                
                    <th>No</th>
                    <th>Name</th>
                    <th>HSN code</th>
                    <th>Company Name</th>
                    <th>Option</th>
                </tr>

            </thead>

            <tbody>

                <?php
                    $i=1;
                    foreach($products as $key)
                    {
                ?>
                    <tr>

                        <td><?php echo $i ?></td>
                        <td><?php echo $key->prod_name	; ?></td>
                        <td><?php echo $key->hsn_code; ?></td>
                        <td><?php echo $key->comp_name; ?></td> 
                        <td><a href="<?php echo site_url('stationary/productedit/'.$key->id.' '); ?>" ><i class="fa fa-edit fa-fw fa-2x"></i></a></td>
                        
                        
                    </tr> 

                <?php
                    $i++;
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