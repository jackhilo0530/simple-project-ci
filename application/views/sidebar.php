<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<aside class="w-64 min-h-screen bg-white border-r border-gray-200 flex flex-col shrink-0">
    <nav class="flex flex-col p-4 space-y-1">
        <!-- Home Link (Active/Primary Style) -->
        <a href="<?php echo base_url('/') ?>"
            class="flex items-center px-3 py-2 text-sm font-medium rounded-md no-underline text-gray-700 hover:bg-gray-100 hover:text-blue-600 transition-colors">
            <i class="bi bi-house-door mr-3 text-lg leading-none"></i>
            Home
        </a>

        <!-- Dashboard Link -->
        <a href="<?php echo base_url('dashboard') ?>"
            class="flex items-center px-3 py-2 text-sm font-medium rounded-md no-underline text-gray-700 hover:bg-gray-100 hover:text-blue-600 transition-colors">
            <i class="bi bi-palette mr-3 text-lg leading-none"></i>
            Dashboard
        </a>

        <!-- Products Link -->
        <a href="<?php echo base_url('products') ?>"
            class="flex items-center px-3 py-2 text-sm font-medium rounded-md no-underline text-gray-700 hover:bg-gray-100 hover:text-blue-600 transition-colors">
            <i class="bi bi-command mr-3 text-lg leading-none"></i>
            Products
        </a>

        <!-- Customers Link -->
        <a href="#"
            class="flex items-center px-3 py-2 text-sm font-medium rounded-md no-underline text-gray-700 hover:bg-gray-100 hover:text-blue-600 transition-colors">
            <i class="bi bi-person-circle mr-3 text-lg leading-none"></i>
            Customers
        </a>
    </nav>
</aside>