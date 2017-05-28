<div class="modal-body">
@if($edit)
{!! Form::model($user, ['route' => ['user.update', $user->id], 'method' => 'PUT', 'id' => 'form-generic', 'class' => 'form-horizontal form-label-left']) !!}
@else
 {!! Form::open(['route' => 'user.store', 'id' => 'form-generic', 'class' => 'form-horizontal form-label-left']) !!}
@endif
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.name')">@lang('app.name') <span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
    {!! Form::text('name', old('name'), ['class' => 'form-control', 'id' => 'name']) !!}
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.last_name')">@lang('app.last_name') <span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
    {!! Form::text('lastname', old('lastname'), ['class' => 'form-control', 'id' => 'lastname']) !!}
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.email')">@lang('app.email') <span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
    {!! Form::text('email', old('email'), ['class' => 'form-control', 'id' => 'email']) !!}
    </div>
  </div>
  @if(!$edit)
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.email')">@lang('app.password') <span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
    {!! Form::password('password',['class' => 'form-control', 'id' => 'password']) !!}
    </div>
  </div>
  @endif
 <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.phone')">@lang('app.phone')</label>
    <div class="col-md-6 col-sm-6 col-xs-12">
    {!! Form::text('phone', old('phone'), ['class' => 'form-control phones', 'id' => 'phone', 'data-inputmask' => "'mask' : '999999999'"]) !!}
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.birthday')">@lang('app.birthday')
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
    {!! Form::text('birthday', isset($user->birthday) ? $user->birthday : old('birthday'), ['class' => 'form-control', 'id' => 'birthday', 'readonly' => 'readonly']) !!}
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.role')">@lang('app.role') <span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12 orb-form">
      @foreach($roles as $role) 
          <input type="checkbox" id='{{$role->name}}' name="role[]" value="{{$role->id}}" {{(isset($user) && $user->hasRole($role->name)) ? 'checked': ''}}><i></i> {{$role->display_name}}<br>
      @endforeach
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.status')">@lang('app.status') <span class="required">*</span>
    </label>
    <div class="col-md-4 col-sm-4 col-xs-12">
      {!! Form::select('status', $status, old('status'), ['class' => 'form-control']) !!}
    </div>
  </div>

</div>
<div class="modal-footer">
  @if($edit)
    <button type="submit" class="btn btn-primary btn-submit col-sm-2 col-xs-6">@lang('app.update')</button>
  @else
      <button type="submit" class="btn btn-primary btn-submit col-sm-2 -xs-6">@lang('app.save')</button>
  @endif
  <button type="button" class="btn btn-default col-sm-2 col-xs-5" data-dismiss="modal">@lang('app.close')</button>
</div>
{!! Form::close() !!}
 
<script>
  $(document).ready(function() {

      $(".phones").inputmask();

      $('#birthday').datetimepicker({
        format: 'DD-MM-YYYY',
        ignoreReadonly: true,
        viewMode: 'years'
      });
   
  });
</script>
