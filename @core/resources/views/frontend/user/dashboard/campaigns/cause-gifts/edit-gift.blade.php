@extends('frontend.user.dashboard.user-master')
@section('site-title')
    {{__('Edit Gift')}}
@endsection

@section('style')
    <x-media.css/>
    <link rel="stylesheet" href="{{asset('assets/backend/css/summernote-bs4.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/bootstrap-tagsinput.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/flatpickr.min.css')}}">
@endsection

@section('section')
  <div class="card">
      <div class="card-body">
          <h5 class="modal-title">{{__('Edit Cause Gift')}}
              <a class="btn btn-success pull-right btn-sm" href="{{route('user.campaign.gift.all')}}">{{__('Go Back')}}</a>
          </h5>

          <form action="{{route('user.campaign.gift.update')}}" method="post">

              <input type="hidden" name="gift_id" value="{{$gift->id}}">
              <div class="modal-body">
                  @csrf
                  <div class="form-group">
                      <label for="name">{{__('Title')}}</label>
                      <input type="text" class="form-control" name="title" value="{{$gift->title}}">
                  </div>

                  <div class="form-group">
                      <label for="name">{{__('Amount')}}</label>
                      <input type="number" class="form-control" name="amount" value="{{$gift->amount}}">
                  </div>

                  @php
                      $gifts = !empty($gift->gifts) ? json_decode($gift->gifts)  : [];
                  @endphp

                  @forelse($gifts as $item)
                      <div class="iconbox-repeater-wrapper">
                          <div class="all-field-wrap">
                              <div class="form-group">
                                  <label for="name">{{__('Gift ')}}</label>
                                  <input type="text" class="form-control" name="gifts[]" value="{{ $item ?? '' }}">
                              </div>
                              <div class="action-wrap">
                                  <span class="add"><i class="fa fa-plus"></i></span>
                                  <span class="remove"><i class="fa fa-trash"></i></span>
                              </div>
                          </div>
                      </div>
                  @empty
                      <div class="iconbox-repeater-wrapper">
                          <div class="all-field-wrap">
                              <div class="form-group">
                                  <label for="name">{{__('Gift ')}}</label>
                                  <input type="text" class="form-control" name="gifts[]" placeholder="{{__('Gift')}}">
                              </div>
                              <div class="action-wrap">
                                  <span class="add"><i class="fa fa-plus"></i></span>
                                  <span class="remove"><i class="fa fa-trash"></i></span>
                              </div>
                          </div>
                      </div>
                  @endforelse

                  <div class="form-group">
                      <label for="description">{{__('Description')}}</label>
                      <textarea name="description" class="form-control" cols="30" rows="4"
                                placeholder="{{__('Description')}}">{{$gift->description}}</textarea>
                  </div>
                  <div class="row">
                      <div class="form-group col-lg-6">
                          <label for="status">{{__('Status')}}</label>
                          <select name="status" id="status"  class="form-control">
                              <option @if($gift->status === 'publish') selected @endif value="publish">{{__('Publish')}}</option>
                              <option @if($gift->status === 'draft') selected @endif value="draft">{{__('Draft')}}</option>
                          </select>
                      </div>

                      <div class="form-group col-lg-6">
                          <label for="edit_designation">{{__('Delivery Date')}}</label>
                          <input type="text" class="form-control date-flat" value="{{$gift->delivery_date}}" name="delivery_date" placeholder="{{__('Delivery Date')}}">
                      </div>

                      <div class="form-group col-lg-12">
                          <label for="image">{{__('Image')}}</label>
                          <div class="media-upload-btn-wrapper">
                              <div class="img-wrap">
                                  {!! render_attachment_preview_for_admin($gift->image) !!}
                              </div>
                              <input type="hidden" name="image" value="{{$gift->image}}">
                              <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="{{__('Select Donation Image')}}" data-modaltitle="{{__('Upload Donation Image')}}" data-toggle="modal" data-target="#media_upload_modal">
                                  {{'Change Image'}}
                              </button>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="modal-footer">
                  <button id="submit" type="submit" class="btn btn-primary">{{__('Submit')}}</button>
              </div>
          </form>

      </div>
  </div>

  <x-media.markup
          :userUpload="true"
          :imageUploadRoute="route('user.upload.media.file')">
  </x-media.markup>
@endsection
@section('scripts')
  <script src="{{asset('assets/backend/js/summernote-bs4.js')}}"></script>
  <script src="{{asset('assets/backend/js/bootstrap-tagsinput.js')}}"></script>
  <script src="{{asset('assets/backend/js/flatpickr.js')}}"></script>
    <script>
        (function($){
            "use strict";
            $(document).ready(function () {

                //Date Picker
                flatpickr('.date-flat', {
                    enableTime: false,
                    dateFormat: "d-m-Y",
                });
                
                $(document).on('click','.mobile_nav',function(e){
                  e.preventDefault(); 
                   $(this).parent().toggleClass('show');
               });
               
                <x-btn.submit/>

                $('.summernote').summernote({
                    height: 400,   //set editable area's height
                    codemirror: { // codemirror options
                        theme: 'monokai'
                    },
                    callbacks: {
                        onChange: function(contents, $editable) {
                            $(this).prev('input').val(contents);
                        }
                    }
                });
            });
        })(jQuery);
    </script>

  <x-media.js
          :deleteRoute="route('user.upload.media.file.delete')"
          :imgAltChangeRoute="route('user.upload.media.file.alt.change')"
          :allImageLoadRoute="route('user.upload.media.file.all')">
  </x-media.js>
  <x-repeater/>
@endsection
