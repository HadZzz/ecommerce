<?php $__env->startSection('content'); ?>
    <!-- Cart Header -->
    <div class="bg-gradient-to-r from-red-500 to-red-600 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl font-extrabold text-white sm:text-5xl">
                    Your Shopping Cart
                </h1>
                <p class="mt-3 text-xl text-red-100">
                    Review your items and proceed to checkout
                </p>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <?php if(!empty($cartItems)): ?>
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Cart Items -->
                <div class="w-full lg:w-2/3">
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                        <ul role="list" class="divide-y divide-gray-200">
                            <?php $__currentLoopData = $cartItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="p-6 hover:bg-gray-50 transition-colors duration-150">
                                    <div class="flex items-center space-x-6">
                                        <!-- Product Image -->
                                        <div class="flex-shrink-0 w-32 h-32 rounded-lg overflow-hidden">
                                            <?php if($item['image']): ?>
                                                <img src="<?php echo e($item['image']); ?>"
                                                     alt="<?php echo e($item['name']); ?>"
                                                     class="w-full h-full object-center object-cover">
                                            <?php else: ?>
                                                <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                                    <i class="fas fa-image text-gray-400 text-4xl"></i>
                                                </div>
                                            <?php endif; ?>
                                        </div>

                                        <!-- Product Info -->
                                        <div class="flex-1">
                                            <div class="flex items-start justify-between">
                                                <div>
                                                    <h3 class="text-lg font-medium text-gray-900">
                                                        <?php echo e($item['name']); ?>

                                                    </h3>
                                                    <p class="mt-1 text-sm text-gray-500">
                                                        Rp <?php echo e(number_format($item['price'], 0, ',', '.')); ?>

                                                    </p>
                                                </div>
                                                <div class="ml-4">
                                                    <form action="<?php echo e(route('cart.remove', ['cartItem' => $id])); ?>" method="POST">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('DELETE'); ?>
                                                        <button type="submit" class="text-red-600 hover:text-red-800">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>

                                            <!-- Quantity -->
                                            <div class="mt-4">
                                                <form action="<?php echo e(route('cart.update', ['cartItem' => $id])); ?>" method="POST" 
                                                      class="flex items-center space-x-3">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('PATCH'); ?>
                                                    <label for="quantity" class="text-sm font-medium text-gray-700">
                                                        Quantity
                                                    </label>
                                                    <input type="number" 
                                                           name="quantity" 
                                                           value="<?php echo e($item['quantity']); ?>"
                                                           min="1"
                                                           class="w-20 rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
                                                    <button type="submit"
                                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                                        Update
                                                    </button>
                                                </form>
                                            </div>

                                            <!-- Subtotal -->
                                            <div class="mt-4">
                                                <p class="text-sm text-gray-500">
                                                    Subtotal: Rp <?php echo e(number_format($item['price'] * $item['quantity'], 0, ',', '.')); ?>

                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="w-full lg:w-1/3">
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <h2 class="text-lg font-medium text-gray-900 mb-4">Order Summary</h2>
                        <div class="flow-root">
                            <dl class="-my-4 text-sm divide-y divide-gray-200">
                                <div class="py-4 flex items-center justify-between">
                                    <dt class="text-gray-600">Subtotal</dt>
                                    <dd class="font-medium text-gray-900">
                                        Rp <?php echo e(number_format($total, 0, ',', '.')); ?>

                                    </dd>
                                </div>
                                <div class="py-4 flex items-center justify-between">
                                    <dt class="text-base font-medium text-gray-900">Total</dt>
                                    <dd class="text-base font-medium text-gray-900">
                                        Rp <?php echo e(number_format($total, 0, ',', '.')); ?>

                                    </dd>
                                </div>
                            </dl>
                        </div>
                        <div class="mt-6">
                            <a href="<?php echo e(route('checkout.index')); ?>"
                               class="w-full flex justify-center items-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-red-600 hover:bg-red-700">
                                Proceed to Checkout
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="text-center py-12">
                <div class="mb-4">
                    <i class="fas fa-shopping-cart text-6xl text-gray-300"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Your cart is empty</h3>
                <p class="text-gray-500 mb-4">Browse our products and start shopping</p>
                <a href="<?php echo e(route('products.index')); ?>" 
                   class="inline-flex items-center px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 transition-colors">
                    <i class="fas fa-shopping-bag mr-2"></i>
                    Browse Products
                </a>
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/naf/mbahhadi/ecom/resources/views/shop/cart.blade.php ENDPATH**/ ?>