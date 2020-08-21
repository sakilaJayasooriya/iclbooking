@extends('template')

@section('main')
  <div class="container margin-top30">
    <div class="col-md-3">
        <div class="panel panel-default">
            <div class="panel-footer">
                <div class="panel">
                @include('common.sidenav')
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-9 min-height-div">
        @if($listed->count() > 0)
        <div class="panel panel-default">
            <div class="panel-body h4">{{trans('messages.property.listed')}}</div>
            @foreach($listed as $row)
            <div class="panel-footer">
                <div class="col-md-2 col-sm-2 col-xs-12"><img class="img-responsive" style="width:100px, height:80px;" src="{{ $row->cover_photo }}"></div>
                <div class="col-md-7 col-sm-7 col-xs-12 margin-top10">
                    <a href="{{ url('properties/'.$row->id) }}" class="text-normal"><div class="h4">{{ ($row->name == '') ? '' : $row->name }}</div></a>
                    <a href="{{ url('listing/'.$row->id.'/basics') }}"><div class="h6 text-danger">{{trans('messages.property.manage_list_cal')}}</div></a>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12 margin-top30">
                    @if($row->steps_count != 0)
                        <a href="{{ url('manage-listing/'.$row->id.'/basics') }}" class="btn ex-btn">{{ $row->steps_count }} {{trans('messages.property.step_listed')}}</a>
                    @else
                        <div id="availability-dropdown" data-room-id="div_{{ $row->id }}">
                            <i class="dot row-space-top-2 col-top dot-{{ ($row->status == 'Listed') ? 'success' : 'danger' }}"></i>
                            <div class="select">
                                <select class="form-control room-list-status" data-room-id="{{ $row->id }}">
                                    <option value="Listed" {{ ($row->status == 'Listed') ? 'selected' : '' }}>{{trans('messages.property.listed')}}</option>
                                    <option value="Unlisted" {{ ($row->status == 'Unlisted') ? 'selected' : '' }}>{{trans('messages.property.unlisted')}}</option>
                                </select>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="clearfix"></div>
            </div>
            @endforeach
        </div>
        @endif
        @if($unlisted->count() > 0)
        <div class="panel panel-default">
            <div class="panel-body h4">{{trans('messages.property.unlisted')}}</div>
            @foreach($unlisted as $row)
            <div class="panel-footer">
                <div class="col-md-2 col-sm-2 col-xs-12"><img class="img-responsive" style="width:100px, height:80px;" src="{{ $row->cover_photo }}"></div>
                <div class="col-md-7 col-sm-7 col-xs-12 margin-top10">
                    <a href="{{ url('properties/'.$row->id) }}" class="text-normal"><div class="h4">{{ ($row->name == '') ? '' : $row->name }}</div></a>
                    <a href="{{ url('listing/'.$row->id.'/basics') }}"><div class="h6 text-danger">{{trans('messages.property.manage_list_cal')}}</div></a>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12 margin-top30">
                    @if($row->steps_completed == 0 && $row->status == NULL)
                    <a class="btn ex-btn" href="{{ url('listing/'.$row->id.'/basics') }}" class="btn ex-btn">{{trans('messages.property.pending')}}</a>
                    @elseif($row->steps_completed != 0)
                    <a class="btn ex-btn" href="{{ url('listing/'.$row->id.'/'.$row->missed_step) }}" class="btn ex-btn">{{ $row->steps_completed }} {{trans('messages.property.step_to_list')}} </a>
                    @else
                    <div id="availability-dropdown" data-room-id="div_{{ $row->id }}">
                        <i class="dot row-space-top-2 col-top dot-{{ ($row->status == 'Listed') ? 'success' : 'danger' }}"></i>&nbsp;
                        <div class="select">
                            <select class="form-control room-list-status" data-room-id="{{ $row->id }}">
                                <option value="Listed" {{ ($row->status == 'Listed') ? 'selected=selected' : '' }}>{{trans('messages.property.listed')}}</option>
                                <option value="Unlisted" {{ ($row->status == 'Unlisted') ? 'selected=selected' : '' }}>{{trans('messages.property.unlisted')}}</option>
                            </select>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="clearfix"></div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
    
  </div>
@stop