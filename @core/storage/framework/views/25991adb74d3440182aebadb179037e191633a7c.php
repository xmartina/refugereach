<?php $__env->startSection('site-title'); ?>
    <?php echo e($user_info->name); ?> :<?php echo e(get_static_option('donation_page_name')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e($user_info->name); ?> :<?php echo e(get_static_option('donation_page_name')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="donation-content-area padding-top-120 padding-bottom-90">
        <div class="container">
            <div class="row">
                <?php $__currentLoopData = $user_donations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg-4">
                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.frontend.donation.user-donation','data' => ['featured' => $data->featured,'image' => $data->image,'amount' => $data->amount,'raised' => $data->raised,'slug' => $data->slug,'id' => $data->id,'title' => $data->title,'excerpt' => $data->excerpt,'buttontext' => get_static_option('donation_button_text')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('frontend.donation.user-donation'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['featured' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($data->featured),'image' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($data->image),'amount' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($data->amount),'raised' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($data->raised),'slug' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($data->slug),'id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($data->id),'title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($data->title),'excerpt' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($data->excerpt),'buttontext' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(get_static_option('donation_button_text'))]); ?>
                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-12 text-center">
                   <div class="blog-pagination ">
                       <?php echo e($user_donations->links()); ?>

                   </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/fundorex.xgenious.com/@core/resources/views/frontend/donations/user-donations.blade.php ENDPATH**/ ?>