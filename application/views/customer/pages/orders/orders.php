<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!-- Changed to w-full and removed max-width constraints -->
<div class="min-h-screen w-full bg-slate-50/50 p-6 lg:p-10">

    <!-- Page Header -->
    <div class="mb-10 flex items-center justify-between">
        <div>
            <h1 class="text-4xl font-extrabold tracking-tight text-slate-900">Orders</h1>
        </div>
    </div>

    <?php if (empty($orders)) : ?>
        <div class="flex flex-col items-center justify-center rounded-3xl border-2 border-dashed border-slate-200 bg-white px-4 py-20 text-center">
            <div class="mb-4 rounded-full bg-slate-100 p-4">
                <svg class="h-12 w-12 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-slate-900">No orders yet</h2>
            <a href="<?php echo site_url('customer/products'); ?>" class="mt-6 rounded-xl bg-indigo-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-indigo-200 transition-all hover:bg-indigo-700">Start Shopping</a>
        </div>
    <?php else : ?>
        <!-- Full width grid: 3 orders per row on desktop -->
        <div class="grid w-full grid-cols-2 gap-8 lg:grid-cols-3">
            <?php foreach ($orders as $order) : ?>
                <div class="flex flex-col overflow-hidden rounded-3xl border border-slate-200 bg-white transition-all hover:border-indigo-200 hover:shadow-xl hover:shadow-indigo-500/5">

                    <!-- Order Top Bar -->
                    <div class="flex items-center justify-between gap-4 border-b border-slate-100 bg-slate-50/50 px-6 py-4">
                        <div class="flex gap-6">
                            <div>
                                <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Date</p>
                                <p class="text-xs font-semibold text-slate-700"><?php echo date('M j, Y', strtotime($order->created_at)); ?></p>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Order ID</p>
                                <p class="font-mono text-xs font-semibold text-slate-700">#<?php echo str_pad($order->id, 5, '0', STR_PAD_LEFT); ?></p>
                            </div>
                        </div>
                        <span class="inline-flex items-center rounded-lg bg-emerald-50 px-2.5 py-1 text-[10px] font-bold text-emerald-700 ring-1 ring-inset ring-emerald-600/20">
                            <?php echo ucfirst($order->status); ?>
                        </span>
                    </div>

                    <!-- Items List (Scrollable if too many items) -->
                    <div class="max-h-[400px] flex-1 overflow-y-auto px-6 py-6">
                        <div class="divide-y divide-slate-100">
                            <?php foreach ($order->items as $item) : ?>
                                <div class="flex items-center gap-4 py-4 first:pt-0 last:pb-0">
                                    <div class="h-16 w-16 flex-shrink-0 overflow-hidden rounded-xl border border-slate-100 bg-slate-50">
                                        <img src="<?php echo base_url('uploads/' . $item->image_path); ?>" alt="Product" class="h-full w-full object-cover">
                                    </div>

                                    <div class="flex min-w-0 flex-1 flex-col">
                                        <h3 class="truncate text-sm font-bold text-slate-900"><?php echo $item->name; ?></h3>
                                        <div class="mt-1 flex items-center justify-between">
                                            <span class="text-xs text-slate-500">Qty: <?php echo $item->quantity; ?></span>
                                            <p class="text-sm font-bold text-slate-900">$<?php echo number_format($item->complete_at_price, 2); ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Summary Section (Fixed to Bottom) -->
                    <div class="mt-auto border-t border-slate-100 bg-slate-50/30 px-6 py-6">
                        <div class="mb-4 space-y-2">
                            <div class="flex justify-between text-xs">
                                <span class="text-slate-500">Subtotal</span>
                                <span class="font-medium text-slate-900">$<?php echo number_format($order->total_price, 2); ?></span>
                            </div>
                            <div class="flex justify-between text-xs">
                                <span class="text-slate-500">Shipping</span>
                                <span class="font-medium text-slate-900"><?php if ($order->total_price > 100) { echo '<span class="text-green-600">Free</span>'; } else { echo '<span class="text-red-600">$5.00</span>'; } ?></span>
                            </div>
                            <div class="flex justify-between border-t border-slate-100 pt-2">
                                <span class="text-sm font-bold text-slate-900">Total</span>
                                <span class="text-lg font-bold text-indigo-600">$<?php echo number_format($order->total_price + ( $order->total_price > 100 ? 0 : 5 ), 2); ?></span>
                            </div>
                        </div>
                        <button class="w-full rounded-xl bg-slate-900 py-3 text-xs font-bold text-white transition-all hover:bg-slate-800">
                            Track Order Details
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>