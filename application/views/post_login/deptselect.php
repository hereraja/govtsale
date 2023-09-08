<!DOCTYPE html>
<html>
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">        
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="<?php echo base_url("/confed.jpg"); ?>">
        <title>CONFED</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url("/assets/css/sb-admin.css");?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url("/assets/css/select2.css");?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url("/assets/css/apps.css"); ?>">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url("/assets/js/validation.js")?>"></script>
        <script type="text/javascript" src="<?php echo base_url("/assets/js/select2.js")?>"></script>
        <script type="text/javascript" src="https://www.benfed.in/assets/js/table2excel.js"></script>
    </head>  
    <style>
        .hr {
            display: block;
            margin-top: 0.5em;
            margin-bottom: 0.5em;
            margin-left: auto;
            margin-right: auto;
            border-style: inset;
            border-width: 1px;
        }
        .transparent_tag {
            background: transparent; 
            border: none;
        }
        .no-border {
            border: 0;
            box-shadow: none;
            width: 75px;
        }
    </style>
    <body id="page-top" style="background-color: #eff3f6;">
        <header style="background-color: #353746; border:none; padding: 6px; border-radius: 0; color: #fff; width: 100%;">
            <div style="margin-left: 35px; display: inline; margin-right: 35px; padding: 3px; font-family: 'Courier New', Courier, monospace;">
                <span styele="display: inline; width: 200px;"><strong>Date:</strong> <?php echo date("d-m-Y");?></span>
                <strong>Financial Year: </strong><?php  echo SESSION_YEAR; ?>
            </div>
            
            <div style="display: inline; margin-right: 35px; padding: 3px; font-family: 'Courier New', Courier, monospace; float: right;">
                <span styele="display: inline;"><strong>User: </strong> <?php echo $this->session->userdata('loggedin')->user_name;?></span>
                &nbsp;&nbsp; <a href="<?php echo site_url("profile") ?>" style="color: white; text-decoration: none;"><i class="fa fa-cog fa-spin fa-fw" aria-hidden="true"></i></a>
            </div>

        </header>
        
        <header style="background-color: #fff;">

            <div style="margin-left: 35px; padding: 3px; font-family: 'Courier New', Courier, monospace;">
            <a href="<?php echo site_url("User_Login/deptselect");?>"><img src="<?php echo base_url("/confed.jpg");?>" style="display: inline; height: 65px;" /></a>
            </div>
            
        </header>

        <nav class="navbar navbar-inverse bg-primary" style="background-color: #424854; border:none; border-radius: 0; color: #9194a0;">
            <div style="margin-left: 20px;">
    
        <div>
            <div class="col-lg-2">
                    
            <a class="navbar-brand" href="<?php echo site_url("User_Login/deptselect");?>"><i class="fa fa-home"></i> Home</a>
                    
        </div>
        <div class="col-lg-1" style="margin-right:48px"><button class="hide_show" style="background-color:#424854;padding: 9px 15px;color: #FFFFFF;" value="stationery_menu">STATIONERY</button></div> 
        <div class="col-lg-1"><button class="hide_show" style="background-color:#424854;padding: 9px 15px;color: #FFFFFF;" value="icds_menu">ICDS</button></div>
        <div class="col-lg-1"><button class="hide_show" style="background-color:#424854;padding: 9px 15px;color: #FFFFFF;" value="cg_menu">CG</button></div> 
        <div class="col-lg-2"><button class="hide_show" style="background-color:#424854;padding: 9px 15px;color: #FFFFFF;" value="textile_menu">Textile</button></div> 
        
        </div> 
                <div class="col-lg-3 col-xs-4">
					<div class="dropdown">
                        <div class="dropbtn">
                            <a href="<?php echo site_url("User_Login/logout") ?>" style="color: white; text-decoration: none;"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
                        </div>    
                    </div>
                </div>
            </div>
        </nav>
