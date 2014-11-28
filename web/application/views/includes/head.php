<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php if(isset($title) && !is_null($title)) {echo $title . " - Servix"; }else{ echo "Servix - a un click de distancia";} ;?></title>
    <!--<title>Servix</title>-->

    <!-- Bootstrap -->
    <link href="<?php echo site_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo site_url('assets/css/bootstrapValidator.min.css'); ?>" rel="stylesheet" >
    <link href="<?php echo site_url('assets/css/raty/jquery.raty.css'); ?>" rel="stylesheet">
    <link href="<?php echo site_url('assets/css/styles.css'); ?>" rel="stylesheet">
    <link href="<?php echo site_url('assets/font-awesome-4.2.0/css/font-awesome.min.css') ?>" rel="stylesheet">
    <link href="<?php echo site_url('assets/css/bootstrap-datetimepicker.min.css') ?>" rel="stylesheet">
    <link href="<?php echo site_url('assets/css/bootstrap-select.min.css') ?>" rel="stylesheet">
    <link href="<?php echo site_url('assets/css/ajax-bootstrap-select.css') ?>" rel="stylesheet">
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