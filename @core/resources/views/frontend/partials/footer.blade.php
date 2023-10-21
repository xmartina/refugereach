@php
    $home_page_variant = $home_page ?? get_static_option('home_page_variant');
@endphp
<footer class="footer-area home-variant-{{$home_page_variant}}">
        <div class="footer-top bg-black bg-image padding-top-90 padding-bottom-65 @if($home_page_variant == '02') style-01 bg-image @endif"
             @if($home_page_variant == '02') style="background-image: url({{asset('assets/frontend/img/shape/footer-bg.png')}})" @endif>

            <div class="container">
                <div class="row">
                    {!! render_frontend_sidebar('footer',['column' => true]) !!}
                </div>
            </div>
        </div>
    <div class="copyright-area  @if($home_page_variant == '02') style-01 bg-image @endif">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="copyright-item">
                        <div class="copyright-area-inner">
                            {!! purify_html_raw(get_footer_copyright_text()) !!}
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
@if(preg_match('/(xgenious)/',url('/')))
    <div class="buy-now-wrap">
        <ul class="buy-list">
            <li><a target="_blank" href="https://docs.xgenious.com/docs/fundorex/" data-container="body" data-toggle="popover" data-placement="left" data-content="{{__('Documentation')}}"><i class="far fa-file-alt"></i></a></li>
            <li><a target="_blank" href="https://codecanyon.net/item/fundorex-crowdfunding-platform/33286096"><i class="fas fa-shopping-cart"></i></a></li>
            <li><a target="_blank" href="https://xgenious51.freshdesk.com/"><i class="fas fa-headset"></i></a></li>
        </ul>
    </div>
@endif

<!-- load all script -->
<script src="{{asset('assets/frontend/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/frontend/js/dynamic-script.js')}}"></script>
<script src="{{asset('assets/frontend/js/jquery.magnific-popup.js')}}"></script>
<script src="{{asset('assets/frontend/js/jquery.waypoints.js')}}"></script>
<script src="{{asset('assets/frontend/js/jquery.counterup.min.js')}}"></script>
<script src="{{asset('assets/frontend/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('assets/frontend/js/jQuery.rProgressbar.min.js')}}"></script>
<script src="{{asset('assets/frontend/js/active.rProgressbar.js')}}"></script>
<script src="{{asset('assets/frontend/js/wow.min.js')}}"></script>
<script src="{{asset('assets/backend/js/sweetalert2.js')}}"></script>
<script src="{{asset('assets/frontend/js/imagesloaded.pkgd.min.js')}}"></script>
<script src="{{asset('assets/frontend/js/isotope.pkgd.min.js')}}"></script>
<script src="{{asset('assets/common/js/toastr.min.js')}}"></script>
<script src="{{asset('assets/frontend/js/slick.min.js')}}"></script>
<script src="{{asset('assets/backend/js/jquery.nice-select.min.js')}}"></script>
<script src="{{asset('assets/frontend/js/main.js')}}"></script>
<script src="{{asset('assets/frontend/js/main2.js')}}"></script>

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

{{--Copy to clipboard--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>
<script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>
<script>
    function setupClipboard(id, targetId) {
        const clipboard = new ClipboardJS(id, {
            text: function() {
                return document.querySelector(targetId).innerText.trim();
            }
        });

        clipboard.on('success', function(e) {
            // Update the button text to "Copied" when the address is successfully copied
            const copyButton = document.querySelector(id);
            copyButton.textContent = 'Copied';

            // Optionally, reset the button text after a short delay
            setTimeout(function() {
                copyButton.textContent = 'Copy';
            }, 2000); // Reset to "Copy" after 2 seconds
        });

        clipboard.on('error', function(e) {
            // Handle copy errors, if any.
            console.error('Copy failed: ' + e.action);
        });
    }

    // Set up Clipboard for each section
    setupClipboard('#copy-btc', '#btc-address-1');
    setupClipboard('#copy-btc-2', '#btc-address-2');
    setupClipboard('#copy-eth', '#eth-address');
</script>
<script>
    var clipboardBTC = new ClipboardJS('#copy-btc-1');
    var clipboardETH = new ClipboardJS('#copy-eth');
    var clipboardUSDT = new ClipboardJS('#copy-usdt'); // Define clipboard for USDT
</script>
{{--    end copy to clipboard--}}

@include('frontend.partials.google-captcha')
@include('frontend.partials.gdpr-cookie')
@include('frontend.partials.inline-script')
@include('frontend.partials.twakto')

<script>
    $( document ).ready(function() {
        $('[data-toggle="tooltip"]').tooltip({'placement': 'left','color':'green'});
    });
</script>


<x-sweet-alert-msg/>
@yield('scripts')


</body>
</html>
