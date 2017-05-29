<div class="content table-responsive table-full-width">
  <table class="table table-hover table-striped">
      <thead>
        <th>@lang('app.full_name')</th>
        <th>@lang('app.email')</th>
        <th>@lang('app.time_login')</th>
        <th>@lang('app.last_logged_in')</th>
        <th class="text-center">@lang('app.actions')</th>
      </thead>
  <tbody>
      @foreach ($users as $user)
          <tr>
              <td>{!! $user->full_name().' '.$user->isOnline() !!}</td>
              <td>{{ $user->email }}</td>
              <td>{{ ($user->online) ? $user->timeLogin() : '' }}</td>
              <td>{{ $user->last_login }}</td>
              <td class="text-center">
                  <a href="{{ route('client.local.visit', $user->id) }}" class="btn btn-info btn-fill" title="Locales visitados" data-toggle="tooltip" data-placement="top">
                      <i class="fa fa-building-o"></i>
                  </a>
                  <a href="{{ route('user.show', $user->id) }}" class="btn btn-info btn-fill" title="@lang('app.show_user')" data-toggle="tooltip" data-placement="top">
                      <i class="fa fa-eye"></i>
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