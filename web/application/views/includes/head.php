<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?php echo site_url('assets/images/favicon.ico'); ?>" type="image/x-icon">
    <link rel="icon" href="<?php echo site_url('assets/images/favicon.ico'); ?>" type="image/x-icon">
    <title><?php if(isset($title) && !is_null($title)){ echo $title . " - " . APP_NAME; }else{ echo APP_NAME . " - " . APP_SLOGAN;} ;?></title>

    <!-- Bootstrap -->
    <link href="<?php echo site_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo site_url('assets/css/bootstrapValidator.min.css'); ?>" rel="stylesheet" >
    <link href="<?php echo site_url('assets/font-awesome-4.2.0/css/font-awesome.min.css') ?>" rel="stylesheet">
    <link href="<?php echo site_url('assets/css/styles.css'); ?>" rel="stylesheet">

    <?php
     if(isset($css) && $css!=null)
      {
        foreach ($css as $key ) {
    ?>
    <link href="<?php echo site_url($key);?>" rel="stylesheet">
    <?php
        }
      }
    ?> 

  <!--   <link href="<?php echo site_url('assets/css/bootstrap-datetimepicker.min.css') ?>" rel="stylesheet">

    <link href="<?php echo site_url('assets/css/bootstrap-select.min.css') ?>" rel="stylesheet">

    <link href="<?php echo site_url('assets/css/ajax-bootstrap-select.css') ?>" rel="stylesheet">

    <link href="<?php echo site_url('assets/css/raty/jquery.raty.css'); ?>" rel="stylesheet"> -->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <?php 
      if(isset($map)){
       echo $map['js'];
      }
     ?>
  </head>
  <body>