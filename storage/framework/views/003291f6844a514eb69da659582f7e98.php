<?php $__env->startSection('content'); ?>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h2 class="text-2xl font-semibold mb-6">My Orders</h2>

                <?php if($orders->isEmpty()): ?>
                    <div class="text-center py-8">
                        <i class="fas fa-shopping-bag text-gray-400 text-5xl mb-4"></i>
                        <p class="text-gray-500">You haven't placed any orders yet.</p>
                        <a href="<?php echo e(route('products.index')); ?>" class="mt-4 inline-block bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700">
                            Start Shopping
                        </a>
                    </div>
                <?php else: ?>
                    <div class="space-y-6">
                        <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="border rounded-lg overflow-hidden">
                                <div class="bg-gray-50 px-4 py-3 border-b flex justify-between items-center">
                                    <div>
                                        <span class="text-sm text-gray-600">Order #<?php echo e($order->order_number); ?></span>
                                        <p class="text-sm text-gray-500"><?php echo e($order->created_at->format('M d, Y')); ?></p>
                                    </div>
                                    <div class="text-right">
                                        <span class="text-lg font-semibold text-gray-900">
                                            Rp <?php echo e(number_format($order->total_amount, 0, ',', '.')); ?>

                                        </span>
                                        <p class="text-sm px-3 py-1 rounded-full 
                                            <?php if($order->status === 'pending'): ?> bg-yellow-100 text-yellow-800
                                            <?php elseif($order->status === 'processing'): ?> bg-blue-100 text-blue-800
                                            <?php elseif($order->status === 'completed'): ?> bg-green-100 text-green-800
                                            <?php elseif($order->status === 'cancelled'): ?> bg-red-100 text-red-800
                                            <?php endif; ?>">
                                            <?php echo e(ucfirst($order->status)); ?>

                                        </p>
                                    </div>
                                </div>
                                <div class="p-4">
                                    <div class="space-y-4">
                                        <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="flex items-center space-x-4">
                                                <div class="flex-shrink-0 w-16 h-16">
                                                    <?php if($item->product && $item->product->getFirstMediaUrl('images')): ?>
                                                        <img src="<?php echo e($item->product->getFirstMediaUrl('images')); ?>" 
                                                             alt="<?php echo e($item->product_name); ?>"
                                                             class="w-full h-full object-cover rounded">
                                                    <?php else: ?>
                                                        <div class="w-full h-full bg-gray-200 rounded flex items-center justify-center">
                                                            <i class="fas fa-image text-gray-400"></i>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="flex-1">
                                                    <h3 class="text-sm font-medium text-gray-900">
                                                        <?php echo e($item->product_name); ?>

                                                    </h3>
                                                    <p class="text-sm text-gray-500">
                                                        Quantity: <?php echo e($item->quantity); ?> × 
                                                        Rp <?php echo e(number_format($item->price, 0, ',', '.')); ?>

                                                    </p>
                                                </div>
                                                <div class="text-right">
                                                    <p class="text-sm font-medium text-gray-900">
                                                        Rp <?php echo e(number_format($item->quantity * $item->price, 0, ',', '.')); ?>

                                                    </p>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                                <div class="bg-gray-50 px-4 py-3 border-t">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <p class="text-sm text-gray-600">
                                                Shipping Address:
                                            </p>
                                            <p class="text-sm text-gray-900">
                                                <?php echo e($order->shipping_address); ?>

                                            </p>
                                        </div>
                                        <a href="<?php echo e(route('orders.show', $order)); ?>" 
                                           class="text-red-600 hover:text-red-700 text-sm font-medium">
                                            View Details
                                            <i class="fas fa-chevron-right ml-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-6">
                        <?php echo e($orders->links()); ?>

                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/naf/mbahhadi/ecom/resources/views/shop/orders/index.blade.php ENDPATH**/ ?>