
<link rel = "stylesheet" href= "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
<script src= "https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js" ></script>
<script src= "https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js" ></script>
<link rel = "stylesheet" href= "https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
<div class="wraper">      
        
    <div class="row">
        <div class="col-lg-9 col-sm-12">
            <h1><strong>Stationery  Bills detail</strong></h1>
        </div>
    </div>

    <div class="col-lg-12 container contant-wraper">    
        <h3>
            <small><a href="<?php echo site_url("stationary/add_bill");?>" class="btn btn-primary" style="width: 100px;">Add</a></small>
            <span class="confirm-div" style="float:right; color:green;"></span>
        </h3>
		
        <table class="table table-striped table-bordered table-hover" id="dataTables-example" style="width:100%;">
            <thead>
                <tr>
                    <th>Sl No</th>
                    <th>Bill entry date</th>
                    <th>System ID</th>
                    <th>Sale Bill No.</th>
                    <th>Vendor</th>
                    <th>Sale bill amt.</th>
                    <th>P Bill Amt(Rs)</th> 
                    <th>View</th>
                    <th>Delete</th>
                </tr>

            </thead>
            <tbody>

                <?php
				    $count = 0;
                    foreach($data as $key)
                    {
                ?>
                    <tr>
                        <td><?php echo ++$count; ?></td>
                        <td><?php echo $key->trans_dt; ?></td>
                        <td><?php echo $key->bulk_trans_id; ?></td>
                        <td><?php echo $key->s_bill_no; ?></td>
                        <td><?php echo $key->name; ?></td>
						<td><?php echo $key->s_bill_amt; ?></td>
                        <td><?php echo $key->p_bill_amt; ?></td> 
                        <td>
                        <a href="<?php echo site_url('stationary/editbill/'.$key->bulk_trans_id); ?>" ><i class="fa fa-eye fa-fw fa-2x"></i></a>
						</td>
                        <td><a href="<?php echo site_url('stationary/deletebill/'.$key->bulk_trans_id); ?>" onclick="return confirm('Are you sure you want to delete this item?');" ><i class="fa fa-trash fa-fw fa-2x"></i></a></td> 
                    </tr> 
                <?php
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