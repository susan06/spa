<div class="modal-body">
@if($edit)
{!! Form::model($tour, ['route' => ['tour.update', $tour->id], 'method' => 'PUT', 'id' => 'form-generic-modal', 'class' => 'form-horizontal']) !!}
@else
 {!! Form::open(['route' => 'tour.store', 'id' => 'form-generic-modal', 'class' => 'form-horizontal']) !!}
@endif
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.local')">@lang('app.local') <span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
    {!! Form::select('branch_office_id', $branch_list, old('branch_office_id'), ['class' => 'form-control']) !!}
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.title')">@lang('app.title') <span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
     {!! Form::text('title', old('title'), ['class' => 'form-control']) !!}
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.date_start')">@lang('app.date_start') <span class="required">*</span>
    </label>
    <div class="col-md-3 col-sm-3 col-xs-12">
     {!! Form::date('date_start', old('date_start'), ['class' => 'form-control']) !!}
    </div>
    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="@lang('app.date_end')">@lang('app.date_end') <span class="required">*</span>
    </label>
    <div class="col-md-3 col-sm-3 col-xs-12">
     {!! Form::date('date_end', old('date_end'), ['class' => 'form-control']) !!}
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.view_start')">@lang('app.view_start') <span class="required">*</span>
    </label>
    <div class="col-md-3 col-sm-3 col-xs-12">
     {!! Form::date('view_start', old('view_start'), ['class' => 'form-control']) !!}
    </div>
    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="@lang('app.view_end')">@lang('app.view_end') <span class="required">*</span>
    </label>
    <div class="col-md-3 col-sm-3 col-xs-12">
     {!! Form::date('view_end', old('view_end'), ['class' => 'form-control']) !!}
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.description')">@lang('app.description') <span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
     {!! Form::text('description', old('description'), ['class' => 'form-control']) !!}
    </div>
  </div>
    <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.status')"> @lang('app.status') <span class="required">*</span>
    </label>
    <div class="col-md-3 col-sm-3 col-xs-12">
      <select class="form-control" name="view">
        <option value="1" {{ ($edit && $tour->view == 1) ? 'selected="selected"' : '' }}>Publicada</option>
        <option value="0" {{ ($edit && $tour->view == 0) ? 'selected="selected"' : '' }}>No publicada</option>
      </select>
    </div>
  </div>
</div>
<div class="modal-footer">
  @if($edit)
    <button type="submit" class="btn btn-primary btn-submit-modal col-sm-2 col-xs-6">@lang('app.update')</button>
  @else
      <button type="submit" class="btn btn-primary btn-submit-modal col-sm-2 -xs-6">@lang('app.save')</button>
  @endif
  <button type="button" class="btn btn-default col-sm-2 col-xs-5" data-dismiss="modal">@lang('app.close')</button>
</div>
{!! Form::close() !!}
