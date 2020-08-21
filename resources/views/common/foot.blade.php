  <script type="text/javascript">
    var APP_URL = "{{ url('/') }}";
    var USER_ID = "{{ @Auth::user()->id }}";
  </script>
  <script src="{{ url('public/front/js/jquery.js') }}"></script>
  <script src="{{ url('public/front/js/jquery.validate.min.js') }}"></script>
  {!! @$head_code !!}
  <script src="{{ url('public/front/js/jquery-ui.js') }}"></script>
  <script src="{{ url('public/front/js/bootstrap.js') }}"></script>
  
  <script type="text/javascript" src='https://maps.google.com/maps/api/js?key={{ @$map_key }}&sensor=false&libraries=places'></script>

  <script src="{{ url('public/front/js/locationpicker.jquery.min.js') }}"></script>
  <script src="{{ url('public/front/js/bootbox.min.js') }}"></script>
  <script src="{{ url('public/front/js/front.js') }}"></script>
  @if (Request::path() == 'reservation/change' || Request::path() == 'reservation/{id}')
    <script src="{{ url('public/front/js/front.js') }}"></script>
  @endif
  <script src="{{ url('public/front/js/jquery.sidr.js') }}"></script>
  @if (Request::path() == 'payments/stripe')
    <script src="https://js.stripe.com/v3/"></script>
  @endif

  <script type="text/javascript">
    $(document).ready(function() {
      $('.menubar-toggle').sidr({
        displace: false
      });
    });

    function closeNav(){
      $.sidr('close', 'sidr');
    }
  </script>
  @stack('scripts')
  
  <script src="{{ url('public/front/js/ninja/ninja-slider.js') }}"></script>
  <script src="{{ url('public/front/js/bootstrap-slider.js') }}"></script>
  <script src="{{ url('public/front/js/selectFx.js') }}"></script>
  <script src="{{ url('public/front/js/admin.js') }}"></script>
  <!--Anything Slider js -->
  <!-- Anything Slider optional plugins -->
  <script src="{{url('public/front/anything/js/jquery.easing.1.2.js')}}"></script>
  <!-- http://ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js -->
  <script src="{{url('public/front/anything/js/swfobject.js')}}"></script>


  <!-- AnythingSlider -->
  <script src="{{url('public/front/anything/js/jquery.anythingslider.js')}}"></script>

  <!-- AnythingSlider video extension; optional, but needed to control video pause/play -->
  <script src="{{url('public/front/anything/js/jquery.anythingslider.video.js')}}"></script>
  <script type="text/javascript">
    $(document).ready( function() {
        $(document).on('change', '.day-of-birth', function () {
          $('#day-of-birth').val($('#user_birthday_year').val() + '-' + $('#user_birthday_month').val() + '-' + $('#user_birthday_day').val());   
        });     
      });
  </script>

  <script src="{{ url('public/front/js/multi-carousel.js') }}"></script>

 </body>
</html>