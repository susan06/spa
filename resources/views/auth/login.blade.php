@extends('layouts.frontend')

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
                    <a href="#register">Registrarse</a>
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
                        <input type="checkbox" value="remember-me">Recordarme
                      @endif
                      </label>
                    </div>

                    <div class="col-xs-12 col-md-6 pull-right">
                      <p class="omb_forgotPwd">
                      @if(Settings::get('forgot_password'))
                        <a href="#">Olvido de contraseña</a>
                      @endif
                      </p>
                    </div>

                  {!! Form::close() !!}
                </div>
            </div>
            <!--/#login.form-action-->
            <div id="register" class="form-action hide">
                <div class="col-md-12 col-xs-12">
                <form>

                    <div class="col-md-12 col-xs-12">
                      <div class="form-group">
                        <input type="text" placeholder="@lang('app.email')" class="form-control"/>
                      </div>
                    </div>

                    <div class="col-md-12 col-xs-12">
                      <div class="col-md-6 col-xs-6 login-row">
                        <div class="form-group">
                          <input type="text" placeholder="@lang('app.lastname')" class="form-control"/>
                        </div>
                      </div>
                      <div class="col-md-6 col-xs-6 login-row-right">
                        <div class="form-group">
                          <input type="text" placeholder="@lang('app.lastname')" class="form-control"/>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-12 col-xs-12">
                      <div class="col-md-6 col-xs-6 login-row">
                        <div class="form-group">
                          <input type="text" placeholder="@lang('app.birthday')" class="form-control"/>
                        </div>
                      </div>
                      <div class="col-md-6 col-xs-6 login-row-right">
                        <div class="form-group">
                          <input type="text" placeholder="@lang('app.phone')" class="form-control"/>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-12 col-xs-12">
                      <div class="col-md-6 col-xs-6 login-row">
                        <div class="form-group">
                          <input type="password" placeholder="@lang('app.password')" class="form-control"/>
                        </div>
                      </div>
                      <div class="col-md-6 col-xs-6 login-row-right">
                        <div class="form-group">
                          <input type="password" placeholder="@lang('app.confirm_password')" class="form-control"/>
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                        <input type="submit" value="Crear cuenta" class="btn btn-fill btn-danger pull-right" />
                    </div>
                </form>
                </div>
            </div>
        </div>
  </div>
</div>
@endsection

@section('scripts')

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
</script>
@endsection