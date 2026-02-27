<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="min-h-screen bg-slate-50/50 py-12 antialiased">
    <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">

        <!-- Breadcrumb / Back Link -->
        <nav class="mb-8 flex items-center gap-2 text-sm font-medium text-slate-500">
            <a href="<?php echo site_url('admin/products'); ?>" class="transition-colors hover:text-indigo-600">Products</a>
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
            <span class="text-slate-900"><?php echo $product['category_name']; ?></span>
        </nav>

        <div class="overflow-hidden rounded-[2.5rem] border border-white bg-white/70 shadow-[0_32px_64px_-16px_rgba(0,0,0,0.08)] backdrop-blur-xl">
            <div class="grid grid-cols-1 lg:grid-cols-12">

                <!-- Media Section (Left) -->
                <div class="relative lg:col-span-7">
                    <div class="aspect-square w-full overflow-hidden bg-slate-100 p-8 lg:aspect-auto lg:h-full">
                        <?php if ($product['image_path']): ?>
                            <img src="<?php echo base_url('uploads/' . $product['image_path']); ?>"
                                alt="<?php echo $product['name']; ?>"
                                class="h-full w-full rounded-3xl object-cover shadow-2xl transition-transform duration-700 hover:scale-105">
                        <?php else: ?>
                            <div class="flex h-full w-full flex-col items-center justify-center rounded-3xl bg-slate-200/50 text-slate-400">
                                <svg class="mb-4 h-16 w-16 opacity-20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span class="text-xs font-bold uppercase tracking-widest">Image Unavailable</span>
                            </div>
                        <?php endif; ?>
                    </div>
                    <!-- Status Badge -->
                    <div class="absolute left-10 top-10">
                        <span class="inline-flex items-center rounded-full bg-white/90 px-4 py-1.5 text-xs font-bold text-slate-900 shadow-sm backdrop-blur-md">
                            <span class="mr-2 h-2 w-2 rounded-full <?php echo $product['stock_quantity'] > 0 ? 'bg-emerald-500' : 'bg-rose-500' ?>"></span>
                            <?php echo $product['stock_quantity'] > 0 ? 'In Stock' : 'Out of Stock' ?>
                        </span>
                    </div>
                </div>

                <!-- Info Section (Right) -->
                <div class="flex flex-col p-10 lg:col-span-5 lg:p-16">
                    <div class="mb-auto">
                        <div class="mb-4 inline-block rounded-lg bg-indigo-50 px-3 py-1 text-[10px] font-black uppercase tracking-tighter text-indigo-600">
                            <?php echo $product['sku']; ?>
                        </div>

                        <h1 class="text-4xl font-black tracking-tight text-slate-900 sm:text-5xl">
                            <?php echo $product['name']; ?>
                        </h1>

                        <div class="mt-6 flex items-baseline gap-4">
                            <span class="text-4xl font-bold text-green-600">$<?php echo number_format($product['complete_at_price'], 2); ?></span>
                            <?php if ($product['complete_at_price']): ?>
                                <span class="text-lg text-slate-400 line-through decoration-slate-300 decoration-2">
                                    $<?php echo number_format($product['price'], 2); ?>
                                </span>
                            <?php endif; ?>
                        </div>

                        <div class="mt-8 space-y-6">
                            <div class="prose prose-slate prose-sm leading-relaxed text-slate-600">
                                <?php echo nl2br($product['description']); ?>
                            </div>


                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-6 pt-6 sm:grid-cols-2">
                        <!-- Inventory with Modern Progress Bar -->
                        <div class="flex flex-col justify-center rounded-2xl border border-slate-100 bg-slate-50 p-4 transition-all hover:border-indigo-100 hover:bg-indigo-50/30">
                            <div class="mb-3 flex items-center justify-between">
                                <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Inventory</p>
                                <span class="text-xs font-black text-slate-900"><?php echo $product['stock_quantity']; ?> </span>
                            </div>

                            <!-- The Bar Container -->
                            <div class="relative h-4 w-full overflow-hidden rounded-full bg-slate-200/50 shadow-inner">
                                <!-- The Fill -->
                                <div class="bg-linear-to-r h-full rounded-full from-emerald-400 to-emerald-600 shadow-[0_0_12px_rgba(16,185,129,0.4)] transition-all duration-1000"
                                    style="width: <?php echo min(100, ($product['stock_quantity'] / 100) * 100); ?>%;">
                                </div>
                            </div>

                            <p class="mt-2 text-[10px] italic text-slate-400">
                                <?php echo $product['stock_quantity'] > 50 ? 'Healthy stock levels' : 'Low stock warning'; ?>
                            </p>
                        </div>

                        <!-- Category Card -->
                        <div class="rounded-2xl border border-slate-100 bg-slate-50 p-4 transition-all hover:border-indigo-100 hover:bg-indigo-50/30">
                            <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Category</p>
                            <div class="mt-2 flex items-center gap-2">
                                <div class="shadow-xs rounded-lg bg-white p-1.5">
                                    <svg class="h-4 w-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                    </svg>
                                </div>
                                <p class="text-lg font-bold text-slate-800"><?php echo $product['category_name']; ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-12 flex flex-col gap-4">
                        <a href="<?php echo site_url('admin/products/edit_product/' . $product['id']); ?>">
                            <button class="w-full rounded-2xl bg-slate-900 py-4 text-sm font-bold text-white shadow-xl transition-all hover:bg-slate-800 hover:shadow-slate-200 active:scale-95">
                                Edit Product Details
                            </button>
                        </a>
                        <button onclick="history.back()" class="w-full rounded-2xl border border-slate-200 py-4 text-sm font-bold text-slate-600 transition-all hover:bg-slate-50">
                            Return to List
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>