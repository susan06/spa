<div class="modal-body">
  <h3>{{ $user->full_name() }}</h3>
  </br>
 <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <thead>
      <th>@lang('app.ip_address')</th>
      <th>@lang('app.user_agent')</th>
      <th>@lang('app.last_activity')</th>
    </thead>
<tbody>
    @foreach ($sessions as $session)
        <tr>
            <td>{{ $session->ip_address }}</td>
            <td>{{ $session->user_agent }}</td>
            <td>{{ \Carbon\Carbon::createFromTimestamp($session->last_activity)->format('Y-m-d H:i:s') }}</td>
        </tr>
    @endforeach
</tbody>
</table>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-fill btn-default col-sm-2 col-xs-5" data-dismiss="modal">@lang('app.close')</button>
</div>

