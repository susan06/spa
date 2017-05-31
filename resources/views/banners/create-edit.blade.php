<div class="modal-body">
@if($edit)
{!! Form::model($banner, ['route' => ['banner.update', $banner->id], 'method' => 'PUT', 'id' => 'form-generic-modal', 'class' => 'form-horizontal form-label-left']) !!}
@else
 {!! Form::open(['route' => 'banner.store', 'id' => 'form-generic-modal', 'class' => 'form-horizontal form-label-left', 'files' => 'true']) !!}
@endif
@if(!$edit)
  <div class="form-group">
    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="@lang('app.image')">@lang('app.image') <span class="required">*</span>
    </label>
    <div class="col-md-10 col-sm-10 col-xs-12">
    <input type="file" name="image" class="form-control" value=""/>
    </div>
  </div>
@endif
  <div class="form-group">
    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="@lang('app.priority')">@lang('app.order') <span class="required">*</span>
    </label>
    <div class="col-md-4 col-sm-4 col-xs-8">
      {!! Form::select('priority', $order, old('priority'), ['class' => 'form-control', 'id' => 'priority']) !!}
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="@lang('app.status')">@lang('app.status') <span class="required">*</span>
    </label>
    <div class="col-md-4 col-sm-4 col-xs-8">
      {!! Form::select('status', $status, old('status'), ['class' => 'form-control', 'id' => 'status-input']) !!}
    </div>
  </div> 
</div>
<div class="modal-footer">
  @if($edit)
    <button type="submit" class="btn btn-primary btn-submit-modal col-sm-2 col-xs-6">@lang('app.update')</button>
  @else
      <button type="submit" class="btn btn-primary btn-submit-modal-file col-sm-2 col-xs-6">@lang('app.save')</button>
  @endif
  <button type="button" class="btn btn-default col-sm-2 col-xs-5" data-dismiss="modal">@lang('app.close')</button>
</div>
{!! Form::close() !!}

