@extends('admin.template')

@section('main')

  <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3 settings_bar_gap">
          @include('admin.common.settings_bar')
        </div>
        <!-- right column -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              @php $fl = 0; @endphp
              @foreach($tab_names as $id => $name)
                @if($fl == 0)
                  <li class="active"><a href="#{{$id}}" data-toggle="tab">{{$name}}</a></li>
                  @php $fl=1; @endphp 
                @else
                  <li><a href="#{{$id}}" data-toggle="tab">{{$name}}</a></li>
                @endif
              @endforeach
            </ul>
            <div class="tab-content">
              @php $fl = 0; @endphp
              @foreach($tab_forms as $id => $form)
                <div class="tab-pane {{ ($fl == 0)? 'active':''}}" id="{{$id}}">
                  <form id="{{ $form['form_id'] or ''}}" method="post" action="{{ $form['action'] or ''}}" class="form-horizontal {{ $form['form_class'] or '' }}" {{ isset($form['form_type']) && $form['form_type'] == 'file'? "enctype=multipart/form-data":"" }}>
                    {{ csrf_field() }}
                    <div class="box-body">
                      @foreach($form['fields'] as $field)
                        @include("admin.common.fields.".$field['type'], ['field' => $field])
                      @endforeach
                      <div class="box-footer">
                        <button id="myBtn" type="submit" class="btn btn-info btn-space">Submit</button>
                        <a class="btn btn-danger" href="{{ url()->previous() }}">Cancel</a>
                        <!--  <button type="submit" class="btn btn-default">Cancel</button> -->
                      
                      </div>
                    </div>
                    <!-- /.box-body -->
                  </form>
                </div>
                @php $fl = 1; @endphp
              @endforeach
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>

        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
@endsection


