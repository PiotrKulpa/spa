<!DOCTYPE html>
<html lang="pl">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    
	<title>Zespół weselny</title>
	
	<!-- My CSS -->
	<link href="<?php echo base_url("assets/css/style.css"); ?>" rel="stylesheet">

    <!-- Bootstrap -->
	<link href="<?php echo base_url("assets/css/bootstrap.min.css"); ?>" rel="stylesheet">
	
	<!-- Lightbox2 -->
	<link href="<?php echo base_url("assets/lightbox2/src/css/lightbox.css"); ?>" rel="stylesheet">
	
	<!-- Angular -->
	<script src="<?php echo base_url('assets/js/angular.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/my-app.js'); ?>"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  
  <body data-spy="scroll" data-target=".navbar">
    
	<!-- Menu -->
	<nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
    
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span> 
          </button>
          <a class="navbar-brand" href="<?php echo base_url(); ?>">The Stringers</a>
        </div>
		
	    <div class="nav-justified">
          <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
            <li class="active"><a href="<?php echo base_url(); ?>">PRZEJDŹ DO STRONY GŁÓWNEJ</a></li>	
            </ul>
          </div>
	    </div>
		
      </div>
    </nav>
  
  