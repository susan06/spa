 <nav class="navbar navbar-fixed navbar-menu">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" id="nav-bar-button" class="navbar-toggle" data-toggle="collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand site-name" href="{{ url('/') }}">
             <img src="{{ asset('images/logo.png') }}">
            </a>
        </div>     
    </div>
</nav>

<div class="div-menu-header">
    <ul class="nav navbar-nav menu-header visible-pc">
        <li>
            <a href="{{ route('local.news') }}" class="active menu-click">
                <i class="pe-7s-star"></i>
                Nuevos
            </a>
        </li>
        <li>
            <a href="#" class="-menu-click">
                <i class="pe-7s-ribbon"></i>
                Ranking
            </a>
        </li>
         <li>
            <a href="#" class="-menu-click">
                <i class="pe-7s-map-2"></i>
                Locales cerca
            </a>
        </li>
        <li>
            <a href="#" class="-menu-click">
                <i class="pe-7s-compass"></i>
                Localidad
            </a>
        </li>
        <li>
            <a href="{{ route('local.reservations') }}" class="menu-click">
                <i class="pe-7s-alarm"></i>
                Reserva Online
            </a>
        </li>
        <li>
            <a href="{{ route('faqs') }}" class="-menu-click">
                <i class="pe-7s-bookmarks"></i>
                FAQs
            </a>
        </li>
        <li>
            <a href="{{ route('conditions') }}" class="-menu-click">
                <i class="pe-7s-notebook"></i>
                Términos y condiciones
            </a>
        </li>
        @if(Auth::check())
        <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="pe-7s-user"></i>
                    {{ Auth::user()->full_name() }}
                    <b class="caret"></b>
              </a>
              <ul class="dropdown-menu">
                <li><a href="{{ route('profile.index')}}">@lang('app.profile')</a></li>
                <li><a href="{{ route('user.setting') }}">@lang('app.setting')</a></li>
                <li><a href="{{ route('user.password') }}">@lang('app.auth_and_registration')</a></li>
              </ul>
        </li>
        <li>
            <a href="{{ route('auth.logout') }}" class="menu-click">
            <i class="pe-7s-back"></i>
                @lang('app.sign_out')
            </a>
        </li>
        @else
        <li>
            <a href="{{ route('login') }}" class="menu-click">
            <i class="pe-7s-lock"></i>
                Ingresar
            </a>
        </li>
        @endif
    </ul>
</div>
