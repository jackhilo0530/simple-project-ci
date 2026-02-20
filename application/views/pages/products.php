<?php
defined("BASEPATH") or exit("No direct script access allowed");
?>

<div class="flex-1 p-6 lg:p-10">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900">Products</h1>

        <div class="flex flex-wrap items-center gap-3">
            <!-- Search Form -->
            <form role="search" class="flex items-center gap-2">
                <input type="search" id="search" placeholder="Search" aria-label="Search"
                    class="block w-full rounded-md border border-gray-300 bg-white px-3 py-1.5 text-sm shadow-xs focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-hidden">
                <button type="submit"
                    class="rounded-md border border-green-600 px-3 py-1.5 text-sm font-medium text-green-600 hover:bg-green-50 transition-colors cursor-pointer">
                    Search
                </button>
            </form>

            <!-- Category Filter -->
            <select id="category" aria-label="Category Filter"
                class="block rounded-md border border-gray-300 bg-white px-3 py-1.5 text-sm shadow-xs focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-hidden">
                <option value="">Choose Category...</option>
                <option value="laptop">Electronics</option>
                <option value="clothing">Clothing</option>
                <option value="home_goods">Home Goods</option>
            </select>
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
                <?php foreach ($products as $product): ?>
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
                        <td class="px-6 py-4">
                            <code class="rounded bg-gray-100 px-1.5 py-0.5 text-xs font-semibold text-gray-700">
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
                                <?php echo ucfirst($product['category']); ?>
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
            </tbody>
        </table>
    </div>

    <!-- Footer Action -->
    <div class="mt-6">
        <a href="<?php echo site_url('products/add_product'); ?>"
            class="no-underline inline-block rounded-md border border-blue-600 px-4 py-2 text-sm font-medium text-blue-600 hover:bg-blue-50 transition-colors">
            Add Product
        </a>
    </div>
</div>