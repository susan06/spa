{!! Form::open(['route' => 'setting.update']) !!}

<div class="row">
  <div class="col-md-6 col-sm-6 col-xs-12">
    <div class="form-group">
      <label for="@lang('app.name')">@lang('app.name') <span class="required">*</span>
      </label>
      {!! Form::text('app_name', Settings::get('app_name'), ['class' => 'form-control']) !!}
    </div>
  </div>

<div class="col-md-6 col-sm-6 col-xs-12">
  <div class="form-group">
    <label class="" for="@lang('app.language_default')">@lang('app.language_default')
    </label>
      {!! Form::select('language_default', $languages, Settings::get('language_default'), ['class' => 'form-control col-md-7 col-xs-12']) !!}
  </div>
</div>

</div>

<div class="row">

<div class="col-md-6 col-sm-6 col-xs-12">
  <div class="form-group">
    <label class="" for="@lang('app.timezone')">@lang('app.timezone')
    </label>
      {!! Form::select('timezone', $timezones, Settings::get('timezone'), ['class' => 'form-control']) !!}
    </div>
  </div>

<div class="col-md-6 col-sm-6 col-xs-12">
  <div class="form-group">
    <label class="" for="@lang('app.coin')">@lang('app.coin') <span class="required">*</span>
    </label>
    {!! Form::text('coin', Settings::get('coin'), ['class' => 'form-control']) !!}
    </div>
  </div>

</div>

<div class="row">

<div class="col-md-12 col-sm-12 col-xs-12">
 <div class="form-group">
    <label class="col-md-6 col-sm-6 col-xs-12" for="@lang('app.allow_remember_me')">@lang('app.allow_remember_me')</label>
       <input type="hidden" name="reg_enabled" value="0">
       {!! Form::checkbox('remember_me', 1, Settings::get('remember_me'), ['class' => 'js-switch']) !!}
    </div>
  </div>

<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="form-group">
    <label class="col-md-6 col-sm-6 col-xs-12" for="@lang('app.forgot_password')">@lang('app.forgot_password')</label>
       <input type="hidden" name="forgot_password" value="0">
       {!! Form::checkbox('forgot_password', 1, Settings::get('forgot_password'), ['class' => 'js-switch']) !!}
    </div>
  </div>

<div class="col-md-12 col-sm-12 col-xs-12">
 <div class="form-group">
    <label class="col-md-6 col-sm-6 col-xs-12" for="@lang('app.terms_and_conditions_show')">@lang('app.terms_and_conditions_show')</label>
    <input type="hidden" name="terms_and_conditions_show" value="0">
    {!! Form::checkbox('terms_and_conditions_show', 1, Settings::get('terms_and_conditions_show'),
                ['class' => 'js-switch']) !!}
    </div>
  </div>

<div class="col-md-12 col-sm-12 col-xs-12">
 <div class="form-group">
    <label class="col-md-6 col-sm-6 col-xs-12" for="@lang('app.allow_registration')">@lang('app.allow_registration')</label>
       <input type="hidden" name="reg_enabled" value="0">
       {!! Form::checkbox('reg_enabled', 1, Settings::get('reg_enabled'), ['class' => 'js-switch']) !!}
    </div>
  </div>

 
 <div class="col-md-12 col-sm-12 col-xs-12">
  <div class="form-group">
    <label class="col-md-6 col-sm-6 col-xs-12" for="@lang('app.email_confirmation')">@lang('app.email_confirmation')</label>
       <input type="hidden" name="reg_email_confirmation" value="0">
       {!! Form::checkbox('reg_email_confirmation', 1, Settings::get('reg_email_confirmation'), ['class' => 'js-switch']) !!}
    </div>
  </div>


<div class="col-md-12 col-sm-12 col-xs-12">
  <button type="submit" class="btn btn-fill btn-danger pull-right">@lang('app.update')</button>
</div> 

</div>
{!! Form::close() !!}