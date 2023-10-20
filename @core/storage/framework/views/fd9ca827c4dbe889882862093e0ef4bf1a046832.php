<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Edit Events Post')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/summernote-bs4.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/bootstrap-tagsinput.css')); ?>">
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
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                <?php echo $__env->make('backend/partials/message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php echo $__env->make('backend/partials/error', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="headerbtn-wrap">
                          <div class="row">
                              <div class="col-md-12">
                                  <h4 class="header-title"><?php echo e(__('Edit Event Post')); ?>

                                      <a href="<?php echo e(route('admin.events.new')); ?>" class="btn btn-secondary pull-right mb-3 ml-2"><?php echo e(__('Add New')); ?></a>
                                      <a href="<?php echo e(route('admin.events.all')); ?>" class="btn btn-info pull-right mb-3"><?php echo e(__('All Events')); ?></a>
                                  </h4>
                              </div>
                          </div>

                        </div>
                        <form action="<?php echo e(route('admin.events.update')); ?>" method="post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="event_id" value="<?php echo e($event->id); ?>">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="title"><?php echo e(__('Title')); ?></label>
                                        <input type="text" class="form-control"  id="title" name="title" value="<?php echo e($event->title); ?>" >
                                    </div>

                                    <div class="form-group permalink_label">
                                        <label class="text-dark"><?php echo e(__('Permalink / Slug * : ')); ?>

                                            <span id="slug_show" class="display-inline"></span>
                                            <span id="slug_edit" class="display-inline">
                                         <button class="btn btn-warning btn-sm slug_edit_button px-2 py-1 ml-1"> <i class="fas fa-edit"></i> </button>
                                          <input type="text" name="slug" value="<?php echo e($event->slug); ?>" class="form-control blog_slug mt-2" style="display: none">
                                          <button class="btn btn-info btn-sm slug_update_button mt-2 px-2 py-1" style="display: none"><?php echo e(__('Update')); ?></button>
                                    </span>
                                        </label>
                                    </div>



                                    <div class="form-group">
                                        <label for="category"><?php echo e(__('Category')); ?></label>
                                        <select name="category_id" class="form-control" id="category">
                                            <option value=""><?php echo e(__("Select Category")); ?></option>
                                            <?php $__currentLoopData = $all_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option <?php if($category->id == $event->category_id): ?> selected <?php endif; ?> value="<?php echo e($category->id); ?>"><?php echo e($category->title); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo e(__('Content')); ?></label>
                                        <input type="hidden" name="event_content" value="<?php echo e($event->content); ?>">
                                        <div class="summernote" data-content='<?php echo e($event->content); ?>'></div>
                                    </div>

                                    <div class="form-group">
                                        <label for="date"><?php echo e(__('Date')); ?></label>
                                        <input type="date" class="form-control" value="<?php echo e($event->date); ?>" id="date" name="date" >
                                    </div>
                                    <div class="form-group">
                                        <label for="time"><?php echo e(__('Time')); ?></label>
                                        <input type="text" class="form-control"  id="time" name="time" value="<?php echo e($event->time); ?>" placeholder="<?php echo e(__('time')); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="cost"><?php echo e(__('Cost')); ?></label>
                                        <input type="number" class="form-control"  id="cost" name="cost" value="<?php echo e($event->cost); ?>" placeholder="<?php echo e(__('cost')); ?>">
                                        <span class="info-text"><?php echo e(__('enter zero (0) to make this event free of cost')); ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="available_tickets"><?php echo e(__('Available Tickets')); ?></label>
                                        <input type="number" class="form-control"  id="available_tickets" value="<?php echo e($event->available_tickets); ?>" name="available_tickets" placeholder="<?php echo e(__('available tickets')); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="organizer"><?php echo e(__('Organizer')); ?></label>
                                        <input type="text" class="form-control"  id="organizer" name="organizer" value="<?php echo e($event->organizer); ?>" placeholder="<?php echo e(__('Event Organizer')); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="organizer_email"><?php echo e(__('Organizer Email')); ?></label>
                                        <input type="text" class="form-control"  id="organizer_email" name="organizer_email" value="<?php echo e($event->organizer_email); ?>" placeholder="<?php echo e(__('Organizer Email')); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="organizer_phone"><?php echo e(__('Organizer Phone')); ?></label>
                                        <input type="text" class="form-control"  id="organizer_phone" name="organizer_phone" value="<?php echo e($event->organizer_phone); ?>" placeholder="<?php echo e(__('Organizer Phone')); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="organizer_website"><?php echo e(__('Organizer Website')); ?></label>
                                        <input type="text" class="form-control"  id="organizer_website" name="organizer_website" value="<?php echo e($event->organizer_website); ?>" placeholder="<?php echo e(__('Organizer Website')); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="venue"><?php echo e(__('Venue')); ?></label>
                                        <input type="text" class="form-control"  id="venue" name="venue" value="<?php echo e($event->venue); ?>" placeholder="<?php echo e(__('Event Venue')); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="venue_location"><?php echo e(__('Venue Location')); ?></label>
                                        <input type="text" class="form-control"  id="venue_location" name="venue_location" value="<?php echo e($event->venue_location); ?>" placeholder="<?php echo e(__('Venue Location')); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="venue_phone"><?php echo e(__('Venue Phone')); ?></label>
                                        <input type="text" class="form-control"  id="venue_phone" name="venue_phone" value="<?php echo e($event->venue_phone); ?>" placeholder="<?php echo e(__('Venue Phone')); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_title"><?php echo e(__('Meta Title')); ?></label>
                                        <input type="text" name="meta_title"  class="form-control" value="<?php echo e($event->meta_title); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_tags"><?php echo e(__('Meta Tags')); ?></label>
                                        <input type="text" name="meta_tags"  class="form-control" data-role="tagsinput" value="<?php echo e($event->meta_tags); ?>" id="meta_tags">
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_description"><?php echo e(__('Meta Description')); ?></label>
                                        <textarea name="meta_description"  class="form-control" rows="5" id="meta_description"><?php echo e($event->meta_description); ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="image"><?php echo e(__('Image')); ?></label>
                                        <div class="media-upload-btn-wrapper">
                                            <div class="img-wrap">
                                                <?php
                                                    $event_img = get_attachment_image_by_id($event->image,null,false);
                                                    $event_img_btn_label = 'Upload Image';
                                                ?>
                                                <?php if(!empty($event_img)): ?>
                                                    <div class="attachment-preview">
                                                        <div class="thumbnail">
                                                            <div class="centered">
                                                                <img class="avatar user-thumb" src="<?php echo e($event_img['img_url']); ?>" alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php  $event_img_btn_label = 'Change Image'; ?>
                                                <?php endif; ?>
                                            </div>
                                            <input type="hidden" name="image" value="<?php echo e($event->image); ?>">
                                            <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="<?php echo e(__('Select Image')); ?>" data-modaltitle="<?php echo e(__('Upload Image')); ?>" data-toggle="modal" data-target="#media_upload_modal">
                                                <?php echo e($event_img_btn_label); ?>

                                            </button>
                                        </div>
                                        <small><?php echo e(__('Recommended image size 1920x1280')); ?></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="status"><?php echo e(__('Status')); ?></label>
                                        <select name="status" id="status"  class="form-control">
                                            <option <?php if($event->status == 'publish'): ?> selected <?php endif; ?> value="publish"><?php echo e(__('Publish')); ?></option>
                                            <option <?php if($event->status == 'draft'): ?> selected <?php endif; ?> value="draft"><?php echo e(__('Draft')); ?></option>
                                        </select>
                                    </div>
                                    <button id="update" type="submit" class="btn btn-primary mt-4 pr-4 pl-4"><?php echo e(__('Update Event')); ?></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php echo $__env->make('backend.partials.media-upload.media-upload-markup', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset('assets/backend/js/summernote-bs4.js')); ?>"></script>
    <script>
        (function($){
            "use strict";
            $(document).ready(function () {

                function converToSlug(slug){
                    let finalSlug = slug.replace(/[^a-zA-Z0-9]/g, ' ');
                    finalSlug = slug.replace(/  +/g, ' ');
                    finalSlug = slug.replace(/\s/g, '-').toLowerCase().replace(/[^\w-]+/g, '-');
                    return finalSlug;
                }

                //Permalink Code
                var sl =  $('.blog_slug').val();
                var url = `<?php echo e(url('/events/')); ?>/` + sl;
                var data = $('#slug_show').text(url).css('color', 'blue');
                var form = $('#blog_new_form');

                //Slug Edit Code
                $(document).on('click', '.slug_edit_button', function (e) {
                    e.preventDefault();
                    $('.blog_slug').show();
                    $(this).hide();
                    $('.slug_update_button').show();
                });

                //Slug Update Code
                $(document).on('click', '.slug_update_button', function (e) {
                    e.preventDefault();
                    $(this).hide();
                    $('.slug_edit_button').show();
                    var update_input = $('.blog_slug').val();
                    var slug = converToSlug(update_input);
                    var url = `<?php echo e(url('/events/')); ?>/` + slug;
                    $('#slug_show').text(url);
                    $('.blog_slug').hide();
                });


                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.btn.update','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('btn.update'); ?>
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
                $(document).on('change','#language',function(e){
                    e.preventDefault();
                    var selectedLang = $(this).val();
                    $.ajax({
                        url: "<?php echo e(route('admin.events.category.by.lang')); ?>",
                        type: "POST",
                        data: {
                            _token : "<?php echo e(csrf_token()); ?>",
                            lang : selectedLang
                        },
                        success:function (data) {
                            $('#category').html('<option value=""><?php echo e(__('Select Category')); ?></option>');
                            $.each(data,function(index,value){
                                $('#category').append('<option value="'+value.id+'">'+value.title+'</option>')
                            });
                        }
                    });
                });

                $('.summernote').summernote({
                    height: 500,   //set editable area's height
                    codemirror: { // codemirror options
                        theme: 'monokai'
                    },
                    callbacks: {
                        onChange: function(contents, $editable) {
                            $(this).prev('input').val(contents);
                        }
                    }
                });
                if($('.summernote').length > 0){
                    $('.summernote').each(function(index,value){
                        $(this).summernote('code', $(this).data('content'));
                    });
                }
            });
        })(jQuery)
    </script>

    <script src="<?php echo e(asset('assets/backend/js/dropzone.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/backend/js/bootstrap-tagsinput.js')); ?>"></script>
    <?php echo $__env->make('backend.partials.media-upload.media-js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/fundorex.xgenious.com/@core/resources/views/backend/events/edit-event.blade.php ENDPATH**/ ?>