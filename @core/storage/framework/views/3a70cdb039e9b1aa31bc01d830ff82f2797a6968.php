<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('GDPR Compliant Cookie Settings')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                <?php echo $__env->make('backend.partials.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title"><?php echo e(__("GDPR Compliant Cookie Settings")); ?></h4>
                        <form action="<?php echo e(route('admin.general.gdpr.settings')); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>

                                        <div class="form-group">
                                            <label for="site_gdpr_cookie_title"><?php echo e(__('GDPR Title')); ?></label>
                                            <input type="text" name="site_gdpr_cookie_title"  class="form-control" value="<?php echo e(get_static_option('site_gdpr_cookie_title')); ?>" id="site_gdpr_cookie_title">
                                        </div>
                                        <div class="form-group">
                                            <label for="site_gdpr_cookie_message"><?php echo e(__('GDPR Message')); ?></label>
                                            <textarea name="site_gdpr_cookie_message"  class="form-control" rows="5" id="site_gdpr_cookie_message"><?php echo e(get_static_option('site_gdpr_cookie_message')); ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="site_gdpr_cookie_more_info_label"><?php echo e(__('GDPR More Info Link Label')); ?></label>
                                            <input type="text" name="site_gdpr_cookie_more_info_label"  class="form-control" value="<?php echo e(get_static_option('site_gdpr_cookie_more_info_label')); ?>" id="site_gdpr_cookie_more_info_label">
                                        </div>
                                        <div class="form-group">
                                            <label for="site_gdpr_cookie_more_info_link"><?php echo e(__('GDPR More Info Link')); ?></label>
                                            <input type="text" name="site_gdpr_cookie_more_info_link"  class="form-control" value="<?php echo e(get_static_option('site_gdpr_cookie_more_info_link')); ?>" id="site_gdpr_cookie_more_info_link">
                                            <small class="form-text text-muted"><?php echo e(__('enter more info link user {url} to point the site address, example: {url}/about , it will be converted to www.yoursite.com/about')); ?></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="site_gdpr_cookie_accept_button_label"><?php echo e(__('GDPR Cookie Accept Button Label')); ?></label>
                                            <input type="text" name="site_gdpr_cookie_accept_button_label"  class="form-control" value="<?php echo e(get_static_option('site_gdpr_cookie_accept_button_label')); ?>" id="site_gdpr_cookie_accept_button_label">
                                        </div>
                                        <div class="form-group">
                                            <label for="site_gdpr_cookie_decline_button_label"><?php echo e(__('GDPR Cookie Decline Button Label')); ?></label>
                                            <input type="text" name="site_gdpr_cookie_decline_button_label"  class="form-control" value="<?php echo e(get_static_option('site_gdpr_cookie_decline_button_label')); ?>" id="site_gdpr_cookie_decline_button_label">
                                        </div>

                            <div class="form-group">
                                <label for="site_gdpr_cookie_enabled"><strong><?php echo e(__('GDPR Cookie Enable/Disable')); ?></strong></label>
                                <label class="switch yes">
                                    <input type="checkbox" name="site_gdpr_cookie_enabled"  <?php if(!empty(get_static_option('site_gdpr_cookie_enabled'))): ?> checked <?php endif; ?> id="site_gdpr_cookie_enabled">
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="site_gdpr_cookie_expire"><?php echo e(__('Cookie Expire')); ?></label>
                                <input type="text" name="site_gdpr_cookie_expire"  class="form-control" value="<?php echo e(get_static_option('site_gdpr_cookie_expire')); ?>" id="site_gdpr_cookie_expire">
                                <small class="form-text text-muted"><?php echo e(__('set cookie expire time, eg: 30, means 30days')); ?></small>
                            </div>
                            <div class="form-group">
                                <label for="site_gdpr_cookie_delay"><?php echo e(__('Show Delay')); ?></label>
                                <input type="text" name="site_gdpr_cookie_delay"  class="form-control" value="<?php echo e(get_static_option('site_gdpr_cookie_delay')); ?>" id="site_gdpr_cookie_delay">
                                <small class="form-text text-muted"><?php echo e(__('set GDPR cookie delay time, it mean the notification will show after this time. number count as mili seconds. eg: 5000, means 5seconds')); ?></small>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4"><?php echo e(__('Update Changes')); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/multistream6/domains/refugereach.help/public_html/@core/resources/views/backend/general-settings/gdpr.blade.php ENDPATH**/ ?>