<!DOCTYPE html>
<html lang="en">
<head>
    
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<link rel="shortcut icon" href="<?php echo base_url(); ?>assets/img/favicon.png">

<title><?php echo $title ?>  - Grassroots </title>

<!-- Bootstrap core CSS -->
<link href="<?=base_url(); ?>assets/css/bootstrap.css" rel="stylesheet">
<style type="text/css">

.admin-content {
    margin: 50px 0;
}
</style>

<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
    <script src="<?=base_url(); ?>>assets/js/html5shiv.js"></script>
    <script src="<?=base_url(); ?>assets/js/respond.min.js"></script>
<![endif]-->


</head>
<body>


<div class="navbar navbar-inverse navbar-static-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Grassroots</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav pull-right">
                <li><a href="<?=base_url('logout'); ?>">Logout</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</div>



<div class="container">
    <div class="row">
       
        <div class="col-md-3" >

                <p class="lead">User Nav</p>
   
                <div class="list-group">
                    <a href="<?=base_url('dashboard'); ?>" class="list-group-item <?php if ( $this->uri->uri_string() == 'dashboard' ) { echo "active"; } ?>">Dashboard</a>
                    <a href="<?=base_url('dashboard/news'); ?>" class="list-group-item <?php if ( $this->uri->uri_string() == 'dashboard/news' ) { echo "active"; } ?>">News</a>
                </div>

                <p class="lead">Settings</p>

                <div class="list-group">

                    <a href="<?=base_url('settings/change-password'); ?>" class="list-group-item <?php if ( $this->uri->uri_string() == 'settings/change-password' ) { echo "active"; } ?>">Change Password</a>

                </div>    

                <?php  // only admins can views this
                if ($this->ion_auth->is_admin()) { ?>

                <p class="lead">Admin</p>  

                <div class="list-group">
                    <a href="<?=base_url('admin/users'); ?>" class="list-group-item <?php if ( $this->uri->uri_string() == 'admin/users' ) { echo "active"; } ?>">User Management</a>
                     <a href="<?=base_url('admin/news'); ?>" class="list-group-item <?php if ( $this->uri->uri_string() == 'admin/news' ) { echo "active"; } ?>">News Management</a>
                    
                </div>

                <?php } ?>
        </div>

        <div class="col-md-9">
            <div class="panel panel-default admin-content">
                <div class="panel-body">
