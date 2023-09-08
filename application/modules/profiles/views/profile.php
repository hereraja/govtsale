<div class="wraper">      

<div class="col-md-6 container form-wraper">

    <div class="form-header">
        
        <h4 >Profile Detail</h4>
        <h5 style="padding: 0;" class="alert"></h5>
     
    </div>

    <form class="form-horizontal form-material" 
            method="post"
            action="<?php echo site_url('profile/updateprofile')?>"
        >
        <div class="form-group">
            <label class="col-md-12">User Name</label>
            <div class="col-md-12">
                <input type="text" name="user_name" class="form-control form-control-line" 
                value='<?php if(isset($userdetail->user_name)) { echo $userdetail->user_name; }?>'
                >
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-12">Emp Code</label>
            <div class="col-md-12">
                <input type="text" name="emp_cd"  class="form-control form-control-line"
                value='<?php if(isset($userdetail->emp_cd)) { echo $userdetail->emp_cd; }?>'
                >
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-12">Department</label>
            <div class="col-md-12">
                <input type="text" name='dept' class="form-control form-control-line"
                value='<?php if(isset($userdetail->dept)) { echo $userdetail->dept; }?>'
                >
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-12">Designation</label>
            <div class="col-md-12">
                <input type="text" id="con_pass" name='designation' class="form-control form-control-line"
                value='<?php if(isset($userdetail->designation)) { echo $userdetail->designation; }?>'
                >
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-12">
                <button class="btn btn-primary" id="btnSubmit">Update Profile</button>
            </div>
        </div>
    </form>

    </div>

</div>

<script>

    $("#form").validate();

</script>

<script type="text/javascript">
    // $("#btnSubmit").click(function () {
    //     var password = $("#new_pass").val();
    //     var confirmPassword = $("#con_pass").val();
    //     if (password != confirmPassword) {
    //         alert("Passwords do not match.");
    //         return false;
    //     }
    //     else{
    //         document.getElementById("btnSubmit").type = 'submit';
    //         return true;
    //     }
        
    // });
</script>

<script>
   
    $(document).ready(function() {

    $('.alert').hide();

        <?php if($this->session->flashdata('msg')['message']){ ?>

            $('.alert').html('<?php echo $this->session->flashdata('msg')['message']; ?> <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>').show();

        <?php } ?>

        });
    
</script>