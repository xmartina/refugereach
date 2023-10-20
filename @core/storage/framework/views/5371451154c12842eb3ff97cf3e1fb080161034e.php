<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Job Settings')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                <?php echo $__env->make('backend.partials.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title"><?php echo e(__("Job Settings")); ?></h4>
                        <form action="<?php echo e(route('admin.jobs.settings')); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>

                            <div class="form-group">
                                <label for="job_success_page_title"><?php echo e(__('Success Page Main Title')); ?></label>
                                <input type="text" name="job_success_page_title"  class="form-control" value="<?php echo e(get_static_option('job_success_page_title')); ?>" id="job_success_page_title">
                            </div>
                            <div class="form-group">
                                <label for="job_success_page_description"><?php echo e(__('Success Page  Description')); ?></label>
                                <textarea name="job_success_page_description" class="form-control" id="job_success_page_description" cols="30" rows="5"><?php echo e(get_static_option('job_success_page_description')); ?></textarea>
                            </div>
                            <hr>
                            <div class="form-group">
                                <label for="job_cancel_page_title"><?php echo e(__('Cancel Page Main Title')); ?></label>
                                <input type="text" name="job_cancel_page_title"  class="form-control" value="<?php echo e(get_static_option('job_cancel_page_title')); ?>" id="job_cancel_page_title">
                            </div>
                            <div class="form-group">
                                <label for="job_cancel_page_description"><?php echo e(__('Cancel Page Description')); ?></label>
                                <textarea name="job_cancel_page_description" class="form-control" id="job_cancel_page_description" cols="30" rows="5"><?php echo e(get_static_option('job_cancel_page_description')); ?></textarea>
                            </div>
                            <hr>
                            <div class="form-group">
                                <label for="site_job_post_items"><?php echo e(__('Jobs Page Items')); ?></label>
                                <input type="number" name="site_job_post_items" class="form-control" value="<?php echo e(get_static_option('site_job_post_items')); ?>">
                            </div>
                            <hr>

                            <div class="form-group">
                                <label for="job_single_page_job_context_label"><?php echo e(__('Job Context Label')); ?></label>
                                <input type="text" name="job_single_page_job_context_label"  class="form-control" value="<?php echo e(get_static_option('job_single_page_job_context_label')); ?>" id="job_single_page_job_context_label">
                            </div>
                            <div class="form-group">
                                <label for="job_single_page_job_responsibility_label"><?php echo e(__('Job Responsibility Label')); ?></label>
                                <input type="text" name="job_single_page_job_responsibility_label"  class="form-control" value="<?php echo e(get_static_option('job_single_page_job_responsibility_label')); ?>" id="job_single_page_job_responsibility_label">
                            </div>
                            <div class="form-group">
                                <label for="job_single_page_education_requirement_label"><?php echo e(__('Education Requirement Label')); ?></label>
                                <input type="text" name="job_single_page_education_requirement_label"  class="form-control" value="<?php echo e(get_static_option('job_single_page_education_requirement_label')); ?>" id="job_single_page_education_requirement_label">
                            </div>
                            <div class="form-group">
                                <label for="job_single_page_experience_requirement_label"><?php echo e(__('Experience Requirement Label')); ?></label>
                                <input type="text" name="job_single_page_experience_requirement_label"  class="form-control" value="<?php echo e(get_static_option('job_single_page_experience_requirement_label')); ?>" id="job_single_page_experience_requirement_label">
                            </div>
                            <div class="form-group">
                                <label for="job_single_page_additional_requirement_label"><?php echo e(__('Additional Requirement Label')); ?></label>
                                <input type="text" name="job_single_page_additional_requirement_label"  class="form-control" value="<?php echo e(get_static_option('job_single_page_additional_requirement_label')); ?>" id="job_single_page_additional_requirement_label">
                            </div>
                            <div class="form-group">
                                <label for="job_single_page_others_benefits_label"><?php echo e(__('Others Benefits Label')); ?></label>
                                <input type="text" name="job_single_page_others_benefits_label"  class="form-control" value="<?php echo e(get_static_option('job_single_page_others_benefits_label')); ?>" id="job_single_page_others_benefits_label">
                            </div>
                            <div class="form-group">
                                <label for="job_single_page_apply_button_text"><?php echo e(__('Job Apply Button Text')); ?></label>
                                <input type="text" name="job_single_page_apply_button_text"  class="form-control" value="<?php echo e(get_static_option('job_single_page_apply_button_text')); ?>" id="job_single_page_apply_button_text">
                            </div>
                            <div class="form-group">
                                <label for="job_single_page_job_info_text"><?php echo e(__('Job Information Text')); ?></label>
                                <input type="text" name="job_single_page_job_info_text"  class="form-control" value="<?php echo e(get_static_option('job_single_page_job_info_text')); ?>" id="job_single_page_job_info_text">
                            </div>
                            <div class="form-group">
                                <label for="job_single_page_company_name_text"><?php echo e(__('Company Name Text')); ?></label>
                                <input type="text" name="job_single_page_company_name_text"  class="form-control" value="<?php echo e(get_static_option('job_single_page_company_name_text')); ?>" id="job_single_page_company_name_text">
                            </div>
                            <div class="form-group">
                                <label for="job_single_page_job_category_text"><?php echo e(__('Job Category Text')); ?></label>
                                <input type="text" name="job_single_page_job_category_text"  class="form-control" value="<?php echo e(get_static_option('job_single_page_job_category_text')); ?>" id="job_single_page_job_category_text">
                            </div>
                            <div class="form-group">
                                <label for="job_single_page_job_position_text"><?php echo e(__('Job Position Text')); ?></label>
                                <input type="text" name="job_single_page_job_position_text"  class="form-control" value="<?php echo e(get_static_option('job_single_page_job_position_text')); ?>" id="job_single_page_job_position_text">
                            </div>
                            <div class="form-group">
                                <label for="job_single_page_job_type_text"><?php echo e(__('Job Type Text')); ?></label>
                                <input type="text" name="job_single_page_job_type_text"  class="form-control" value="<?php echo e(get_static_option('job_single_page_job_type_text')); ?>" id="job_single_page_job_type_text">
                            </div>
                            <div class="form-group">
                                <label for="job_single_page_salary_text"><?php echo e(__('Salary Text')); ?></label>
                                <input type="text" name="job_single_page_salary_text"  class="form-control" value="<?php echo e(get_static_option('job_single_page_salary_text')); ?>" id="job_single_page_salary_text">
                            </div>
                            <div class="form-group">
                                <label for="job_single_page_job_location_text"><?php echo e(__('Job Location Text')); ?></label>
                                <input type="text" name="job_single_page_job_location_text"  class="form-control" value="<?php echo e(get_static_option('job_single_page_job_location_text')); ?>" id="job_single_page_job_location_text">
                            </div>
                            <div class="form-group">
                                <label for="job_single_page_job_deadline_text"><?php echo e(__('Deadline Text')); ?></label>
                                <input type="text" name="job_single_page_job_deadline_text"  class="form-control" value="<?php echo e(get_static_option('job_single_page_job_deadline_text')); ?>" id="job_single_page_job_deadline_text">
                            </div>
                            <div class="form-group">
                                <label for="job_single_page_job_application_fee_text"><?php echo e(__('Application Fee Text')); ?></label>
                                <input type="text" name="job_single_page_job_application_fee_text"  class="form-control" value="<?php echo e(get_static_option('job_single_page_job_application_fee_text')); ?>">
                            </div>

                            <div class="form-group">
                                <label for="job_single_page_applicant_mail"><?php echo e(__('Job Application Receiving Mail')); ?></label>
                                <input type="text" name="job_single_page_applicant_mail"  class="form-control" value="<?php echo e(get_static_option('job_single_page_applicant_mail')); ?>" id="job_single_page_applicant_mail">
                            </div>
                            <div class="form-group">
                                <label for="job_single_page_apply_form"><strong><?php echo e(__('Apply Page Enable/Disable')); ?></strong></label>
                                <label class="switch">
                                    <input type="checkbox" name="job_single_page_apply_form"  <?php if(!empty(get_static_option('job_single_page_apply_form'))): ?> checked <?php endif; ?> id="job_single_page_apply_form">
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <button id="update" type="submit" class="btn btn-primary mt-4 pr-4 pl-4"><?php echo e(__('Update Changes')); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>
        (function($){
            "use strict";
            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.btn.update','data' => []]); ?>
<?php $component->withName('btn.update'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
        })(jQuery);
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/xgenious/Desktop/xgenious/localhost/fundorex-last-server-file-with-api/@core/resources/views/backend/jobs/job-settings.blade.php ENDPATH**/ ?>