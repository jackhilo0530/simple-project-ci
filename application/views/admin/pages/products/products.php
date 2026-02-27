<?php
defined("BASEPATH") or exit("No direct script access allowed");
?>

<div class="flex-1 p-6 lg:p-10">
    <!-- Header Section -->
    <div class="mb-8 flex flex-col justify-between gap-4 md:flex-row md:items-center">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900">Products</h1>

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

    <!-- Table Container -->
    <div class="shadow-xs overflow-x-auto rounded-xl border border-gray-200 bg-white">
        <table class="w-full border-collapse text-left">
            <thead class="border-b border-gray-200 bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-4 text-sm font-semibold text-gray-900">Product</th>
                    <th scope="col" class="px-6 py-4 text-sm font-semibold text-gray-900">Description</th>
                    <th scope="col" class="px-6 py-4 text-sm font-semibold text-gray-900">Category</th>
                    <th scope="col" class="px-6 py-4 text-sm font-semibold text-gray-900">Status</th>
                    <th scope="col" class="px-6 py-4 text-center text-sm font-semibold text-gray-900">Visibility</th>
                    <th scope="col" class="px-2 py-4 text-sm font-semibold text-gray-900">SKU</th>
                    <th scope="col" class="px-6 py-4 text-sm font-semibold text-gray-900">Price</th>
                    <th scope="col" class="px-6 py-4 text-sm font-semibold text-gray-900">Stock</th>
                    <th scope="col" class="px-6 py-4 text-sm font-semibold text-gray-900">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <?php if (empty($products)) : ?>
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-500">No products found.</td>
                    </tr>
                <?php else : ?>
                    <?php foreach ($products as $product) : ?>
                        <!-- Render product row -->
                        <tr class="transition-colors hover:bg-gray-50">
                            <!-- Product & Image -->
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    <img src="<?php echo base_url('uploads/' . ($product['image_path'] ?: 'default.jpg')); ?>"
                                        alt="product"
                                        class="shadow-xs h-16 w-16 rounded-lg border border-gray-200 object-cover">
                                    <a href="<?php echo site_url('admin/products/detail_product/' . $product['id']); ?>"><span class="font-bold text-gray-900"><?php echo $product['name']; ?></span></a>
                                </div>
                            </td>

                            <!-- Description -->
                            <td class="px-6 py-4 text-sm text-gray-500">
                                <?php echo (strlen($product['description']) > 60) ? substr($product['description'], 0, 60) . '...' : $product['description']; ?>
                            </td>

                            <!-- Category Badge -->
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center rounded-full bg-blue-50 px-2.5 py-0.5 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10">
                                    <?php echo ucfirst($product['category_name']); ?>
                                </span>
                            </td>

                            <!--status -->
                            <td class="px-6 py-4">
                                <?php if (!$product['is_draft']) : ?>
                                    <?php if ($product['status'] === 'active') : ?>
                                        <span class="inline-flex items-center rounded-full bg-green-50 px-2.5 py-0.5 text-xs font-medium text-green-600 ring-1 ring-inset ring-green-700/10">
                                            Active
                                        </span>
                                    <?php else : ?>
                                        <span class="inline-flex items-center rounded-full bg-red-50 px-2.5 py-0.5 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-700/10">
                                            Inactive
                                        </span>
                                    <?php endif; ?>
                                <?php else : ?>
                                    <a href="<?php echo site_url('admin/products/toggle_status/' . $product['id']); ?>">
                                        <?php if ($product['status'] === 'active') : ?>
                                            <span class="inline-flex items-center rounded-full bg-green-50 px-2.5 py-0.5 text-xs font-medium text-green-600 ring-1 ring-inset ring-green-700/10">
                                                Active
                                            </span>
                                        <?php else : ?>
                                            <span class="inline-flex items-center rounded-full bg-red-50 px-2.5 py-0.5 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-700/10">
                                                Inactive
                                            </span>
                                        <?php endif; ?>
                                    </a>
                                <?php endif; ?>

                            </td>
                            <!-- Draft/Published Badge with PATCH -->
                            <td class="px-6 py-4 text-center">
                                <a href="<?php echo site_url('admin/products/toggle_draft/' . $product['id']); ?>">
                                    <?php if (!$product['is_draft']) : ?>
                                        <span class="inline-flex items-center rounded-full bg-amber-50 px-2.5 py-0.5 text-xs font-medium text-amber-600 ring-1 ring-inset ring-amber-700/10">
                                            Draft
                                        </span>
                                    <?php else : ?>
                                        <span class="inline-flex items-center rounded-full bg-green-50 px-2.5 py-0.5 text-xs font-medium text-green-600 ring-1 ring-inset ring-green-700/10">
                                            Published
                                        </span>
                                    <?php endif; ?>
                                </a>
                            </td>

                            <!-- SKU -->
                            <td class="px-2 py-4">
                                <code class="rounded bg-gray-100 px-0 py-0.5 text-xs font-semibold text-gray-700">
                                    <?php echo $product['sku']; ?>
                                </code>
                            </td>
                            <!-- Price -->
                            <td class="px-6 py-4 font-bold text-gray-900">
                                <div class="flex flex-col">
                                    <?php if ($product['complete_at_price'] > 0) : ?>
                                        <!-- Original Price (Strikethrough) -->
                                        <span class="text-xs text-gray-400" style="text-decoration-line: line-through;">
                                            $<?php echo number_format($product['price'], 2); ?>
                                        </span>
                                        <!-- Discounted Price -->
                                        <span class="text-sm font-bold text-green-600">
                                            $<?php echo number_format($product['complete_at_price'], 2); ?>
                                        </span>
                                    <?php else : ?>
                                        <!-- Regular Price Only -->
                                        <span class="text-sm font-bold text-gray-900">
                                            $<?php echo number_format($product['price'], 2); ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </td>

                            <!-- Stock Quantity-->
                            <td class="px-6 py-4">
                                <div class="flex flex-col gap-1">
                                    <div class="h-2 w-full rounded-full bg-gray-200">
                                        <div class="h-2 rounded-full <?php echo $product['stock_quantity'] >= 50 ? 'bg-green-500' : ($product['stock_quantity'] >= 20 ? 'bg-yellow-500' : 'bg-red-200'); ?>" style="width: <?php echo $product['stock_quantity'] > 0 ? min(100, ($product['stock_quantity'] / 100 * 100)) : 0; ?>%"></div>
                                    </div>
                                    <span class="text-xs text-gray-500"><?php echo $product['stock_quantity']; ?> in stock</span>
                                </div>
                            </td>

                            <!-- Actions -->
                            <td class="px-6 py-4">
                                <div class="flex flex-col gap-2">
                                    <a href="<?php echo site_url('admin/products/edit_product/' . $product['id']); ?>"
                                        class="rounded-md border border-amber-500 px-2 py-1 text-center text-xs font-medium text-amber-600 no-underline transition-colors hover:bg-amber-50">
                                        Edit
                                    </a>
                                    <a href="<?php echo site_url('admin/products/delete/' . $product['id']); ?>"
                                        class="rounded-md border border-red-500 px-2 py-1 text-center text-xs font-medium text-red-600 no-underline transition-colors hover:bg-red-50"
                                        onclick="return confirm('Delete this product?')">
                                        Delete
                                    </a>
                                </div>
                            </td>
                        </tr>

                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <nav aria-label="Pagination" class="isolate mt-6 inline-flex w-full justify-between gap-5 rounded-md">
        <?php

        $params = $this->input->get();

        $params['page'] = max(1, $current_page - 1);
        $prev_url = site_url('admin/products/index?' . http_build_query($params));

        $params['page'] = min($current_page + 1, ceil($total_products / 4));
        $next_url = site_url('admin/products/index?' . http_build_query($params));
        $limit = 4;

        $start_item = ($total_products > 0) ? ($current_page - 1) * $limit + 1 : 0;

        $end_item = min($current_page * $limit, $total_products);
        ?>

        <div>
            <p class="text-sm text-gray-700">
                Showing
                <span class="font-medium"><?php echo $start_item; ?></span>
                to
                <span class="font-medium"><?php echo $end_item; ?></span>
                of
                <span class="font-medium"><?php echo $total_products; ?></span>
                results
            </p>
        </div>

        <div>
            <!-- Previous Button -->
            <a href="<?php echo $prev_url; ?>"
                class="inset-ring inset-ring-gray-400 relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-700 hover:bg-white/5">
                <span class="sr-only">Previous</span>
                <svg viewBox="0 0 20 20" fill="currentColor" class="size-5">
                    <path d="M11.78 5.22a.75.75 0 0 1 0 1.06L8.06 10l3.72 3.72a.75.75 0 1 1-1.06 1.06l-4.25-4.25a.75.75 0 0 1 0-1.06l4.25-4.25a.75.75 0 0 1 1.06 0Z" clip-rule="evenodd" fill-rule="evenodd" />
                </svg>
            </a>

            <!-- Next Button -->
            <a href="<?php echo $next_url; ?>"
                class="inset-ring inset-ring-gray-400 relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-700 hover:bg-white/5">
                <span class="sr-only">Next</span>
                <svg viewBox="0 0 20 20" fill="currentColor" class="size-5">
                    <path d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" fill-rule="evenodd" />
                </svg>
            </a>
        </div>
    </nav>

    <!-- Footer Action -->
    <div class="mt-1">
        <a href="<?php echo site_url('admin/products/add_product'); ?>"
            class="inline-block rounded-md border border-blue-600 px-4 py-2 text-sm font-medium text-blue-600 no-underline transition-colors hover:bg-blue-50">
            Add Product
        </a>
        <div>

        </div>
    </div>

</div>