@extends('layouts.auth')

@section('page-title', trans('app.login'))

@section('content') 

<?php                  
  Session::set('backUrl', URL::previous());
?>

<div class="row content-login">
  <div class="col-md-4 col-xs-12">
        <div class="flat-form form-login">
            <ul class="tabs">
                <li>
                    <a href="#login" class="active">Login</a>
                </li>
                <li>
                    <a href="#register" id="register-menu">Registrarse</a>
                </li>
            </ul>
            <div id="login" class="form-action show">

              <div class="col-md-12 col-xs-12 btn-social">
                <a href="#" class="btn-login btn-lg btn-block omb_btn-facebook">
                  <span class="">Entrar con Facebook</span>
                </a>
              </div>

                <div class="col-md-12 col-xs-12">
                  {!! Form::open(['url' => '/authenticate', 'class' => 'omb_login']) !!}
                      <div class="form-group">
                          <input type="text" name="username" placeholder="@lang('app.email_or_username')" class="form-control"/>
                      </div>
                      <div class="form-group">
                          <input type="password" name="password" placeholder="@lang('app.password')" class="form-control"/>
                      </div>

                    <div class="col-md-12 col-xs-12 btn-social">
                      <input type="submit" value="Login" class="btn-login btn-lg btn-block omb_btn-login" />
                      </a>
                    </div>

                    <div class="col-xs-5 col-md-6 pull-left">
                      <label class="remember">
                      @if (Settings::get('remember_me'))
                        <input type="checkbox" value="remember-me">@lang('app.remember_me')
                      @endif
                      </label>
                    </div>

                    <div class="col-xs-12 col-md-6 pull-right">
                      <p class="omb_forgotPwd">
                      @if(Settings::get('forgot_password'))
                        <a href="{{ url('password/remind') }}">@lang('app.i_forgot_my_password')</a>
                      @endif
                      </p>
                    </div>

                  {!! Form::close() !!}
                </div>
            </div>
            <!--/#login.form-action-->
            <div id="register" class="form-action hide">
                <div class="col-md-12 col-xs-12">
                  {!! Form::open(['url' => '/register', 'class'=>'', 'method' => 'post']) !!}

                    <div class="col-md-12 col-xs-12">
                      <div class="form-group">
                        <input type="text" name="email" placeholder="@lang('app.email')" value="{{ old('email') }}" class="form-control"/>
                      </div>
                    </div>

                    <div class="col-md-12 col-xs-12">
                      <div class="col-md-6 col-xs-6 login-row">
                        <div class="form-group">
                          <input type="text" name="name" placeholder="@lang('app.name')" value="{{ old('name') }}" class="form-control"/>
                        </div>
                      </div>
                      <div class="col-md-6 col-xs-6 login-row-right">
                        <div class="form-group">
                          <input type="text" name="lastname" placeholder="@lang('app.lastname')" value="{{ old('lastname') }}" class="form-control"/>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-12 col-xs-12">
                      <div class="col-md-6 col-xs-6 login-row">
                        <div class="form-group">
                          <input type="text" name="birthday" placeholder="@lang('app.birthday')" value="{{ old('birthday') }}" class="form-control birthday" data-inputmask="'mask' : '99-99-9999'"/>
                        </div>
                      </div>
                      <div class="col-md-6 col-xs-6 login-row-right">
                        <div class="form-group">
                          <input type="text" name="phone" placeholder="@lang('app.phone')" value="{{ old('phone') }}" class="form-control phones" data-inputmask="'mask' : '9999999999'"/>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-12 col-xs-12">
                      <div class="col-md-6 col-xs-6 login-row">
                        <div class="form-group">
                          <input type="password" name="password" placeholder="@lang('app.password')" class="form-control"/>
                        </div>
                      </div>
                      <div class="col-md-6 col-xs-6 login-row-right">
                        <div class="form-group">
                          <input type="password" name="password_confirmation" placeholder="@lang('app.confirm_password')" class="form-control"/>
                        </div>
                      </div>
                    </div>

                  @if (Settings::get('terms_and_conditions_show'))
                    <div class="col-md-12 col-xs-12">
                      <label class="">
                        <input type="checkbox" name="accept_terms" id="accept_terms" value="1" checked>
                        @lang('app.i_accept') <a href="#terms_and_conditions_modal" class="text-red" data-toggle="modal">@lang('app.terms_of_service')</a>
                      </label>
                    </div>
                  @else
                    <input type="checkbox" name="accept_terms" id="accept_terms" value="1" checked="checked" style="display: none" />
                  @endif

                    <div class="form-group">
                        <input type="submit" value="Crear cuenta" class="btn btn-fill btn-danger menu-click pull-right" />
                    </div>
                {!! Form::close() !!}               
            </div>
        </div>
  </div>


@if (Settings::get('terms_and_conditions_show'))
<div class="modal fade" id="terms_and_conditions_modal" tabindex="-1" role="dialog" aria-labelledby="tos-label" style="z-index: 9999;">
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

</div>

@endsection

@section('scripts')

<!-- jquery.inputmask -->
 {!! HTML::script('vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js') !!}

 <!-- bootstrap-daterangepicker -->
 {!! HTML::script('vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js') !!}

<script type="text/javascript">
  (function( $ ) {
  // constants
  var SHOW_CLASS = 'show',
      HIDE_CLASS = 'hide',
      ACTIVE_CLASS = 'active';
  
  $( '.tabs' ).on( 'click', 'li a', function(e){
    e.preventDefault();
    var $tab = $( this ),
         href = $tab.attr( 'href' );
  
     $( '.active' ).removeClass( ACTIVE_CLASS );
     $tab.addClass( ACTIVE_CLASS );
  
     $( '.show' )
        .removeClass( SHOW_CLASS )
        .addClass( HIDE_CLASS )
        .hide();
    
      $(href)
        .removeClass( HIDE_CLASS )
        .addClass( SHOW_CLASS )
        .hide()
        .fadeIn( 550 );
  });
})( jQuery );

  $(".phones").inputmask();
  $(".birthday").inputmask();

  @if(Session::get('register', false))
    $('#register-menu').trigger('click');
  @endif

</script>
@endsection