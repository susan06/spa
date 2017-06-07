 <nav class="navbar navbar-fixed navbar-menu visible-pc">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" id="nav-bar-button" class="navbar-toggle" data-toggle="collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand site-name menu-click" href="{{ url('/') }}">
             <img src="{{ asset('images/logo.png') }}">
            </a>
        </div>     
    </div>
</nav>

<div class="div-menu-header">
    <ul class="nav navbar-nav menu-header visible-pc">
        <li>
            <a href="{{ route('local.search') }}" class="menu-click">
                <i class="pe-7s-search"></i>
                Buscar
            </a>
        </li>
        @if(Auth::check() && Auth::user()->hasRole('client')) 
        <li>
            <a href="{{ route('local.favorites') }}" class="menu-click">
                <i class="pe-7s-safe"></i>
                Guardados
            </a>
        </li>
        @endif
        <li>
            <a href="{{ route('local.news') }}" class="active menu-click">
                <i class="pe-7s-star"></i>
                Nuevos
            </a>
        </li>
        @if(Settings::get('location'))
         <li>
            <a href="#" class="-menu-click">
                <i class="pe-7s-map-2"></i>
                Locales cerca
            </a>
        </li>
        @endif
        <li>
            <a href="{{ route('local.reservations') }}" class="menu-click">
                <i class="pe-7s-alarm"></i>
                Reserva Online
            </a>
        </li>
        @if(Auth::check() && Auth::user()->hasRole('client')) 
        <li>
            <a href="{{ route('local.my.reservations') }}" class="menu-click">
                <i class="pe-7s-ribbon"></i>
                Mis reservas
            </a>
        </li>
        <li>
            <a href="{{ route('messages') }}" class="menu-click">
                <i class="pe-7s-mail"></i>
                Mensajes
            </a>
        </li>
        @endif
        <li>
            <a href="{{ route('faqs') }}" class="menu-click">
                <i class="pe-7s-bookmarks"></i>
                FAQs
            </a>
        </li>
        <li>
            <a href="{{ route('conditions') }}" class="menu-click">
                <i class="pe-7s-notebook"></i>
                Térm. & Cond.
            </a>
        </li>
        @if(Auth::check())
        <li class="dropdown">
            <a href="{{ route('profile.index')}}" class="menu-click">
            <i class="pe-7s-user"></i>
                {{ Auth::user()->full_name() }}
            </a>
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
