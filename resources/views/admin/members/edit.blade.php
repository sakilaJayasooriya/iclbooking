@extends('admin.template')
@section('main')
  <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Profile Edit Form
        <small>Edit your profile</small>
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

            @include('admin.common.member_menu')

            <div class="tab-content">
              <div id="editProfile" class="tab-pane fade in {{isset($tab) && ( $tab == 'profile' ) ? 'active' : ''}}">
                        <div class="box-header with-border">
                          <h3 class="box-title">Profile Edit Form</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form id="editMember" method="post" action="{{ URL::to('/').'/admin/edit_member/'.$result->id }}" class="form-horizontal">
                          {{ csrf_field() }}
                          <div class="box-body">

                                <div class="form-group">
                                  <label for="inputEmail3" class="col-sm-2 control-label">Name</label>
                                  <div class="col-sm-6">
                                    <input type="text" name="name" class="form-control validate_field" id="name" value="{{$result->name}}" placeholder="Name">
                                    <span class="text-danger">{{ $errors->first($result->name) }}</span>
                                  </div>
                                  <div class="col-sm-4">
                                    <small></small>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                                  <div class="col-sm-6">
                                    <input type="email" name="email" class="form-control validate_field" id="email" value="{{$result->email}}" placeholder="Email" readonly="true">
                                    <span class="text-danger">{{ $errors->first($result->email) }}</span>
                                  </div>
                                  <div class="col-sm-4">
                                    <small></small>
                                  </div>
                                </div>


                              <?php
                                $types = ['User','Admin'];
                                $statuses = ['Active','Inactive'];
                              ?>
                              
                              <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Type</label>
                                <div class="col-sm-6">
                                  <select class="form-control validate_field" id="type" name="type">
                                      @foreach ($types as $type)
                                          <option value='{{ $type }}' {{ (@$_POST['type'] == $type || @$result->type ==  @$type)?'selected':'' }}>{{ $type }}</option>
                                      @endforeach
                                  </select>
                                  <span class="text-danger">{{ $errors->first($result->type) }}</span>
                                </div>
                                <div class="col-sm-4">
                                  <small></small>
                                </div>
                              </div>

                              <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Status</label>
                                <div class="col-sm-6">
                                  <select class="form-control validate_field" id="status" name="status">
                                      @foreach ($statuses as $status)
                                          <option value='{{ $status }}' {{ (@$_POST['status'] == $status || @$result->status ==  @$status)?'selected':'' }}>{{ $status }}</option>
                                      @endforeach
                                  </select>
                                  <span class="text-danger">{{ $errors->first($result->status) }}</span>
                                </div>
                                <div class="col-sm-4">
                                  <small></small>
                                </div>
                              </div>


                          </div>
                          <!-- /.box-body -->
                          <div class="box-footer">
                            <button type="reset" class="btn btn-default">Reset</button>
                            <button type="submit" class="btn btn-info pull-right">Submit</button>
                          </div>
                          <!-- /.box-footer -->
                        </form>
              </div>
            </div>
          </div>
          <!-- /.box -->
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>

@endsection