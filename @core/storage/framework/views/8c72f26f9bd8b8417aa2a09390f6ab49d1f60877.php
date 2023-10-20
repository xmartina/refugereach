
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Flag Report View')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.media.css','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('media.css'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 margin-top-40">
        <div class="row">
            <div class="col-lg-12 mt-t">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="left">
                                <h4 class="header-title"><?php echo e(__('Flag Report View')); ?></h4>
                            </div>
                            <div class="right">
                                <a href="<?php echo e(route('admin.donations.flag.reports')); ?>" class="btn btn-primary btn-sm"><?php echo e(__('All Flag Report')); ?></a>
                            </div>
                        </div>
                        <ul>
                            <li><strong><?php echo e(__('Cause Name ')); ?>:</strong> <?php echo e($flag_report->cause->name ?? ''); ?></li>
                            <li><strong><?php echo e(__('Name')); ?>:</strong> <?php echo e($flag_report->name); ?></li>
                            <li><strong><?php echo e(__('Email')); ?>:</strong> <?php echo e($flag_report->email); ?></li>
                            <li><strong><?php echo e(__('Subject')); ?>:</strong> <?php echo e($flag_report->subject); ?></li>
                            <li><strong><?php echo e(__('Description')); ?> :</strong> <?php echo e($flag_report->description); ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/fundorex.xgenious.com/@core/resources/views/backend/donations/flag-report/view.blade.php ENDPATH**/ ?>