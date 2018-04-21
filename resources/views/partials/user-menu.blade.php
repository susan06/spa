 <nav class="navbar navbar-default navbar-fixed">
    <div class="container-fluid" style="background-color: #8bd9ea; height: 50px;">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand menu-click" href="{{ route('home') }}">{{ settings::get('app_name') }}</a>
        </div>
        @if(Auth::check())
         <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            {{ Auth::user()->full_name() }}
                            <b class="caret"></b>
                      </a>
                      <ul class="dropdown-menu">
                        <li><a href="{{ route('profile.index')}}" class="menu-click">@lang('app.profile')</a></li>
                        <li><a href="{{ route('user.setting') }}" class="menu-click">@lang('app.setting')</a></li>
                        <li><a href="{{ route('user.password') }}" class="menu-click">@lang('app.auth_and_registration')</a></li>
                      </ul>
                </li>
                <li>
                    <a href="{{ route('auth.logout') }}">
                        @lang('app.sign_out')
                    </a>
                </li>
            </ul>
        </div>
        @endif
    </div>
</nav>
