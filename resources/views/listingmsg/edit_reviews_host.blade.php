@extends('template')
@section('main')  

    <div class="container margin-top30">
      <div class="col-md-3">
        <div class="panel panel-default text-center">
          <a href="{{ url('users/show/'.$result->users->id) }}" title="{{ trans('messages.dashboard.view_profile') }}">
            <img width="225" height="225" title="{{ $result->users->first_name }}" src="{{ $result->users->profile_src }}" class="img-responsive-height" alt="{{ $result->users->first_name }}">
          </a>
          
          <div class="add-photo"><a href="#">{{ $result->users->first_name }}</a></div>
          <div class="panel-body">
            <div class="col-md-2 l-pad-none r-pad-none mb20 mrg-top-10">
              <a href="{{ url('properties/'.@$result->property_id) }}">
                <img src="{{ @$result->properties->cover_photo }}" alt="" width="40" height="40">
              
              </a>
            </div>
            <div class="col-md-10 l-pad-none r-pad-none mb20 mrg-top-10">
              <small class="float-left pad-l-5">{{ trans('messages.reviews.stayed_at') }}
              {{ @$result->properties->name }}</small>
              <small class="float-left pad-l-5">{{ @$result->dates }}</small>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-9">    
        <div class="panel panel-default {{ @$review_id?'display-off':''}} opening-div">
          <div class="panel-body h4">
            {{ trans('messages.reviews.write_review_for') }} {{ $result->users->first_name }}
          </div>
          <div class="panel-footer ">
            <p>
              {{ trans('messages.reviews.write_review_host_desc1') }}
              {{ trans('messages.reviews.write_review_host_desc2',['site_name'=>$site_name]) }}
            </p>
            <p>
              {{ trans('messages.reviews.write_review_host_desc3') }}
            </p>
            <button class="btn btn-primary btn-large" id="open-review">
              {{ trans('messages.reviews.write_a_review') }}
            </button>
          </div>
        </div>   
        <div class="panel panel-default {{ @$review_id?'':'display-off'}} review-div">
          <input type="hidden" value="{{ $review_id }}" name="review_id" id="review_id">
          <input type="hidden" value="{{ $result->id }}" name="booking_id" id="booking_id">
          <form id="guest-form" method="post" class="edit_review">
            <div class="panel-footer">
              <div class="input-fields mb20">
                <h4>{{ trans('messages.reviews.describe_your_exp') }} <small>(required)</small></h4>
                <p>{{ trans('messages.reviews.describe_your_exp_host_desc',['first_name'=>$result->users->first_name]) }}</p>
                <textarea rows="5" placeholder="What was it like to host this guest?" name="message" id="review_message" data-behavior="countable" cols="40" maxlength="500" class="form-control mb10">{{ @$result->review_details($review_id)->message }}</textarea>
                <span class="float-right">{{ trans('messages.reviews.500_words_left') }}</span>
                <div class="clearfix"></div>
                {{ trans('messages.reviews.describe_your_exp_host_desc2') }}
              </div>
              <div class="input-fields mb20">
                <h4>{{ trans('messages.reviews.private_guest_feedback') }}</h4>
                <p>{{ trans('messages.reviews.private_guest_feedback_desc') }}</p>
                <textarea rows="5" placeholder="Thank your guest for visiting or offer some tips to help them improve for their next trip." name="secret_feedback" id="secret_feedback" cols="40" class="form-control mb10">{{ @$result->review_details($review_id)->secret_feedback }}</textarea>
              </div>
              <div class="input-fields mb20">
                <h4>{{ trans('messages.reviews.cleanliness') }}</h4>
                <p class="mb10">{{ trans('messages.reviews.cleanliness_host_desc') }}</p>
                <input type="hidden" name="cleanliness" id="cleanliness" value="{{ @$result->review_details($review_id)->cleanliness }}">
                <div class="background" style="font-size:25px;">
                  @for($i=1; $i <=5 ; $i++)
                    <i id="cleanliness-{{$i}}" class="icon icon-star {{ $i <= @$result->review_details($review_id)->cleanliness? 'icon-beach':'icon-light-gray' }} icon-click"></i> 
                  @endfor
                </div> 
              </div>
              <div class="input-fields mb20">
                <h4>{{ trans('messages.reviews.communication') }}</h4>
                <p class="mb10">{{ trans('messages.reviews.communication_host_desc') }}</p>
                <input type="hidden" name="communication" id="communication" value="{{ @$result->review_details($review_id)->communication }}">
                <div class="background" style="font-size:25px;">
                  @for($i=1; $i <=5 ; $i++)
                    <i id="communication-{{$i}}" class="icon icon-star {{ $i <= @$result->review_details($review_id)->communication? 'icon-beach':'icon-light-gray' }} icon-click"></i> 
                  @endfor
                </div> 
              </div>
              <div class="input-fields mb20">
                <h4>{{ trans('messages.reviews.observance_house_rules') }}</h4>
                <p class="mb10">{{ trans('messages.reviews.observance_house_rules_desc') }}</p>
                <input type="hidden" name="house_rules" id="house_rules" value="{{ @$result->review_details($review_id)->house_rules }}">
                <div class="background" style="font-size:25px;">
                  @for($i=1; $i <=5 ; $i++)
                    <i id="house_rules-{{$i}}" class="icon icon-star {{ $i <= @$result->review_details($review_id)->house_rules? 'icon-beach':'icon-light-gray' }} icon-click"></i> 
                  @endfor 
                </div>
              </div>
              <!--<div class="input-fields mb20">
                <h4>{{ trans('messages.reviews.would_you_recommend') }}</h4>
                <p>{{ trans('messages.reviews.would_you_recommend_host_desc') }}</p> 
                <input type="hidden" name="recommend" id="recommend" value="{{ @$result->review_details($review_id)->recommend }}">
                <label class="h5 mrg-right-20 thumb-icon {{@$result->review_details($review_id)->recommend == 0?'icon-unselect':''}}" data-rel="0">
                  <i class="icon icon-thumbs-down icon-size-2"></i>
                  {{ trans('messages.reviews.no') }}
                </label>
                <label class="h5 thumb-icon" data-rel="1">
                  <i class="icon icon-thumbs-up icon-size-2 {{@$result->review_details($review_id)->recommend == 1?'icon-select':''}}" ></i>
                  {{ trans('messages.reviews.yes') }}!
                </label>             
              </div>-->
              <div>
                <button class="btn ex-btn btn-large" type="submit">
                  {{ trans('messages.reviews.submit') }}
                </button>
              </div>
            </div>
          </form>
        </div>             
      </div>
    </div>
  @push('scripts')
    <script type="text/javascript">
      $('#open-review').on( 'click', function(){
        $('.opening-div').addClass('display-off');
        $('.review-div').removeClass('display-off');
      });
      $('.icon-click').on('click', function(){
        var temp = $(this).attr('id');
        temp = temp.split('-');
        var name = temp[0];
        var val = temp[1];
        var prv = $('#'+name).val();
        $('#'+name).val(val);
        for(i = 1; i <= prv; i++){
          $('#'+name+'-'+i).removeClass('icon-beach');
          $('#'+name+'-'+i).addClass('icon-light-gray');
        }
        for(i = 1; i <= val; i++){
          $('#'+name+'-'+i).removeClass('icon-light-gray');
          $('#'+name+'-'+i).addClass('icon-beach');
        }
      })
      $('.thumb-icon').on('click', function(){
        $('.thumb-icon').removeClass('icon-select');
        $('.thumb-icon').removeClass('icon-unselect');
        var rec = $(this).attr('data-rel');
        $('#recommend').attr('value', rec);
        if(rec == 0)
          $(this).addClass('icon-unselect');
        else
          $(this).addClass('icon-select');
      })
      $('#guest-form').on('submit', function(e){
        e.preventDefault();
        var booking_id = $('#booking_id').val();
        var review_id = $('#review_id').val();
        var message = $('#review_message').val();
        var secret_feedback = $('#secret_feedback').val(); 
        var cleanliness = $('#cleanliness').val();
        var communication = $('#communication').val();
        var house_rules = $('#house_rules').val();
        var recommend = $('#recommend').val();
        dataURL = APP_URL + "/reviews/edit/" + booking_id;

        $.ajax({
          url: dataURL,
          data: {
            'review_id': review_id,
            'message': message,
            'secret_feedback': secret_feedback, 
            'cleanliness': cleanliness,
            'communication': communication,
            'house_rules': house_rules,
            'recommend' : recommend,
          },
          type: 'post',
          async: false,
          dataType: 'json',
          success: function (result) {
             if(result.success){
              window.location.href = APP_URL + "/users/reviews"
             }
          },
          error: function (request, error) {
            // This callback function will trigger on unsuccessful action
            //show_error_message('Det har oppstått nettverksfeil vennligst prøv igjen');
          },
        });
      })
    </script>
  @endpush
@stop    