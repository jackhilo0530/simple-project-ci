<?php
defined("BASEPATH") or exit("No direct script access allowed");
?>

<div class="flex-1 p-6 lg:p-10">
    <div class="mx-auto max-w-6xl">
        <h1 class="mb-8 text-3xl font-bold tracking-tight text-gray-900">Edit Product</h1>

        <?php echo form_open_multipart('admin/products/edit_product/' . $product['id'], array('class' => 'space-y-8')); ?>

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">

            <!-- Left Column: Product Details -->
            <div class="space-y-6 lg:col-span-2">
                <div class="shadow-xs overflow-hidden rounded-xl border border-gray-200 bg-white">
                    <div class="border-b border-gray-200 bg-gray-50 px-6 py-4">
                        <h2 class="text-sm font-semibold uppercase tracking-wider text-gray-900">Product Details</h2>
                    </div>
                    <div class="space-y-5 p-6">
                        <!-- Name -->
                        <div>
                            <label for="productName" class="mb-1 block text-sm font-medium text-gray-700">Product Name</label>
                            <input type="text" id="productName" name="name"
                                value="<?php echo set_value('name', $product['name']); ?>" required
                                class="shadow-xs outline-hidden block w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm transition-all focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="productDescription" class="mb-1 block text-sm font-medium text-gray-700">Description</label>
                            <textarea id="productDescription" name="description" rows="4"
                                class="shadow-xs outline-hidden block w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm transition-all focus:border-blue-500 focus:ring-1 focus:ring-blue-500"><?php echo set_value('description', $product['description']); ?></textarea>
                        </div>

                        <!-- Complete At Price, SKU, Stock, Category Grid -->
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="productCompleteAtPrice" class="mb-1 block text-sm font-medium text-gray-700">Complete At Price ($)</label>
                                <input type="number" id="productCompleteAtPrice" name="complete_at_price" step="0.01"
                                    value="<?php echo set_value('complete_at_price', $product['complete_at_price']); ?>"
                                    class="shadow-xs outline-hidden block w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                            </div>
                            <div>
                                <label for="productSKU" class="mb-1 block text-sm font-medium text-gray-700">SKU</label>
                                <input type="text" id="productSKU" name="sku"
                                    value="<?php echo set_value('sku', $product['sku']); ?>" required
                                    class="shadow-xs outline-hidden block w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                            </div>
                            <div>
                                <label for="productStockQuantity" class="mb-1 block text-sm font-medium text-gray-700">Stock Quantity</label>
                                <input type="number" id="productStockQuantity" name="stock_quantity"
                                    value="<?php echo set_value('stock_quantity', $product['stock_quantity']); ?>" required
                                    class="shadow-xs outline-hidden block w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                            </div>
                            <div>
                                <label for="productCategory" class="mb-1 block text-sm font-medium text-gray-700">Category</label>
                                <select id="productCategory" name="category_id" required
                                    class="shadow-xs outline-hidden block w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                                    <option value="1" <?php echo set_select('category_id', '1', $product['category_id'] == '1'); ?>>Electronics</option>
                                    <option value="2" <?php echo set_select('category_id', '2', $product['category_id'] == '2'); ?>>Clothing</option>
                                    <option value="3" <?php echo set_select('category_id', '3', $product['category_id'] == '3'); ?>>Home Goods</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Image Management -->
            <div class="space-y-6">
                <div class="shadow-xs overflow-hidden rounded-xl border border-gray-200 bg-white">
                    <div class="border-b border-gray-200 bg-gray-50 px-6 py-4">
                        <h2 class="text-sm font-semibold uppercase tracking-wider text-gray-900">Product Image</h2>
                    </div>
                    <div class="flex flex-col items-center p-6">
                        <span class="mb-3 block self-start text-xs font-semibold uppercase text-gray-400">Current Image</span>
                        <img src="<?php echo base_url('uploads/' . ($product['image_path'] ?: 'default.jpg')); ?>"
                            class="shadow-xs mb-6 h-48 w-48 rounded-lg border border-gray-200 object-cover">

                        <div class="w-full">
                            <label for="formFile" class="mb-2 block text-sm font-medium text-gray-700">Change Image</label>
                            <input type="file" id="formFile" name="image_path"
                                class="block w-full cursor-pointer text-sm text-gray-500 transition-all file:mr-4 file:rounded-md file:border-0 file:bg-blue-50 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-blue-700 hover:file:bg-blue-100">
                            <p class="mt-2 text-xs italic text-gray-400">Leave empty to keep current image.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="flex items-center gap-4 border-t border-gray-100 pt-4">
            <button type="submit"
                class="cursor-pointer rounded-md bg-blue-600 px-8 py-2.5 text-sm font-semibold text-white shadow-sm transition-all hover:bg-blue-700 focus-visible:outline-2 focus-visible:outline-blue-600">
                Update Product
            </button>
            <a href="<?php echo site_url('admin/products'); ?>"
                class="rounded-md bg-white px-8 py-2.5 text-sm font-semibold text-gray-900 no-underline shadow-sm ring-1 ring-inset ring-gray-300 transition-all hover:bg-gray-50">
                Cancel
            </a>
        </div>

        <?php echo form_close(); ?>
    </div>
</div>