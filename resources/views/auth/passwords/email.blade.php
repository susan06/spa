@extends('layouts.auth')

@section('page-title', trans('app.i_forgot_my_password'))

@section('content') 


<div class="row content-login">
  <div class="col-md-4 col-xs-12">
        <div class="flat-form form-login">
            <ul class="tabs">
                <li style="width: 100%;">
                    <a href="#" class="active">@lang('app.i_forgot_my_password')</a>
                </li>
            </ul>

            <div class="form-action">
              <br>
                <div class="col-md-12 col-xs-12">
                   {!! Form::open(['url' => '/password/remind', 'class'=>'', 'method' => 'post', 'id' => '']) !!}

                    <div class="col-md-12 col-xs-12">
                      <div class="form-group">
                        <input type="text" name="email" placeholder="@lang('app.email')" value="{{ old('email') }}" class="form-control"/>
                      </div>
                    </div>

                    <div class="col-md-12 col-xs-12">
                        <button type="submit" class="btn btn-fill btn-danger menu-click">@lang('app.send_password_link_reset')</button>
                    </div>
                {!! Form::close() !!}               
            </div>
        </div>
  </div>

</div>

@endsection
