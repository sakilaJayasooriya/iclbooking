@extends('template')

@section('main')
<div class="container margin-top30">
  <input id="id" name="id" type="hidden" value="33661974">
  <input id="redirect_on_error" name="redirect_on_error" type="hidden" value="/users/security?id=33661974">
  <input id="user_password_ok" name="user[password_ok]" type="hidden" value="true">
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
      <div class="panel panel-default">
        <div class="panel-body h5">
          {{trans('messages.account_transaction.transaction')}}
        </div>
        <div class="panel-footer">
          <div class="panel">
            <div class="panel-body" style="padding: 0px 0px;">
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>{{trans('messages.account_transaction.date')}}</th>
                      <th>{{trans('messages.account_transaction.type')}}</th>
                      <th>{{trans('messages.account_transaction.detail')}}</th>
                      <th>{{trans('messages.account_transaction.amount')}}</th>
                      <th>{{trans('messages.account_transaction.status')}}</th>
                    </tr>
                  </thead>
                  <tbody id="transaction-table-body">
                    
                  </tbody>
                </table>
              </div>
              <div style="float:right">
                <p id="transaction-page-info" class="b-mar-none"></p>
                <ul class="pagination" id="transaction-pagination" style="margin: 5px 0px;">
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
  
</div>
@push('scripts')
<script type="text/javascript">
  transaction_data_load();
  $(document).on('click', '.transaction-page', function(){
      var page = $(this).attr('data-rel');
      transaction_data_load(page);
  });
  function transaction_data_load(page = 1){
      var dataURL = APP_URL+'/users/account_transaction_history?page='+page;
      $.ajax({
        url: dataURL,
        data: {
          data : 1,
        },
        type: 'post',
        async: false,
        dataType: 'json',
        /*beforeSend: function (){
          $('#rooms_show').html("");
          show_loader();
        },*/
        success: function (result) {
          var transaction = result.data;
          //alert(transaction);
          var transaction_list = '';
          var pagination = '';
          var transfer = '';
          if(result.from == null){
              result.from = 0;
          }
          if(result.to == null){
              result.to = 0;
           }
           if(result.total == null){
              result.from = 0;
           }
          for (var key in transaction) {
            if (transaction.hasOwnProperty(key)) {
              transfer = transaction[key].status == 'Completed'?"Transfer to "+transaction[key].account:'';
              var oldDate = transaction[key].created_at;
              var newDate = new Date(oldDate);
              var date    = newDate.toISOString().slice(0,10);
              transaction_list += '<tr>'
                                    +'<td>'+date+'</td>'
                                    +'<td>'+"Payout"+'</td>'
                                    +'<td>'+transfer+'</td>'
                                    +'<td><b>'+transaction[key].currency_code+' '+transaction[key].amount+'</b></td>'
                                    +'<td>'+transaction[key].status+'</td>'
                                  +'</tr>';
              
            }
          }
          $('#transaction-table-body').html(transaction_list);
          $('#transaction-page-info').html(result.from+' – '+result.to+' of '+result.total+' {{trans('messages.account_transaction.transaction')}}');
          var page_show = Math.min(5, result.last_page);
          if(result.prev_page_url != null)
            pagination += '<li><a class="transaction-page" data-rel="1" href="javascript:void(0)"><<</a></li><li><a class="transaction-page" data-rel="'+(result.current_page-1)+'" href="javascript:void(0)">< Prev</a></li>';
          for(var i=1; i <= page_show; i++){
            if(i == result.current_page) pagination += '<li class="active"><a href="javascript:void(0)">'+i+'</a></li>';
            else pagination += '<li><a class="transaction-page" data-rel="'+i+'" href="javascript:void(0)">'+i+'</a></li>';
          }
          if(result.next_page_url != null)
            pagination += '<li><a class="transaction-page" data-rel="'+(result.current_page+1)+'" href="javascript:void(0)">Next ></a></li><li><a class="transaction-page" data-rel="'+result.last_page+'" href="javascript:void(0)">>></a></li>';
          $('#transaction-pagination').html(pagination);
        },
        error: function (request, error) {
          // This callback function will trigger on unsuccessful action
          //show_error_message('Det har oppstått nettverksfeil vennligst prøv igjen');
        },
        /*complete: function(){
          hide_loader();
        }*/
      });
  }
</script>
@endpush
@stop