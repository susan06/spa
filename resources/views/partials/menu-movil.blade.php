 <ul>
    <li>
        <a href="{{ route('local.search') }}" class="menu-click">
            <i class="pe-7s-search"></i>
            Busqueda avanzada
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
        <a href="{{ route('local.news') }}" class="menu-click">
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
            Mensajes <span class="badge bg-green count-messages">0</span>
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
            Términos y condiciones
        </a>
    </li>
    @if(Auth::check())
    <li>
        <a href="{{ route('profile.index')}}" class="menu-click">
            <i class="pe-7s-user"></i>
            Perfil
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
            Inicio de sesión
        </a>
    </li>
    @endif
</ul>