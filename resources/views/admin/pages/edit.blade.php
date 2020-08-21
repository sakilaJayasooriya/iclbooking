@extends('admin.template')

@section('main')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Edit Page Form
      <small>edit page form</small>
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
            <h3 class="box-title">Edit Page Form</h3>
          </div>
          <!-- form start -->
          <form class="form-horizontal" action="{{url('admin/edit-page/'.$result->id)}}" id="edit_page" method="post" name="edit_page" accept-charset='UTF-8' {{-- onsubmit="return contentValidate();" --}}>
            {{ csrf_field() }}



            <div class="box-body">

              <div class="form-group">
               <label for="exampleInputPassword1" class="control-label col-sm-3">Name<span style="color: red !important;">*</span></label>
               <div class="col-sm-6">
                 <input type="text" class="form-control" value="{{$result->name}}" name="name" placeholder="">
               </div>
             </div>
             <div class="form-group">
               <label for="exampleInputPassword1" class="control-label col-sm-3">URL<span style="color: red !important;">*</span></label>
               <div class="col-sm-6">
                 <input type="text" class="form-control" name="url" id="subject" placeholder="" value="{{$result->url}}">
               </div>
             </div>
             <div class="form-group">
               <label for="inputEmail3" class="col-sm-3 control-label">Content<span style="color: red !important;">*</span></label>  
               <div class="col-sm-6">
                 <textarea id="editor" name="content" placeholder="" rows="10" cols="80" class="">{{$result->content}} </textarea>
                 <span id="content-validation-error"></span>
               </div>

             </div>
             <div class="form-group">
              <label for="exampleInputPassword1" class="control-label col-sm-3">Position</label>
               <div class="col-sm-6">
                 <select name="position" class="form-control">
                   <option value="first" {{isset($result->position) == 'first' ? 'selected': ""}}> First Column </option>
                   <option value="second" {{isset($result->position) == 'second' ? 'selected': ""}}> Second Column </option>
                 </select>
               </div>
             </div>
              <div class="form-group">
              <label for="exampleInputPassword1" class="control-label col-sm-3">Status</label>
               <div class="col-sm-6">
                 <select name="status" class="form-control">
                   <option value="Active" {{isset($result->status) == 'Active' ? 'selected': ""}}> Active </option>
                   <option value="Inactive" {{isset($result->status) == 'Inactive' ? 'selected': ""}}>Inactive</option>
                 </select>
               </div>
             </div>

           </div>
           <!-- /.box-body -->
           <div class="box-footer">
            <button type="submit" class="btn btn-info" id="submitBtn">Submit</button>
            <a href="{{url('admin/pages')}}" class="btn btn-danger btn-sm">
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
 
<script src="https://cdn.ckeditor.com/ckeditor5/16.0.0/classic/ckeditor.js"></script>
 <script type="text/javascript">
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .then( editor => {
          console.log( editor );
        } )
        .catch( error => {
          console.error( error );
        } );
    

  
</script>
<script>

  $(document).ready(function() {
   $(document).on('submit', 'form', function() {
     $('button').attr('disabled', 'disabled');
   });
 });
</script>
<script type="text/javascript">
 $(document).ready(function () {


  $('#edit_page').validate({
    rules: {
      name: {
        required: true
      },
      url:{
        required:true
      }
 
    }

 });
});

</script>
@endpush