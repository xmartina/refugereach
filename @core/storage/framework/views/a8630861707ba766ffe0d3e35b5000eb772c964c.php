<?php
    $home_page_variant = $home_page ?? get_static_option('home_page_variant');
?>
<footer class="footer-area home-variant-<?php echo e($home_page_variant); ?>">
        <div class="footer-top bg-black bg-image padding-top-90 padding-bottom-65 <?php if($home_page_variant == '02'): ?> style-01 bg-image <?php endif; ?>"
             <?php if($home_page_variant == '02'): ?> style="background-image: url(<?php echo e(asset('assets/frontend/img/shape/footer-bg.png')); ?>)" <?php endif; ?>>

            <div class="container">
                <div class="row">
                    <?php echo render_frontend_sidebar('footer',['column' => true]); ?>

                </div>
            </div>
        </div>
    <div class="copyright-area  <?php if($home_page_variant == '02'): ?> style-01 bg-image <?php endif; ?>">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="copyright-item">
                        <div class="copyright-area-inner">
                            <?php echo purify_html_raw(get_footer_copyright_text()); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<div class="back-to-top">
    <span class="back-top">
        <i class="fas fa-angle-up"></i>
    </span>
</div>
<?php if(preg_match('/(xgenious)/',url('/'))): ?>
    <div class="buy-now-wrap">
        <ul class="buy-list">
            <li><a target="_blank" href="https://docs.xgenious.com/docs/fundorex/" data-container="body" data-toggle="popover" data-placement="left" data-content="<?php echo e(__('Documentation')); ?>"><i class="far fa-file-alt"></i></a></li>
            <li><a target="_blank" href="https://codecanyon.net/item/fundorex-crowdfunding-platform/33286096"><i class="fas fa-shopping-cart"></i></a></li>
            <li><a target="_blank" href="https://xgenious51.freshdesk.com/"><i class="fas fa-headset"></i></a></li>
        </ul>
    </div>
<?php endif; ?>

<!-- load all script -->
<script src="<?php echo e(asset('assets/frontend/js/bootstrap.bundle.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/dynamic-script.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/jquery.magnific-popup.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/jquery.waypoints.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/jquery.counterup.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/owl.carousel.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/jQuery.rProgressbar.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/active.rProgressbar.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/wow.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/backend/js/sweetalert2.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/imagesloaded.pkgd.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/isotope.pkgd.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/common/js/toastr.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/slick.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/backend/js/jquery.nice-select.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/main.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/main2.js')); ?>"></script>

<script type="text/javascript">
    var Xgenious_API = Xgenious_API || {}, Xgenious_LoadStart = new Date();
    (function () {
        var s2 = document.createElement("script"), fs = document.getElementsByTagName("script")[0];
        s2.async = true;
        s2.src = "https://embed.xgenious.com/5e0b3e167e39ea1242a27b69.js";
        s2.charset = 'UTF-8';
        s2.setAttribute('crossorigin', '*');
        fs.parentNode.insertBefore(s2, fs);
    })();
</script>
    

<?php echo $__env->make('frontend.partials.google-captcha', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('frontend.partials.gdpr-cookie', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('frontend.partials.inline-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('frontend.partials.twakto', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<script>
    $( document ).ready(function() {
        $('[data-toggle="tooltip"]').tooltip({'placement': 'left','color':'green'});
    });
</script>


<?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sweet-alert-msg','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('sweet-alert-msg'); ?>
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
<?php echo $__env->yieldContent('scripts'); ?>


</body>
</html>
<?php /**PATH /home/xgenxchi/fundorex.xgenious.com/@core/resources/views/frontend/partials/footer.blade.php ENDPATH**/ ?>