<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<aside class="flex min-h-screen w-64 shrink-0 flex-col border-r border-gray-200 bg-white">
    <nav class="flex flex-col space-y-1 p-4">
        <!-- Dashboard Link -->
        <a href="<?php echo base_url('admin/dashboard') ?>"
            class="flex items-center rounded-md px-3 py-2 text-sm font-medium text-gray-700 no-underline transition-colors hover:bg-gray-100 hover:text-blue-600">
            <i class="bi bi-palette mr-3 text-lg leading-none"></i>
            Dashboard
        </a>

        <!-- Products Link -->
        <a href="<?php echo base_url('admin/products') ?>"
            class="flex items-center rounded-md px-3 py-2 text-sm font-medium text-gray-700 no-underline transition-colors hover:bg-gray-100 hover:text-blue-600">
            <i class="bi bi-command mr-3 text-lg leading-none"></i>
            Products
        </a>

        <!-- Users Link -->
        <a href="<?php echo base_url('users') ?>"
            class="flex items-center rounded-md px-3 py-2 text-sm font-medium text-gray-700 no-underline transition-colors hover:bg-gray-100 hover:text-blue-600">
            <i class="bi bi-person-circle mr-3 text-lg leading-none"></i>
            User
        </a>

        <!-- Orders Link -->
        <a href="<?php echo base_url('admin/orders') ?>"
            class="flex items-center rounded-md px-3 py-2 text-sm font-medium text-gray-700 no-underline transition-colors hover:bg-gray-100 hover:text-blue-600">
            <i class="bi bi-command mr-3 text-lg leading-none"></i>
            Orders
        </a>

        <!-- Shipments Link -->
        <a href="<?php echo base_url('admin/shipments') ?>"
            class="flex items-center rounded-md px-3 py-2 text-sm font-medium text-gray-700 no-underline transition-colors hover:bg-gray-100 hover:text-blue-600">
            <i class="bi bi-truck mr-3 text-lg leading-none"></i>
            Shipments
        </a>
    </nav>
</aside>