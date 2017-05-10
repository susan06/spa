 <nav class="navbar navbar-fixed navbar-menu">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" id="nav-bar" class="navbar-toggle" data-toggle="collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand site-name" href="{{ route('home') }}">
             <img src="{{ asset('images/logo.png') }}">
            </a>
        </div>
        
         <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right visible-pc">
                <li>
                    <a href="#">
                        <i class="pe-7s-home"></i>
                        Inicio
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="pe-7s-search"></i>
                        Busqueda avanzada
                    </a>
                </li>
                 <li>
                    <a href="#">
                        <i class="pe-7s-star"></i>
                        Ranking
                    </a>
                </li>
                 <li>
                    <a href="#">
                        <i class="pe-7s-map-marker"></i>
                        Locales cerca
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
                    <a href="{{ route('auth.logout') }}">
                    <i class="pe-7s-back"></i>
                        @lang('app.sign_out')
                    </a>
                </li>
                @else
                <li>
                    <a href="{{ route('login') }}">
                    <i class="pe-7s-lock"></i>
                        Ingresar
                    </a>
                </li>
                @endif
            </ul>
        </div>
        
    </div>
</nav>
