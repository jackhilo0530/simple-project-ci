<?php
defined("BASEPATH") or exit("No direct script access allowed");
?>

<div class="flex-1 p-6 lg:p-10">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900">Products</h1>

        <div class="flex flex-wrap items-center gap-3">
            <!-- Search Form -->
            <?php echo form_open('products', array('method' => 'get', 'class' => 'flex items-center gap-2')); ?>
            <input type="search" id="search" placeholder="Search" aria-label="Search" name="search"
                value="<?php echo html_escape($this->input->get('search')); ?>"
                class="block w-full rounded-md border border-gray-300 bg-white px-3 py-1.5 text-sm shadow-xs focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-hidden">
            <button type="submit"
                class="rounded-md border border-green-600 px-3 py-1.5 text-sm font-medium text-green-600 hover:bg-green-50 transition-colors cursor-pointer">
                Search
            </button>


            <!-- Category Filter -->
            <select id="category" aria-label="Category Filter" name="category_id"
                class="block rounded-md border border-gray-300 bg-white px-3 py-1.5 text-sm shadow-xs focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-hidden">
                <option value="">All</option>
                <option value="1" <?php echo ($this->input->get('category_id') == '1') ? 'selected' : ''; ?>>Electronics</option>
                <option value="2" <?php echo ($this->input->get('category_id') == '2') ? 'selected' : ''; ?>>Clothing</option>
                <option value="3" <?php echo ($this->input->get('category_id') == '3') ? 'selected' : ''; ?>>Home Goods</option>
            </select>

            <?php echo form_close(); ?>

        </div>
    </div>

    <!-- Table Container -->
    <div class="overflow-x-auto rounded-xl border border-gray-200 bg-white shadow-xs">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-4 text-sm font-semibold text-gray-900 w-1/4">Name</th>
                    <th class="px-6 py-4 text-sm font-semibold text-gray-900 w-[30%]">Description</th>
                    <th class="px-6 py-4 text-sm font-semibold text-gray-900 w-[15%]">SKU</th>
                    <th class="px-6 py-4 text-sm font-semibold text-gray-900 w-[10%]">Price</th>
                    <th class="px-6 py-4 text-sm font-semibold text-gray-900 w-[10%]">Category</th>
                    <th class="px-6 py-4 text-sm font-semibold text-gray-900 w-[10%] text-center">Actions</th>
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
                        <tr class="hover:bg-gray-50 transition-colors">
                            <!-- Product & Image -->
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    <img src="<?php echo base_url('uploads/' . ($product['image_path'] ?: 'default.jpg')); ?>"
                                        alt="product"
                                        class="h-16 w-16 rounded-lg border border-gray-200 object-cover shadow-xs">
                                    <span class="font-bold text-gray-900"><?php echo $product['name']; ?></span>
                                </div>
                            </td>

                            <!-- Description -->
                            <td class="px-6 py-4 text-sm text-gray-500">
                                <?php echo (strlen($product['description']) > 60) ? substr($product['description'], 0, 60) . '...' : $product['description']; ?>
                            </td>

                            <!-- SKU -->
                            <td class="px-2 py-4">
                                <code class="rounded bg-gray-100 px-0 py-0.5 text-xs font-semibold text-gray-700">
                                    <?php echo $product['sku']; ?>
                                </code>
                            </td>

                            <!-- Price -->
                            <td class="px-6 py-4 font-bold text-gray-900">
                                $<?php echo number_format($product['price'], 2); ?>
                            </td>

                            <!-- Category Badge -->
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center rounded-full bg-blue-50 px-2.5 py-0.5 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10">
                                    <?php echo ucfirst($product['category_name']); ?>
                                </span>
                            </td>

                            <!-- Actions -->
                            <td class="px-6 py-4">
                                <div class="flex flex-col gap-2">
                                    <a href="<?php echo site_url('products/edit_product/' . $product['id']); ?>"
                                        class="no-underline text-center rounded-md border border-amber-500 px-2 py-1 text-xs font-medium text-amber-600 hover:bg-amber-50 transition-colors">
                                        Edit
                                    </a>
                                    <a href="<?php echo site_url('products/delete/' . $product['id']); ?>"
                                        class="no-underline text-center rounded-md border border-red-500 px-2 py-1 text-xs font-medium text-red-600 hover:bg-red-50 transition-colors"
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

    <nav aria-label="Pagination" class="isolate inline-flex rounded-md gap-5 mt-6 w-full justify-between">
        <?php

        $params = $this->input->get();

        $params['page'] = max(1, $current_page - 1);
        $prev_url = site_url('products/index?' . http_build_query($params));

        $params['page'] = min($current_page + 1, ceil($total_products / 4));
        $next_url = site_url('products/index?' . http_build_query($params));
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
                class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-700 inset-ring inset-ring-gray-400 hover:bg-white/5">
                <span class="sr-only">Previous</span>
                <svg viewBox="0 0 20 20" fill="currentColor" class="size-5">
                    <path d="M11.78 5.22a.75.75 0 0 1 0 1.06L8.06 10l3.72 3.72a.75.75 0 1 1-1.06 1.06l-4.25-4.25a.75.75 0 0 1 0-1.06l4.25-4.25a.75.75 0 0 1 1.06 0Z" clip-rule="evenodd" fill-rule="evenodd" />
                </svg>
            </a>

            <!-- Next Button -->
            <a href="<?php echo $next_url; ?>"
                class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-700 inset-ring inset-ring-gray-400 hover:bg-white/5">
                <span class="sr-only">Next</span>
                <svg viewBox="0 0 20 20" fill="currentColor" class="size-5">
                    <path d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" fill-rule="evenodd" />
                </svg>
            </a>
        </div>
    </nav>

    <!-- Footer Action -->
    <div class="mt-1">
        <a href="<?php echo site_url('products/add_product'); ?>"
            class="no-underline inline-block rounded-md border border-blue-600 px-4 py-2 text-sm font-medium text-blue-600 hover:bg-blue-50 transition-colors">
            Add Product
        </a>
        <div>

        </div>
    </div>

</div>