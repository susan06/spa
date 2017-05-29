<!--Main Menu-->
<ul class="nav">

    <li class="{{ Request::is('client*') ? 'active' : ''  }}">
      <a href="{{ route('client.index') }}" title="@lang('app.clients')">
      <i class="pe-7s-users"></i>
      <p> @lang('app.clients')</p>
      </a>
    </li>

    <li class="{{ Request::is('company*') ? 'active' : ''  }}">
        <a  href="{{ route('company.index') }}" title="@lang('app.companies')">
        <i class="pe-7s-medal"></i>
        <p> @lang('app.companies')</p>
        </a>
    </li>

    <li class="{{ Request::is('branch*') ? 'active' : ''  }}">
        <a  href="{{ route('branch.index') }}" title="@lang('app.locales')">
        <i class="pe-7s-map-2"></i>
        <p> @lang('app.locales')</p>
        </a>
    </li>

    <li class="{{ Request::is('banner*') ? 'active' : ''  }}">
        <a  href="{{ route('banner.index') }}" title="@lang('app.banners')">
        <i class="pe-7s-photo"></i>
        <p> @lang('app.banners')</p>
        </a>
    </li>

    @permission('users.manage')
    <li class="{{ Request::is('user*') ? 'active' : ''  }}">
      <a href="{{ route('user.index') }}" title="@lang('app.users')">
      <i class="pe-7s-users"></i>
      <p> @lang('app.users')</p>
      </a>
    </li>
   @endpermission

    @permission('roles.manage') 
      <li class="{{ Request::is('role*') ? 'active' : ''  }}">
        <a  href="{{ route('role.index') }}" title="@lang('app.roles')">
        <i class="pe-7s-id"></i>
        <p>@lang('app.roles')</p>
        </a>
      </li>
    @endpermission

    @permission('permissions.manage')    
      <li class="{{ Request::is('permission*') ? 'active' : ''  }}">
        <a  href="{{ route('permission.index') }}" title="@lang('app.permissions')">
        <i class="pe-7s-door-lock"></i>
        <p>@lang('app.permissions')</p>
        </a>
      </li>
    @endpermission


    <li class="{{ Request::is('faq*') ? 'active' : ''  }}">
        <a  href="{{ route('faq.index') }}" title="@lang('app.faqs')">
        <i class="pe-7s-albums"></i>
        <p>FAQs</p>
        </a>
    </li>

    <li class="{{ Request::is('setting/conditions_and_privacy*') ? 'active' : ''  }}">
        <a  href="{{ route('setting.conditions_and_privacy') }}" title="terminos">
        <i class="pe-7s-notebook"></i>
        <p>Térm. & Cond.</p>
        </a>
    </li>

    @permission('settings.general') 
       <li class="menu {{ Request::is('setting/administration*') ? 'active' : ''  }}">
        <a href="{{ route('setting.administration') }}" title="@lang('app.setting')">
        <i class="pe-7s-config"></i>
        <p> @lang('app.setting')</p>
        </a>
      </li>

       <li class="menu {{ Request::is('parameter-search*') ? 'active' : ''  }}">
        <a href="{{ route('settings.search') }}" title="@lang('app.setting_search')">
        <i class="pe-7s-search"></i>
        <p> Conf. Búsqueda</p>
        </a>
      </li>
    @endpermission

</ul>

<!--/MainMenu--> 