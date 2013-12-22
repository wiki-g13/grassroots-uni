<!DOCTYPE html>
<html lang="en">
<head>
    
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<link rel="shortcut icon" href="<?=base_url(); ?>assets/img/favicon.png">

<title><?php echo $title ?>  - Grassroots </title>

<!-- Bootstrap core CSS -->
<link href="<?=base_url(); ?>assets/css/bootstrap.css" rel="stylesheet">
<style type="text/css">
body {
    padding-top: 70px;
}
</style>

<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
    <script src="<?=base_url(); ?>>assets/js/html5shiv.js"></script>
    <script src="<?=base_url(); ?>assets/js/respond.min.js"></script>
<![endif]-->


</head>
<body>




<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
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
                <li class="<?php if ( $this->uri->uri_string() == 'login' ) { echo "active"; } ?>"><a href="<?=base_url('login'); ?>">Login</a></li>
                <li class="<?php if ( $this->uri->uri_string() == 'register' ) { echo "active"; } ?>"><a href="<?=base_url('register'); ?>">Register</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</div>


