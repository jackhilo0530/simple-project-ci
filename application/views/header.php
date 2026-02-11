<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!Doctype html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Site title</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">

    <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/style.css'); ?>" rel="stylesheet">

</head>

<body>
    <header id="site-header">
        <nav class="navbar navbar-default" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?= base_url() ?>">Site title</a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <?php if (isset($_SESSION['username']) && $_SESSION['logged_in'] === true): ?>
                            <li><a href="<?php echo base_url('logout'); ?>">Logout</a></li>
                        <?php else: ?>
                            <li><a href="<?php echo base_url('signup'); ?>">Signup</a></li>
                            <li><a href="<?php echo base_url('signin'); ?>">Signin</a></li>
                        <?php endif; ?>
                    </ul>
                </div><!-- .navbar-collapse -->
            </div><!-- .container-fluid -->
        </nav>
    </header>

    <main id="site-content" role="main">
