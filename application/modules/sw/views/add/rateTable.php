<!-- <script src= "https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery/.min.js" ></script> -->
<link rel = "stylesheet" href= "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
<script src= "https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js" ></script>
<script src= "https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js" ></script>
<link rel = "stylesheet" href= "https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />


<div class="wraper">      
        
    <div class="row">
        
        <div class="col-lg-9 col-sm-12">

            <h1><strong>Rate Chart</strong></h1>

        </div>

    </div>

    <div class="col-lg-12 container contant-wraper">    
		
		<div class="row">
		    <div class="col-md-2">
				<h3>
					<small><a href="<?php echo site_url("sw/addRate");?>" class="btn btn-primary" style="width: 100px;">Add</a></small>
					<span class="confirm-div" style="float:right; color:green;"></span>
				</h3>
			</div>
			<form method="POST" id="form" action="<?php echo site_url("sw/rateEntry");?>">
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
		
		
		<?php   if( $_SERVER['REQUEST_METHOD']=="POST" )   {       ?>
        <table class="table table-striped table-bordered table-hover" id="dataTables-example" >

            <thead>
                <tr>
                    <th>From Date</th>
                    <th>To Date</th>
                    <th>Product</th>
                    <th>Rate (Rs.)</th>
                    <th>Margin (Rs.)</th>
                    <th>GST(%)</th>
                    <th>Per Unit</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tbody>

                <?php
                    foreach($data as $key)
                    {
                ?>
                    <tr>

                        <td><?php echo date("d-m-Y",strtotime($key->from_dt)); ?></td>
                        <td><?php echo date("d-m-Y",strtotime($key->to_dt)); ?></td>
                        <td><?php echo $key->item_name; ?></td>
                        <td><?php echo $key->rate; ?></td>
                        <td><?php echo $key->margin; ?></td>
                        <td><?php echo $key->gst; ?></td>
                        <td><?php echo $key->unit; ?></td>
                        <?php if($key->to_dt < date('Y-m-d')){ ?>
                        <td></td>
                        <?php }else{ ?>
                            <td><a href="<?php echo site_url('sw/editRateEntry?sl_no='.$key->sl_no.'&hsn_no='.$key->hsn_no.' '); ?>"><i class="fa fa-edit fa-fw fa-2x"></i></a></td>
                        <?php } ?>

                    </tr>

                <?php
                    }
                ?>

            </tbody>

        </table>
		
		<?php }else{  ?>
		
		<table class="table table-striped table-bordered table-hover" id="dataTables-example" >
            <thead>
                <tr>
                    <th>From Date</th>
                    <th>To Date</th>
                    <th>Product</th>
                    <th>Rate (Rs.)</th>
                    <th>Margin (Rs.)</th>
                    <th>GST(%)</th>
                    <th>Per Unit</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tbody>

                <?php
                    foreach($data as $key)
                    {
                ?>
                    <tr>

                        <td><?php echo date("d-m-Y",strtotime($key->from_dt)); ?></td>
                        <td><?php echo date("d-m-Y",strtotime($key->to_dt)); ?></td>
                        <td><?php echo $key->item_name; ?></td>
                        <td><?php echo $key->rate; ?></td>
                        <td><?php echo $key->margin; ?></td>
                        <td><?php echo $key->gst; ?></td>
                        <td><?php echo $key->unit; ?></td>
                        <?php if($key->to_dt < date('Y-m-d')){ ?>
                        <td></td>
                        <?php }else{ ?>
                            <td><a href="<?php echo site_url('sw/editRateEntry?sl_no='.$key->sl_no.'&hsn_no='.$key->hsn_no.' '); ?>"><i class="fa fa-edit fa-fw fa-2x"></i></a></td>
                        <?php } ?>

                    </tr>

                <?php
                    }
                ?>

            </tbody>

        </table>
		<?php } ?>

    </div>

</div>


<!-- DataTables JavaScript -->
<script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable();
    });
</script>