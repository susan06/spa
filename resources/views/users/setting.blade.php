@extends('layouts.app')

@section('page-title',  trans('app.setting'))

@section('content')

<div class="row">
  <div class="col-md-12 col-xs-12">
    <div class="card">
      <div class="header">
        <h4>{{ trans('app.auth_and_registration') }}
            <small>{{trans('app.settings_users')}}</small></h4>
      </div>
      <div class="content">
          <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">  
                {!! Form::open(['route' => 'user.setting.update', 'method' => 'PUT', 'class' => '']) !!}
                <div class="row">

                  <div class="col-md-6 col-xs-12">
                    <div class="form-group">
                        <label'>@lang('app.language_default') </label>
                       {!! Form::select('lang', $languages, $user->lang, ['class' => 'form-control']) !!}
                    </div>
                  </div>

                </div>

                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">   
                  <button type="submit" class="btn btn-danger btn-fill menu-click pull-right">@lang('app.update')</button>
                </div>

                <div class="clearfix"></div>

               {!! Form::close() !!}
              </div>
          </div>
      </div>
    </div>
  </div>
</div>

@endsection
