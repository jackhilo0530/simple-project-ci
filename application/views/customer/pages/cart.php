<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="min-h-screen w-full bg-white pb-24">
    <div class="mx-auto max-w-7xl px-4 pt-16 sm:px-6 lg:px-8">
        <div class="flex items-baseline justify-between border-b border-gray-200 pb-6">
            <h1 class="text-4xl font-bold tracking-tight text-gray-900">Your Shopping Cart</h1>
            <p class="text-sm text-gray-500"><?php echo count($cart); ?> items</p>
        </div>

        <div class="mt-12 lg:grid lg:grid-cols-12 lg:items-start lg:gap-x-12">
            <!-- Product List -->
            <section class="lg:col-span-7">
                <ul role="list" class="divide-y divide-gray-200 border-b border-t border-gray-200">
                    <?php if (!empty($cart)): foreach ($cart as $item): ?>
                            <li class="flex py-6 sm:py-10">
                                <div class="shrink-0">
                                    <img src="<?php echo base_url('uploads/' . ($item->image_path ?: 'default.jpg')); ?>" alt="Product" class="h-24 w-24 rounded-lg object-cover shadow-sm sm:h-32 sm:w-32">
                                </div>

                                <div class="ml-4 flex flex-1 flex-col justify-between sm:ml-6">
                                    <div class="relative pr-9 sm:grid sm:grid-cols-2 sm:gap-x-6 sm:pr-0">
                                        <div>
                                            <h3 class="text-lg font-semibold text-gray-800 transition hover:text-indigo-600">
                                                <?php echo $item->product_name; ?>
                                            </h3>
                                            <p class="mt-2 text-base font-bold text-green-600">$<?php echo number_format($item->product_price, 2); ?></p>
                                        </div>

                                        <div class="mt-4 sm:mt-0 sm:pe-9">
                                            <div class="flex flex-wrap items-center gap-4">
                                                <!-- Quantity Wrapper -->
                                                <div class="relative flex items-center">
                                                    <label for="quantity-<?php echo $item->id; ?>" class="sr-only">Quantity</label>

                                                    <select
                                                        id="quantity-<?php echo $item->id; ?>"
                                                        onchange="location.href='<?php echo site_url('customer/cart/update_quantity/' . $item->id); ?>?quantity=' + this.value"
                                                        class="...">

                                                        <?php for ($i = 1; $i <= 10; $i++): ?>
                                                            <option value="<?php echo $i; ?>" <?php echo ((int)$i === (int)$item->quantity) ? 'selected' : ''; ?>>
                                                                <?php echo $i; ?>
                                                            </option>
                                                        <?php endfor; ?>
                                                    </select>
                                                </div>

                                                <!-- Remove Button -->
                                                <a href="<?php echo site_url('customer/cart/remove/' . $item->id); ?>"
                                                    onclick="return confirm('Are you sure?');"
                                                    class="group flex items-center gap-2 rounded-xl bg-rose-50 px-4 py-2 text-sm font-bold text-rose-600 transition-all duration-300 hover:bg-rose-600 hover:text-white hover:shadow-lg hover:shadow-rose-200 active:scale-95">
                                                    <svg xmlns="http://www.w3.org" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                        class="size-4 transition-transform duration-300 group-hover:-rotate-12 group-hover:scale-110">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                    </svg>
                                                    <span>Remove</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach;
                    else: ?>
                        <p class="py-10 text-center text-gray-500">Your cart is currently empty.</p>
                    <?php endif; ?>
                </ul>
            </section>

            <!-- Order Summary Sidebar -->
            <section class="sticky top-10 mt-16 rounded-2xl bg-white px-6 py-8 shadow-xl shadow-gray-200/50 lg:col-span-5 lg:mt-0 lg:p-10">
                <h2 class="text-xl font-bold text-gray-900">Order Summary</h2>

                <dl class="mt-8 space-y-4">
                    <div class="flex items-center justify-between">
                        <dt class="text-sm text-gray-600">Subtotal</dt>
                        <dd class="text-sm font-semibold text-gray-900">$<?php echo number_format($subtotal, 2); ?></dd>
                    </div>
                    <div class="flex items-center justify-between border-t border-gray-100 pt-4">
                        <dt class="text-sm text-gray-600">Shipping estimate</dt>
                        <dd class="text-sm font-semibold text-gray-900"><?php if ($subtotal > 100) { echo '<span class="text-green-600">Free</span>'; } elseif ($subtotal > 0) { echo '<span class="text-red-600">$5.00</span>'; } else { echo '$0.00'; } ?></dd>
                    </div>
                    <div class="flex items-center justify-between border-t border-gray-200 pt-4">
                        <dt class="text-lg font-bold text-gray-900">Order total</dt>
                        <dd class="text-lg font-bold text-indigo-600">$<?php echo number_format($subtotal + ( $subtotal > 100 || $subtotal == 0 ? 0 : 5 ), 2); ?></dd>
                    </div>
                </dl>

                <div class="mt-10">
                    <a href="<?php echo base_url('customer/orders/insert_order'); ?>">
                        <button type="button" class="w-full rounded-xl bg-indigo-600 px-4 py-4 text-center text-lg font-bold text-white shadow-lg shadow-indigo-200 transition-all duration-200 hover:scale-[1.02] hover:bg-indigo-700 active:scale-95">
                            Proceed to Checkout
                        </button>
                    </a>
                </div>

                <div class="mt-6 flex justify-center text-sm">
                    <p class="text-gray-500">
                        or <a href="<?php echo base_url('customer/products'); ?>" class="font-bold text-indigo-600 hover:text-indigo-500">Continue Shopping &rarr;</a>
                    </p>
                </div>
            </section>
        </div>
    </div>
</div>

<!-- <script>
    function updateQuantity(id, qty) {
        const formData = new FormData();
        formData.append('quantity', qty);

        // CI3 CSRF Security (Required if CSRF is enabled in config)
        formData.append('<?php echo $this->security->get_csrf_token_name(); ?>', '<?php echo $this->security->get_csrf_hash(); ?>');

        fetch('<?php echo base_url('customer/cart/update/'); ?>' + id, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                if (response.ok) {
                    window.location.reload(); // Refresh to update totals/prices
                } else {
                    alert('Failed to update cart. Please refresh and try again.');
                }
            })
            .catch(error => console.error('Error:', error));
    }
</script> -->