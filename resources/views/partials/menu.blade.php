<!--Main Menu-->
<ul class="nav">

  @permission('users.manage')
    <li class="{{ Request::is('user*') ? 'active' : ''  }}">
      <a href="{{ route('user.index') }}" title="@lang('app.users')">
      <i class="pe-7s-users"></i>
      <p> @lang('app.users')</p>
      </a>
    </li>

    <li class="{{ Request::is('client*') ? 'active' : ''  }}">
      <a href="{{ route('client.index') }}" title="@lang('app.clients')">
      <i class="pe-7s-users"></i>
      <p> @lang('app.clients')</p>
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
        <p> @lang('app.faqs')</p>
        </a>
    </li>

    <li class="{{ Request::is('setting/conditions_and_privacy*') ? 'active' : ''  }}">
        <a  href="{{ route('setting.conditions_and_privacy') }}" title="terminos">
        <i class="pe-7s-notebook"></i>
        <p>Términos y condiciones</p>
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
        <i class="pe-7s-config"></i>
        <p> @lang('app.setting_search')</p>
        </a>
      </li>
    @endpermission

</ul>

<!--/MainMenu--> 