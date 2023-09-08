<!--/// jquery links for data range ///  dateRange picker //-->
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />



<div class="wraper">      

    <div class="col-md-6 container form-wraper">

        <form role="form" method="POST" action= "<?php echo site_url('sw/f_get_dateRange_oilPayment') ?>" >
            <div class="form-header">
                
                <h4>Date Wise oil Payment Report</h4>
            
            </div>
            <div class="form-group row">
			    <div class="col-md-6" style="margin-top:20px">
				
						<label for="from_date" class="col-sm-4 col-form-label">From Date:</label>
						<div class="col-sm-8">
							<input type="date" name="from_date" class="form-control" required value="">
						</div>
						
				</div>
				<div class="col-md-6" style="margin-top:20px">
												
					<label for="to_date" class="col-sm-4 col-form-label">To Date:</label>
					<div class="col-sm-8">
						<input type="date" name="to_date" class="form-control" required value="">
					</div>
					
				</div>
            
            </div>

            <div class="form-group row">

                <div class="col-sm-10">

                    <button type="submit" class="btn btn-primary" >GO<i class="fa fa-angle-double-right fa-fw "></i></button>

                </div>

            </div>

        </form>

            
    </div>

</div>



<!-- JS for dateRange picker calender -->

<script type="text/javascript">

    $(function() {

    $('input[name="datefilter"]').daterangepicker({
        autoUpdateInput: false,
        locale: {
            cancelLabel: 'Clear'
        }
    });

    $('input[name="datefilter"]').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('YYYY-MM-DD') + '  ' + picker.endDate.format('YYYY-MM-DD'));
    });

    $('input[name="datefilter"]').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });

    });

    //var startDate =  picker.startDate.format('DD/MM/YYYY');
    //var endDate =  picker.endDate.format('DD/MM/YYYY');

    //console.log(startDate); 

</script>