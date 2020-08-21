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
                  <div class="col-md-9">

                          <div class="box box_info">
                                <div class="box-header">
                                  <h3 class="box-title">Amenity Type Management</h3>
                                  <div style="float:right;"><a class="btn btn-success" href="{{ url('admin/settings/add-amenities-type') }}">Add Amenity Type</a></div>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    {!! $dataTable->table() !!}
                                </div>
                          </div>
                  </div>
          </div>
      </section>
 </div>
@endsection

@push('scripts')
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
<script src="{{url('public/js/buttons.server-side.js')}}"></script>
<script src="{{ url('public/backend/dist/js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
{!! $dataTable->scripts() !!}
@endpush
