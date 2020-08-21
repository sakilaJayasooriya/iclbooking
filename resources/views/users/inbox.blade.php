@extends('template')

@section('main')
<div class="container margin-top30">
  <div class="panel panel-default">
    <div class="panel-body h4">
      <select id="inbox_filter_select" name="filter">
      </select>
    </div>
    <div class="panel-footer ">
      <ul class="list-layout" id="message-list">
        
      </ul>
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
@push('scripts')
  <script type="text/javascript">
    inbox_message_type_load();
    inbox_data_load();
    $(document).on('click', '.inbox-page', function(){
      var page = $(this).attr('data-rel');
      inbox_data_load(page);
    });
    $(document).on('change', '#inbox_filter_select', function(){
      var option = $(this).val();
      inbox_data_load(1, option);
    });

    $(document).on('click', '.inbox-star', function(){
      var temp = $(this).attr('data-rel');
      temp = temp.split('-');
      var msg_id = temp[0];
      var type = temp[1];
      var id = temp[2];
      var dataURL = APP_URL+'/inbox/star';
      $.ajax({
        url: dataURL,
        data: {
          'id' : id,
          'msg_id' : msg_id,
          'type' : type
        },
        type: 'post',
        async: false,
        dataType: 'json',
        success: function (result) {
        },
        error: function (request, error) {
          // This callback function will trigger on unsuccessful action
          //show_error_message('Det har oppstått nettverksfeil vennligst prøv igjen');
        },
      });
      var star_name = type == 'Star'? 'Unstar':'Star';
      var datarel = msg_id+'-'+star_name+'-'+id;
      $(this).attr('data-rel', datarel);
      $(this).html(star_name);
      inbox_message_type_load();
    });

    $(document).on('click', '.inbox-archive', function(){
      var temp = $(this).attr('data-rel');
      temp = temp.split('-');
      var msg_id = temp[0];
      var type = temp[1];
      var id = temp[2];
      var dataURL = APP_URL+'/inbox/archive';
      $.ajax({
        url: dataURL,
        data: {
          'id' : id,
          'msg_id' : msg_id,
          'type' : type
        },
        type: 'post',
        async: false,
        dataType: 'json',
        success: function (result) {
        },
        error: function (request, error) {
          // This callback function will trigger on unsuccessful action
        },
      });
      var archive_name = type == 'Archive'? 'Unarchive':'Archive';
      var datarel = msg_id+'-'+archive_name+'-'+id;
      $(this).attr('data-rel', datarel);
      $(this).html(archive_name);
      inbox_message_type_load();
    });

    function inbox_data_load(page, type){
      type='all';
      var dataURL = APP_URL+'/inbox/message_with_type'+'?page='+page;
      $.ajax({
        url: dataURL,
        data: {
          data : 1,
          type : type
        },
        type: 'post',
        async: false,
        dataType: 'json',
        success: function (result) {
          var messages = result.data;
          var message_list = '';
          var pagination = '';
          if(result.from == null){
              result.from = 0;
          }
          if(result.to == null){
              result.to = 0;
           }
           if(result.total == null){
              result.from = 0;
           }
          for (var key in messages) {
            if (messages.hasOwnProperty(key)) {
              var checkin = new Date(messages[key].bookings.start_date);
              var checkout = new Date(messages[key].bookings.end_date);
              checkin = checkin.getDate()+'/'+(checkin.getMonth() + 1)+'/'+checkin.getFullYear();
              checkout = checkout.getDate()+'/'+(checkout.getMonth() + 1)+'/'+checkout.getFullYear();
              var content = '';
              var view_url = '';
              if (messages[key].message != null)
                content = messages[key].message;
              
              if(messages[key].host_user ==1 && messages[key].bookings.status != 'Pending') view_url = "{{ url('messaging/host') }}/"+messages[key].booking_id;
              else if(messages[key].host_user ==1 && messages[key].bookings.status == 'Pending') view_url = "{{ url('booking')}}/"+ messages[key].booking_id;
              else view_url = "{{ url('messaging/guest')}}/"+ messages[key].booking_id;

              var star_name = messages[key].star == '1'? 'Unstar':'Star';
              var archive_name = messages[key].archive == '1'? 'Unarchive':'Archive';
              message_list += '<li id="'+messages[key].id+'" class="panel-body thread-read thread"><div class="row">'
                +'<div class="col-md-3">'
                  +'<div class="col-5"><a href="#"><img height="50" width="50" title="'+messages[key].sender.first_name+'" src="'+messages[key].sender.profile_src+'" alt="'+messages[key].sender.first_name+'"></a></div>'
                  +'<div class="col-7">'+messages[key].sender.first_name+'<br>'+messages[key].created_time +'</div>'
                +'</div>'
                +'<div class="col-md-8">'
                  +'<a href="'+view_url+'">'
                  +'<span style="color:black"><b>'+content+'</b></span><br>'
                  +'<span class="text-muted"><span class="street-address">'+messages[key].property_address.address_line_1+' '+messages[key].property_address.address_line_2+'</span>, <span class="locality">'+messages[key].property_address.city+'</span>, <span class="region">'+messages[key].property_address.state+'</span>'
                    +' '+checkin+', '+ checkout +' '
                  +'</span>'
                  +'</a>'       
                +'</div>'
                +'<div class="col-md-1">'
                  +'<span class="label label-'+messages[key].bookings.label_color+'">'+messages[key].bookings.status+'</span>'
                  +'<br>'+messages[key].bookings.currency.symbol + messages[key].bookings.total+'</span>'
                +'</div>'
              +'</div></li>';
              
            }
          }
          $('#inbox-page-info').html(result.from+' – '+result.to+' of '+result.total+' {{trans("messages.users_dashboard.message")}}');
          var page_show = Math.min(5, result.last_page);
          $('#message-list').html(message_list);
          if(result.prev_page_url != null)
            pagination += '<li><a class="inbox-page" data-rel="1" href="javascript:void(0)"><<</a></li><li><a class="inbox-page" data-rel="'+(result.current_page-1)+'" href="javascript:void(0)">< Prev</a></li>';
          for(var i=1; i <= page_show; i++){
            if(i == result.current_page) pagination += '<li class="active"><a href="javascript:void(0)">'+i+'</a></li>';
            else pagination += '<li><a class="inbox-page" data-rel="'+i+'" href="javascript:void(0)">'+i+'</a></li>';
          }
          if(result.next_page_url != null)
            pagination += '<li><a class="inbox-page" data-rel="'+(result.current_page+1)+'" href="javascript:void(0)">Next ></a></li><li><a class="inbox-page" data-rel="'+result.last_page+'" href="javascript:void(0)">>></a></li>';
          $('#inbox-pagination').html(pagination);
        },
        error: function (request, error) {
        
        },
       
      });
    } 

    function inbox_message_type_load(type){
      type = 'all';
      var filter_options = '';
      var dataURL = APP_URL+'/inbox/message_count';
      $.ajax({
        url: dataURL,
        data: {
          data : 1,
          type : type
        },
        type: 'post',
        async: false,
        dataType: 'json',
        success: function (result) {
          filter_options = '<option value="all" selected="selected" >'+"{{trans('messages.users_dashboard.all_messages')}}"+' ('+result.all_message_count+')</option>'
          
          +'<option value="unread">'+"{{trans('messages.users_dashboard.unread')}}"+' ('+result.unread_count+')</option>'
          +'<option value="accepted_requests">'+"{{trans('messages.users_dashboard.accepted_requests')}}"+' ('+result.accepted_count+')</option>'
          +'<option value="pending_requests">'+"{{trans('messages.users_dashboard.pending_requests')}}"+' ('+result.pending_count+')</option>'
          +'<option value="cancelled_requests">'+"{{trans('messages.users_dashboard.cancelled_requests')}}"+' ('+result.cancelled_count+')</option>'
          +'<option value="declined_requests">'+"{{trans('messages.users_dashboard.declined_requests')}}"+' ('+result.declined_count+')</option>'
          +'<option value="expired_requests">'+"{{trans('messages.users_dashboard.expired_requests')}}"+' ('+result.expired_count+')</option>'
          
          $('#inbox_filter_select').html(filter_options);
        },
        error: function (request, error) {
          
        },

      });
    }
  </script>
@endpush
@stop


