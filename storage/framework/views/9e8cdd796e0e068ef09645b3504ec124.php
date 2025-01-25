<?php
    $navigation = filament()->getNavigation();
?>

<?php if (isset($component)) { $__componentOriginale960ae7ad1b1ce9e3596e483505fadc9 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale960ae7ad1b1ce9e3596e483505fadc9 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-panels::components.layout.base','data' => ['livewire' => $livewire]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-panels::layout.base'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['livewire' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($livewire)]); ?>
    <div class="fi-layout flex min-h-screen w-full overflow-x-clip">
        <div
            x-cloak
            x-data="{}"
            x-on:click="$store.sidebar.close()"
            x-show="$store.sidebar.isOpen"
            x-transition.opacity.300ms
            class="fi-sidebar-close-overlay fixed inset-0 z-30 bg-gray-950/50 transition duration-500 dark:bg-gray-950/75 lg:hidden"
        ></div>

        <?php if (isset($component)) { $__componentOriginal507b9338c225a118b42b83ae4f73ad2b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal507b9338c225a118b42b83ae4f73ad2b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-panels::components.sidebar.index','data' => ['navigation' => $navigation]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-panels::sidebar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['navigation' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($navigation)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal507b9338c225a118b42b83ae4f73ad2b)): ?>
<?php $attributes = $__attributesOriginal507b9338c225a118b42b83ae4f73ad2b; ?>
<?php unset($__attributesOriginal507b9338c225a118b42b83ae4f73ad2b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal507b9338c225a118b42b83ae4f73ad2b)): ?>
<?php $component = $__componentOriginal507b9338c225a118b42b83ae4f73ad2b; ?>
<?php unset($__componentOriginal507b9338c225a118b42b83ae4f73ad2b); ?>
<?php endif; ?>

        <div
            <?php if(filament()->isSidebarCollapsibleOnDesktop()): ?>
                x-data="{}"
                x-bind:class="{
                    'lg:ps-[--collapsed-sidebar-width]': ! $store.sidebar.isOpen,
                    'fi-main-ctn-sidebar-open lg:ps-[--sidebar-width]': $store.sidebar.isOpen,
                }"
                x-bind:style="'display: flex'" 
            <?php elseif(filament()->isSidebarFullyCollapsibleOnDesktop()): ?>
                x-data="{}"
                x-bind:class="{
                    'fi-main-ctn-sidebar-open lg:ps-[--sidebar-width]': $store.sidebar.isOpen,
                }"
                x-bind:style="'display: flex'" 
            <?php endif; ?>
            class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                'fi-main-ctn w-screen flex-1 flex-col',
                'hidden h-full transition-all' => filament()->isSidebarCollapsibleOnDesktop() || filament()->isSidebarFullyCollapsibleOnDesktop(),
                'flex lg:ps-[--sidebar-width]' => ! (filament()->isSidebarCollapsibleOnDesktop() || filament()->isSidebarFullyCollapsibleOnDesktop() || filament()->hasTopNavigation()),
            ]); ?>"
        >
            <?php if (isset($component)) { $__componentOriginal3730a29838011bd2ea530ae9e3b87bdd = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3730a29838011bd2ea530ae9e3b87bdd = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-panels::components.topbar.index','data' => ['navigation' => $navigation]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-panels::topbar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['navigation' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($navigation)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3730a29838011bd2ea530ae9e3b87bdd)): ?>
<?php $attributes = $__attributesOriginal3730a29838011bd2ea530ae9e3b87bdd; ?>
<?php unset($__attributesOriginal3730a29838011bd2ea530ae9e3b87bdd); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3730a29838011bd2ea530ae9e3b87bdd)): ?>
<?php $component = $__componentOriginal3730a29838011bd2ea530ae9e3b87bdd; ?>
<?php unset($__componentOriginal3730a29838011bd2ea530ae9e3b87bdd); ?>
<?php endif; ?>

            <main
                class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                    'fi-main mx-auto w-full px-4 md:px-6 lg:px-8',
                    match ($maxContentWidth ?? filament()->getMaxContentWidth() ?? '7xl') {
                        'xl' => 'max-w-xl',
                        '2xl' => 'max-w-2xl',
                        '3xl' => 'max-w-3xl',
                        '4xl' => 'max-w-4xl',
                        '5xl' => 'max-w-5xl',
                        '6xl' => 'max-w-6xl',
                        '7xl' => 'max-w-7xl',
                        'full' => 'max-w-full',
                        default => $maxContentWidth,
                    },
                ]); ?>"
            >
                <?php echo e(\Filament\Support\Facades\FilamentView::renderHook('panels::content.start')); ?>


                <?php echo e($slot); ?>


                <?php echo e(\Filament\Support\Facades\FilamentView::renderHook('panels::content.end')); ?>

            </main>

            <?php echo e(\Filament\Support\Facades\FilamentView::renderHook('panels::footer')); ?>

        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale960ae7ad1b1ce9e3596e483505fadc9)): ?>
<?php $attributes = $__attributesOriginale960ae7ad1b1ce9e3596e483505fadc9; ?>
<?php unset($__attributesOriginale960ae7ad1b1ce9e3596e483505fadc9); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale960ae7ad1b1ce9e3596e483505fadc9)): ?>
<?php $component = $__componentOriginale960ae7ad1b1ce9e3596e483505fadc9; ?>
<?php unset($__componentOriginale960ae7ad1b1ce9e3596e483505fadc9); ?>
<?php endif; ?>
<?php /**PATH /home/naf/mbahhadi/ecom/vendor/filament/filament/src/../resources/views/components/layout/index.blade.php ENDPATH**/ ?>