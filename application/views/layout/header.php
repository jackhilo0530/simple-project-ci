<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
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

    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">


<body>
    <div class="w-full px-4 sm:px-6 lg:px-8">
        <header class="mb-4 flex flex-wrap items-center justify-center py-3 shadow-sm shadow-gray-200/50 sm:justify-end">

            <div class="flex items-center gap-2 text-right">
                <?php if (isset($_SESSION['username']) && $_SESSION['logged_in'] === true): ?>
                    <a href="<?php echo base_url('logout'); ?>"
                        class="inline-block rounded-md border border-blue-600 px-4 py-2 text-sm font-medium text-blue-600 transition-colors hover:bg-blue-50">
                        Logout
                    </a>
                <?php else: ?>
                    <a href="<?php echo base_url('signup'); ?>"
                        class="inline-block rounded-md border border-blue-600 px-4 py-2 text-sm font-medium text-blue-600 no-underline transition-colors hover:bg-blue-50">
                        Signup
                    </a>
                    <a href="<?php echo base_url('signin'); ?>"
                        class="inline-block rounded-md border border-blue-600 bg-blue-600 px-4 py-2 text-sm font-medium text-white no-underline transition-colors hover:bg-blue-700">
                        Signin
                    </a>
                <?php endif; ?>
            </div>
        </header>
    </div>

    <main class="flex min-h-screen bg-white" id="site-layout">