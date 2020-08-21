@extends('admin.template')

@section('main')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Update message form
      <small>Update message</small>
    </h1>
    @include('admin.common.breadcrumb')
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <!-- right column -->
      <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box">
          <!-- /.box-header -->
          <div class="box-header with-border">
            <h3 class="box-title">Update message form</h3>
          </div>
          <!-- form start -->
          <form class="form-horizontal" action="{{url('admin/send-message-email/'.$messages->id)}}" id="send_email" method="post" name="add_customer" accept-charset='UTF-8' {{-- onsubmit="return contentValidate();" --}}>
            {{ csrf_field() }}

            
            <input type="hidden" name="message_id" value="{{$messages->id}}">

            <div class="box-body">

              <div class="form-group">
               
               <div class="col-sm-6">
                 <input type="hidden" class="form-control" value="{{$messages->receiver_id}}" name="receiver_id" placeholder="">
               </div>
             </div>
          
             <div class="form-group">
               <label for="inputEmail3" class="col-sm-3 control-label">Message<span style="color: red !important;">*</span></label>  
               <div class="col-sm-6">
                 <textarea id="content" name="content" placeholder="" class="form-control col-md-12"> {{$messages->message}} </textarea>
                 <span id="content-validation-error"></span>
               </div>

             </div>
             <div class="form-group">
                <input type="hidden" class="form-control" value="{{$messages->type_id}}" name="admin_email" placeholder="">
               
               <div class="col-sm-6">

                 <input type="hidden" class="form-control" value="{{$messages->sender->email}}" name="admin_email" placeholder="">
               </div>
             </div>

           </div>
           <!-- /.box-body -->
           <div class="box-footer">
            <button type="submit" class="btn btn-info" id="submitBtn">Update</button>
            <a href="{{url('admin/messages')}}" class="btn btn-danger btn-sm">
              Cancel
            </a>
           
          </div>
          <!-- /.box-footer -->
        </form>
      </div>
      <!-- /.box -->

      <!-- /.box -->
    </div>
    <!--/.col (right) -->
  </div>
</section>
</div>
@endsection

@push('scripts')

<script>

  $(document).ready(function() {
   $(document).on('submit', 'form', function() {
     $('button').attr('disabled', 'disabled');
   });
 });
</script>

<script type="text/javascript">
 $(document).ready(function () {


  $('#send_email').validate({
  
    rules: {
       content: {
          required: true,
    }
  }
});
});

</script>

@endpush

