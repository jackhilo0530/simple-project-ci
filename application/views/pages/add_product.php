<?php
defined("BASEPATH") or exit("No direct script access allowed");
?>

<div class="flex-1 p-6 lg:p-10">
    <div class="max-w-6xl mx-auto">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900 mb-8">Add New Product</h1>

        <?php echo form_open_multipart('products/add_product', array('class' => 'space-y-8')); ?>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- Left Column: Product Details (Spans 2 columns) -->
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-xl border border-gray-200 shadow-xs overflow-hidden">
                    <div class="bg-gray-50 border-b border-gray-200 px-6 py-4">
                        <h2 class="text-sm font-semibold text-gray-900 uppercase tracking-wider">Product Details</h2>
                    </div>
                    <div class="p-6 space-y-5">
                        <!-- Product Name -->
                        <div>
                            <label for="productName" class="block text-sm font-medium text-gray-700 mb-1">Product Name</label>
                            <input type="text" id="productName" name="name" placeholder="Enter product name"
                                value="<?php echo set_value('name'); ?>" required
                                class="block w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm shadow-xs focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-hidden transition-all">
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="productDescription" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                            <textarea id="productDescription" name="description" rows="4" placeholder="Enter product description"
                                class="block w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm shadow-xs focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-hidden transition-all"><?php echo set_value('description'); ?></textarea>
                        </div>

                        <!-- Price, SKU, Category Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label for="productPrice" class="block text-sm font-medium text-gray-700 mb-1">Price ($)</label>
                                <input type="number" id="productPrice" name="price" placeholder="0.00" step="0.01"
                                    value="<?php echo set_value('price'); ?>" required
                                    class="block w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm shadow-xs focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-hidden">
                            </div>
                            <div>
                                <label for="productSKU" class="block text-sm font-medium text-gray-700 mb-1">SKU</label>
                                <input type="text" id="productSKU" name="sku" placeholder="Enter SKU"
                                    value="<?php echo set_value('sku'); ?>" required
                                    class="block w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm shadow-xs focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-hidden">
                            </div>
                            <div>
                                <label for="productCategory" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                                <select id="productCategory" name="category" required
                                    class="block w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm shadow-xs focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-hidden">
                                    <option value="">Choose...</option>
                                    <option value="laptop" <?php echo set_select('category', 'laptop'); ?>>Electronics</option>
                                    <option value="clothing" <?php echo set_select('category', 'clothing'); ?>>Clothing</option>
                                    <option value="home_goods" <?php echo set_select('category', 'home_goods'); ?>>Home Goods</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Images -->
            <div class="space-y-6">
                <div class="bg-white rounded-xl border border-gray-200 shadow-xs overflow-hidden">
                    <div class="bg-gray-50 border-b border-gray-200 px-6 py-4">
                        <h2 class="text-sm font-semibold text-gray-900 uppercase tracking-wider">Product Images</h2>
                    </div>
                    <div class="p-6">
                        <label for="formFileMultiple" class="block text-sm font-medium text-gray-700 mb-3">Upload Product Image</label>
                        <input type="file" id="formFileMultiple" name="image_path"
                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-all cursor-pointer">
                        <p class="mt-2 text-xs text-gray-400">JPG, PNG or GIF. Max 2MB.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="flex items-center gap-4 pt-4 border-t border-gray-100">
            <button type="submit"
                class="rounded-md bg-blue-600 px-6 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-700 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600 transition-all cursor-pointer">
                Save Product
            </button>
            <a href="<?php echo site_url('products'); ?>"
                class="no-underline rounded-md bg-white px-6 py-2.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 transition-all">
                Cancel
            </a>
        </div>

        <?php echo form_close(); ?>
    </div>
</div>