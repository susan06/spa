 <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <thead>
      <th>@lang('app.type')</th>
      <th class="text-center">@lang('app.actions')</th>
    </thead>
<tbody>
    @foreach ($notifications as $notification)
        <tr>
            <td>
                {{ notification->type }}
            </td>
            <td class="text-center">
            </td>
        </tr>
    @endforeach
</tbody>
</table>
