<?php
defined("BASEPATH") or exit("No direct script access allowed");
?>

<div class="flex-1 p-6 lg:p-10">
    <div class="mx-auto max-w-6xl">
        <h1 class="mb-8 text-3xl font-bold tracking-tight text-gray-900">Add New Product</h1>

        <?php echo form_open_multipart('admin/products/add_product', array('class' => 'space-y-8')); ?>

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">

            <!-- Left Column: Product Details (Spans 2 columns) -->
            <div class="space-y-6 lg:col-span-2">
                <div class="shadow-xs overflow-hidden rounded-xl border border-gray-200 bg-white">
                    <div class="border-b border-gray-200 bg-gray-50 px-6 py-4">
                        <h2 class="text-sm font-semibold uppercase tracking-wider text-gray-900">Product Details</h2>
                    </div>
                    <div class="space-y-5 p-6">
                        <!-- Product Name -->
                        <div>
                            <label for="productName" class="mb-1 block text-sm font-medium text-gray-700">Product Name</label>
                            <input type="text" id="productName" name="name" placeholder="Enter product name"
                                value="<?php echo set_value('name'); ?>" required
                                class="shadow-xs outline-hidden block w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm transition-all focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="productDescription" class="mb-1 block text-sm font-medium text-gray-700">Description</label>
                            <textarea id="productDescription" name="description" rows="4" placeholder="Enter product description"
                                class="shadow-xs outline-hidden block w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm transition-all focus:border-blue-500 focus:ring-1 focus:ring-blue-500"><?php echo set_value('description'); ?></textarea>
                        </div>

                        <!-- Price, Compare_at_price, SKU, Category Grid -->
                        <div class="grid grid-cols-2 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                            <!-- Price -->
                            <div>
                                <label for="price" class="mb-1 block text-sm font-medium text-gray-700">Price ($)</label>
                                <input type="number" step="0.01" id="price" name="price" placeholder="0.00"
                                    value="<?php echo set_value('price'); ?>" required
                                    class="shadow-xs outline-hidden block w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm transition-all focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                            </div>

                            <!-- Complete at Price. When I toggle checkbox the element is able to edit-->
                            <div>
                                <label for="complete_at_price" class="mb-1 block text-sm font-medium text-gray-700">Complete At Price ($)</label>
                                <input type="number" step="0.01" id="complete_at_price" name="complete_at_price" placeholder="0.00"
                                    value="<?php echo set_value('complete_at_price'); ?>"
                                    class="shadow-xs outline-hidden block w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm transition-all focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                            </div>
                            
                            <!-- SKU -->
                            <div>
                                <label for="sku" class="mb-1 block text-sm font-medium text-gray-700">SKU</label>
                                <input type="text" id="sku" name="sku" placeholder="Stock Keeping Unit"
                                    value="<?php echo set_value('sku'); ?>"
                                    class="shadow-xs outline-hidden block w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm transition-all focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                            </div>

                            <!-- Category -->
                            <div>
                                <label for="category_id" class="mb-1 block text-sm font-medium text-gray-700">Category</label>
                                <select id="category_id" name="category_id"
                                    class="shadow-xs outline-hidden block w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm transition-all focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                                    <option value="">Select a category</option>
                                    <?php foreach ($categories as $category) : ?>
                                        <option value="<?php echo $category['id']; ?>" <?php echo set_select('category_id', $category['id']); ?>>
                                            <?php echo html_escape($category['name']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <!-- stock quantity and status can be added here in the future -->
                            <div>
                                <label for="stock_quantity" class="mb-1 block text-sm font-medium text-gray-700">Stock Quantity</label>
                                <input type="number" id="stock_quantity" name="stock_quantity" placeholder="0"
                                    value="<?php echo set_value('stock_quantity'); ?>"
                                    class="shadow-xs outline-hidden block w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm transition-all focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Images -->
                <div class="space-y-6">
                    <div class="shadow-xs overflow-hidden rounded-xl border border-gray-200 bg-white">
                        <div class="border-b border-gray-200 bg-gray-50 px-6 py-4">
                            <h2 class="text-sm font-semibold uppercase tracking-wider text-gray-900">Product Images</h2>
                        </div>
                        <div class="p-6">
                            <label for="formFileMultiple" class="mb-3 block text-sm font-medium text-gray-700">Upload Product Image</label>
                            <input type="file" id="formFileMultiple" name="image_path"
                                class="block w-full cursor-pointer text-sm text-gray-500 transition-all file:mr-4 file:rounded-md file:border-0 file:bg-blue-50 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-blue-700 hover:file:bg-blue-100">
                            <p class="mt-2 text-xs text-gray-400">JPG, PNG or GIF. Max 2MB.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex items-center gap-4 border-t border-gray-100 pt-4">
                <button type="submit"
                    class="cursor-pointer rounded-md bg-blue-600 px-6 py-2.5 text-sm font-semibold text-white shadow-sm transition-all hover:bg-blue-700 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                    Save Product
                </button>
                <a href="<?php echo site_url('admin/products'); ?>"
                    class="rounded-md bg-white px-6 py-2.5 text-sm font-semibold text-gray-900 no-underline shadow-sm ring-1 ring-inset ring-gray-300 transition-all hover:bg-gray-50">
                    Cancel
                </a>
            </div>

            <?php echo form_close(); ?>
        </div>
    </div>
</div>