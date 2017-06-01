@extends('layouts.frontend')

@section('page-title',  trans('app.auth_and_registration'))

@section('content')

  <div class="col-md-12 col-xs-12">
    <div class="card">
      <div class="header">
        <h4 class="title">{{ trans('app.auth_and_registration') }}
            <small>{{trans('app.change_password')}}</small></h4>
      </div>
      <div class="content">
          <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">  
                {!! Form::open(['route' => ['user.password.update'], 'method' => 'PUT', 'class' => '']) !!}

                <div class="row">

                  <div class="col-md-6 col-xs-12">
                    <div class="form-group">
                        <label>@lang('app.password') </label>
                        {!! Form::password('password', ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'password']) !!}
                    </div>
                  </div>

                </div>

                <div class="row">

                   <div class="col-md-6 col-xs-12">
                    <div class="form-group">
                        <label>@lang('app.confirm_password') </label>
                       {!! Form::password('password_confirmation', ['class' => 'form-control', 'id' => 'password_confirmation']) !!}
                    </div>
                  </div>

                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">   
                  <button type="submit" class="btn btn-danger btn-fill menu-click pull-right">@lang('app.change_password')</button>
                </div>

                <div class="clearfix"></div>

               {!! Form::close() !!}
              </div>
          </div>
      </div>
    </div>
  </div>

@endsection
