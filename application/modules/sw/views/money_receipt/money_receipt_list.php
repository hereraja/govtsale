<!-- <script src= "https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery/.min.js" ></script> -->
<link rel = "stylesheet" href= "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
<script src= "https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js" ></script>
<script src= "https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js" ></script>
<link rel = "stylesheet" href= "https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
<div class="wraper">      
        
    <div class="row">
        
        <div class="col-lg-9 col-sm-12">

            <h1><strong>Money receipt</strong></h1>

        </div>

    </div>

    <div class="col-lg-12 container contant-wraper">    

		<div class="row">
		    <div class="col-md-2">
				<h3>
                  <small><a href="<?php echo site_url("sw/money_receipt");?>" class="btn btn-primary" style="width: 100px;">Add</a></small>
                  <span class="confirm-div" style="float:right; color:green;"></span>
                </h3>
			</div>
			<form method="POST" id="form" action="<?php echo site_url("sw/money_receipt_list");?>">
				<div class="col-md-3" style="margin-top:20px">
						<label for="from_date" class="col-sm-4 col-form-label">From Date:</label>
						<div class="col-sm-8">
							<input type="date" name="from_date" class="form-control required" value="">
						</div>
				</div>
				<div class="col-md-3" style="margin-top:20px">
												
					<label for="to_date" class="col-sm-4 col-form-label">To Date:</label>
					<div class="col-sm-8">
						<input type="date" name="to_date" class="form-control required" value="">
					</div>
					
				</div>
				<div class="col-md-2" style="margin-top:20px">
					<input type="submit" class="btn btn-info" value="Proceed">
				</div>
			</form> 
			
		</div>
        <table class="table table-striped table-bordered table-hover" id="dataTables-example">

            <thead>
                <tr>
                    <th>Transaction Date</th>
                    <th>Number</th>
                    <th>Received from</th>
                    <th>Refference Detail</th>
					<th>Amount</th>
					<th>Print</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>

            <tbody>

                <?php
                    foreach($data as $key)
                    {
                ?>
                    <tr>
                        <td><?php echo date("d-m-Y",strtotime($key->trans_dt)); ?></td>
                        <td><?php echo $key->no; ?></td>
                        <td><?php echo $key->received_from; ?></td>
                        <td><?php echo $key->reff_detail; ?></td>
                        <td><?php echo $key->amt; ?></td>
						<td><a href="<?php echo site_url('sw/money_receipt_print?key='.base64_encode($key->id)); ?>" target="_blank"><i class="fa fa-print" aria-hidden="true" style=""></i></a></td>
                        <td><a href="<?php echo site_url('sw/money_receipt_edit?trans_dt='.$key->trans_dt.'&no='.$key->no.'&key='.base64_encode($key->id).''); ?>"><i class="fa fa-edit fa-fw fa-2x"></i></a></td>
                        <td><a href="<?php echo site_url('sw/deleteMoneyreceipt?trans_dt='.$key->trans_dt.'&no='.$key->no.'&key='.base64_encode($key->id).''); ?>" onclick="return confirm('Are you sure you want to delete this item?');" ><i class="fa fa-trash fa-fw fa-2x"></i></a></td>
                        
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
        "order": [[ 1, "desc" ]]
         });
    });
</script>

 