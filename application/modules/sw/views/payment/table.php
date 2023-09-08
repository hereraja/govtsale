<link rel = "stylesheet" href= "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
<script src= "https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js" ></script>
<script src= "https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js" ></script>
<link rel = "stylesheet" href= "https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />


<div class="wraper">      
        
    <div class="row">
        
        <div class="col-lg-9 col-sm-12">

            <h1><strong>Payment Detail(ICDS)</strong></h1>

        </div>

    </div>

    <div class="col-lg-12 container contant-wraper">    

        <h3>
            <small><a href="<?php echo site_url("sw/add_payment");?>" class="btn btn-primary" style="width: 100px;">Add</a></small>
            <span class="confirm-div" style="float:right; color:green;"></span>
        </h3>
		
        <table class="table table-striped table-bordered table-hover" id="dataTables-example" style="width:100%;">
            <thead>

                <tr>
				    <th>Date</th>
				    <th>Supplier Name</th>
                 <!--   <th>Mr No</th>
                    <th>Mr date</th>
                    <th>Trans mode.</th>
                    <th>Pay Dt</th> -->
                    <th>Amt</th> 
                    <th>Option</th>
					<th>Voucher</th>
                </tr>

            </thead>

            <tbody>

                <?php
                    foreach($data as $key)
                    {
                ?>
                    <tr>
					    <td><?php echo date("d/m/Y",strtotime($key->trans_dt)); ?></td>
						<td><?php echo $key->vendor_name; ?></td>
                        <td><?php echo $key->amt; ?></td> 
                        <td>
                      <!--  <a href="<?php echo site_url('sw/editpayment/'.$key->id); ?>" ><i class="fa fa-edit fa-fw fa-2x"></i></a> -->
						<a href="<?php echo site_url('sw/deletepayment/'.$key->id); ?>" onclick="return confirm('Are you sure you want to delete this item?');" ><i class="fa fa-trash fa-fw fa-2x"></i></a>
						<a href="<?php echo site_url('sw/notesheet/'.$key->id); ?>" ><i class="fa fa-print fa-fw fa-2x"></i></a>
						<a href="<?php echo site_url('sw/get_sort_calculation/'.$key->id); ?>" ><i class="fa fa-eye fa-fw fa-2x"></i></a>
						</td>
						<td><a href="<?php echo site_url('sw/get_voucher/'.urldecode($key->id)); ?>" target="_blank"><i class="fa fa-print fa-fw fa-2x"></i></a></td>
                     
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
        $('#dataTables-example').DataTable({ 
        //"order": [[ 0, "desc" ]] 
			"ordering": false
        });
    });
</script>