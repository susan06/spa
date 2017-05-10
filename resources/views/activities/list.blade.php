<div class="content table-responsive table-full-width">
  <table id="datatable-responsive" class="table table-hover table-striped" cellspacing="0" width="100%">
    <thead>
      <th>@lang('app.username')</th>
      <th>@lang('app.type_register')</th>
      <th>@lang('app.action')</th>
      <th>@lang('app.description')</th>
      <th>IP</th>
      <th>@lang('app.registration_date')</th>
      <th>@lang('app.actions')</th>
    </thead>
    <tbody>
        @foreach ($activities as $activity)
            <tr>
                <td>
                @if($activity->user_id)
                  <a href="{{ route('activity.index', 'user='.$activity->user_id) }}">{{ $activity->user->full_name() }}</a>
                @else
                  {{ trans('log.system') }}
                @endif
                </td>
                <td>{{ trans('log.'.$activity->content_type) }}</td>
                <td>
                {{ trans('log.'.$activity->action) }}
                {{ ($activity->content_id) ? ' del registro: '.$activity->content_id : ''}}
                </td>
                <td>
                  {{ $activity->description }}
                </td>
                <td>{{ $activity->ip_address }}</td>
                <td>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $activity->created_at)->format('d-m-Y G:ia') }}</td>
                <td>
                  <a tabindex="0" role="button" class="btn btn-fill btn-info"
                     data-trigger="focus"
                     data-placement="left"
                     data-toggle="popover"
                     title="@lang('app.user_agent')"
                     data-content="{{ $activity->user_agent }}">
                      <i class="fa fa-info"></i>
                  </a>
                </td>
            </tr>
        @endforeach
    </tbody>
    </table>
    <div class="">
    {{ $activities->links() }}
    </div> 
</div>