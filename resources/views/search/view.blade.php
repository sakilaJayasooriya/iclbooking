@extends('template')

<style>
@media screen and (min-width: 992px) {
    .custom_class_booking_type {
        text-align: center;         
    }
}
</style>
@section('main')
    <div class="container-fluid margin-top10 mb30">
        <div class="col-md-7 col-sm-8 col-xs-12 mb10 l-pad-none r-pad-none hidden-pod" style="">
            <div>
                <h5 class="col-sm-2 mb20" for="user_birthdate">{{trans('messages.search.dates')}}</h5>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="select col-sm-6 mb20">
                            <input id="search-pg-checkin" size="30" class="form-control" name="text" value="{{ $checkin ? $checkin : date(Session::get('search_date_format_type')) }}" placeholder="{{trans('messages.search.check_in')}}" type="text">
                        </div>

                        <div class="select col-sm-6 mb20">
                            <input id="search-pg-checkout" size="30" class="form-control" name="text"value="{{ $checkout ? $checkout : date(Session::get('search_date_format_type')) }}" placeholder="{{trans('messages.search.check_out')}}" type="text">
                        </div>
                        <input type="hidden" name='location' id="search-pg-location" value="{{$location}}">
                        <input type="hidden" id="location" value="{{ $location }}">
                        <input type="hidden" id="lat" value="{{ $lat }}">
                        <input type="hidden" id="long" value="{{ $long }}">
                    
                        <div class="select col-sm-6 mb20">
                            <select id="search-pg-adult" class="form-control" name="birthday_year">
                                <option value="">{{trans('messages.search.adult')}}</option>
                                @for($i=1;$i<=16;$i++)
                                    <option value="{{ $i }}" {{ ($adult==$i)?"selected=selected":'' }}> {{ ($i=='16') ? $i.'+ '.'adult' : $i.' '.'adult' }} </option>
                                @endfor
                            </select>
                        </div>
                        <div class="select col-sm-6 mb20">
                            <select id="search-pg-children" class="form-control" name="birthday_year">
                                <option value="">{{trans('messages.search.children')}}</option>
                                @for($i=1;$i<=16;$i++)
                                    <option value="{{ $i }}" {{ ($children==$i)?"selected=selected":'' }}> {{ ($i=='16') ? $i.'+ '.'children' : $i.' '.'children' }} </option>
                                @endfor
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <h5 class="col-sm-2" for="user_birthdate">{{trans('messages.search.room_type')}}</h5>
                <div class="col-sm-10">

                    @foreach($space_type as $rws=>$value)
                        <div class="col-md-4 l-pad-none">
                            <div class="list-group-item" style="padding:10px 10px;">
                                @if($rws==1)
                                    <i class="icon icon-entire-place h5 needsclick"></i>
                                @endif
                                @if($rws==2)
                                    <i class="icon icon-private-room h5 needsclick"></i>
                                @endif
                                @if($rws==3)
                                    <i class="icon icon-shared-room h5 needsclick"></i>
                                @endif
                                {{ $value }}
                                <label class="pull-right">
                                    <input type="checkbox" id="space_type_{{ $rws }}" name="space_type[]" value="{{ $rws }}" class="space_type mb20" {{ in_array($rws, $space_type_selected)?'checked':'' }}>
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

                {{-- Booking type filter Starts  --}}
                <div>&nbsp; </div>
                <div>
                        <h5 class="col-md-2 col-sm-2" for="user_birthdate" style="max-height: 25px;">{{trans('messages.search.book_type')}}</h5>
                        <div class="col-sm-10">
                            <div class="col-md-5 l-pad-none">
                                <div class="list-group-item custom_class_booking_type" style="padding:10px 10px;">
                                    <i class="fa fa-clock-o text-beach"></i>  Request To Book <label class="pull-right" ><input type="checkbox" style="margin: 0px 4px 0 0;" name="book_type[]" class="book_type" value="request"></label><br>
                                </div>
                            </div>
                            <div class="col-md-5 l-pad-none">
                                <div class="list-group-item custom_class_booking_type" style="padding:10px 10px;">
                                    <i class="icon icon-bolt text-beach"></i>  Instant Book <label class="pull-right"><input type="checkbox" style="margin: 0px 4px 0 0;" name="book_type[]" class="book_type"  value="instant"></label> <br>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Booking type filter Ends --}}
            

            <div>
                <h5 class="col-sm-2" for="user_birthdate" style="margin-top:20px;">{{trans('messages.search.price_range')}}</h5>
                <div class="col-sm-9" style="margin-top:20px;">
                    <input id="price-range" data-provide="slider" data-slider-min="{{ $min_price }}" data-slider-max="{{ $max_price }}" data-slider-value="[{{ $min_price }},{{ $max_price }}]"/>
                </div>
            </div>

            <div class="clearfix"></div>
            <hr>

            <button class="btn btn-warning" id="more_filters" data-status="show" type="submit">{{trans('messages.search.more_filters')}}</button>
            <div class="margin-top20 mb30" >
                <div class="rooms">
                    <div id="loader" class="display-off" style="min-height:200px;width:100%;text-align:center;opacity:0.9;padding-top: 70px;">
                        <img src="{{URL::to('/')}}/public/front/img/green-loader.gif">
                    </div>
                    <div id="properties_show" class="row" style="margin-right: 0px !important">
                        <h2 class="text-center">{{trans('messages.search.no_result_found')}}</h2>
                    </div>
                </div>

                <div class="display-off room_filter">
                    <div class="size-div">
                        <h5 class="col-sm-2" for="user_birthdate">{{trans('messages.search.size')}}</h5>
                        <div class="col-sm-10">
                            <div class="row">
                                <div class="select col-sm-4">
                                    <select name="min_bedrooms" class="form-control" id="map-search-min-bedrooms">
                                        <option value="">{{trans('messages.search.bedrooms')}}</option>
                                        @for($i=1;$i<=10;$i++)
                                            <option value="{{ $i }}" {{ ($bedrooms==$i)?'selected':''}}>
                                                {{ $i }} {{trans('messages.search.bedrooms')}}
                                            </option>
                                        @endfor
                                    </select>
                                </div>

                                <div class="select col-sm-4">
                                    <select name="min_bathrooms" class="form-control" id="map-search-min-bathrooms">
                                        <option value="">{{trans('messages.search.bathrooms')}}</option>
                                        @for($i=0.5;$i<=8;$i+=0.5)
                                            <option class="bathrooms" value="{{ $i }}" {{ $bathrooms == $i?'selected':''}}>
                                                {{ ($i == '8') ? $i.'+' : $i }} {{trans('messages.search.bathrooms')}}
                                            </option>
                                        @endfor
                                    </select>
                                </div>

                                <div class="select col-sm-4">
                                    <select name="min_beds" class="form-control" id="map-search-min-beds">
                                        <option value="">{{trans('messages.search.beds')}}</option>
                                        @for($i=1;$i<=16;$i++)
                                            <option value="{{ $i }}" {{ $beds == $i?'selected':''}}>
                                                {{ ($i == '16') ? $i.'+' : $i }} {{trans('messages.search.beds')}}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    

                    <div style="height:180px; overflow-y:scroll; overflow:auto; border:1px solid #FFFFFF;">
                        <div class="amenities">
                            <h5 class="col-sm-2" for="user_birthdate">{{trans('messages.search.amenities')}}</h5>
                            <div class="col-sm-9 mrg-top-10">
                                @php $row_inc = 1 @endphp
                                @foreach($amenities as $row_amenities)
                                    @if($row_inc <= 3)
                                        <div class="col-md-4 l-pad-none">
                                            <label class="text-truncate" title="{{ $row_amenities->title }}">
                                                <input type="checkbox" name="amenities[]" value="{{ $row_amenities->id }}" class="form-control amenities_array" id="map-search-amenities-{{ $row_amenities->id }}" >
                                                {{ $row_amenities->title }}
                                            </label>
                                        </div>
                                    @endif
                                    @php $row_inc++ @endphp
                                @endforeach

                                <div class="collapse" id="amenities-collapse">
                                    @php $amen_inc = 1 @endphp
                                    @foreach($amenities as $row_amenities)
                                        @if($amen_inc > 3)
                                            <div class="col-md-4 l-pad-none">
                                                <label class="text-truncate" title="{{ $row_amenities->title }}">
                                                    <input type="checkbox" name="amenities[]" value="{{ $row_amenities->id }}" class="form-control amenities_array" id="map-search-amenities-{{ $row_amenities->id }}" ng-checked="{{ (in_array($row_amenities->id, $amenities_selected)) ? 'true' : 'false' }}">
                                                    {{ $row_amenities->title }}
                                                </label>
                                            </div>
                                        @endif
                                        @php $amen_inc++ @endphp
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-sm-1 mrg-top-10">
                                <i style="cursor: pointer;" data-toggle="collapse" data-target="#amenities-collapse" class="fa fa-plus"></i>
                            </div>
                        </div>

                        <div class="propery">
                            <h5 class="col-sm-2" for="user_birthdate">{{trans('messages.search.property_type')}}</h5>
                            <div class="col-sm-9 mrg-top-10">
                                @php $pro_inc = 1 @endphp
                                @foreach($property_type as $row_property_type =>$value_property_type)
                                    @if($pro_inc <= 3)
                                        <div class="col-md-4 l-pad-none">
                                            <label class="text-truncate" title="{{ $value_property_type }}">
                                                <input type="checkbox" name="property_type[]" value="{{ $row_property_type }}" class="form-control" id="map-search-property_type-{{ $row_property_type }}">
                                                {{ $value_property_type}}
                                            </label>
                                        </div>
                                    @endif
                                    @php $pro_inc++ @endphp
                                @endforeach

                                <div class="collapse" id="property-collapse">
                                    @php $property_inc = 1 @endphp
                                    @foreach($property_type as $row_property_type =>$value_property_type)
                                        @if($property_inc > 3)
                                            <div class="col-md-4 l-pad-none">
                                                <label title="{{ $value_property_type }}">
                                                    <input type="checkbox" name="property_type[]" value="{{ $row_property_type }}" class="form-control" id="map-search-property_type-{{ $row_property_type }}">
                                                    {{ $value_property_type}}
                                                </label>
                                            </div>
                                        @endif
                                        @php $property_inc++ @endphp
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-sm-1 mrg-top-10">
                                <i style="cursor: pointer;" data-toggle="collapse" data-target="#property-collapse" class="fa fa-plus"></i>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div id="pagination">
                <div class="h6" style="padding-left:15px;"><span id="page-from">0</span> – <span id="page-to">0</span> of <span id="page-total">0</span> Rentals</div>
                <ul class="pager" id="pager">
                    <!--<li><a href="#">Next</a></li>
                    <li><a href="#">>></a></li>-->
                </ul>
            </div>

            <hr>

            <div class="col-md-7 col-sm-12 col-xs-12 display-off room_filter exPod-btnOn" style="">
                <button class="btn btn-danger filter-cancel">{{trans('messages.search.cancel')}}</button>
                <button class="btn btn-success filter-apply">{{trans('messages.search.apply_filter')}}</button>
            </div>

        </div>



        <div class="col-md-5 col-sm-4 col-xs-12 mb10 r-pad-none l-pad-none">
            <div id="map_view" style="width:100%; height:600px;"></div>
        </div>


        <div class="col-md-7 col-sm-8 col-xs-12 display-off room_filter exPod-btn" style="">
            <button class="btn btn-danger filter-cancel">{{trans('messages.search.cancel')}}</button>
            <button class="btn btn-success filter-apply">{{trans('messages.search.apply_filter')}}</button>
        </div>
        <div class="col-md-5 col-sm-4 col-xs-12 mb10">
            <div>&nbsp;</div>
        </div>

    </div>

    @push('scripts')
    <script type="text/javascript">
        var markers      = [];
        var allowRefresh = true;

        $("#price-range").slider();
        $("#price-range").on("slideStop", function(slideEvt) {
            allowRefresh = true;
            deleteMarkers();
            getProperties($('#map_view').locationpicker('map').map);
        });

        $('#search-pg-guest').on('change', function(){
            allowRefresh = true;
            deleteMarkers();
            getProperties($('#map_view').locationpicker('map').map);
        });
        $('#search-pg-adult').on('change', function(){
            allowRefresh = true;
            deleteMarkers();
            getProperties($('#map_view').locationpicker('map').map);
        });
        $('#search-pg-children').on('change', function(){
            allowRefresh = true;
            deleteMarkers();
            getProperties($('#map_view').locationpicker('map').map);
        });

        $("#search-pg-checkin").datepicker({
            dateFormat:"{{ Session::get('front_date_format_type')}}",
            minDate: 0,
            onSelect: function(e) {
                var t = $("#search-pg-checkin").datepicker("getDate");
                t.setDate(t.getDate() + 1), $("#search-pg-checkout").datepicker("option", "minDate", t), setTimeout(function() {
                    $("#search-pg-checkout").datepicker("show")
                }, 20);
                allowRefresh = true;
                getProperties($('#map_view').locationpicker('map').map);
            }
        });

        $("#search-pg-checkout").datepicker({
            dateFormat:"{{ Session::get('front_date_format_type')}}",
            minDate: 1,
            onClose: function() {
                var e = $("#checkin").datepicker("getDate"),
                    t = $("#header-search-checkout").datepicker("getDate");
                if (e >= t) {
                    var a = $("#search-pg-checkout").datepicker("option", "minDate");
                    $("#search-pg-checkout").datepicker("setDate", a)
                }
            }, onSelect: function(){
                allowRefresh = true;
                getProperties($('#map_view').locationpicker('map').map);
            }
        });

        $(document.body).on('click', '.page-data', function(e){
            e.preventDefault();
            var hr = $(this).attr('href');
            allowRefresh = true;
            getProperties($('#map_view').locationpicker('map').map, hr);
        });
        ///var contentString = '<div id="content"><ul id="slider"><li><img src="http://localhost/vrent_live/public/images/property/1/1523429218_crowne-plaza-jamaica-2589646442-2x1.jpg" alt=""></li><li><img src="http://localhost/vrent_live/public/images/property/2/1523430028_Property-FourSeasonsHotelNewYorkDowntown-Hotel-GuestroomSuite-RoyalSuiteDiningArea-FourSeasonsHotelsLimited.jpg" alt=""></li><li><img src="http://localhost/vrent_live/public/images/property/3/1523431422_ie_hyatt_andaz_palm_springs_rendering.jpg" alt=""></li><li><img src="http://localhost/vrent_live/public/images/property/2/1523430028_Property-FourSeasonsHotelNewYorkDowntown-Hotel-GuestroomSuite-RoyalSuiteDiningArea-FourSeasonsHotelsLimited.jpg" alt=""></li></ul></div>';

        function addMarker(map, features){

            var infowindow = new google.maps.InfoWindow();
            for (var i = 0, feature; feature = features[i]; i++) {
                var marker = new google.maps.Marker({
                    position: new google.maps.LatLng(feature.latitude, feature.longitude),
                    icon: feature.icon !== undefined ? feature.icon : undefined,
                    label: {
                    text: feature.price_map,
                    color: 'white',
                    fontSize: '13px',
                    fontWeight: 'bold'
                    },
                    map: map,
                    title: feature.title !== undefined? feature.title : undefined,
                    content: feature.content !== undefined? feature.content : undefined,
                });
                markers.push(marker);

                google.maps.event.addListener(marker, 'click', function (e) {
                    //e.preventDefault();
                    if(this.content){
                        infowindow.setContent(this.content);
                        infowindow.open(map, this);
                    }
                });

                google.maps.event.addListener(infowindow, 'domready', function() {
                  $('#slider').anythingSlider();

                });

                /*google.maps.event.addListener(map, 'zoom_changed', function(event) {       
                    searchOnZoom(map);
                });*/
            }
        }

        // Sets the map on all markers in the array.
        function setMapOnAll(map) {
            for (var i = 0; i < markers.length; i++) {
                markers[i].setMap(map);
            }
        }

        // Removes the markers from the map, but keeps them in the array.
        function clearMarkers() {
            setMapOnAll(null);
        }

        // Deletes all markers in the array by removing references to them.
        function deleteMarkers() {
            clearMarkers();
            markers = [];
        }

        function moneyFormat(symbol, value) {
            var symbolPosition = '<?php echo currencySymbolPosition(); ?>';
            if (symbolPosition == "before") {
               val = symbol + ' ' + value;
            } else {
                val = value + ' ' + symbol;
            }
            return val;
        }

        function getProperties(map,url){
            var ad=parseInt($('#search-pg-adult').val());
            var chl=parseInt($('#search-pg-children').val());
            var guest = (ad+chl);
            //$('#sakitemp').val("New total value :"+guest);

            url = url||'';
            p = map;
            var a = p.getZoom(),
                t = p.getBounds(),
                o = t.getSouthWest().lat(),
                i = t.getSouthWest().lng(),
                s = t.getNorthEast().lat(),
                r = t.getNorthEast().lng(),
                l = t.getCenter().lat(),
                n = t.getCenter().lng();

            var range       = $('#price-range').attr('data-value');
            //var range       = $('#price-range').attr('data-slider-value');
            range           = range.split(',');
            var map_details = a + "~" + t + "~" + o + "~" + i + "~" + s + "~" + r + "~" + l + "~" + n;
            var location    = $('#location').val();

            //Input Search value set
            $('#header-search-form').val(location);
            //Input Search value set

            var min_price       = range[0];
            var max_price       = range[1];
            var amenities       = getCheckedValueArray('amenities');
            var property_type   = getCheckedValueArray('property_type');
            var book_type       = getCheckedValueArray('book_type');
            var space_type      = getCheckedValueArray('space_type');
            var beds            = $('#map-search-min-beds').val();
            var bathrooms       = $('#map-search-min-bathrooms').val();
            var bedrooms        = $('#map-search-min-bedrooms').val();
            var checkin         = $('#search-pg-checkin').val();
            var checkout        = $('#search-pg-checkout').val();
            //var guest           = $('#search-pg-guest').val();

            //var map_details = map_details;

            var dataURL = '{{url("search/result")}}';
            if(url != '') dataURL = url;

            if($('#more_filters').css('display') != 'none'){
                $.ajax({
                    url: dataURL,
                    data: {
                        'location': location,
                        'min_price': min_price,
                        'max_price': max_price,
                        'amenities': amenities,
                        'property_type': property_type,
                        'book_type':book_type,
                        'space_type': space_type,
                        'beds': beds,
                        'bathrooms': bathrooms,
                        'bedrooms': bedrooms,
                        'checkin': checkin,
                        'checkout': checkout,
                        'guest': guest,
                        'map_details': map_details
                    },
                    type: 'post',
                    //async: false,
                    dataType: 'json',
                    beforeSend: function (){
                        $('#properties_show').html("");
                        show_loader();
                    },
                    success: function (result) {
                        $('#page-total').html(result.total);
                        $('#page-from').html(result.from);
                        $('#page-to').html(result.to);

                        allowRefresh = false;

                        var pager = '';
                        if(result.prev_page_url) pager +=  '<li><a class="page-data" href="'+result.prev_page_url+'">Previous</a></li>';
                        if(result.current_page) pager +=  '<li><a href="#">'+result.current_page+'</a></li>';
                        if(result.next_page_url) pager +=  '<li><a class="page-data" href="'+result.next_page_url+'">Next</a></li>';
                        $('#pager').html(pager);

                        var properties = result.data;
                        var room_point = [];
                        var room_div   = "";
                        for (var key in properties) {
                            if (properties.hasOwnProperty(key)) {
                                var moneySymbol_map = properties[key].property_price.currency.symbol;
                                var moneySymPlainText = $("<span></span>").html(moneySymbol_map).text();
                                
                                var price_map      = properties[key].property_price.price;
                                var symbolWithPrice_map = moneySymPlainText+''+price_map;

                                room_point[key] = {
                                    latitude: properties[key].property_address.latitude,
                                    longitude: properties[key].property_address.longitude,
                                    title: properties[key].name,
                                    price_map:symbolWithPrice_map,
                                    //content: '<h5>'+properties[key].name+'</h5>'+'<p>'+properties[key].summary+'</p>'
                                    content: '<a href="'+APP_URL+'/properties/'+properties[key].id+'?checkin='+checkin+'&checkout='+checkout+'&guests='+guest+'" class="media-cover">'
                                    +'<img style="max-height:150px;max-width:200px;" src="'+properties[key].cover_photo+'"alt="">'
                                    +'</a>'

                                    /*'<a href="'+APP_URL+'/properties/'+properties[key].id+'?checkin='+checkin+'&checkout='+checkout+'&guests='+guest+'" class="media-cover">'
                                    +'<div id="content">'
                                    +'<ul id="slider">'
                                    //+'<img style="max-height:150px;max-width:200px;" src="'+properties[key].cover_photo+'"alt="">'
                                    +'<li>'
                                    +'<img src="http://localhost/vrent_live/public/images/property/12/1523522542_leonardo-1253861-bg-exterior-night2-2_S-image.jpg" alt="">'
                                    +'</li>'
                                    +'<li>'
                                    +'<img src="http://localhost/vrent_live/public/images/property/12/1523522542_leonardo-1253861-bg-exterior-night2-2_S-image.jpg" alt="">'
                                    +'</li>'
                                    +'<li>'
                                    +'<img src="http://localhost/vrent_live/public/images/property/12/1523522542_leonardo-1253861-bg-exterior-night2-2_S-image.jpg" alt="">'
                                    +'</li>'
                                    +'<li>'
                                    +'<img src="http://localhost/vrent_live/public/images/property/12/1523522542_leonardo-1253861-bg-exterior-night2-2_S-image.jpg" alt="">'
                                    +'</li>'
                                    +'</ul>'
                                    +'</div>'
                                    +'</a>'*/
                                    +'<div style="max-height:150px;max-width:200px;">'
                                    +'<div class="col-xs-12" style="padding:2px 0px;">'
                                    +'<div class="location-title"><h5 style="margin-bottom:0px;">'+properties[key].name+'</h5></div>'
                                    +'<div class="text-muted">'+properties[key].property_description.summary.substring(0,50)+' ...<a href="'+APP_URL+'/properties/'+properties[key].id+'?checkin='+checkin+'&checkout='+checkout+'&guests='+guest+'" class="media-cover">more>></a>'+'</div>'
                                    +'</div>'
                                    +'</div>'
                                };
                                var active_star = Math.floor(properties[key].overall_rating/25);
                                var review = '';
                                if(active_star){
                                    review = '<div class="star-rating"> <div class="foreground"> ';
                                    for(var i=0; i < active_star; i++){
                                        review += '<i class="icon icon-star icon-beach"></i> ';
                                    }
                                    review +=  '</div> <div class="background"><i class="icon icon-star icon-light-gray"></i> <i class="icon icon-star icon-light-gray"></i> <i class="icon icon-star icon-light-gray"></i> <i class="icon icon-star icon-light-gray"></i> <i class="icon icon-star icon-light-gray"></i> </div> </div>';

                                }
                                reviews_count = '';
                                if(properties[key].reviews_count == 1) reviews_count = properties[key].reviews_count+' Review';
                                else if(properties[key].reviews_count > 0) reviews_count = properties[key].reviews_count+' Reviews';

                                review_sec = '';
                                if(properties[key].reviews_count != 0)
                                    review_sec = ' . '+review+' . '+reviews_count;
                                else
                                    review_sec = '';
                                    if (properties[key].booking_type=='instant') {
                                        var booking_type_string = "Instant Book";
                                    } else {
                                        var booking_type_string = "Request To Book";                                
                                    }
                                    var moneySymbol = properties[key].property_price.currency.symbol;
                                    var price       = properties[key].property_price.price;
                                    var symbolWithPrice = moneyFormat(moneySymbol, price);
                                      
                                    room_div += '<div class="col-md-6 col-sm-6 col-xs-12 mb10">'
                                        +'<div style="min-height:200px;background-color:#999999;">'
                                        +'<a target="listing_'+properties[key].id+'" href="'+APP_URL+'/properties/'+properties[key].id+'?checkin='+checkin+'&checkout='+checkout+'&guests='+guest+'" class="media-cover">'
                                        +'<img style="height:200px;" src="'+properties[key].cover_photo+'" alt="">'
                                        +'</a>'
                                        +'</div>'
                                        +'<div>'
                                        +'<div class="media-left">'
                                        +'<div class="media-user">'
                                        +'<div class="doller-sign-bg">'+ symbolWithPrice +'</div>'
                                        +'</div>'
                                        +'</div>'
                                        +'<div class="media-user">'
                                        +'<a target="_blank" href="'+APP_URL+'/users/show/'+properties[key].host_id+'">'
                                        +'<div class="media-user-img"><img src="'+properties[key].users.profile_src+'" alt="" width="100%"></div>'
                                        +"</a>"
                                        +'</div>'
                                        +'<div class="col-xs-12 mb20">'
                                        +'<a target="listing_'+properties[key].id+'" href="'+APP_URL+'/properties/'+properties[key].id+'?checkin='+checkin+'&checkout='+checkout+'&guests='+guest+'" class="media-cover">'
                                        +'<div class="location-title">'+properties[key].name+'</div>'
                                        +'<div class="booking_type-title">'+booking_type_string+'</div>'
                                        +"</a>"
                                        +properties[key].space_type_name+review_sec
                                        +'</div>'
                                        +'</div>'
                                        +'</div>';
                                }
                            }

                            if(room_div != '') $('#properties_show').html(room_div);
                            else $('#properties_show').html('<h2 class="text-center">No Results Found</h2>');

                            //deleteMarkers();
                            addMarker(map, room_point);


                        },
                        error: function (request, error) {
                            allowRefresh = false;
                            // This callback function will trigger on unsuccessful action
                            console.log(error);
                        },
                        complete: function(){
                            hide_loader();
                        }
                });
            }
        }
               
        $('.space_type').on('click', function(){
            allowRefresh = true;
            deleteMarkers();
            getProperties($('#map_view').locationpicker('map').map);
            $('.room_filter').addClass('display-off');
            $('#more_filters').show();
        });

        $('.book_type').on('click', function(){
            
            allowRefresh = true;
            deleteMarkers();
            getProperties($('#map_view').locationpicker('map').map);
            $('.room_filter').addClass('display-off');
            $('#more_filters').show();
        });

        $('#more_filters').on('click', function(){
            $('#more_filters').hide();
            //console.log($('#more_filters').css('display'));
            $('#pagination').hide();
            $('#properties_show').html("");
            $('.room_filter').removeClass('display-off');
            var width = $( window ).width();
            if(width < 980) $('.exPod-btnOn').show();
        });

        $('.filter-cancel').on('click', function(){
            allowRefresh = true;
            $('.room_filter').addClass('display-off');
            $('#more_filters').show();
            $('#pagination').show();
            $('.exPod-btnOn').hide();
            getProperties($('#map_view').locationpicker('map').map);
        });

        $('.filter-apply').on('click', function(){
            allowRefresh = true;
            $('.room_filter').addClass('display-off');
            $('#more_filters').show();
            $('#pagination').show();
            $('.exPod-btnOn').hide();
            deleteMarkers();
            getProperties($('#map_view').locationpicker('map').map);
        });

        function getCheckedValueArray(field_name){
            var array_Value = '';
            /*var i=0;
             $('input[name="'+field_name+'[]"]').each(function() {
             if($(this).prop( "checked" ))
             array_Value[i++] = $(this).val();
             });*/
            array_Value = $('input[name="'+field_name+'[]"]:checked').map(function() {
                return this.value;
            })
                .get()
                .join(',');

            return array_Value;
        }
        /*function searchOnZoom(map){
            var  zoomLevel = map.getZoom();
            var minLevel   = 16;
            if(minLevel<=zoomLevel){
                allowRefresh = true;
                getProperties($('#map_view').locationpicker('map').map);  
            }else{
                console.log(zoomLevel);
                console.log('In Else');
                setMapOnAll(null);
            }
        }*/
        $(document.body).on('click','#map_view',function(){
            allowRefresh = true;
            getProperties($('#map_view').locationpicker('map').map);
        });

        $('#map_view').locationpicker({
            location: {
                latitude: {{"$lat"}},
                longitude: {{"$long"}}
            },
            radius: 0,
            zoom: 13,
            addressFormat: "",
            markerVisible: false,
            markerInCenter: true,
            inputBinding: {
                latitudeInput: $('#latitude'),
                longitudeInput: $('#longitude'),
                locationNameInput: $('#address_line_1')
            },
            enableAutocomplete: true,
            draggable: true,
            onchanged: function (currentLocation, radius, isMarkerDropped) {
                if (allowRefresh == true) {
                    getProperties($(this).locationpicker('map').map);
                }
            },

            oninitialized: function (component) {
                var addressComponents = $(component).locationpicker('map').location.addressComponents;
                //updateControls(addressComponents);
            }
        });

        $('.slider-selection').trigger('click');

        $( window ).resize(function() {
            var width = $( window ).width();
            if(width > 980) $('.exPod-btnOn').hide();
        });

        function show_loader(){
            $('#loader').removeClass('display-off');
            $('#pagination').hide();
        }

        function hide_loader(){
            $('#loader').addClass('display-off');
            $('#pagination').show();
        }


    </script>
    @endpush
@stop