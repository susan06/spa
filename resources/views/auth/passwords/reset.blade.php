@extends('layouts.auth')

@section('page-title', trans('app.reset_password'))

@section('content') 


<div class="row content-login">
  <div class="col-md-4 col-xs-12">
        <div class="flat-form form-login">
            <ul class="tabs">
                <li style="width: 100%;">
                    <a href="#" class="active">@lang('app.reset_password')</a>
                </li>
            </ul>

            <div class="form-action">
              <br>
                <div class="col-md-12 col-xs-12">
                   {!! Form::open(['url' => '/password/reset', 'class'=>'', 'method' => 'post', 'id' => '']) !!}

                   <input type="hidden" name="token" value="{{ $token }}">

                   <div class="col-md-12 col-xs-12">
                        <div class="form-group">
                          <input type="text" name="email" id="email" value="{{ $email }}" class="form-control" readonly="readonly"/>
                        </div>
                    </div>

                    <div class="col-md-12 col-xs-12">
                        <div class="form-group">
                          <input type="password" name="password" placeholder="@lang('app.password')" class="form-control"/>
                        </div>
                    </div>

                    <div class="col-md-12 col-xs-12">
                        <div class="form-group">
                          <input type="password" name="password_confirmation" placeholder="@lang('app.confirm_password')" class="form-control"/>
                        </div>
                    </div>

                    <div class="col-md-12 col-xs-12">
                        <input type="submit" value="@lang('app.update_password')" class="btn btn-fill btn-danger menu-click" />
                    </div>
                {!! Form::close() !!}               
            </div>
        </div>
  </div>

</div>

@endsection
