
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Attendance Details')); ?>

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
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12 mt-t">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title"><?php echo e(__('Attendance Details')); ?></h4>
                        <ul>
                            <li><strong><?php echo e(__('Event')); ?>:</strong> <?php echo e(optional($attendance->event)->title); ?></li>
                            <li><strong><?php echo e(__('Ticket Cost')); ?>

                                    :</strong> <?php echo e(amount_with_currency_symbol($attendance->event_cost)); ?></li>
                            <li><strong><?php echo e(__('Ticket Quantity')); ?>:</strong> <?php echo e($attendance->quantity); ?></li>
                            <li><strong><?php echo e(__('Status')); ?>:</strong> <?php echo e($attendance->status); ?></li>
                            <li><strong><?php echo e(__('Payment Status')); ?>:</strong> <?php echo e($attendance->status); ?></li>
                            <?php
                            $custom_fields = unserialize($attendance->custom_fields,['class' => false]);
                            $attachment = unserialize($attendance->attachment,['class' => false]);
                            unset($custom_fields['event_id'],$custom_fields['quantity'],$custom_fields['selected_payment_gateway']);
                            ?>
                            <?php if(!empty($custom_fields)): ?>
                            <li><strong><?php echo e(__('Custom Fields')); ?>:</strong>
                              <ul class="ml-2">
                                  <?php $__currentLoopData = $custom_fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <li><storng><?php echo e(str_replace(['-','_'],[' ',' '],$field)); ?>:</storng> <?php echo e($value); ?></li>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </ul>
                            </li>
                            <?php endif; ?>
                            <?php if(!empty($attachment)): ?>
                            <li><strong><?php echo e(__('Attachments')); ?>:</strong>
                                <ul class="ml-2">
                                    <?php $__currentLoopData = $attachment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><storng><?php echo e(str_replace(['-','_'],[' ',' '],$field)); ?>:</storng> <?php echo e($value); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/fundorex.xgenious.com/@core/resources/views/backend/events/attendance-view.blade.php ENDPATH**/ ?>