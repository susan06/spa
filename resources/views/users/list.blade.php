<div class="content table-responsive table-full-width">
  <table id="datatable-responsive" class="table table-hover table-striped" cellspacing="0" width="100%">
      <thead>
        <th>@lang('app.profile')</th>
        <th>@lang('app.full_name')</th>
        <th>@lang('app.email')</th>
        <th>@lang('app.time_login')</th>
        <th>@lang('app.registration_date')</th>
        <th>@lang('app.status')</th>
        <th class="text-center">@lang('app.actions')</th>
      </thead>
  <tbody>
      @foreach ($users as $user)
          <tr>
              <td>
                @foreach($user->roles->all() as $role)
                  {{ $role->display_name.'. ' }}
                @endforeach
              </td>
              <td>{!! $user->full_name().' '.$user->isOnline() !!}</td>
              <td>{{ $user->email }}</td>
              <td>{{ ($user->online) ? $user->timeLogin() : '' }}</td>
              <td>{{ $user->created_at }}</td>
              <td>{!! $user->labelStatus() !!}</td>
              <td class="text-center">
                @if (config('session.driver') == 'database')
                  <a type="button" data-href="{{ route('user.sessions', $user->id) }}" class="btn btn-info btn-fill create-edit-show" data-model="modal"
                     title="@lang('app.user_sessions')" data-toggle="tooltip" data-placement="top">
                      <i class="fa fa-list"></i>
                  </a>
                @endif
                  <a href="{{ route('user.show', $user->id) }}" class="btn btn-info btn-fill" title="@lang('app.show_user')" data-toggle="tooltip" data-placement="top">
                      <i class="fa fa-eye"></i>
                  </a>
                  <a type="button" data-href="{{ route('user.edit', $user->id) }}" class="btn btn-info btn-fill create-edit-show" data-model="modal"
                     title="@lang('app.edit_user')" data-toggle="tooltip" data-placement="top">
                      <i class="fa fa-pencil"></i>
                  </a>
                  <a type="button" data-href="{{ route('user.destroy', $user->id) }}" 
                    class="btn btn-danger btn-fill btn-delete" 
                    data-confirm-text="@lang('app.are_you_sure_delete_user')"
                    data-confirm-delete="@lang('app.yes_delete_him')"
                    title="@lang('app.delete_user')" data-toggle="tooltip" data-placement="top">
                      <i class="fa fa-trash-o"></i>
                  </a>
              </td>
          </tr>
      @endforeach
  </tbody>
  </table>
  <div class="col-md-12 col-xs-12">
  {{ $users->links() }}
  </div> 
</div>