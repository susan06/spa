<!--Main Menu-->
<ul class="nav">
  <li class="{{Request::is('home*') ?  'active' : '' }}">
      <a href="{{ route('home') }}" title="@lang('app.home')">
          <i class="pe-7s-home"></i>
          <p>@lang('app.home')</p>
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

    @permission('users.activity')
    <li class="{{ Request::is('activity*') ? 'active' : ''  }}">
      <a  href="{{ route('activity.index') }}" title="@lang('app.activity_log')">
      <i class="pe-7s-display1"></i>
      <p>@lang('app.activity_log')</p>
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

    <li class="{{ Request::is('conditions_and_privacy*') ? 'active' : ''  }}">
        <a  href="{{ route('setting.conditions_and_privacy') }}" title="terminos">
        <i class="pe-7s-notebook"></i>
        <p>Términos y condiciones</p>
        </a>
    </li>


    @permission('settings.general') 
       <li class="menu {{ Request::is('setting*') ? 'active' : ''  }}">
        <a href="{{ route('setting.administration') }}" title="@lang('app.setting')">
        <i class="pe-7s-config"></i>
        <p> @lang('app.setting')</p>
        </a>
      </li>
    @endpermission

</ul>

<!--/MainMenu--> 