<?php
defined("BASEPATH") OR exit("No direct script access allowed");
?>

<div class="col pe-5">
    <div class="d-flex justify-content-between mb-3">
        <h1>Products</h1>
        <div class="hstack p-3">
            <form role="search" class="hstack">
                <input class="form-control me-2" id="search" type="search" placeholder="Search" aria-label="Search" />
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
            <div class="ms-3">
                <select class="form-select" id="category" aria-label="Default select example">
                    <option value="">Choose...</option>
                    <option value="laptop">Electronics</option>
                    <option value="clothing">Clothing</option>
                    <option value="home_goods">Home Goods</option>
                </select>
            </div>
        </div>
    </div>
    <div class="d-flex mb-3">
        <table class="table table-hover align-middle">
            <!-- align-middle keeps text centered vertically with the image -->
            <thead>
                <tr class="fs-5">
                    <th scope="col" style="width: 25%;">Name</th>
                    <th scope="col" style="width: 30%;">Description</th>
                    <th scope="col" style="width: 15%;">SKU</th>
                    <th scope="col" style="width: 10%;">Price</th>
                    <th scope="col" style="width: 10%;">Category</th>
                    <th scope="col" style="width: 10%; text-align: center;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <!-- Product & Image Column -->
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="<?php echo base_url('uploads/' . ($product['image_path'] ?: 'default.jpg')); ?>"
                                    alt="product" class="img-thumbnail me-3"
                                    style="width: 70px; height: 70px; object-fit: cover;">
                                <span class="fw-bold text-light"><?php echo $product['name']; ?></span>
                            </div>
                        </td>

                        <!-- Description -->
                        <td class="text-muted small">
                            <?php echo (strlen($product['description']) > 60) ? substr($product['description'], 0, 60) . '...' : $product['description']; ?>
                        </td>

                        <!-- SKU -->
                        <td><code><?php echo $product['sku']; ?></code></td>

                        <!-- Price -->
                        <td class="fw-bold">$<?php echo number_format($product['price'], 2); ?></td>

                        <!-- Category -->
                        <td>
                            <span class="badge bg-info text-dark"><?php echo ucfirst($product['category']); ?></span>
                        </td>

                        <!-- Actions -->
                        <td>
                            <div class="d-flex flex-column gap-2">
                                <a href="<?php echo site_url('products/edit_product/' . $product['id']); ?>"
                                    class="btn btn-sm btn-outline-warning">Edit</a>
                                <a href="<?php echo site_url('products/delete/' . $product['id']); ?>"
                                    class="btn btn-sm btn-outline-danger"
                                    onclick="return confirm('Delete this product?')">Delete</a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="d-flex mb-3">
        <a href="<?php echo site_url('products/add_product'); ?>"><button class="btn btn-outline-primary">Add
                Product</button></a>
    </div>
</div>