<?php
defined("BASEPATH") OR exit("No direct script access allowed");
?>

<div class="container mt-5 mx-2">
    <h1 class="mb-4 offset-1">Add New Product</h1>
    <?php echo form_open_multipart('products/add_product'); ?>
    <div class="row mx-3 justify-content-center">
        <!-- Left Column for Product Details -->
        <div class="col-6">
            <div class="card mb-4">
                <div class="card-header">Product Details</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="productName" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="productName" name="name"
                            placeholder="Enter product name" value="<?php echo set_value('name'); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="productDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="productDescription" name="description" rows="3"
                            placeholder="Enter product description"><?php echo set_value('description'); ?></textarea>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="productPrice" class="form-label">Price ($)</label>
                            <input type="number" class="form-control" id="productPrice" name="price" placeholder="0.00"
                                value="<?php echo set_value('price'); ?>" required>
                        </div>
                        <div class="col-4">
                            <label for="productSKU" class="form-label">SKU</label>
                            <input type="text" class="form-control" id="productSKU" name="sku" placeholder="Enter SKU"
                                value="<?php echo set_value('sku'); ?>" required>
                        </div>
                        <div class="col-4">
                            <label for="productCategory" class="form-label">Category</label>
                            <select class="form-select" id="productCategory" name="category" required>
                                <option value="">Choose...</option>
                                <option value="laptop" <?php echo set_select('category', 'laptop'); ?>>Electronics
                                </option>
                                <option value="clothing" <?php echo set_select('category', 'clothing'); ?>>Clothing
                                </option>
                                <option value="home_goods" <?php echo set_select('category', 'home_goods'); ?>>Home
                                    Goods</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column for Image Upload/Status -->
        <div class="col-4">
            <div class="card mb-4">
                <div class="card-header">Product Images</div>
                <div class="card-body">
                    <input class="form-control" type="file" id="formFileMultiple" name="image_path">
                    <label for="formFileMultiple" class="form-label mt-2">Upload image</label>
                </div>
            </div>
        </div>
    </div>

    <!-- Submit Button -->
    <div class="offset-2">
        <button type="submit" class="btn btn-primary me-3">Save Product</button>
        <a href="<?php echo site_url('products'); ?>"><button type="button"
                class="btn btn-secondary">Cancel</button></a>
    </div>
    <?php echo form_close(); ?>
</div>