@extends('admin.template')
@section('main')
  <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{ $page_title or '' }}
        <small>{{ $page_subtitle or '' }}</small>
      </h1>
      @include('admin.common.breadcrumb')
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- right column -->
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">{{ $form_name or '' }}</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form id="{{ $form_id or ''}}" method="post" action="{{ $action or ''}}" onsubmit="return contentValidate();" class="form-horizontal {{ $form_class or '' }}" {{ isset($form_type) && $form_type == 'file'? "enctype=multipart/form-data":"" }}>
              {{ csrf_field() }}
              <div class="box-body">
                @foreach($fields as $field)
                  @include("admin.common.fields.".$field['type'], ['field' => $field])
                @endforeach
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-info btn-space">Submit</button>
                <button type="reset" class="btn btn-danger">Reset</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
          <!-- /.box -->

          <!-- /.box -->
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>

@endsection