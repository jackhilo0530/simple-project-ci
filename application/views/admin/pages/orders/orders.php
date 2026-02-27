<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="min-h-screen w-full p-10">
    <div class="mb-8 sm:flex sm:items-center sm:justify-between">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900">Orders</h1>

        <div class="flex flex-wrap items-center gap-3">
            <!-- Search Form -->
            <?php echo form_open('admin/products', array('method' => 'get', 'class' => 'flex items-center gap-2')); ?>
            <input type="search" id="search" placeholder="Search" aria-label="Search" name="search"
                value="<?php echo html_escape($this->input->get('search')); ?>"
                class="shadow-xs outline-hidden block w-full rounded-md border border-gray-300 bg-white px-3 py-1.5 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
            <button type="submit"
                class="inline-flex cursor-pointer items-center justify-center rounded-lg bg-green-100 px-4 py-2 text-sm font-semibold text-green-600 shadow-sm transition-all hover:bg-green-300 focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2">
                Search
            </button>


            <!-- Category Filter -->
            <select id="category" aria-label="Category Filter" name="category_id"
                onchange="this.form.submit()"
                class="shadow-xs outline-hidden block rounded-md border border-gray-300 bg-white px-3 py-1.5 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                <option value="">All</option>
                <option value="1" <?php echo ($this->input->get('category_id') == '1') ? 'selected' : ''; ?>>Electronics</option>
                <option value="2" <?php echo ($this->input->get('category_id') == '2') ? 'selected' : ''; ?>>Clothing</option>
                <option value="3" <?php echo ($this->input->get('category_id') == '3') ? 'selected' : ''; ?>>Home Goods</option>
            </select>

            <?php echo form_close(); ?>

        </div>
    </div>

    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm ring-1 ring-gray-200">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="h-12 bg-gray-50">
                <tr>
                    <th scope="col" style="width: 10%;" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Order ID</th>
                    <th scope="col" style="width: 25%;" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Customer</th>
                    <th scope="col" style="width: 20%;" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Date</th>
                    <th scope="col" style="width: 10%;" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Total</th>
                    <th scope="col" style="width: 5%;" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Status</th>
                    <th scope="col" style="width: 5%;" class="relative px-6 py-4"><span class="sr-only">Toggle</span></th>
                    <th scope="col" style="width: 5%;" class="py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500"><span class="sr-only">Action</span></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white">
                <?php if (!empty($all_orders)): ?>
                    <?php foreach ($all_orders as $order): ?>
                        <!-- Main Order Row -->
                        <tr class="group transition-colors hover:bg-gray-50">
                            <td class="whitespace-nowrap py-4 pl-10 text-sm text-gray-600">
                                #<?php echo $order['id']; ?>
                            </td>
                            <td class="flex items-center gap-3 whitespace-nowrap px-6 py-4 text-sm">
                                <img src="<?php echo base_url('uploads/avatars/' . $order['user_image']); ?>" alt="User Image" class="h-10 w-10 rounded-full object-cover">
                                <div class="text-sm font-medium text-gray-900">
                                    <?php echo $order['user']; ?>
                                    <?php echo $order['user_email'] ? '<div class="text-xs text-gray-500">' . $order['user_email'] . '</div>' : ''; ?>
                                </div>
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900">
                                <?php echo date('M d, Y', strtotime($order['created_at'])); ?>
                                <?php echo $order['created_at'] ? '<div class="text-xs text-gray-500">' . date('g:i A', strtotime($order['created_at'])) . '</div>' : ''; ?>
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm font-semibold text-gray-900">
                                $<?php echo number_format($order['total_price'], 2); ?>
                            </td>
                            <td class="whitespace-nowrap px-6 py-4">
                                <a href="<?php echo base_url('admin/orders/edit_status/' . $order['id']); ?>" class="inline-flex items-center rounded-md px-2 py-1 text-xs font-medium ring-1 ring-inset 
                                    <?php
                                        switch( $order['status'] ):
                                            case 'pending': echo 'bg-amber-50 text-amber-700 ring-amber-600/20'; break;
                                            case 'processing': echo 'bg-green-50 text-green-700 ring-green-600/20'; break;
                                            case 'completed': echo 'bg-blue-50 text-blue-700 ring-blue-600/20'; break;
                                            default: echo 'bg-red-50 text-red-700 ring-red-600/20'; break;
                                        endswitch; ?>">
                                    <?php echo ucfirst($order['status']); ?>
                                </a>
                            </td>
                            <td class="contents- cursor-pointer whitespace-nowrap px-6 py-4 text-right text-sm" onclick="toggleOrder('items-<?php echo $order['id']; ?>')">
                                <svg id="icon-<?php echo $order['id']; ?>" class="h-4 w-4 text-gray-400 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </td>
                            <!-- Action Button for delete -->
                            <td class="whitespace-nowrap py-4 text-sm font-medium">
                                <a href="<?php echo base_url('admin/orders/delete/' . $order['id']); ?>" class="rounded-md border border-red-600 px-3 py-1 text-xs text-red-600 hover:bg-red-50 hover:text-red-900" onclick="return confirm('Are you sure you want to delete this order?');">Delete</a>
                            </td>
                        </tr>

                        <!-- Hidden Items Row -->
                        <tr id="items-<?php echo $order['id']; ?>" class="hidden bg-gray-50">
                            <td colspan="7" class="px-6 py-4">
                                <div class="rounded-lg border border-gray-100 bg-white px-4 pt-2">
                                    <h3 class="mb-3 text-xs font-bold uppercase tracking-widest text-gray-400">Order Items</h3>
                                    <div class="space-y-3">
                                        <?php foreach ($order['items'] as $item): ?>
                                            <div class="mb-3 flex items-center justify-between border-b border-gray-200 pb-3 last:border-0 last:pb-0">
                                                <div class="flex items-center gap-4">
                                                    <img src="<?php echo base_url('uploads/' . $item->image_path); ?>" class="h-16 w-16 rounded-md object-cover ring-1 ring-gray-200">
                                                    <p class="text-sm font-medium text-gray-900"><?php echo $item->name; ?></p>
                                                </div>
                                                <div class="flex items-center gap-10">
                                                    <p class="text-xs text-gray-500">x <?php echo $item->quantity; ?></p>
                                                    <p class="text-sm font-semibold text-gray-900">$<?php echo number_format($item->complete_at_price, 2); ?></p>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-sm italic text-gray-500">
                            No orders found.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    function toggleOrder(id) {
        const row = document.getElementById(id);
        const iconId = id.replace('items-', 'icon-');
        const icon = document.getElementById(iconId);

        // Toggle the hidden class
        row.classList.toggle('hidden');

        // Rotate the arrow icon
        if (row.classList.contains('hidden')) {
            icon.style.transform = 'rotate(0deg)';
        } else {
            icon.style.transform = 'rotate(180deg)';
        }
    }
</script>