<?php
    use Filament\Support\Enums\IconSize;
?>

<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'aside' => false,
    'collapsed' => false,
    'collapsible' => false,
    'compact' => false,
    'contentBefore' => false,
    'description' => null,
    'headerEnd' => null,
    'heading' => null,
    'icon' => null,
    'iconColor' => 'gray',
    'iconSize' => IconSize::Large,
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'aside' => false,
    'collapsed' => false,
    'collapsible' => false,
    'compact' => false,
    'contentBefore' => false,
    'description' => null,
    'headerEnd' => null,
    'heading' => null,
    'icon' => null,
    'iconColor' => 'gray',
    'iconSize' => IconSize::Large,
]); ?>
<?php foreach (array_filter(([
    'aside' => false,
    'collapsed' => false,
    'collapsible' => false,
    'compact' => false,
    'contentBefore' => false,
    'description' => null,
    'headerEnd' => null,
    'heading' => null,
    'icon' => null,
    'iconColor' => 'gray',
    'iconSize' => IconSize::Large,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php
    $hasDescription = filled((string) $description);
    $hasHeading = filled($heading);
    $hasIcon = filled($icon);
    $hasHeader = $hasIcon || $hasHeading || $hasDescription || $collapsible || filled((string) $headerEnd);
?>

<section
    <?php if($collapsible): ?>
        x-data="{
            isCollapsed: <?php echo \Illuminate\Support\Js::from($collapsed)->toHtml() ?>,
        }"
        x-on:collapse-section.window="if ($event.detail.id == $el.id) isCollapsed = true"
        x-on:expand-concealing-component.window="
            error = $el.querySelector('[data-validation-error]')

            if (! error) {
                return
            }

            isCollapsed = false

            if (document.body.querySelector('[data-validation-error]') !== error) {
                return
            }

            setTimeout(
                () =>
                    $el.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start',
                        inline: 'start',
                    }),
                200,
            )
        "
        x-on:open-section.window="if ($event.detail.id == $el.id) isCollapsed = false"
        x-on:toggle-section.window="if ($event.detail.id == $el.id) isCollapsed = ! isCollapsed"
    <?php endif; ?>
    <?php echo e($attributes->class([
            'fi-section',
            match ($aside) {
                true => 'grid grid-cols-1 items-start gap-x-6 gap-y-4 md:grid-cols-3',
                false => 'rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10',
            },
        ])); ?>

>
    <?php if($hasHeader): ?>
        <header
            <?php if($collapsible): ?>
                x-on:click="isCollapsed = ! isCollapsed"
            <?php endif; ?>
            class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                'flex items-center gap-x-3 overflow-hidden',
                'cursor-pointer' => $collapsible,
                match ($compact) {
                    true => 'px-4 py-2.5',
                    false => 'px-6 py-4',
                } => ! $aside,
            ]); ?>"
        >
            <?php if($hasIcon): ?>
                <?php if (isset($component)) { $__componentOriginalbfc641e0710ce04e5fe02876ffc6f950 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbfc641e0710ce04e5fe02876ffc6f950 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.icon','data' => ['icon' => $icon,'class' => \Illuminate\Support\Arr::toCssClasses([
                        'fi-section-header-icon',
                        match ($iconColor) {
                            'gray' => 'text-gray-400 dark:text-gray-500',
                            default => 'text-custom-500 dark:text-custom-400',
                        },
                        match ($iconSize) {
                            IconSize::Small, 'sm' => 'h-4 w-4 mt-1',
                            IconSize::Medium, 'md' => 'h-5 w-5 mt-0.5',
                            IconSize::Large, 'lg' => 'h-6 w-6',
                            default => $iconSize,
                        },
                    ]),'style' => \Illuminate\Support\Arr::toCssStyles([
                        \Filament\Support\get_color_css_variables($iconColor, shades: [400, 500]) => $iconColor !== 'gray',
                    ])]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($icon),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\Illuminate\Support\Arr::toCssClasses([
                        'fi-section-header-icon',
                        match ($iconColor) {
                            'gray' => 'text-gray-400 dark:text-gray-500',
                            default => 'text-custom-500 dark:text-custom-400',
                        },
                        match ($iconSize) {
                            IconSize::Small, 'sm' => 'h-4 w-4 mt-1',
                            IconSize::Medium, 'md' => 'h-5 w-5 mt-0.5',
                            IconSize::Large, 'lg' => 'h-6 w-6',
                            default => $iconSize,
                        },
                    ])),'style' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\Illuminate\Support\Arr::toCssStyles([
                        \Filament\Support\get_color_css_variables($iconColor, shades: [400, 500]) => $iconColor !== 'gray',
                    ]))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalbfc641e0710ce04e5fe02876ffc6f950)): ?>
<?php $attributes = $__attributesOriginalbfc641e0710ce04e5fe02876ffc6f950; ?>
<?php unset($__attributesOriginalbfc641e0710ce04e5fe02876ffc6f950); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalbfc641e0710ce04e5fe02876ffc6f950)): ?>
<?php $component = $__componentOriginalbfc641e0710ce04e5fe02876ffc6f950; ?>
<?php unset($__componentOriginalbfc641e0710ce04e5fe02876ffc6f950); ?>
<?php endif; ?>
            <?php endif; ?>

            <?php if($hasHeading || $hasDescription): ?>
                <div class="grid flex-1 gap-y-1">
                    <?php if($hasHeading): ?>
                        <?php if (isset($component)) { $__componentOriginalf35f9d5c1b29d7f1be16c01d4cf43815 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf35f9d5c1b29d7f1be16c01d4cf43815 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.section.heading','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::section.heading'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                            <?php echo e($heading); ?>

                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf35f9d5c1b29d7f1be16c01d4cf43815)): ?>
<?php $attributes = $__attributesOriginalf35f9d5c1b29d7f1be16c01d4cf43815; ?>
<?php unset($__attributesOriginalf35f9d5c1b29d7f1be16c01d4cf43815); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf35f9d5c1b29d7f1be16c01d4cf43815)): ?>
<?php $component = $__componentOriginalf35f9d5c1b29d7f1be16c01d4cf43815; ?>
<?php unset($__componentOriginalf35f9d5c1b29d7f1be16c01d4cf43815); ?>
<?php endif; ?>
                    <?php endif; ?>

                    <?php if($hasDescription): ?>
                        <?php if (isset($component)) { $__componentOriginal0998190339a840b029249e9ecb6b0282 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0998190339a840b029249e9ecb6b0282 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.section.description','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::section.description'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                            <?php echo e($description); ?>

                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0998190339a840b029249e9ecb6b0282)): ?>
<?php $attributes = $__attributesOriginal0998190339a840b029249e9ecb6b0282; ?>
<?php unset($__attributesOriginal0998190339a840b029249e9ecb6b0282); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0998190339a840b029249e9ecb6b0282)): ?>
<?php $component = $__componentOriginal0998190339a840b029249e9ecb6b0282; ?>
<?php unset($__componentOriginal0998190339a840b029249e9ecb6b0282); ?>
<?php endif; ?>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <?php echo e($headerEnd); ?>


            <?php if($collapsible): ?>
                <?php if (isset($component)) { $__componentOriginalf0029cce6d19fd6d472097ff06a800a1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf0029cce6d19fd6d472097ff06a800a1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.icon-button','data' => ['color' => 'gray','icon' => 'heroicon-m-chevron-down','iconAlias' => 'section.collapse-button','xOn:click.stop' => 'isCollapsed = ! isCollapsed','xBind:class' => '{ \'rotate-180\': ! isCollapsed }','class' => '-m-2']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::icon-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['color' => 'gray','icon' => 'heroicon-m-chevron-down','icon-alias' => 'section.collapse-button','x-on:click.stop' => 'isCollapsed = ! isCollapsed','x-bind:class' => '{ \'rotate-180\': ! isCollapsed }','class' => '-m-2']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf0029cce6d19fd6d472097ff06a800a1)): ?>
<?php $attributes = $__attributesOriginalf0029cce6d19fd6d472097ff06a800a1; ?>
<?php unset($__attributesOriginalf0029cce6d19fd6d472097ff06a800a1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf0029cce6d19fd6d472097ff06a800a1)): ?>
<?php $component = $__componentOriginalf0029cce6d19fd6d472097ff06a800a1; ?>
<?php unset($__componentOriginalf0029cce6d19fd6d472097ff06a800a1); ?>
<?php endif; ?>
            <?php endif; ?>
        </header>
    <?php endif; ?>

    <div
        <?php if($collapsible): ?>
            x-bind:aria-expanded="(! isCollapsed).toString()"
            <?php if($collapsed): ?>
                x-cloak
            <?php endif; ?>
            x-bind:class="{ 'invisible h-0 border-none': isCollapsed }"
        <?php endif; ?>
        class="<?php echo \Illuminate\Support\Arr::toCssClasses([
            'fi-section-content-ctn',
            'md:col-span-2' => $aside,
            'border-t border-gray-200 dark:border-white/10' => $hasHeader && (! $aside),
            'md:order-first' => $contentBefore,
        ]); ?>"
    >
        <div
            class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                'fi-section-content',
                'rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10' => $aside,
                match ($compact) {
                    true => 'p-4',
                    false => 'p-6',
                },
            ]); ?>"
        >
            <?php echo e($slot); ?>

        </div>
    </div>
</section>
<?php /**PATH /home/naf/mbahhadi/ecom/vendor/filament/support/src/../resources/views/components/section.blade.php ENDPATH**/ ?>