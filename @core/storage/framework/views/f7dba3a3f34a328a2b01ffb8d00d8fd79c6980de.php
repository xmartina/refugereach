<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Donation Settings')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.media.css','data' => []]); ?>
<?php $component->withName('media.css'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
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

            <div class="col-12 mt-5">
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.msg.success','data' => []]); ?>
<?php $component->withName('msg.success'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.msg.error','data' => []]); ?>
<?php $component->withName('msg.error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title"><?php echo e(__("Donation Settings")); ?></h4>
                        <form action="<?php echo e(route('admin.donations.settings')); ?>" method="POST"
                              enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>

                            <div class="form-group">
                                <label for="navbar_button"><?php echo e(__('Donation Charge - Active/Deactivate')); ?></label>
                                <label class="switch">
                                    <input type="checkbox" name="donation_charge_active_deactive_button"
                                           <?php if(!empty(get_static_option('donation_charge_active_deactive_button'))): ?> checked <?php endif; ?> >
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="donation_charge_form"><?php echo e(__('Donation Charge From')); ?></label>
                                <select class="form-control" name="donation_charge_form">
                                    <option value="donor" <?php if(get_static_option('donation_charge_form') == 'donor'): ?>  selected <?php endif; ?> ><?php echo e(__('Donor')); ?></option>
                                    <option value="campaign_owner"  <?php if(get_static_option('donation_charge_form') == 'campaign_owner'): ?> selected <?php endif; ?>><?php echo e(__('Campaign Owner')); ?></option>
                                </select>
                                <span class="info-text"><?php echo e(__('you can set where you charge from donor (user) or campaign owner ( who created campaign )')); ?></span>
                            </div>
                            <div class="form-group">
                                <label for="donation_button_text"><?php echo e(__('Donation Charge Type')); ?></label>
                                <select class="form-control" name="charge_amount_type">
                                    <option value="fixed"
                                            <?php if(get_static_option('charge_amount_type') == 'fixed'): ?>  selected <?php endif; ?> ><?php echo e(__('Fixed Amount')); ?></option>
                                    <option value="percentage"
                                            <?php if(get_static_option('charge_amount_type') == 'percentage'): ?> selected <?php endif; ?>><?php echo e(__('Percentage Amount')); ?></option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="donation_button_text"><?php echo e(__('Donation Charge')); ?></label>
                                <input type="text" name="charge_amount" class="form-control"
                                       value="<?php echo e(get_static_option('charge_amount')); ?>" id="donation_button_text">
                            </div>
                            <div class="form-group">
                                <label for="allow_user_to_add_custom_tip_in_donation"><?php echo e(__('Allow User To Add Custom Tip In Donation')); ?></label>
                                <label class="switch">
                                    <input type="checkbox" name="allow_user_to_add_custom_tip_in_donation"
                                           <?php if(!empty(get_static_option('allow_user_to_add_custom_tip_in_donation'))): ?> checked <?php endif; ?> >
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <hr>
                            <div class="form-group">
                                <label for="user_campaign_metadata_status"><?php echo e(__('User Campaign Meta Data Input - Active/Deactivate')); ?></label>
                                <label class="switch">
                                    <input type="checkbox" name="user_campaign_metadata_status"
                                           <?php if(!empty(get_static_option('user_campaign_metadata_status'))): ?> checked <?php endif; ?> >
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="donation_button_text"><?php echo e(__('Donation Button Text')); ?></label>
                                <input type="text" name="donation_button_text" class="form-control"
                                       value="<?php echo e(get_static_option('donation_button_text')); ?>" id="donation_button_text">
                            </div>
                            <div class="form-group">
                                <label for="donation_raised_text"><?php echo e(__('Raised Text')); ?></label>
                                <input type="text" name="donation_raised_text" class="form-control"
                                       value="<?php echo e(get_static_option('donation_raised_text')); ?>" id="donation_raised_text">
                            </div>
                            <div class="form-group">
                                <label for="donation_goal_text"><?php echo e(__('Goal Text')); ?></label>
                                <input type="text" name="donation_goal_text" class="form-control"
                                       value="<?php echo e(get_static_option('donation_goal_text')); ?>" id="donation_goal_text">
                            </div>

                            <div class="form-group">
                                <label for="site_events_post_items"><?php echo e(__('Donation Page Items')); ?></label>
                                <input type="text" name="donor_page_post_items" class="form-control"
                                       value="<?php echo e(get_static_option('donor_page_post_items')); ?>"
                                       id="donor_page_post_items">
                                <span class="info-text"><?php echo e(__('how many item you want to show in donation page')); ?></span>
                            </div>
                            <hr>
                            <div class="form-group">
                                <label for="donation_single_form_button_text"><?php echo e(__('Form Button Title')); ?></label>
                                <input type="text" name="donation_single_form_button_text"  class="form-control" value="<?php echo e(get_static_option('donation_single_form_button_text')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="donation_single_recent_donation_text"><?php echo e(__('Recent Donation Title')); ?></label>
                                <input type="text" name="donation_single_recent_donation_text"  class="form-control" value="<?php echo e(get_static_option('donation_single_recent_donation_text')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="donation_single_faq_title"><?php echo e(__('Donation Page Faq Title')); ?></label>
                                <input type="text" name="donation_single_faq_title"  class="form-control" value="<?php echo e(get_static_option('donation_single_faq_title')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="donation_custom_amount"><?php echo e(__('Custom Donation Once Amount')); ?></label>
                                <input type="text" name="donation_custom_amount_once"  class="form-control" value="<?php echo e(get_static_option('donation_custom_amount_once')); ?>" id="donation_custom_amount_once">
                                <p><?php echo e(__('Separate amount by comma (,)')); ?></p>
                            </div>
                            <div class="form-group">
                                <label for="donation_custom_amount"><?php echo e(__('Custom Donation Monthly Amount')); ?></label>
                                <input type="text" name="donation_custom_amount_monthly"  class="form-control" value="<?php echo e(get_static_option('donation_custom_amount_monthly')); ?>" id="donation_custom_amount_monthly">
                                <p><?php echo e(__('Separate amount by comma (,)')); ?></p>
                            </div>
                            <div class="form-group">
                                <label for="donation_default_amount"><?php echo e(__('Default Donation Amount')); ?></label>
                                <input type="number" name="donation_default_amount"  class="form-control" value="<?php echo e(get_static_option('donation_default_amount')); ?>" id="donation_default_amount">
                            </div>
                            <div class="form-group">
                                <label for="minimum_donation_amount"><?php echo e(__('Minimum Donation Amount')); ?></label>
                                <input type="number" name="minimum_donation_amount"  class="form-control" value="<?php echo e(get_static_option('minimum_donation_amount')); ?>" id="minimum_donation_amount">
                                <small><?php echo e(__('If you dont want to set minimum amount of donation than you can leave this field blank..!')); ?></small>
                            </div>
                            <div class="form-group">
                                <label for="donation_notify_mail"><?php echo e(__('Donation Notify Email')); ?></label>
                                <input type="email" name="donation_notify_mail"  class="form-control" value="<?php echo e(get_static_option('donation_notify_mail')); ?>" id="donation_notify_mail">
                            </div>
                            <hr>
                            <div class="form-group">
                                <label for="cause_single_donate_button_text"><?php echo e(__('Cause Single Page Donate Button Text')); ?></label>
                                <input type="text" name="cause_single_donate_button_text"  class="form-control" value="<?php echo e(get_static_option('cause_single_donate_button_text')); ?>" id="cause_single_donate_button_text">
                            </div>
                            <div class="form-group">
                                <label for="cause_single_donate_sidebar_text"><?php echo e(__('Cause Single Page sidebar Text')); ?></label>
                                <input type="text" name="cause_single_donate_sidebar_text"  class="form-control" value="<?php echo e(get_static_option('cause_single_donate_sidebar_text')); ?>" >
                            </div>
                            <div class="form-group">
                                <label for="navbar_button"><?php echo e(__('Show/Hide Donation Countdown')); ?></label>
                                <label class="switch">
                                    <input type="checkbox" name="donation_single_page_countdown_status"
                                           <?php if(!empty(get_static_option('donation_single_page_countdown_status'))): ?> checked <?php endif; ?> >
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <hr>

                            <div class="form-group">
                                <label for="donation_success_page_title"><?php echo e(__('Success Page Main Title')); ?></label>
                                <input type="text" name="donation_success_page_title"  class="form-control" value="<?php echo e(get_static_option('donation_success_page_title')); ?>" id="donation_success_page_title">
                            </div>
                            <div class="form-group">
                                <label for="donation_success_page_description"><?php echo e(__('Success Page Description')); ?></label>
                                <textarea name="donation_success_page_description" class="form-control" id="donation_success_page_description" cols="30" rows="5"><?php echo e(get_static_option('donation_success_page_description')); ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="donation_cancel_page_description"><?php echo e(__('Cancel Description')); ?></label>
                                <textarea name="donation_cancel_page_description" class="form-control" id="donation_cancel_page_description" cols="30" rows="5"><?php echo e(get_static_option('donation_cancel_page_description')); ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="donation_cancel_page_title"><?php echo e(__('Cancel Main Title')); ?></label>
                                <input type="text" name="donation_cancel_page_title"  class="form-control" value="<?php echo e(get_static_option('donation_cancel_page_title')); ?>" id="donation_cancel_page_title">
                            </div>
                            <div class="form-group">
                                <label for="donation_deadline_text"><?php echo e(__('Donation Deadline Text')); ?></label>
                                <input type="text" name="donation_deadline_text" class="form-control" id="donation_deadline_text" value="<?php echo e(get_static_option('donation_deadline_text')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="donation_deadline_text"><?php echo e(__('Medical Document Button Text')); ?></label>
                                <input type="text" name="donation_medical_document_button_text" class="form-control" id="donation_deadline_text" value="<?php echo e(get_static_option('donation_medical_document_button_text')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="donation_deadline_text"><?php echo e(__('Emmergency Donation Text')); ?></label>
                                <input type="text" name="emmergency_donation_text" class="form-control" id="emmergency_donation_text" value="<?php echo e(get_static_option('emmergency_donation_text')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="donation_deadline_text"><?php echo e(__('Related Donation Text')); ?></label>
                                <input type="text" name="releated_donation_text" class="form-control" id="emmergency_donation_text" value="<?php echo e(get_static_option('releated_donation_text')); ?>">
                            </div>

                            <div class="form-group">
                                <label for="donation_deadline_text"><?php echo e(__('Reward Heading')); ?></label>
                                <input type="text" name="donation_single_reward_heading" class="form-control" id="donation_single_reward_heading" value="<?php echo e(get_static_option('donation_single_reward_heading')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="donation_deadline_text"><?php echo e(__('Reward title')); ?></label>
                                <input type="text" name="donation_single_reward_title" class="form-control" id="donation_single_reward_title" value="<?php echo e(get_static_option('donation_single_reward_title')); ?>">
                            </div>

                            <div class="form-group">
                                <label for="donation_deadline_text"><?php echo e(__('Enter how many days ago user will get notification monthly recuring donation invoice with email')); ?></label>
                                <input type="number" min="1" class="form-control" name="how_many_days_ago_user_get_recuring_notification" value="<?php echo e(get_static_option('how_many_days_ago_user_get_recuring_notification')); ?>">
                            </div>

                            <div class="form-group col-lg-12">
                                <label for="donation_deadline_text"><?php echo e(__('Reward Image')); ?></label>
                                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.image','data' => ['name' => 'donation_single_reward_image','id' => 'donation_single_reward_image','value' => 'donation_single_reward_image']]); ?>
<?php $component->withName('image'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('donation_single_reward_image'),'id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('donation_single_reward_image'),'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('donation_single_reward_image')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                            </div>

                            <div class="form-group">
                                <label for="navbar_button"><?php echo e(__('Show/Hide Donation Medical Document Button')); ?></label>
                                <label class="switch">
                                    <input type="checkbox" name="donation_medical_document_button_show_hide"
                                           <?php if(!empty(get_static_option('donation_medical_document_button_show_hide'))): ?> checked <?php endif; ?> >
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="navbar_button"><?php echo e(__('Show/Hide Donation Flag')); ?></label>
                                <label class="switch">
                                    <input type="checkbox" name="donation_flag_show_hide"
                                           <?php if(!empty(get_static_option('donation_flag_show_hide'))): ?> checked <?php endif; ?> >
                                    <span class="slider"></span>
                                </label>
                            </div>

                            <div class="form-group">
                                <label for="navbar_button"><?php echo e(__('Show/Hide Donation FAQ')); ?></label>
                                <label class="switch">
                                    <input type="checkbox" name="donation_faq_show_hide"
                                           <?php if(!empty(get_static_option('donation_faq_show_hide'))): ?> checked <?php endif; ?> >
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="navbar_button"><?php echo e(__('Show/Hide Donation Description')); ?></label>
                                <label class="switch">
                                    <input type="checkbox" name="donation_descriptions_show_hide"
                                           <?php if(!empty(get_static_option('donation_descriptions_show_hide'))): ?> checked <?php endif; ?> >
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="navbar_button"><?php echo e(__('Show/Hide Donation Updates')); ?></label>
                                <label class="switch">
                                    <input type="checkbox" name="donation_updates_show_hide"
                                           <?php if(!empty(get_static_option('donation_updates_show_hide'))): ?> checked <?php endif; ?> >
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="navbar_button"><?php echo e(__('Show/Hide Donation Comments')); ?></label>
                                <label class="switch">
                                    <input type="checkbox" name="donation_comments_show_hide"
                                           <?php if(!empty(get_static_option('donation_comments_show_hide'))): ?> checked <?php endif; ?> >
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="navbar_button"><?php echo e(__('Show/Hide Social Share ')); ?></label>
                                <label class="switch">
                                    <input type="checkbox" name="donation_social_icons_show_hide"
                                           <?php if(!empty(get_static_option('donation_social_icons_show_hide'))): ?> checked <?php endif; ?> >
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="navbar_button"><?php echo e(__('Show/Hide Recent Donors')); ?></label>
                                <label class="switch">
                                    <input type="checkbox" name="donation_recent_donors_show_hide"
                                           <?php if(!empty(get_static_option('donation_recent_donors_show_hide'))): ?> checked <?php endif; ?> >
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="navbar_button"><?php echo e(__('Show/Hide Donate Button (Only Login user can see and Donate)')); ?></label>
                                <label class="switch">
                                    <input type="checkbox" name="donation_login_user_donate_show_hide"
                                           <?php if(!empty(get_static_option('donation_login_user_donate_show_hide'))): ?> checked <?php endif; ?> >
                                    <span class="slider"></span>
                                </label>
                            </div>

                            <button id="update" type="submit"
                                    class="btn btn-primary mt-4 pr-4 pl-4"><?php echo e(__('Update Changes')); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.media.markup','data' => []]); ?>
<?php $component->withName('media.markup'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script>
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
    </script>
        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.media.js','data' => []]); ?>
<?php $component->withName('media.js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/public_html/laravel/fundorex/@core/resources/views/backend/donations/settings.blade.php ENDPATH**/ ?>