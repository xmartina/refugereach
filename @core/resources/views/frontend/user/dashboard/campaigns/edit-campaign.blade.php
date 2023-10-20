@extends('frontend.user.dashboard.user-master')
@section('site-title')
    {{__('Edit Campaign')}}
@endsection
@section('style')
    <x-media.css/>
    <link rel="stylesheet" href="{{asset('assets/backend/css/summernote-bs4.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/bootstrap-tagsinput.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/select2.min.css')}}">
@endsection

@section('section')

    <div class="header-area-wrap d-flex justify-content-between">
        <h4 class="header-title">{{__('Edit Campaign')}}</h4>
        <div class="btn-wrapper">
            <a href="{{route('user.campaign.all')}}" class="btn btn-info">{{__('All Campaigns')}}</a>
            <a href="{{route('user.campaign.new')}}" class="btn btn-secondary ml-1">{{__('Add New')}}</a>
        </div>
    </div>
    <form action="{{route('user.campaign.update')}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="donation_id" value="{{$donation->id}}">
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="title">{{__('Title')}}</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{$donation->title}}">
                </div>


                <div class="form-group permalink_label">
                    <label class="text-dark">{{__('Permalink / Slug * :')}}
                        <span id="slug_show" class="display-inline"></span>
                        <span id="slug_edit" class="display-inline">
                                 <button class="btn btn-warning btn-sm slug_edit_button px-2 py-1 ml-1"> <i class="fas fa-edit"></i> </button>
                                  <input type="text" name="slug" value="{{$donation->slug}}" class="form-control blog_slug mt-2" style="display: none">
                                  <button class="btn btn-info btn-sm slug_update_button mt-2 px-2 py-1" style="display: none">{{__('Update')}}</button>
                            </span>
                    </label>
                </div>


                <div class="form-group">
                    <label>{{__('Content')}}</label>
                    <input type="hidden" name="cause_content" value="{{$donation->cause_content}}">
                    <div class="summernote" data-content='{{$donation->cause_content}}'></div>
                </div>
                <div class="form-group">
                    <label for="amount">{{__('Amount')}}</label>
                    <input type="number" class="form-control" id="amount" name="amount" value="{{$donation->amount}}">
                </div>
                <div class="form-group">
                    <label for="excerpt">{{__('Excerpt')}}</label>
                    <textarea class="form-control" name="excerpt" rows="5"
                              placeholder="{{__('expert')}}">{{$donation->excerpt}}</textarea>
                </div>
                <div class="form-group">
                    <label for="categories_id"><strong>{{__('Category')}}</strong></label>
                    <select name="categories_id" class="form-control">
                        @foreach($all_category as $cat)
                            <option value="{{$cat->id}}"
                                    @if($cat->id == $donation->categories_id) selected @endif>{{$cat->title}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="date">{{__('Deadline')}}</label>
                    <input type="date" class="form-control" value="{{$donation->deadline}}" name="deadline">
                </div>


                <div class="form-group">
                    <label for="featured"><strong>{{__('Gift')}}</strong></label>
                    <label class="switch">
                        <input type="checkbox" name="gift_status" class="add_gift_status" @if(!empty($donation->gift_status)) checked @endif>
                        <span class="slider"></span>
                    </label>
                </div>


                <div class="gift_select_wrapper">
                    <div class="form-group data">
                        <label><strong>{{__('Select Gift')}}</strong></label>
                        <select name="gifts[]" class="form-control gifts" multiple>
                            @foreach($all_gifts as $gift)
                                <option value="{{$gift->id}}"
                                @foreach($donation->gift ?? [] as $gift_item)
                                    {{ $gift_item->id == $gift->id ? 'selected' : '' }}
                                 @endforeach
                                    >{{$gift->title}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>


                @if(!empty(get_static_option('user_campaign_metadata_status')))
                <div class="form-group">
                    <label for="meta_title">{{__('Meta Title')}}</label>
                    <input type="text" name="meta_title" value="{{$donation->meta_title}}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="meta_tags">{{__('Meta Tags')}}</label>
                    <input type="text" name="meta_tags" class="form-control" data-role="tagsinput"
                           value="{{$donation->meta_tags}}" id="meta_tags">
                </div>
                <div class="form-group">
                    <label for="meta_description">{{__('Meta Description')}}</label>
                    <textarea name="meta_description" class="form-control" rows="5"
                              >{{$donation->meta_description}}</textarea>
                </div>
                <div class="form-group">
                    <label for="meta_title">{{__('Og Meta Title')}}</label>
                    <input type="text" name="meta_title" value="{{$donation->meta_title}}" class="form-control">
                </div>

                <div class="form-group">
                    <label for="meta_description">{{__('Og Meta Description')}}</label>
                    <textarea name="meta_description" class="form-control" rows="5"
                              >{{$donation->meta_description}}</textarea>
                </div>
                <div class="form-group">
                    <label for="image">{{__('Og Meta Image')}}</label>
                    <div class="media-upload-btn-wrapper">
                        <div class="img-wrap">
                            {!! render_attachment_preview_for_admin($donation->og_meta_image) !!}
                        </div>
                        <input type="hidden" name="og_meta_image" value="{{$donation->og_meta_image}}">
                        <button type="button" class="btn btn-info media_upload_form_btn"
                                data-btntitle="{{__('Select Donation Image')}}"
                                data-modaltitle="{{__('Upload Donation Image')}}" data-toggle="modal"
                                data-target="#media_upload_modal">
                            {{__('Change Image')}}
                        </button>
                    </div>

                </div>
                @endif
                <div class="form-group">
                    <label for="image">{{__('Image')}}</label>
                    <div class="media-upload-btn-wrapper">
                        <div class="img-wrap">
                            {!! render_attachment_preview_for_admin($donation->image) !!}
                        </div>
                        <input type="hidden" name="image" value="{{$donation->image}}">
                        <button type="button" class="btn btn-info media_upload_form_btn"
                                data-btntitle="{{__('Select Donation Image')}}"
                                data-modaltitle="{{__('Upload Donation Image')}}" data-toggle="modal"
                                data-target="#media_upload_modal">
                            {{__('Change Image')}}
                        </button>
                    </div>
                    <small>{{__('Recommended image size 1920x1280')}}</small>
                </div>
                <div class="form-group">
                    <label for="image">{{__('Image Gallery')}}</label>
                    <div class="media-upload-btn-wrapper">
                        <div class="img-wrap">
                            {!! render_gallery_image_attachment_preview($donation->image_gallery) !!}
                        </div>
                        <input type="hidden" name="image_gallery" value="{{$donation->image_gallery}}">
                        <button type="button" class="btn btn-info media_upload_form_btn" data-mulitple="true"
                                data-btntitle="{{__('Select Image')}}" data-modaltitle="{{__('Upload Image')}}"
                                data-toggle="modal" data-target="#media_upload_modal">
                            {{__('Upload Images')}}
                        </button>
                    </div>
                    <small>{{__('Recommended image size 1920x1280')}}</small>
                </div>
                <div class="form-group">
                    <label for="image">{{__('Medical Documents')}}</label>
                    <div class="media-upload-btn-wrapper">
                        <div class="img-wrap">
                            {!! render_gallery_image_attachment_preview($donation->medical_document) !!}
                        </div>
                        <input type="hidden" name="medical_document" value="{{$donation->medical_document}}">
                        <button type="button" class="btn btn-info media_upload_form_btn" data-mulitple="true" data-btntitle="{{__('Select Document')}}" data-modaltitle="{{__('Upload Document')}}" data-toggle="modal" data-target="#media_upload_modal">
                            {{__('Upload Images')}}
                        </button>
                    </div>
                    <small>{{__('Recommended image size 1920x1280')}}</small>
                </div>
                <div class="iconbox-repeater-wrapper">
                    @php
                        $faq_items = !empty($donation->faq) ? unserialize($donation->faq,['class' => false]) : ['title' => ['']];
                    @endphp
                    @forelse($faq_items['title'] as $faq)
                        <div class="all-field-wrap">
                            <div class="form-group">
                                <label for="faq">{{__('Faq Title')}}</label>
                                <input type="text" name="faq[title][]" class="form-control" value="{{$faq}}">
                            </div>
                            <div class="form-group">
                                <label for="faq_desc">{{__('Faq Description')}}</label>
                                <textarea name="faq[description][]"
                                          class="form-control">{{$faq_items['description'][$loop->index] ?? ''}}</textarea>
                            </div>
                            <div class="action-wrap">
                                <span class="add"><i class="fas fa-plus"></i></span>
                                <span class="remove"><i class="fas fa-trash"></i></span>
                            </div>
                        </div>
                    @empty
                        <div class="all-field-wrap">
                            <div class="form-group">
                                <label for="faq">{{__('Faq Title')}}</label>
                                <input type="text" name="faq[title][]" class="form-control"
                                       placeholder="{{__('faq title')}}">
                            </div>
                            <div class="form-group">
                                <label for="faq_desc">{{__('Faq Description')}}</label>
                                <textarea name="faq[description][]" class="form-control"
                                          placeholder="{{__('faq description')}}"></textarea>
                            </div>
                            <div class="action-wrap">
                                <span class="add"><i class="fas fa-plus"></i></span>
                                <span class="remove"><i class="fas fa-trash"></i></span>
                            </div>
                        </div>
                    @endforelse
                </div>
                <button id="update" type="submit"
                        class="submit-btn margin-top-40">{{__('Update Campaign')}}</button>
            </div>
        </div>
    </form>
    <x-media.markup
            :userUpload="true"
            :imageUploadRoute="route('user.upload.media.file')">
    </x-media.markup>
@endsection

@section('scripts')
    <script src="{{asset('assets/backend/js/select2.min.js')}}"></script>s
    <script>
        (function ($) {
            "use strict";
            $(document).ready(function () {

                $('.gifts').select2();

                let gift_status = '{{$donation->gift_status}}';

                if(gift_status != 'on'){
                    $('.gifts').prop('disabled',true);
                }
                $(document).on('change','.add_gift_status',function(){
                    $('.gifts').prop('disabled',false);
                    if(this.checked){
                        $('.gift_select_wrapper').removeClass('d-none')
                    }else{
                        $('.gift_select_wrapper').addClass('d-none')
                    }
                });

                function converToSlug(slug){
                    let finalSlug = slug.replace(/[^a-zA-Z0-9]/g, ' ');
                    finalSlug = slug.replace(/  +/g, ' ');
                    finalSlug = slug.replace(/\s/g, '-').toLowerCase().replace(/[^\w-]+/g, '-');
                    return finalSlug;
                }

                //Permalink Code
                var sl =  $('.blog_slug').val();
                var url = `{{url('/donation/')}}/` + sl;
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
                    var url = `{{url('/donation/')}}/` + slug;
                    $('#slug_show').text(url);
                    $('.blog_slug').hide();
                });
                
                $(document).on('click','.mobile_nav',function(e){
                  e.preventDefault(); 
                   $(this).parent().toggleClass('show');
               });
               
                <x-btn.update/>
                $('.summernote').summernote({
                    height: 500,   //set editable area's height
                    codemirror: { // codemirror options
                        theme: 'monokai'
                    },
                    callbacks: {
                        onChange: function (contents, $editable) {
                            $(this).prev('input').val(contents);
                        }
                    }
                });

                if ($('.summernote').length > 0) {
                    $('.summernote').each(function (index, value) {
                        $(this).summernote('code', $(this).data('content'));
                    });
                }
            });
        })(jQuery)
    </script>
    <script src="{{asset('assets/backend/js/summernote-bs4.js')}}"></script>
    <script src="{{asset('assets/backend/js/bootstrap-tagsinput.js')}}"></script>
    <x-media.js
            :deleteRoute="route('user.upload.media.file.delete')"
            :imgAltChangeRoute="route('user.upload.media.file.alt.change')"
            :allImageLoadRoute="route('user.upload.media.file.all')">
    </x-media.js>
    <x-repeater/>

    <script>
        $(function (){
            let data;
            data = $('.data').children();
            data[data.length-1].remove();
        });
    </script>

@endsection
