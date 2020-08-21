@extends('template')
@section('main')
  <div class="container margin-top30">
    <div class="col-md-3">
      <div class="panel panel-default">
          <div class="panel-footer">
            <div class="panel">
              @include('common.sidenav')
            </div>
          </div>
      </div>
    </div>

    <div class="col-md-9">
      <div id="exTab2" class="container"> 
        <ul class="nav nav-tabs">
          <li class="active">
            <a  href="#1" data-toggle="tab">{{ trans('messages.reviews.reviews_about_you') }}</a>
          </li>
          <li>
            <a href="#2" data-toggle="tab">
              {{ trans('messages.reviews.reviews_by_you') }}
              @if($reviewsToWriteCount)
                <i class="alert-count position-super">({{ $reviewsToWriteCount }})</i>
              @endif
            </a>
          </li>
        </ul>

        <div class="tab-content l-pad-none r-pad-none">
          <div class="tab-pane active" id="1">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">{{ trans_choice('messages.reviews.review',2) }}</h3>
              </div>
              @if($reviewsAboutYou->count())
              <div class="panel-body">
                <p>
                  {{ trans('messages.reviews.reviews_about_you_desc') }}
                </p>
                <ul class="list-layout reviews-list row-space-top-4">

                  @for($i=0; $i < $reviewsAboutYou->count(); $i++)
                    @if(!$reviewsAboutYou[$i]->hidden_review)
                      <li class="media reviews-list-item row-space-top-2">
                          <div class="pull-left text-center">
                            <a href="{{ url('/') }}/users/show/{{ $reviewsAboutYou[$i]->users->id }}">
                              <img width="68" height="68" title="{{ $reviewsAboutYou[$i]->users->first_name }}" src="{{ $reviewsAboutYou[$i]->users->profile_src }}" alt="{{ $reviewsAboutYou[$i]->users->first_name }}">
                            </a>                  
                            <div class="name"><a class="text-muted" href="{{ url('/') }}/users/show/{{ $reviewsAboutYou[$i]->sender_id }}">{{ $reviewsAboutYou[$i]->users->full_name }}</a></div>
                          </div>
                          <div class="media-body response">
                            <p>{{ $reviewsAboutYou[$i]->message }}</a></p>
                                <hr>
                            @if($reviewsAboutYou[$i]->bookings->host_id == Auth::user()->id)
                              <div class="row-space-top-2">
                                <p>
                                  <strong>
                                    <i aria-label="Private" data-behavior="tooltip" class="icon icon-lock icon-rausch"></i>
                                    {{ trans('messages.reviews.love_comments',['first_name'=>$reviewsAboutYou[$i]->users->first_name]) }}:
                                  </strong>
                                  <br>
                                  {{ $reviewsAboutYou[$i]->secret_feedback }}
                                </p>
                              </div>
                              <div class="row-space-top-2">
                                <p>
                                  <strong>
                                    <i aria-label="Private" data-behavior="tooltip" class="icon icon-lock icon-rausch"></i>
                                    {{ trans('messages.reviews.improve_comments',['first_name'=>$reviewsAboutYou[$i]->users->first_name]) }}:
                                  </strong>
                                  <br>
                                  {{ $reviewsAboutYou[$i]->improve_message }}
                                </p>
                              </div>
                              <div class="row-space-top-2">
                                <p>
                                  <strong>
                                    <i aria-label="Private" data-behavior="tooltip" class="icon icon-lock icon-rausch"></i>
                                    {{ trans('messages.reviews.accuracy_comments') }}:
                                  </strong>
                                  <br>
                                  {{ $reviewsAboutYou[$i]->accuracy_message }}
                                </p>
                              </div>
                              <div class="row-space-top-2">
                                <p>
                                  <strong>
                                    <i aria-label="Private" data-behavior="tooltip" class="icon icon-lock icon-rausch"></i>
                                    {{ trans('messages.reviews.cleanliness_comments') }}:
                                  </strong>
                                  <br>
                                  {{ $reviewsAboutYou[$i]->cleanliness_message }}
                                </p>
                              </div>
                              
                              <div class="row-space-top-2">
                                <p>
                                  <strong>
                                    <i aria-label="Private" data-behavior="tooltip" class="icon icon-lock icon-rausch"></i>
                                    {{ trans('messages.reviews.arrival_comments') }}:
                                  </strong>
                                  <br>
                                  {{ $reviewsAboutYou[$i]->arrival_message }}
                                </p>
                              </div>
                              
                              <div class="row-space-top-2">
                                <p>
                                  <strong>
                                    <i aria-label="Private" data-behavior="tooltip" class="icon icon-lock icon-rausch"></i>
                                    {{ trans('messages.reviews.amenities_comments') }}:
                                  </strong>
                                  <br>
                                  {{ $reviewsAboutYou[$i]->amenities_message }}
                                </p>
                              </div>
                              <div class="row-space-top-2">
                                <p>
                                  <strong>
                                    <i aria-label="Private" data-behavior="tooltip" class="icon icon-lock icon-rausch"></i>
                                    {{ trans('messages.reviews.communication_comments') }}:
                                  </strong>
                                  <br>
                                  {{ $reviewsAboutYou[$i]->communication_message }}
                                </p>
                              </div>
                              <div class="row-space-top-2">
                                <p>
                                  <strong>
                                    <i aria-label="Private" data-behavior="tooltip" class="icon icon-lock icon-rausch"></i>
                                    {{ trans('messages.reviews.location_comments') }}:
                                  </strong>
                                  <br>
                                  {{ $reviewsAboutYou[$i]->location_message }}
                                </p>
                              </div>
                              <div class="row-space-top-2">
                                <p>
                                  <strong>
                                    <i aria-label="Private" data-behavior="tooltip" class="icon icon-lock icon-rausch"></i>
                                    {{ trans('messages.reviews.value_comments') }}:
                                  </strong>
                                  <br>
                                  {{ $reviewsAboutYou[$i]->value_message }}
                                </p>
                              </div>
                            @else
                              <div class="row-space-top-2">
                                <p>
                                  <strong>
                                    <i aria-label="Private" data-behavior="tooltip" class="icon icon-lock icon-rausch"></i>
                                    {{ trans('messages.reviews.private_feedback',['first_name'=>$reviewsAboutYou[$i]->users->first_name]) }}:
                                  </strong>
                                  <br>
                                  {{ $reviewsAboutYou[$i]->secret_feedback }}
                                </p>
                              </div>
                            @endif
                            <p class="clearfix text-muted">
                              {{ $reviewsAboutYou[$i]->date_fy }}
                            </p>
                          </div>
                      </li>
                    @else
                      <li class="media reviews-list-item row-space-top-2">
                          <div class="pull-left text-center">
                            <a class="media-photo media-round" href="{{ url('/') }}/users/show/{{ $reviewsAboutYou[$i]->sender_id }}">
                              <img width="68" height="68" title="{{ $reviewsAboutYou[$i]->users->first_name }}" src="{{ $reviewsAboutYou[$i]->users->profile_src }}" alt="{{ $reviewsAboutYou[$i]->users->first_name }}">
                            </a>                  
                            <div class="name"><a class="text-muted" href="{{ url('/') }}/users/show/{{ $reviewsAboutYou[$i]->sender_id }}">{{ $reviewsAboutYou[$i]->users->full_name }}</a></div>
                          </div>
                          <div class="media-body response">

                          @if($reviewsAboutYou[$i]->hidden_review)
                            <div class="double-blind-hidden">
                              <div class="label label-info">
                                {{ trans('messages.reviews.review_is_hidden') }}
                              </div>
                              <p>
                                {{ trans('messages.reviews.pls_complete_your_part') }}.
                              </p>
                              <a href="{{ url('/') }}/reviews/edit/{{ $reviewsAboutYou[$i]->booking_id }}" class="btn">
                                {{ trans('messages.reviews.complete_review') }}
                              </a>
                            </div>
                          @endif
                          </div>
                          <div class="clearfix"></div>
                          <hr>
                      </li>
                    @endif
                  @endfor
                </ul>
              </div>
              @else
              <div class="panel-body">
                <p class="text-lead">
                  {{ trans('messages.reviews.no_review_desc',['site_name'=>$site_name]) }}
                </p>

                <ul class="list-layout reviews-list row-space-top-4">
                    <li class="reviews-list-item">
                      {{ trans('messages.reviews.no_review') }}
                    </li>
                </ul>
              </div>
              @endif
            </div>
          </div>
          <div class="tab-pane" id="2">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">{{ trans('messages.reviews.reviews_to_write') }}</h3>
              </div>

              @if($reviewsToWriteCount)
              <div class="panel-body">
                  <p>
                    {{ trans('messages.reviews.reviews_written_after_checkout') }}
                  </p>
                <ul class="list-layout reviews-list">
              @for($i=0; $i<$reviewsToWrite->count(); $i++)

               @if($reviewsToWrite[$i]->review_days > 0 && $reviewsToWrite[$i]->reviews->count() < 2)
                

                @if(@$reviewsToWrite[$i]->reviews->count() == 0)
      
                <?php
                 $write = 1;
                 ?>

                @endif

                @for($j=0; $j<$reviewsToWrite[$i]->reviews->count(); $j++)

                  @if(@$reviewsToWrite[$i]->reviews[$j]->sender_id != Auth::user()->id)
                 <?php
                 $write = 1;
                 ?>

                   @endif
                @endfor

               @endif

               @if(@$write == 1)
                <li class="media reviews-list-item row-space-2">
                  <div class="pull-left text-center">
                    <a href="{{ url('/') }}/users/show/{{ $reviewsToWrite[$i]->review_user(Auth::user()->id)->id }}">
                      <img width="68" height="68" title="{{ $reviewsToWrite[$i]->review_user(Auth::user()->id)->full_name }}" src="{{ $reviewsToWrite[$i]->review_user(Auth::user()->id)->profile_src }}" alt="{{ $reviewsToWrite[$i]->review_user(Auth::user()->id)->full_name }}">
                    </a>
                  <div class="name"><a class="text-muted" href="{{ url('/') }}/users/show/{{ $reviewsToWrite[$i]->review_user(Auth::user()->id)->id }}">
                    {{ $reviewsToWrite[$i]->review_user(Auth::user()->id)->full_name }}
                  </a></div>
                  </div>
                  <div class="media-body">
                    <p>
                      {{ trans('messages.reviews.you_have') }} <b>{{ str_replace('+','',$reviewsToWrite[$i]->review_days) }} {{ ($reviewsToWrite[$i]->review_days > 1) ? trans_choice('messages.reviews.day',2) : trans_choice('messages.reviews.day',1) }}</b> {{ trans('messages.reviews.to_submit_public_review') }} <a class="text-normal" href="{{ url('/') }}/users/show/{{ $reviewsToWrite[$i]->review_user(Auth::user()->id)->id }}">{{ $reviewsToWrite[$i]->review_user(Auth::user()->id)->full_name }}</a>.
                    </p>

                    <ul class="list-unstyled">
                      <li>
                        <a href="{{ url('/') }}/reviews/edit/{{ $reviewsToWrite[$i]->id }}">{{ trans('messages.reviews.write_a_review') }}</a>
                      </li>
                      <li>
                        <!--<a href="{{ url('/') }}/booking/receipt?code={{ $reviewsToWrite[$i]->code }}">{{ trans('messages.reviews.view_itinerary') }}</a>-->
                      </li>
                    </ul>
                  </div>
                </li>
               @endif
              @endfor
              </ul>
              </div>
              @else
              <div class="panel-body">
                <ul class="list-layout reviews-list">
                    <li class="reviews-list-item">
                    {{ trans('messages.reviews.nobody_to_review') }}
                    </li>
                </ul>
              </div>
              @endif
              <?php
              //dd($reviewsByYou->count());
               
              ?>
            </div>
            <div class="panel panel-default row-space-top-4">
              <div class="panel-heading">
                <h3 class="panel-title">{{ trans('messages.reviews.past_reviews_written') }}</h3>
              </div>
              @if($reviewsByYou->count())
              <div class="panel-body">
                  <ul class="list-layout reviews-list">
                  @for($i=0; $i<$reviewsByYou->count(); $i++)
                    <li class="reviews-list-item media row-space-top-2">
                      <a class="pull-left row-space-top-0 r-pad-none mrg-right-10" href="{{ url('/') }}/users/show/{{ $reviewsByYou[$i]->receiver_id }}">
                        <img width="50" height="50" title="{{ $reviewsByYou[$i]->users_from->first_name }}" src="{{ $reviewsByYou[$i]->users_from->profile_src }}" alt="{{ $reviewsByYou[$i]->users_from->first_name }}">
                      </a>   
                      <div class="media-body">
                        <h5>
                          {{ trans('messages.reviews.review_for') }} <a class="text-uppercase" href="{{ url('/') }}/users/show/{{ $reviewsByYou[$i]->receiver_id }}">{{ $reviewsByYou[$i]->users_from->first_name }}</a> of <a class="text-uppercase" href="{{ url('/') }}/properties/{{ $reviewsByYou[$i]->property_id }}">{{ $reviewsByYou[$i]->properties->name }}</a>
                        </h5>
                        <p style="margin-bottom: 0px !important">{{ $reviewsByYou[$i]->message }}</p>
                        @if($reviewsByYou[$i]->bookings->review_days > 0)
                          <div class="row-space-2">
                          <a class="edit" href="{{ url('/') }}/reviews/edit/{{ $reviewsByYou[$i]->booking_id }}">{{ trans('messages.reviews.edit') }}</a>
                          ({{ str_replace('+','',$reviewsByYou[$i]->bookings->review_days) }} {{ ($reviewsByYou[$i]->bookings->review_days > 1) ? trans_choice('messages.reviews.day',2) : trans_choice('messages.reviews.day',1) }} {{ trans('messages.reviews.left_to_edit') }})
                          </div>
                        @endif
                        <p class="clearfix text-muted">
                          {{ $reviewsByYou[$i]->date_fy }}
                        </p>
                      </div>
                    </li>
                  @endfor
                  </ul>
              </div>
              @else
              <div class="panel-body">
              </div>
              @endif
            </div>
            @if($expiredReviewsCount)
              <div class="panel panel-default row-space-top-4" id="expired-reviews">
                <div class="panel-heading">
                  <h3 class="panel-title">{{ trans('messages.reviews.expired_reviews') }}</h3>
                </div>
                <div class="panel-body">
                  <p class="text-lead">
                    {{ trans('messages.reviews.expired_reviews_desc') }}
                  </p>
                  <ul class="list-layout reviews-list row-space-top-4">
                    @for($i=0; $i<$expiredReviews->count(); $i++)
                     @if($expiredReviews[$i]->review_days <= 0 && $expiredReviews[$i]->reviews->count() < 2)
                      @if(@$expiredReviews[$i]->reviews->count() == 0)
                      <?php
                      $expired = 1; 
                      ?>
                      @endif
                      @for($j=0; $j<$expiredReviews[$i]->reviews->count(); $j++)
                        @if(@$expiredReviews[$i]->reviews[$j]->sender_id != Auth::user()->id)
                         <?php
                          $expired = 1;
                          ?>
                        @endif
                      @endfor
                     @endif
                     @if(@$expired == 1)
                      <li class="media reviews-list-item row-space-top-2">
                        <a class="pull-left r-pad-none mrg-right-10" href="{{ url('/') }}/users/show/{{ @$expiredReviews[$i]->review_user(Auth::user()->id)->id }}">
                          <img width="68" height="68" title="{{ @$expiredReviews[$i]->review_user(Auth::user()->id)->first_name }}" src="{{ @$expiredReviews[$i]->review_user(Auth::user()->id)->profile_src }}" alt="{{ @$expiredReviews[$i]->review_user(Auth::user()->id)->first_name }}">
                        </a>              
                        <div class="media-body response">
                          {{ trans('messages.reviews.your_time_to_write_review') }} <a href="{{ url('/') }}/users/show/{{ @$expiredReviews[$i]->review_user(Auth::user()->id)->id }}">{{ @$expiredReviews[$i]->review_user(Auth::user()->id)->full_name }}</a> {{ trans('messages.reviews.has_expired') }}
                          <div>
                            <!--<a href="{{ url('/') }}/booking/receipt?code={{ @$expiredReviews[$i]->code }}">{{ trans('messages.reviews.view_itinerary') }}</a>-->
                          </div>
                        </div>
                          <div class="clearfix"></div>
                          <hr class="col-12">
                      </li>
                     @endif
                    @endfor
                  </ul>
                </div>
              </div>
            @endif
          </div>
        </div>
      </div>
    </div>
    
  </div>
@stop