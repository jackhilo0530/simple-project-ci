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
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <header class="flex flex-wrap items-center justify-center py-3 mb-4 border-b border-gray-200 sm:justify-end">

            <div class="flex items-center gap-2 text-right">
                <?php if (isset($_SESSION['username']) && $_SESSION['logged_in'] === true): ?>
                    <a href="<?php echo base_url('logout'); ?>"
                        class="inline-block px-4 py-2 text-sm font-medium text-blue-600 border border-blue-600 rounded-md hover:bg-blue-50 transition-colors">
                        Logout
                    </a>
                <?php else: ?>
                    <a href="<?php echo base_url('signup'); ?>"
                        class="no-underline inline-block px-4 py-2 text-sm font-medium text-blue-600 border border-blue-600 rounded-md hover:bg-blue-50 transition-colors">
                        Signup
                    </a>
                    <a href="<?php echo base_url('signin'); ?>"
                        class="no-underline inline-block px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-blue-600 rounded-md hover:bg-blue-700 transition-colors">
                        Signin
                    </a>
                <?php endif; ?>
            </div>
        </header>
    </div>

    <main class="flex min-h-screen bg-gray-50" id="site-layout">