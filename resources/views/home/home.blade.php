@extends('template')

@section('main')
    <input type="hidden" id="front_date_format_type" value="{{ Session::get('front_date_format_type')}}">
    <div id="mega-slider" class="carousel slide" data-ride="carousel">
      <!-- Wrapper for slides -->
      <div class="carousel-inner" role="listbox">
        @php $i = 0 @endphp
          @foreach($banners as $banner)
          <div class="item {{$i==0?'active':''}}">
            <img src="{{ url('public/front/images/banners/'.$banner->image) }}" alt="...">
            <div class="carousel-caption">
              <h2>{{$banner->heading}}</h2>
              <p>{{$banner->subheading}}</p>
            </div>
          </div>
          @php $i = 1 @endphp
        @endforeach
      </div>
      <!-- Controls -->
      <a class="left carousel-control" href="#mega-slider" role="button" data-slide="prev">
      </a>
      <a class="right carousel-control" href="#mega-slider" role="button" data-slide="next">
      </a>
    </div>
    <div class="mg-bn-forms-up">
      <div class="mg-book-now2 mg-book-now">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="mg-bn-forms">
                <form id="front-search-form" method="post" action="{{url('search')}}">
                  <div class="row">
                    <div class="col-sm-6 col-md-4 col-xs-12 input-mb" style="width: 17.8333333%;">
                      <div class="input-group date mg-check-in col-xs-12">
                        <input class="form-control" id="front-search-field" placeholder="{{trans('messages.home.where_want_to_go')}}" autocomplete="off" name="location" type="text" required>
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-2 col-xs-12 input-mb" style="width: 14.6666666%;">
                      <div class="input-group date mg-check-in">
                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                        <input class="form-control" name="checkin" id="front-search-checkin" placeholder="{{trans('messages.search.check_in')}}" autocomplete="off" type="text" readonly="readonly" required>
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-2 col-xs-12 input-mb" style="width: 14.6666666%;">
                      <div class="input-group date mg-check-out">
                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                        <input class="form-control" name="checkout" id="front-search-checkout" placeholder="{{trans('messages.search.check_out')}}" type="text" readonly="readonly" required>
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-2 col-xs-12" style="width: 14.6666666%;">
                      <div class="input-group date mg-check-out col-xs-12">
                        <select id="front-search-adult" class="form-control black-select" name="adult">
                          <option value=""> {{trans('messages.home.adult')}} (Age &gt; 13)</option>
                          <option value="1">  1 Adults </option>
                          <option value="2">  2 Adults </option>
                          <option value="3">  3 Adults </option>
                          <option value="4">  4 Adults </option>
                          <option value="5">  5 Adults </option>
                          <option value="6">  6 Adults </option>
                          <option value="7">  7 Adults </option>
                          <option value="8">  8 Adults </option>
                          <option value="9">  9 Adults </option>
                          <option value="10">  10 Adults </option>
                          <option value="11">  11 Adults </option>
                          <option value="12">  12 Adults </option>
                          <option value="13">  13 Adults </option>
                          <option value="14">  14 Adults </option>
                          <option value="15">  15 Adults </option>
                          <option value="16">  16+ Guests </option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-2 col-xs-12" style="width: 14.6666666%;">
                      <div class="input-group date mg-check-out col-xs-12">
                        <select id="front-search-children" class="form-control black-select" name="children">
                          <option value=""> {{trans('messages.home.children')}} (Age 2-12)</option>
                          <option value="0"> 0 Children </option>
                          <option value="1"> 1 Children </option>
                          <option value="2"> 2 Children </option>
                          <option value="3"> 3 Children </option>
                          <option value="4"> 4 Children </option>
                          <option value="5"> 5 Children </option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-2 col-xs-12" style="width: 14.6666666%;">
                      <div class="input-group date mg-check-out col-xs-12">
                        <select id="front-search-infant" class="form-control black-select" name="infant">
                          <option value=""> {{trans('messages.home.infant')}} (Under 2)</option>
                          <option value="0"> 0 Infants </option>
                          <option value="1"> 1 Infants </option>
                          <option value="2"> 2 Infants </option>
                          <option value="3"> 3 Infants </option>
                          <option value="4"> 4 Infants </option>
                          <option value="5"> 5 Infants </option>
                        </select>
                      </div>
                    </div>


                    <div class="col-md-1 col-xs-12 front-search">
                      <button type="submit" class="btn btn-main btn-block">{{trans('messages.home.search')}}</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
         </div>
      </div>
    </div>
    <!--start starting city slider -->
    <div class="container-fluid pt-1 pb-4">
        <div class="row" >
          <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
            <div class="carousel slide multi-item-carousel multi-three-in-row-carousel" id="cityCarousel">
              <div class="carousel-inner">
                @for($i=0;$i<= $city_count-1;$i++)
                  @if ($i==0)
                    <div class="item active">
                  @else
                    <div class="item"> 
                  @endif
                      <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 p-3">
                        <div class="ex-image-container" style="background-image:url({{ @$starting_cities[$i]->image_url }});">
                          <a href="{{URL::to('/')}}/search?location={{$starting_cities[$i]->name}}&source=ds">
                            <div class="ex-container">
                              <div class="ex-center-content">
                                  <div class="h2">
                                    <strong>
                                      {{$starting_cities[$i]->name}}
                                    </strong>
                                  </div>
                                  
                              </div>
                            </div>
                          </a>
                        </div>
                        <div class="sliderConten">
                          <p>{{substr($starting_cities[$i]->description_city,0,110)}}....<br>
                            <small>
                            <b>Weather:</b> {{$starting_cities[$i]->weather}}<br>
                            <b>Population:</b> {{$starting_cities[$i]->population}}<br>
                            <b>Mayor:</b> {{$starting_cities[$i]->mayor}}<br>
                            <b>Municipality:</b> {{$starting_cities[$i]->municipality}}
                            </small>
                          </p>
                          <h5><b>Plan a trip</b></h5>
                          <p><a href="{{URL::to('/')}}/search?location={{$starting_cities[$i]->name}}&source=ds">iclbooking travel guide </a></p>
                        </div>
                      </div>
  
                    </div>
                    <!-- end items -->
                @endfor
              </div>
              <!-- end inner -->
              <a class="left carousel-control" href="#cityCarousel" data-slide="prev"><span class="sr-only">Previous</span></a>
              <a class="right carousel-control" href="#cityCarousel" data-slide="next"><span class="sr-only">Next</span></a>
            
            </div>
            <!-- end carousel -->
          </div>
          <!-- end col-12 -->
          <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2" style="background-color:aquamarine">
            <div style="height:600px;background-color:aquamarine">
                <h2 style="vertical:align:center">Banner</h2>
            </div>
          </div>
        </div>
        <!-- end row -->
      </div>
      <!-- end container -->
      <!--end starting city slider -->


    <!--start property type slider -->
    <div class="container-fluid pt-1 pb-4">
        <div class="row margin-top40" >
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 pt-4">
              <h4 class="mrg-left-15 pb-5"><b>Browse by property type</b></h4><br>
            </div>
        </div>
        <div class="row" >
          <div class="col-md-12">
            @php $typeCount = 0 @endphp
            <div class="carousel slide multi-item-carousel multi-four-in-row-carousel" id="typesCarousel">
              <div class="carousel-inner">
                @foreach($propertyType as $property)
                  @if ($typeCount ==0)
                    @php $typeCount = 1 @endphp
                    <div class="item active">
                  @else
                    <div class="item"> 
                  @endif
                      <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3 p-3">
                        <img class="property-img" src="{{ url('public/front/images/property_type/'.$property->image) }}" alt="{{$property->name}}">
                        <p class="pt-3 pb-0 text-center" style="margin-bottom: 0px;padding-top:10px;">
                        <b><a target="_blank" href="{{ url('search?property_type='.$property->id) }}">{{$property->name}}</a></b>
                        </p>
                      </div>
  
                    </div>
                    <!-- end items -->
                @endforeach
              </div>
              <!-- end inner -->
              <a class="left carousel-control" href="#typesCarousel" data-slide="prev"><span class="sr-only">Previous</span></a>
              <a class="right carousel-control" href="#typesCarousel" data-slide="next"><span class="sr-only">Next</span></a>
            </div>
            <!-- end carousel -->
          </div>
          <!-- end col-12 -->
        </div>
        <!-- end row -->
        <!-- start banner row -->
        <div class="row margin-top40" >
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 pt-4 mrg-left-5 mrg-right-5">
              <div style="height:160px;background-color:aquamarine;text-align:centers">
                  <h2 style="text-align:center">Banner</h2>
              </div>
            </div>
        </div>
        <!-- end bnner row -->
      </div>
      <!-- end container -->
    <!--end property type slider -->


     <!--start top destionation slider -->
    <div class="container-fluid pt-1 pb-4">
      <div class="row margin-top40" >
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <h2 class="mrg-left-15 pb-5">Top Destinations</h2>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <div class="carousel slide multi-item-carousel multi-four-in-row-carousel" id="cityCarousel">
            <div class="carousel-inner">
              @php $tdcount = 0 @endphp
              @foreach($top_destinations as $td)
                @if ($tdcount==0)
                  <div class="item active">
                    @php $tdcount = 1 @endphp
                @else
                  <div class="item"> 
                @endif
                    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 p-3">
                      <div class="ex-image-container" style="background-image:url({{ @$td->image_url }});">
                        
                          <div class="ex-container">
                            <div class="ex-center-content">
                                <div class="h5">
                                  <strong>
                                    {{$td->title}}
                                  </strong>
                                </div>
                                <p><small>{{$td->descripion}}</small></p>
                                
                            </div>
                          </div>
                        
                      </div>
                    </div>

                  </div>
                  <!-- end items -->
              @endforeach
            </div>
            <!-- end inner -->
            <a class="left carousel-control" href="#cityCarousel" data-slide="prev"><span class="sr-only">Previous</span></a>
            <a class="right carousel-control" href="#cityCarousel" data-slide="next"><span class="sr-only">Next</span></a>
          
          </div>
          <!-- end carousel -->
        </div>
        <!-- end col-12 -->
      </div>
      <!-- end row -->
    </div>
    <!-- end container -->
    <!--end top destionation slider -->


    <!--start featured propertys -->
    <div class="container-fluid">
      <div class="row margin-top40 mrg-left-2 mrg-right-2" >
        <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 pt-4">
            <div style="height:260px;background-color:aquamarine;text-align:centers">
                <h2 style="text-align:center">Banner</h2>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 pt-4">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 pt-4">
              <h4 class="pb-5"><b>For Clean and Comfortable Stay</b></h4><br>
            </div>
            @foreach($featuredProperties as $property)
              <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 pt-5">
                <img class="property-img" src="{{ url($property->cover_photo) }}" alt="{{$property->name}}">
                <p class="pt-3 pb-0" style="margin-bottom: 0px;padding-top:10px;">
                  <b><a target="_blank" href="{{ url('properties/'.$property->id) }}">{{$property->name}}</a></b>
                </p>
                <p style="margin-bottom: 5px;">
                  <small>{{$property->property_address->countries->name}}</small>
                </p>
                <p style="padding-top:0px;">
                  <b class="pb-3">Starting From {{$property->property_price->price}} {{$property->property_price->currency->symbol}}</b><br>
                  <span class="startingPrice">{{$property->overall_rating}} </span> <small>   - {{$property->reviews->count()}} reviews</small>
                </p>
              </div>
            @endforeach
        </div>
      </div>
    </div>
    <!--end featured propertys -->
    
@stop