@extends('template')
@section('main')
<div class="container margin-top30" style="min-height:500px;">
  <div class="col-md-3">
    <div class="gal-pic">
      <img src="{{ $result->profile_src }}" title="{{ $result->first_name }}" class="img-responsive" alt="{{ $result->first_name }}" width="300" height="150">
    </div>
    <div class="text-center mb20">
      <br>
      @if((Auth::user()->users_verification->email == 'no') || (Auth::user()->users_verification->facebook == 'no') || (Auth::user()->users_verification->google == 'no'))
      <a href="{{ url('users/edit-verification') }}" class="btn ex-btn">{{trans('messages.users_dashboard.complete_profile')}}</a>
      @else
      <i class="fa fa-check-circle fa-3x text-success" aria-hidden="true"></i>
      @endif
    </div>
    @if($result['school'] || $result['work'])
    <div class="panel panel-default margin-top20">
      <div class="panel-heading">{{trans('messages.users_show.about_me')}}</div>
      <div class="panel-body">
        <div class="doc">
          <p class=""><strong>{{trans('messages.users_show.school')}}</strong> &nbsp; {{ $result['school'] }}</p>
          <p class=""><strong>{{trans('messages.users_show.work')}}</strong> &nbsp; {{ $result['work'] }}</p>
        </div>
      </div>
    </div>
    @endif
    <!--<div class="panel panel-default">
      <div class="panel-heading">Varification</div>
      <div class="panel-body row">
        <div class="col-xs-3">
          <img src="img/step-tick.png">
        </div>
        <div class="col-xs-9 margin-top10">Linkedin Validate</div>
      </div>
    </div>-->
  </div>
  <div class="col-md-9">
    <div class="doc2">
      <h1>{{trans('messages.users_show.hey')}} {{ucfirst($result->first_name)}}!</h1>
      <h6><strong>{{trans('messages.users_show.member_since')}} {{ $result->account_since }}</strong></h6>
      @if(isset($details['live']))
        <a href="{{ url('search?location='.$details['live']) }}">{{ $details['live'] }}</a>·
      @endif
      <p>{{ $result->about }}</p>
    </div>
    <div class="doc2">
      @if($reviews_count > 0)
      <div class="col-md-3 col-sm-4 mb20">
        <a href="#" rel="nofollow" class="link-reset" id="profile-review-count">
          <div class="text-center text-wrap">
            <div class="badge-pill h3">
              <span class="badge-pill-count">{{ $reviews_count }}</span>
            </div>
            <div class="row-space-top-1">{{trans('messages.users_show.review')}}</div>
          </div>
        </a>
        <span></span>
      </div>
      @endif
    </div>    
    <div class="clearfix"></div>
    
    @if($reviews_count > 0)
    <div class="profile-review">
      <div class="doc"><span class="h3" id="profile-review-title"><strong>{{trans('messages.users_show.review')}}</strong></span> ({{ $reviews_count }}) </div>
      
      @if($reviews_from_hosts->count() > 0)
      <h4>{{trans('messages.users_show.review_host')}}</h4>
        @foreach($reviews_from_hosts->get() as $row_host)  
        <div class="row margin-top20 mb25">
          <div class="col-md-2 text-center">
            <div class="media-photo-badge">
              <a href="#" ><img style="width: 50px;height: 50px;border-radius:0px !important" alt="User Profile Image" class="" src="{{ $row_host->users->profile_src }}" title="{{ $row_host->users->first_name }}"></a>
              <p>{{ $row_host->users->first_name }}</p>
            </div>
          </div>
          <div class="col-md-9">
            <div class="row">
              <div class="col-md-6">
                  <h5>{{ $row_host->properties->name }}</h5>
                  <p class="h5">{{ $row_host->message }}</p> 
                  <p>{{ onlyFormat($row_host->date_fy) }}</p>  
              </div>  
            </div> 
          </div>
        </div>
        @endforeach 
      @endif

      @if($reviews_from_guests->count() > 0)
      <h4>{{trans('messages.users_show.review_guest')}}</h4>
        @foreach($reviews_from_guests->get() as $row_guest) 
        <div class="row margin-top20 mb25">
          <div class="col-md-2 text-center">
            <a href="{{ url('/') }}/users/show/{{ $row_guest->sender_id }}">
              <div class="media-photo-badge">
                <img style="width: 50px;height: 50px;border-radius:0px !important" alt="User Profile Image" class="" src="{{ $row_guest->users->profile_src }}" title="{{ $row_guest->users->first_name }}">
                <p>{{ $row_guest->users->first_name }}</p>
              </div>
            </a>
          </div>
          <div class="col-md-9">
            <div class="row">
              <div class="col-md-6">
                  <h5>{{ $row_guest->properties->name }}</h5>
                  <p class="h5">{{ $row_guest->message }}</p> 
                  <p>{{ $row_guest->date_fy }}</p>  
              </div>  
            </div> 
          </div>
        </div>
        @endforeach 
      @endif
    </div>
    @endif
  </div>
</div>
<div class="clearfix"></div>
@push('scripts')
<script type="text/javascript">
  $("#profile-review-count").on('click', function(e){
      //e.stopPropagation();
      e.preventDefault()
      $('html,body').animate({
          scrollTop: $("#profile-review-title").offset().top},
          'slow');
  });
</script>
@endpush
@stop