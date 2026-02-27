<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="min-h-screen w-full p-10">
    <div class="mb-8 flex items-center justify-between">
        <h1 class="text-3xl font-bold tracking-tight text-gray-800">Shipments</h1>

        <div class="flex items-center">
            <?php echo form_open('admin/shipments', array('method' => 'get', 'class' => 'flex items-center gap-2')); ?>
            <input type="search" name="search" placeholder="Search shipments..." id="search" aria-label="Search"
                value="<?php echo html_escape($this->input->get('search')); ?>"
                class="shadow-xs block rounded-md border border-gray-300 px-3 py-1.5 text-sm outline-none duration-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 focus:ring-offset-gray-100">

            <button type="submit" class="rounded-md bg-green-100 px-3 py-1.5 text-sm text-green-600 shadow-sm duration-200 hover:bg-green-300 focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                Search
            </button>

            <!-- Category Filter -->
            <select name="category" id="category"
                onchange="this.form.submit()"
                class="block rounded-md border border-gray-300 px-3 py-1.5 text-sm shadow-sm outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                <option value="">All</option>
                <option value="pending" <?php echo ($this->input->get('category') === 'pending') ? 'selected' : ''; ?>>Pending</option>
                <option value="shipped" <?php echo ($this->input->get('category') === 'shipped') ? 'selected' : ''; ?>>Shipped</option>
                <option value="delivered" <?php echo ($this->input->get('category') === 'delivered') ? 'selected' : ''; ?>>Delivered</option>
                <option value="returned" <?php echo ($this->input->get('category') === 'returned') ? 'selected' : ''; ?>>Returned</option>
            </select>
            <?php echo form_close(); ?>
        </div>
    </div>

    <div class="overflow-hidden rounded-xl border border-gray-200 shadow-sm ring-1 ring-gray-200">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="h-12 bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Shipment ID</th>
                    <th scope="col" class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Order ID</th>
                    <th scope="col" class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Track Number</th>
                    <th scope="col" class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Carrier</th>
                    <th scope="col" class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Status</th>
                    <th scope="col" class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Created At</th>
                    <th scope="col" class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Shipped At</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <?php if (!empty($shipments)): ?>

                    <?php foreach ($shipments as $shipment) : ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm text-gray-900"><?php echo $shipment['id']; ?></td>
                            <td class="px-6 py-4 text-sm text-gray-900"><?php echo $shipment['order_id']; ?></td>
                            <td class="px-6 py-4 text-sm text-gray-900"><?php echo $shipment['tracking_number']; ?></td>
                            <td class="px-6 py-4 text-sm text-gray-900">
                                <?php if ($shipment['status'] === 'pending'): ?>
                                    <a href="<?php echo base_url('admin/shipments/edit_carrier/' . $shipment['id']); ?>" class="rounded-xl bg-green-100 px-2.5 text-green-800 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2"><?php echo $shipment['carrier']; ?></a>
                                <?php else: ?>
                                    <?php echo $shipment['carrier']; ?>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4">
                                <a href="<?php echo base_url('admin/shipments/edit_status/' . $shipment['id']); ?>">
                                    <span class="inline-flex items-center rounded-full px-2.5 text-xs font-medium 
                                    <?php
                                    switch ($shipment['status']):
                                        case 'pending':
                                            echo 'bg-yellow-100 text-yellow-800';
                                            break;
                                        case 'shipped':
                                            echo 'bg-blue-100 text-blue-800';
                                            break;
                                        case 'delivered':
                                            echo 'bg-green-100 text-green-800';
                                            break;
                                        case 'returned':
                                            echo 'bg-red-100 text-red-800';
                                            break;
                                        default:
                                            echo 'bg-gray-100 text-gray-800';
                                            break;
                                    endswitch; ?>">
                                        <?php echo ucfirst($shipment['status']); ?>
                                    </span>
                                </a>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900">
                                <?php echo date('M d, Y', strtotime($shipment['created_at'])); ?>
                                <?php echo '<div class="text-xs text-gray-500">' . date('g:i A', strtotime($shipment['created_at'])) . '</div>'; ?>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900">
                                <?php echo date('M d, Y', strtotime($shipment['shipped_at'])); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-sm italic text-gray-500">
                            No shipments found.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>