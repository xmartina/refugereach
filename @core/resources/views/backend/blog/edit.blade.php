@extends('backend.admin-master')
@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/bootstrap-tagsinput.css')}}">
    <x-summernote.css/>
    <x-media.css/>
@endsection
@section('site-title')
    {{__('Edit Blog Post')}}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                <x-msg.success/>
                <x-msg.error/>
            </div>
            <div class="col-lg-12 mt-t">
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrapp">
                            <h4 class="header-title">{{__('Edit Blog Post')}}  </h4>
                            <div class="header-title">
                                <a href="{{ route('admin.blog') }}"
                                   class="btn btn-primary mt-4 pr-4 pl-4">{{__('All Blog Post')}}</a>
                            </div>
                        </div>
                        <form action="{{route('admin.blog.update',$blog_post->id)}}" method="post"
                              enctype="multipart/form-data">
                            @csrf


                            <div class="form-group">
                                <label for="title">{{__('Title')}}</label>
                                <input type="text" class="form-control" name="title"
                                       value="{{$blog_post->title}}" id="title">
                            </div>

                            <div class="form-group permalink_label">
                                <label class="text-dark">{{__('Permalink / Slug * : ')}}
                                    <span id="slug_show" class="display-inline"></span>
                                    <span id="slug_edit" class="display-inline">
                                         <button class="btn btn-warning btn-sm slug_edit_button px-2 py-1 ml-1"> <i class="fas fa-edit"></i> </button>
                                          <input type="text" name="slug" value="{{$blog_post->slug}}" class="form-control blog_slug mt-2" style="display: none">
                                          <button class="btn btn-info btn-sm slug_update_button mt-2 px-2 py-1" style="display: none">{{__('Update')}}</button>
                                    </span>
                                </label>
                            </div>

                            <div class="form-group">
                                <label>{{__('Blog Content')}}</label>
                                <input type="hidden" name="blog_content" value="{{ $blog_post->blog_content }}">
                                <div class="summernote" data-content="{{ $blog_post->blog_content }}"></div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="author">{{__('Author')}}</label>
                                    <input type="text" class="form-control" name="author"
                                           value="{{$blog_post->author}}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="title">{{__('Blog Tags')}}</label>
                                    <input type="text" class="form-control" name="tags"
                                           data-role="tagsinput" value="{{$blog_post->tags}}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="meta_tags">{{__('Meta Tags')}}</label>
                                    <input type="text" class="form-control" name="meta_tags"
                                           data-role="tagsinput" value="{{$blog_post->meta_tags}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="title">{{__('Excerpt')}}</label>
                                    <textarea name="excerpt" id="excerpt" class="form-control max-height-150" cols="30"
                                              rows="10">{{$blog_post->excerpt}}</textarea>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="meta_title">{{__('Meta Title')}}</label>
                                    <input type="text" class="form-control" name="meta_title"
                                           value="{{$blog_post->meta_title}}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="og_meta_title">{{__('Og Meta Title')}}</label>
                                    <input type="text" class="form-control" name="og_meta_title"
                                           value="{{$blog_post->og_meta_title}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="meta_description">{{__('Meta Description')}}</label>
                                    <textarea type="text" class="form-control" name="meta_description"
                                              rows="5" cols="10">{{$blog_post->meta_description}}</textarea>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="og_meta_description">{{__('Og Meta Description')}}</label>
                                    <textarea type="text" class="form-control"
                                              name="og_meta_description" rows="5"
                                              cols="10">{{$blog_post->og_meta_description}} </textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 col-lg-6">
                                    <label for="image">{{__('Blog Image')}}</label>
                                    <div class="media-upload-btn-wrapper">
                                        <div class="img-wrap">
                                            @php
                                                $image = get_attachment_image_by_id($blog_post->image,null,true);
                                                $image_btn_label = 'Upload Image';
                                            @endphp
                                            @if (!empty($image))
                                                <div class="attachment-preview">
                                                    <div class="thumbnail">
                                                        <div class="centered">
                                                            <img class="avatar user-thumb" src="{{$image['img_url']}}"
                                                                 alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                                @php  $image_btn_label = 'Change Image'; @endphp
                                            @endif
                                        </div>
                                        <input type="hidden" id="image" name="image"
                                               value="{{$blog_post->image}}">
                                        <button type="button" class="btn btn-info media_upload_form_btn"
                                                data-btntitle="{{__('Select Image')}}"
                                                data-modaltitle="{{__('Upload Image')}}" data-toggle="modal"
                                                data-target="#media_upload_modal">
                                            {{__($image_btn_label)}}
                                        </button>
                                    </div>
                                    <small class="form-text text-muted">{{__('allowed image format: jpg,jpeg,png')}}</small>
                                </div>
                                <div class="form-group col-md-6 col-lg-6">
                                    <label for="og_meta_image">{{__('Og Meta Image')}}</label>
                                    <div class="media-upload-btn-wrapper">
                                        <div class="img-wrap">
                                            @php
                                                $image = get_attachment_image_by_id($blog_post->og_meta_image,null,true);
                                                $image_btn_label = 'Upload Image';
                                            @endphp
                                            @if (!empty($image))
                                                <div class="attachment-preview">
                                                    <div class="thumbnail">
                                                        <div class="centered">
                                                            <img class="avatar user-thumb" src="{{$image['img_url']}}"
                                                                 alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                                @php  $image_btn_label = 'Change Image'; @endphp
                                            @endif
                                        </div>
                                        <input type="hidden" id="og_meta_image" name="og_meta_image"
                                               value="{{$blog_post->og_meta_image}}">
                                        <button type="button" class="btn btn-info media_upload_form_btn"
                                                data-btntitle="{{__('Select Image')}}"
                                                data-modaltitle="{{__('Upload Image')}}" data-toggle="modal"
                                                data-target="#media_upload_modal">
                                            {{__($image_btn_label)}}
                                        </button>
                                    </div>
                                    <small class="form-text text-muted">{{__('allowed image format: jpg,jpeg,png')}}</small>
                                </div>

                            </div>

                            <div class="row">
                                <div class="form-group  col-md-6">
                                    <label for="category">{{__('Category')}}</label>
                                    <select name="category" class="form-control" id="category">
                                        <option value="">{{__("Select Category")}}</option>
                                        @foreach($all_category as $category)
                                            <option @if($category->id == $blog_post->blog_categories_id) selected
                                                    @endif  value="{{$category->id}}">{{purify_html($category->name)}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="status">{{__('Status')}}</label>
                                    <select name="status" class="form-control" id="status">
                                        <option value="draft" {{($blog_post->status == 'draft' )? 'selected' : ''}}>{{__("Draft")}}</option>
                                        <option value="publish" {{($blog_post->status  == 'publish')? 'selected' : ''}}>{{__("Publish")}}</option>
                                    </select>
                                </div>
                            </div>
                            <button type="submit" id="update"
                                    class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Post')}}</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-media.markup/>
@endsection
@section('script')
    <x-summernote.js/>
    <x-media.js/>
    <script src="{{asset('assets/backend/js/bootstrap-tagsinput.js')}}"></script>
    <script>
        (function ($) {
            "use strict";
            $(document).ready(function () {
                <x-btn.update/>

                function converToSlug(slug){
                    let finalSlug = slug.replace(/[^a-zA-Z0-9]/g, ' ');
                    finalSlug = slug.replace(/  +/g, ' ');
                    finalSlug = slug.replace(/\s/g, '-').toLowerCase().replace(/[^\w-]+/g, '-');
                    return finalSlug;
                }

                //Permalink Code
                var sl =  $('.blog_slug').val();
                var url = `{{url('/blog/')}}/` + sl;
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
                    var url = `{{url('/blog/')}}/` + slug;
                    $('#slug_show').text(url);
                    $('.blog_slug').hide();
                });


                $('.summernote').summernote({
                    height: 400,   //set editable area's height
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
@endsection
