@extends('template')

@section('main')
<div class="container margin-top30">
  <div class="panel panel-default">
    <div class="panel-body h4">
      <h2>Messages Regarding Your Listings
    </div>
    <div class="panel-footer ">
      @if (0<count($listing_messages))
        <div class="panel-group" id="accordion">
          @php
              $i=0;
          @endphp
          @foreach ($listing_messages as $item)
            <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $i }}">
                  {{ $item->first_name }} {{ $item->last_name }}</a>
                </h4>
              </div>
              <div id="collapse{{ $i }}" class="panel-collapse collapse @if($i==0) in @endif">
                <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
                minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                commodo consequat.<p>
                    {{ $item->msg }} <br>
                    {{ $item->created_at }} <br>
                  </p></div>
              </div>
            </div>
            @php
                $i++;
            @endphp
          @endforeach
        </div>
      @else
          
      @endif

    </div>
    <div class="panel-body">
      <div style="float:right">
        <p id="inbox-page-info"></p>
        <ul class="pagination" id="inbox-pagination" style="margin: 5px 0px;">
        </ul>
      </div>
    </div>
  </div> 
</div>
@stop


