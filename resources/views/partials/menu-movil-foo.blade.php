 <ul class="nav navbar-nav menu-header">
    <li>
        <a href="{{ route('local.search') }}" class="menu-click">
            <i class="pe-7s-search"></i>
            Buscar
        </a>
    </li>
    <li>
        <a href="{{ route('local.news') }}" class="menu-click">
            <i class="pe-7s-star"></i>
            Nuevos
        </a>
    </li>
    <li>
        <a href="{{ route('faqs') }}" class="menu-click">
            <i class="pe-7s-bookmarks"></i>
            FAQs
        </a>
    </li>
     <li>
        <a href="javascript:void(0)" data-href="{{ route('local.location') }}" onclick="check_gps(this)">
            <i class="pe-7s-map-2"></i>
            Cerca
        </a>
    </li>
    <li>
        <a href="{{ route('local.reservations') }}" class="menu-click">
            <i class="pe-7s-alarm"></i>
            Reserva
        </a>
    </li>gps
</ul>