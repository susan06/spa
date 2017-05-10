@extends('layouts.auth')

@section('page-title', trans('app.registration'))

@section('content') 

<div class="center-block" style="width: 500px;">
  <div class="login-block">
  {!! Form::open(['url' => '/register', 'class'=>'orb-form', 'method' => 'post', 'id' => 'login-form']) !!}
      <header>
        <div class="image-block">
         <a href="{{ url('login') }}">
        {{ HTML::image('assets/images/logos/logo3.png', Settings::get('app_name')) }}
        </a>
        </div>
        @lang('app.registration_to') {{ Settings::get('app_name') }}
        <small><h4><a href="{{ url('login') }}">@lang('app.login')</a></h4></small> 
      </header>
      <fieldset>
        <div class="row">
          <section class="col col-6">
              <label class="label">@lang('app.agent_external')</label>
              <label class="select">
                <select name="agent_external">
                  <option value="">@lang('app.select')</option>
                  <option value="operator">@lang('app.operator')</option>
                  <option value="agency">@lang('app.agency')</option>
                </select>
                <i></i> </label>
          </section>
          <section class="col col-6">
            <label class="label">@lang('app.name')</label>
              <label class="input"> 
                <input type="text" name="name" id="name" value="{{ old('name') }}">
              </label>
          </section>
        </div>
       <div class="row">          
          <section class="col col-6">
            <label class="label">@lang('app.lastname')</label>
              <label class="input"> 
                <input type="text" name="lastname" id="lastname" value="{{ old('lastname') }}">
              </label>
          </section>
          <section class="col col-6">
            <label class="label">@lang('app.email')</label>
              <label class="input"> 
                <input type="text" name="email" id="email" value="{{ old('email') }}">
              </label>
          </section>
        </div>
        <div class="row">
          <section class="col col-6">
            <label class="label">@lang('app.phone')</label>
              <label class="input"> 
                <input type="text" name="phone" id="phone" value="{{ old('phone') }}">
              </label>
          </section>
          <section class="col col-6">
              <label class="label">@lang('app.mobile')</label>
              <label class="input"> 
                <input type="text" name="mobile" id="mobile" value="{{ old('mobile') }}">
              </label>
          </section>
        </div>        
        <div class="row">
          <section class="col col-6">
              <label class="label">@lang('app.password')</label>
              <label class="input"> 
                <input type="password" name="password" id="password">
              </label>
          </section>
          <section class="col col-6">
              <label class="label">@lang('app.confirm_password')</label>
              <label class="input"> 
                <input type="password" name="password_confirmation" id="password_confirmation">
              </label>
          </section>
        </div>
        @if (Settings::get('terms_and_conditions_show'))
          <section>
            <label class="checkbox">
              <input type="checkbox" name="accept_terms" id="accept_terms" value="1" checked>
              <i></i>@lang('app.i_accept') <a href="#terms_and_conditions_modal" data-toggle="modal">@lang('app.terms_of_service')</a>
            </label>
          </section>
        @else
          <input type="checkbox" name="accept_terms" id="accept_terms" value="1" checked="checked" style="display: none" />
        @endif
      </fieldset>
      <footer>
        {!! Form::submit(trans('app.register'), ['class' => 'btn btn-default btn-submit']) !!}
      </footer>
    {!! Form::close() !!}
  </div>
  @include('copyrights')
</div>

@if (Settings::get('terms_and_conditions_show'))
<div class="modal fade" id="terms_and_conditions_modal" tabindex="-1" role="dialog" aria-labelledby="tos-label">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="modal-title">@lang('app.terms_and_conditions')</h3>
            </div>
            <div class="modal-body">
                {!! Settings::get('terms_and_conditions') !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default col-sm-2 col-xs-5" data-dismiss="modal">@lang('app.close')</button>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
