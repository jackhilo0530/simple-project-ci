<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!Doctype html>

<html lang="en" data-bs-theme="light">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Site title</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">

    <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <div class="container">
        <header
            class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-end py-3 mb-4 border-bottom">

            <div class="col-md-3 text-end">
                <?php if (isset($_SESSION['username']) && $_SESSION['logged_in'] === true): ?>
                    <a href="<?php echo base_url('logout'); ?>"><button type="button" class="btn btn-outline-primary me-2">
                            Logout
                        </button></a>
                <?php else: ?>
                    <a href="<?php echo base_url('signup'); ?>"><button type="button" class="btn btn-outline-primary me-2">
                            Signup
                        </button></a>
                    <a href="<?php echo base_url('signin'); ?>"><button type="button" class="btn btn-outline-primary me-2">
                            Signin
                        </button></a>
                <?php endif; ?>
            </div>
        </header>
    </div>

    <main class="row" id="site-content" role="main">