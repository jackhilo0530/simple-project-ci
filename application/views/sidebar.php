<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="absolute col-2 d-flex flex-column flex-shrink-0 text-bg-white text-black">
    <ul class="nav nav-pills nav-tabs flex-column mb-auto">
        <li class="nav-item ">
            <a href="<?php echo base_url('logout') ?>" class="nav-link link-bg-primary" aria-current="page">
                <i class="bi bi-house-door pe-none me-2" width="16" height="16" aria-hidden="true">
                    <use xlink:href="#home"></use>
                </i>
                Home
            </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo base_url('dashboard') ?>" class="nav-link">
                <i class="bi bi-palette pe-none me-2" width="16" height="16" aria-hidden="true">
                    <use xlink:href="#speedometer2"></use>
                </i>
                Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo base_url('products') ?>" class="nav-link">
                <i class="bi bi-command pe-none me-2" width="16" height="16" aria-hidden="true">
                    <use xlink:href="#grid"></use>
                </i>
                Products
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="bi bi-person-circle pe-none me-2" width="16" height="16" aria-hidden="true">
                    <use xlink:href="#people-circle"></use>
                </i>
                Customers
            </a>
        </li>
    </ul>
    
</div>