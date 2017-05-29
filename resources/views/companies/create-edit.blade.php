<div class="modal-body">
@if($edit)
{!! Form::model($company, ['route' => ['company.update', $company->id], 'method' => 'PUT', 'id' => 'form-generic-modal', 'class' => 'form-horizontal']) !!}
@else
 {!! Form::open(['route' => 'company.store', 'id' => 'form-generic-modal', 'class' => 'form-horizontal']) !!}
@endif
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.name')">@lang('app.name') <span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
    {!! Form::text('name', old('name'), ['class' => 'form-control', 'id' => 'name']) !!}
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.status')">@lang('app.owner') <span class="required">*</span>
    </label>
    <div class="col-md-4 col-sm-4 col-xs-12">
      {!! Form::select('owner_id', $owners, old('owner_id'), ['class' => 'form-control']) !!}
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

