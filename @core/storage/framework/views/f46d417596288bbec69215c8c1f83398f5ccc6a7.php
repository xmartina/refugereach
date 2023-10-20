<?php
  $post_img = null;
  $blog_image = get_attachment_image_by_id($donation->image,"full",false);
  $post_img = !empty($blog_image) ? $blog_image['img_url'] : '';
 ?>
<?php $__env->startSection('og-meta'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('site-title'); ?>
    <?php echo e($donation->title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-title'); ?>
    <?php echo e($donation->title); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-meta-data'); ?>
     <meta property="og:type" content="website">
    <meta property="og:title" content="<?php echo e($donation->title); ?>">
    <meta property="og:description" content="<?php echo e(strip_tags(\Str::words($donation->cause_content,150))); ?>">
    <meta property="og:image:width" content="600" />
    <meta property="og:image:height" content="315" />
    <meta property="og:image" content="<?php echo e($post_img); ?>"/>
	<meta property="og:image:secure" content="<?php echo e($post_img); ?>">
    
    <meta property="og:url" content="<?php echo e(route('frontend.donations.single',$donation->slug)); ?>">
    <meta property="twitter:card" content="summary_large_image">


   <meta property="title" content="<?php echo e($donation->title); ?>">
    <meta property="description" content="<?php echo e($donation->meta_tags); ?>">
    <meta property="tags" content="<?php echo e($donation->meta_description); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <section class="donation-single-content-area padding-top-120 padding-bottom-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="contribute-single-page-item single-flag-contribute">
                        <div id="mobile_btn">
                            <a href="#"> <?php echo e(get_static_option('cause_single_donate_button_text')); ?></a>
                        </div>
                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.msg.success','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('msg.success'); ?>
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
                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.msg.error','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('msg.error'); ?>
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


                        <?php if(!empty($donation->image_gallery)): ?>
                            <?php if($donation->emmergency === 'on'): ?>
                                <div class="alert alert-danger">
                                    <div class="contribute-alert">
                                        <span> <i class="lab la-android"></i> <?php echo e(get_static_option('emmergency_donation_text')); ?> </span>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div class="donation-image-gallery global-carousel-init"
                                 data-loop="true"
                                 data-desktopitem="1"
                                 data-mobileitem="1"
                                 data-tabletitem="1"
                                 data-dots="true"
                                 data-autoplay="true"
                            >
                                <?php
                                $images = explode("|",$donation->image_gallery);
                                ?>

                        <div class="single-gallery-image single-featured">
                            <?php echo render_image_markup_by_attachment_id($donation->image,'','large'); ?>

                            <?php if(get_static_option('donation_flag_show_hide')): ?>
                            <a href="#0" data-toggle="modal" data-target="#flag_store_modal" class="flag-icon">
                                <i class="fas fa-flag"></i>
                            </a>
                            <?php endif; ?>

                            <?php if($donation->reward === 'on'): ?>
                                <div class="flag-icon gift-icon-two mt-5">
                                    <i class="las la-gift"></i>
                                </div>
                            <?php endif; ?>



                            <?php if($donation->featured === 'on'): ?>
                            <div class="award-icon-two">
                                <i class="las la-award"></i>
                            </div>
                             <?php endif; ?>


                        </div>


                                <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php 
                                    	$image_details = get_attachment_image_by_id($image);
                                    	if(empty($image_details)){
                                    		continue;
                                    	}
                                	?>
                                    <div class="single-gallery-image single-featured">
                                        <?php echo render_image_markup_by_attachment_id($image,'large'); ?>


                                        <?php if(get_static_option('donation_flag_show_hide')): ?>
                                        <a href="#0" data-toggle="modal" data-target="#flag_store_modal" class="flag-icon">
                                            <i class="fas fa-flag"></i>
                                        </a>
                                        <?php endif; ?>

                                        <?php if($donation->reward === 'on'): ?>
                                            <div class="flag-icon gift-icon-two mt-5">
                                                <i class="las la-gift"></i>
                                            </div>
                                        <?php endif; ?>

                                        <?php if($donation->featured === 'on'): ?>
                                        <div class="award-icon-two">
                                            <i class="las la-award"></i>
                                        </div>
                                         <?php endif; ?>

                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php else: ?>

                            <?php if($donation->emmergency === 'on'): ?>
                                <div class="alert alert-danger">
                                    <div class="contribute-alert">
                                        <span> <i class="lab la-android"></i> <?php echo e(get_static_option('emmergency_donation_text')); ?> </span>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <div class="thumb single-featured">
                            <?php echo render_image_markup_by_attachment_id($donation->image,'','large'); ?>

                            <?php if(get_static_option('donation_flag_show_hide')): ?>
                            <a href="#0" data-toggle="modal" data-target="#flag_store_modal" class="flag-icon">
                                <i class="fas fa-flag"></i>
                            </a>
                            <?php endif; ?>

                            <?php if($donation->reward === 'on'): ?>
                                <div class="flag-icon gift-icon-two mt-5">
                                    <i class="las la-gift"></i>
                                </div>
                            <?php endif; ?>



                            <?php if($donation->featured === 'on'): ?>
                            <div class="award-icon-two">
                                <i class="las la-award"></i>
                            </div>
                             <?php endif; ?>


                        </div>
                        <?php endif; ?>
                        <div class="post-meta-wrap ">
                            <div class="author-data author-data-new margin-top-20">
                                <?php if($donation->created_by === 'user'): ?>
                                    <?php $user = $donation->user; ?>
                                <?php else: ?>
                                    <?php $user = $donation->admin; ?>
                                <?php endif; ?>
                                <div class="medical-documents">
                                    <div class="thumb">
                                        <?php echo render_image_markup_by_attachment_id(optional($user)->image,'','thumb'); ?>

                                    </div>

                                    <div class="auth-details">
                                    <ul class="my-3">
                                      <li>  <a <?php if(!empty($user->id)): ?> href="<?php echo e(route('frontend.user.created.donations',['user' => $donation->created_by,'id' => $user->id ])); ?>" <?php endif; ?>>
                                            <h4 class="name">
                                                <?php echo e($user ? $user->name  : __('Anonymous')); ?>

                                                <?php if(!is_null($user) && $user->user_verify_status == 2): ?>
                                                    <a href="#!" class="user_verified_check">
                                                        <i class="fas fa-check-circle text-success user_verified_check_icon" data-toggle="tooltip" data-title="<?php echo e(__('Verified')); ?>"></i>
                                                    </a>
                                                <?php endif; ?>
                                            </h4>

                                        </a>

                                      </li>


                                        <?php $follow_condition = __('Follow'); ?>

                                         <?php if(!empty($follow_user) && $follow_user->user_id != $user->id): ?>
                                            <?php
                                                  if(!empty($follow_user) && $follow_user->follow_status == 'follow'){

                                                       $follow_condition =  __('Following');
                                                  }else{

                                                       $follow_condition =  __('Follow');
                                                  }
                                            ?>
                                        <?php endif; ?>
                                        <?php if(!is_null($user) && auth()->guard('web')->check()): ?>
                                      <li>
                                          <a class="follow_btn badge badge-success p-2" data-campaign_owner_id="<?php echo e($user->id); ?>" data-user_type ="<?php echo e($donation->created_by); ?>" href="#">
                                              <?php echo e($follow_condition); ?>

                                          </a>
                                      </li>
                                       <?php endif; ?>

                                    </ul>
                                        <ul>
                                            <li><i class="fas fa-clock"></i> <?php echo e($donation->created_at->diffForHumans()); ?></li>

                                            <li>
                                                <i class="fas fa-tag"></i>
                                                <a href="<?php echo e(route('frontend.donations.category',['id' => $donation->categories_id,'any' => Str::slug($donation->category->title ?? __('Uncategorized')) ?? '' ])); ?>"><?php echo e($donation->category->title ?? __('Uncategorized')); ?></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>



                              <?php if(get_static_option('donation_medical_document_button_show_hide')): ?>
                                <?php if($donation->medical_document): ?>
                                <div class="medical-document-btn">
                                    <div class="btn-wrapper">
                                        <?php
                                            $medical_document_images = explode("|",$donation->medical_document);
                                        ?>
                                        <?php $__currentLoopData = $medical_document_images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image_id): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                $image_url = get_attachment_image_by_id($image_id,'full');
                                            ?>
                                            <?php if($loop->index === 0): ?>
                                                <a href="<?php echo e($image_url['img_url'] ?? ''); ?>" class="boxed-btn btn-color-three medical-image-popup" >
                                                    <?php echo get_static_option('donation_medical_document_button_text'); ?>

                                                </a>
                                            <?php else: ?>
                                                <a class="d-none medical-image-popup" href="<?php echo e($image_url['img_url'] ?? ''); ?>"></a>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <?php endif; ?>
                            </div>
                            <?php 
                                $style = ['frontend.partials.donation-single.tab-view' => '02','frontend.partials.donation-single.general-view' =>'01'];
                                $get_view = !empty($type) && in_array($type,['tab','general']) ? 'frontend.partials.donation-single.'.$type.'-view' : array_search(get_static_option('donation_single_page_variant'),$style); 
                            ?>
                            <?php if(in_array(get_static_option('donation_single_page_variant'),$style)): ?>
                             <?php echo $__env->make( $get_view, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php endif; ?>

                            <?php if(count($all_related_cause) > 1): ?>
                                <div class="related-post-area margin-top-40">
                                    <div class="section-title ">
                                        <h4 class="title "><?php echo e(get_static_option('releated_donation_text')); ?></h4>
                                    </div>
                                    <div class="related-news-carousel global-carousel-init"
                                         data-desktopitem="2"
                                         data-mobileitem="1"
                                         data-tabletitem="1"
                                         data-margin="30"
                                         data-dots="true"
                                    >
                                        <?php $__currentLoopData = $all_related_cause; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($data->id === $donation->id): ?> <?php continue; ?> <?php endif; ?>
                                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.frontend.donation.related','data' => ['featured' => $data->featured,'image' => $data->image,'amount' => $data->amount,'raised' => $data->raised,'slug' => $data->slug,'title' => $data->title,'excerpt' => $data->excerpt,'deadline' => $data->deadline,'buttontext' => get_static_option('donation_button_text')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('frontend.donation.related'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['featured' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($data->featured),'image' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($data->image),'amount' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($data->amount),'raised' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($data->raised),'slug' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($data->slug),'title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($data->title),'excerpt' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($data->excerpt),'deadline' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($data->deadline),'buttontext' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(get_static_option('donation_button_text'))]); ?>
                                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                   <div class="sidebar-outer-wrap">
                       <div class="sidebar-wrap">

                           <?php if($donation->reward == 'on'): ?>
                               <div class="widget-area single-reward-bg margin-bottom-40">
                                   <div class="single-reward">
                                       <div class="reward-flex-content">
                                           <div class="icon-img">
                                             <?php echo render_image_markup_by_attachment_id(get_static_option('donation_single_reward_image')); ?>

                                           </div>
                                           <div class="reward-contents">
                                               <h4 class="reward-titles"> <?php echo e(get_static_option('donation_single_reward_heading')); ?></h4>
                                               <span class="reward-para"> <?php echo e(get_static_option('donation_single_reward_title') . ' : '); ?> <strong><?php echo e(amount_with_currency_symbol($minimum_goal_amount)); ?></strong></span>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                           <?php endif; ?>

                           <div class="widget-area">
                               <?php if(!empty(get_static_option('donation_single_page_countdown_status'))): ?>
                                <div class="counterdown-wrap event-page">
                                    <div id="event_countdown"></div>
                                </div>
                                <?php endif; ?>
                               <div class="donation-details" id="donate_box_wrapper">
                                   <div class="amount-details">
                                       <h3 class="raised"> <?php echo e(amount_with_currency_symbol($donation->raised ? $donation->raised : 0 )); ?>

                                           <span class="goal"><?php echo e(get_static_option('donation_raised_text')); ?> <?php echo e(__('Of')); ?> <?php echo e(amount_with_currency_symbol($donation->amount)); ?> <?php echo e(get_static_option('donation_goal_text')); ?></span>
                                       </h3>
                                   </div>
                                   <div class="progress">
                                       <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                            aria-valuenow="<?php echo e(get_percentage($donation->amount,$donation->raised)); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo e(get_percentage($donation->amount,$donation->raised)); ?>%"></div>
                                   </div>

                                   <?php if(!empty(get_static_option('donation_login_user_donate_show_hide')) && !auth()->guard('web')->check()): ?>

                                       <div class="btn-wrapper margin-top-30">
                                           <a class="boxed-btn reverse-color" href="<?php echo e(route('user.login',)); ?>">
                                               <?php echo e(__('Login to Donate')); ?>

                                           </a>
                                       </div>
                                    <?php else: ?>

                                   <div class="btn-wrapper margin-top-30">
                                           <?php if(!empty($donation->deadline) && $donation->deadline <= date('Y-m-d')): ?>
                                               <p class="alert alert-danger margin-top-30"><?php echo e(get_static_option('donation_deadline_text')); ?></p>
                                           <?php else: ?>
                                               <a class="boxed-btn reverse-color" href="<?php echo e(route('frontend.donation.in.separate.page',$donation->id)); ?>">
                                                   <?php echo e(get_static_option('cause_single_donate_button_text')); ?>

                                               </a>
                                           <?php endif; ?>
                                       </div>
                                   <?php endif; ?>

                                   <?php if(get_static_option('donation_social_icons_show_hide')): ?>
                                   <div class="social-share-wrap">
                                            <div class="form-group">
                                                <input type="hidden" data-url="<?php echo e(route('frontend.donations.single',$donation->slug)); ?>" class="form-control" id="donation_copy_id">
                                                    <input type="text" readonly class="form-control" id="copy_field">
                                                <button  class="btn btn-success btn-sm copy_btn"><?php echo e(__('Copy')); ?></button>
                                            </div>
                                       <div class="share-list-icon">
                                           <h5 class="share-title"> <?php echo e(__('Share:')); ?> </h5>
                                           <ul>
                                               <?php
                                                   $image_url = get_attachment_image_by_id($donation->image);
                                                   $img_url = $image_url['img_url'] ?? '';
                                               ?>

                                               <?php echo single_post_share(route('frontend.donations.single',$donation->slug), $donation->title, $img_url); ?>

                                           </ul>
                                       </div>
                                   </div>
                                 <?php endif; ?>
                               </div>

                               
                                   <div class="social-texarea-share mt-4">
                                       <label><?php echo e(__('Get Embed Code')); ?></label>
                                       <div class="form-group">
                                           <input type="hidden" data-url="<?php echo e(route('frontend.donations.single',$donation->slug)); ?>" class="form-control" id="donation_copy_id">
                                           <textarea class="form-control embed_area copy_embed_field" readonly rows="4" cols="30"></textarea>
                                           <button class="btn btn-warning w-100 btn-sm copy_embed_btn mt-2 text-white"><?php echo e(__('Copy')); ?></button>
                                       </div>
                                   </div>

                                   <?php
                                       $colors = ['success','info','warning','danger'];
                                   ?>
                               
                           </div>
                            <?php if(isset($donation->gift_status)): ?>
                           <div class="widget-area margin-top-40">
                               <div class="box donor-load-box">
                                   <h3 class="panel-title"> <?php echo e(__('You Can Select Gift As Donation Also')); ?> </h3>
                               </div>
                               <?php $__currentLoopData = $donation->gift ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                   <div class="donation-gift-box margin-top-40">
                                       <div class="donation-gift-box-inner">
                                           <div class="thumb">
                                               <?php echo render_image_markup_by_attachment_id($data->image,'','grid') ?? ''; ?>

                                               <span><?php echo e(amount_with_currency_symbol($data->amount ?? 0)); ?></span>
                                           </div>
                                          <div class="content-wrap">
                                               <h3 class="panel-title"><?php echo e($data->title ?? ''); ?> </h3>
                                               <p class="py-2"><?php echo $data->description ?? ''; ?></p>
                                               <strong><?php echo e(__('Gifts:')); ?></strong>
                                               <?php $__currentLoopData = json_decode($data->gifts) ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                   <span class="badge badge-<?php echo e($colors[$key % count($colors)]); ?>"><?php echo e($item ?? ''); ?></span>
                                               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                          </div>
                                        </div>
                                        <a href="<?php echo e(route('frontend.donation.gift.checkout',['id'=>$data->id , 'd_id'=>$donation->id])); ?>" class="btn btn-outline-primary btn-block mt-3"><?php echo e(__('Select Gift')); ?></a>
                                   </div>
                               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <?php endif; ?>
                               
                           <?php if(get_static_option('donation_recent_donors_show_hide')): ?>
                           <div class="widget-area margin-top-40">
                               
                               <div class="box donor-load-box">
                                   <h3 class="panel-title">
                                       <?php echo e(get_static_option('donation_single_recent_donation_text')); ?> </h3>
                                   <div id="post_data" data-page="0"></div>
                               </div>
                               
                           </div>
                           <?php endif; ?>



                       </div>
                   </div>
                </div>
            </div>
        </div>
        </div>
    </section>


    <div class="modal fade" id="flag_store_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo e(__('Cause Claim')); ?></h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <form action="<?php echo e(route('frontend.donation.flag.report.store')); ?>" id="faq_edit_modal_form" enctype="multipart/form-data"
                      method="post">
                        <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <input type="hidden" name="cause_id"  value="<?php echo e($donation->id); ?>">

                        <?php
                            $userAuthCheck = auth()->check();
                            $authUser = auth()->guard('web')->user();
                        ?>

                        <div class="form-group">
                            <label for="edit_title"><?php echo e(__('Name')); ?></label>
                            <input type="text" class="form-control" name="name"  value="<?php echo e($userAuthCheck ? $authUser->name : ''); ?>"
                                   placeholder="<?php echo e(__('Name')); ?>">
                        </div>

                        <div class="form-group">
                            <label for="edit_title"><?php echo e(__('Email')); ?></label>
                            <input type="email" class="form-control" name="email" value="<?php echo e($userAuthCheck ? $authUser->email : ''); ?>"
                                   placeholder="<?php echo e(__('Email')); ?>">
                        </div>

                        <div class="form-group">
                            <label for="edit_title"><?php echo e(__('Subject')); ?></label>
                            <input type="text" class="form-control" name="subject"
                                   placeholder="<?php echo e(__('Subject')); ?>">
                        </div>

                        <div class="form-group">
                            <label for="edit_description"><?php echo e(__('Description')); ?></label>
                           <textarea class="form-control" name="description" rows="5"></textarea>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('Close')); ?></button>
                        <button id="submit" type="submit" class="btn btn-primary"><?php echo e(__('Submit')); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>



<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

 <script src="<?php echo e(asset('assets/common/js/countdown.jquery.js')); ?>"></script>
    <script>

        (function ($) {
            'use strict';

            $(document).ready(function () {
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.btn.submit','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('btn.submit'); ?>
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



            <?php if(!empty(get_static_option('donation_single_page_countdown_status'))): ?>
            var ev_offerTime = "<?php echo e($donation->deadline); ?>";
            var ev_year = ev_offerTime.substr(0, 4);
            var ev_month = ev_offerTime.substr(5, 2);
            var ev_day = ev_offerTime.substr(8, 2);

            if (ev_offerTime) {
                $('#event_countdown').countdown({
                    year: ev_year,
                    month: ev_month,
                    day: ev_day,
                    labels: true,
                    labelText: {
                        'days': "<?php echo e(__('days')); ?>",
                        'hours': "<?php echo e(__('hours')); ?>",
                        'minutes': "<?php echo e(__('min')); ?>",
                        'seconds': "<?php echo e(__('sec')); ?>",
                    }
                });
            }
            <?php endif; ?>

                //Cause content
                  $(document).on('click', '#ReadMoreButton', function (e) {
                    e.preventDefault();
                    var data = "";
                    $(this).parent().parent().css({
                        'max-height' : '100%',
                        'margin-bottom' : '0px'
                    });
                    $(this).parent().hide();

                });


                //Cause Comment Insert
                $(document).on('click', '#submitComment', function (e) {
                    e.preventDefault();
                    var erContainer = $(".error-message");
                    var el = $(this);
                    var form = $('#cause-comment-form');
                    var user_id = $('#user_id').val();
                    var cause_id = $('#cause_id').val();
                    var commented_by = $('#commented_by').val();
                    var comment_content = $('#comment_content').val();
                    el.text('<?php echo e(__('Submitting')); ?>..');

                    $.ajax({
                        url: form.attr('action'),
                        method: 'POST',
                        data: {
                            _token: "<?php echo e(csrf_token()); ?>",
                            user_id: user_id,
                            cause_id: cause_id,
                            commented_by: commented_by,
                            comment_content: comment_content,
                        },
                        success: function (data) {
                            location.reload();
                        },
                        error: function (data) {
                            var errors = data.responseJSON;
                            erContainer.html('<div class="alert alert-danger"></div>');
                            $.each(errors.errors, function (index, value) {
                                erContainer.find('.alert.alert-danger').append('<p>' + value + '</p>');
                            });
                            el.text('<?php echo e(__('Comment')); ?>');
                        },

                    });

                });

                //Load More Cause Comment Data
                var _token = $('input[name="_token"]').val();
                load_comment_data("<?php echo e($donation->id); ?>", _token);

                function load_comment_data(id = "", _token) {
                    var page = $('#comment_data').attr('data-page');

                    $.ajax({
                        url: "<?php echo e(route('frontend.load.cause.comment.data')); ?>",
                        method: "POST",
                        data: {id: id, _token: _token, page: page},
                        success: function (data) {
                            var appendData = '';

                            $.each(data, function (index, value) {
                                appendData += ' <div class="donor-comment"> '+
                                    '<span class="commented_by"> <?php echo e(__('By')); ?> '+value.commented_by+' <?php echo e(__('at')); ?> ' + value.date + '</span>' +
                                    '<p class="description">' + value.comment_content + '</p>' +
                                    '</div>';
                            });

                            if (data.length > 4) {
                                appendData += '<div id="load_more_div"> <button type="button" class="load-more-btn" id="load_more_comment_button"><?php echo e(__('Load More')); ?></button> </div>';
                            }
                            $('#load_more_div').remove();
                            $('#comment_data').append(appendData);
                            $('#comment_data').attr('data-page', parseInt(page) + 5);

                        }
                    })
                }

                $(document).on('click', '#load_more_comment_button', function () {
                    $('#load_more_comment_button').html('<b><?php echo e(__('Loading...')); ?></b>');
                    load_comment_data('<?php echo e($donation->id); ?>', _token);
                });


                //Load More Donors Data
                var _token = $('input[name="_token"]').val();


                $(document).on('click', '#load_more_case_update_button', function () {
                    $('#load_more_case_update_button').html('<b><?php echo e(__('Loading...')); ?></b>');
                    load_donation_update('<?php echo e($donation->id); ?>');
                });


                load_donation_update("<?php echo e($donation->id); ?>");

                function load_donation_update(id){
                    var parentContainer = $('#recent_update_about_cause');
                    var page = parentContainer.attr('data-page');
                    $.ajax({
                        url: "<?php echo e(route('frontend.load.cause.donation.update.data')); ?>", // defaine route for update load more
                        method: "POST",
                        data: {id: id, _token: "<?php echo e(csrf_token()); ?>", page: page},
                        success: function (data) {
                            var appendData = '';
                            $('#load_more_case_update_button').remove();
                            $.each(data,function (index,value){
                               appendData += '<div class="cause-update-section-body">';
                               if (value.img_url){
                                   appendData += '<div class="thumb">' +value.img_markup+'<div class="img-pop-wrap"><a href="'+value.img_url+'" class="image-popup"><i class="fas fa-search"></i></a></div></div>';
                               }
                             appendData += '<div class="content">'+
                            '<h3 class="title">'+value.title+'</h3>'+
                            '<div id="time-creator">'+value.date+' <?php echo e(__('by ')); ?>'+
                            '<span id="creator">'+value.created_by+'</span>'+
                            '</div> <p>'+value.description+'</p></div></div>';
                            });
                            if (data.length < 1) {
                                appendData += '<p class="not-found-button"><?php echo e(__('No more update found')); ?></p>';
                            } else {
                                appendData += '<div class="btn-wrapper load_more"> <button type="button" class="load-more-btn" id="load_more_case_update_button"><?php echo e(__('Load More')); ?></button> </div>';
                            }
                            parentContainer.append(appendData);
                            parentContainer.attr('data-page', parseInt(page) + 5);

                            $('.image-popup').magnificPopup({
                                type: 'image',
                                gallery: {
                                    // options for gallery
                                    enabled: true
                                },
                            });
                        }
                    })
                }
                load_data("<?php echo e($donation->id); ?>", _token);

                function load_data(id = "", _token) {
                    var page = $('#post_data').attr('data-page');
                    $.ajax({
                        url: "<?php echo e(route('frontend.load.cause.donor.data')); ?>",
                        method: "POST",
                        data: {id: id, _token: _token, page: page},
                        success: function (data) {
                            var appendData = '';
                            $('#load_more').remove();
                            $.each(data, function (index, value) {
                                appendData += ' <div class="donoer-info">' +
                                    '<div class="icon"><i class="fas fa-donate"></i></div>' +
                                    '<div class="content"><h3 class="title">' + value.name + '</h3>' +
                                    '<div class="dinfo"><span>' + value.amount + '</span><?php echo e(__('at')); ?> ' + value.date + '</div>' +
                                    '</div></div>';
                            });
                            if (data.length < 1) {
                                appendData += '<p class="not-found-button"><?php echo e(__('No donor found')); ?></p>';
                            } else {
                                appendData += '<div id="load_more" class="btn-wrapper"> <button type="button" class="load-more-btn" id="load_more_button"><?php echo e(__('Load More')); ?></button> </div>';
                            }
                            $('#post_data').append(appendData);
                            $('#post_data').attr('data-page', parseInt(page) + 5);
                        }
                    })
                }

                $(document).on('click', '#load_more_button', function () {
                    $('#load_more_button').html('<b><?php echo e(__('Loading...')); ?></b>');
                    load_data('<?php echo e($donation->id); ?>', _token);
                });

                //Donation Charge
                $(document).on('keyup', '#donation_amount_user_input', function () {
                    var donation_amount_user_input = $('#donation_amount_user_input').val();
                    var show_charge_amount = $('#show_charge_amount').val();

                    $.ajax({
                        url: "<?php echo e(route('frontend.get.donation.charges.by.ajax')); ?>",
                        type: 'get',
                        dataType: 'JSON',

                        success: function (data) {
                            if (data.amount === 'percentage' && data.donation_charge_button_on) {
                                $('.amount_show').text(parseInt(donation_amount_user_input) * data.percentage / 100 + '<?php echo e(site_currency_symbol()); ?>');

                            } else if (data.amount === 'fixed' && data.donation_charge_button_on) {

                                $('.amount_show').text(parseInt(data.fixed) + parseInt(donation_amount_user_input + '<?php echo e(site_currency_symbol()); ?>'));

                            } else if (!data.donation_charge_button_on) {
                                $('#show_charge_amount').val('');
                            } else {
                                $('#show_charge_amount').val('');
                            }

                        }
                    });
                })


                //Copy Url
                var url = $('#donation_copy_id').data(url);
                var copy_field = $('#copy_field').val(url.url);

                //Copy Url Code
                $(document).on('click','.copy_btn',function(){
                    navigator.clipboard.writeText(copy_field.val())
                    $(this).html('<i class="fas fa-check"> <?php echo e(__('Copied')); ?></i>');
                     setTimeout(function(){
                         $('.copy_btn').text('Copy');
                     },3000);
                 });
            });


            //Copy Embed Code
            var url = $('#donation_copy_id').data(url);
            var copy_field = $('.copy_embed_field').val(url.url);
            let imf_container = '<iframe class="iframe_field" width="560" height="315" src="'+copy_field.val()+'" frameborder="0" '+
                'allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
            $('.embed_area').val(imf_container);

            $(document).on('click','.copy_embed_btn',function(){
                navigator.clipboard.writeText(imf_container)
                $(this).html('<i class="fas fa-check"> <?php echo e(__('Copied')); ?></i>');
                setTimeout(function(){
                    $('.copy_embed_btn').text('Copy');
                },3000);
            });


            $(document).on('click','.follow_btn',function(e){
                e.preventDefault();
                let el = $(this);
                let text = el.text();

                let campaign_owner_id = $(this).data('campaign_owner_id');
                let user_type = $(this).data('user_type');
                $.ajax({
                    url: '<?php echo e(route('user.home.user.follow.store')); ?>',
                    method: 'post',
                    data:{campaign_owner_id:campaign_owner_id, text:text,user_type:user_type, _token: '<?php echo e(csrf_token()); ?>'},

                    success: function(data){

                        if (data.type === 'success') {
                            toastr.success("<?php echo e(__('You are now following this user..')); ?>");
                            el.text(data.text)

                        } else if(data.type === 'updated'){
                            if(data.text == "<?php echo e(__('Follow')); ?>"){
                                el.text(data.text)
                                toastr.error("<?php echo e(__('You are not following this user..')); ?>");
                            }else{
                                el.text(data.text)
                                toastr.success("<?php echo e(__('You are now following this user..')); ?>");
                            }
                        } else {
                            toastr.error("<?php echo e(__('Something went wrong!')); ?>");
                        }
                    },
                    error: function (response) {
                        let data = response.responseJSON;
                        if(data.message === 'Unauthenticated.'){
                            toastr.error(`<?php echo e(__('login to follow this campaign owner')); ?>`);

                            return true;
                        }
                        toastr.error(data.message);
                    }
                });

            })

        })(jQuery);
    </script>
    <?php echo $__env->make('frontend.partials.ajax-login-js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/fundorex.xgenious.com/@core/resources/views/frontend/donations/donation-single.blade.php ENDPATH**/ ?>