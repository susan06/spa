<div class="content table-responsive table-full-width">
  <table class="table table-hover table-striped">
    <thead>
        <th>@lang('app.name')</th>
        <th>@lang('app.reservations')</th>
        <th>@lang('app.visites')</th>
        <th>@lang('app.recommendat')</th>
        <th class="text-center">@lang('app.actions')</th>
        </thead>
    <tbody>
        @foreach ($locales as $local)
            <tr>
                <td>{!! $local->name.'   '.$local->isDescount() !!}</td>
                <td class="text-center">{{ $local->reservations->count() }}</td>
                <td class="text-center">{{ $local->visites->count() }}</td>
                <td class="text-center">{{ $local->recommendations->count() }}</td>                
                <td class="text-center">
                    <a href="{{ route('branch.reservations', $local->id) }}" class="btn btn-fill btn-info"
                    title="@lang('app.reservations')" data-toggle="tooltip" data-placement="top">
                      <i class="fa fa-calendar"></i>
                    </a>
                    <a href="{{ route('branch.comments', $local->id) }}" class="btn btn-fill btn-info"
                       title="Commentarios" data-toggle="tooltip" data-placement="top">
                       <i class="fa fa-bullhorn"></i>
                    </a>
                    <a href="{{ route('local.show', $local->id) }}" target="_blank" class="btn btn-fill btn-info" 
                       title="@lang('app.show_branch')" data-toggle="tooltip" data-placement="top">
                        <i class="fa fa-eye"></i>
                    </a>
                    <a href="{{ route('branch.edit', $local->id) }}" class="btn btn-fill btn-info" 
                       title="@lang('app.edit_branch')" data-toggle="tooltip" data-placement="top">
                        <i class="fa fa-pencil"></i>
                    </a>
                    <a type="button" data-href="{{ route('branch.destroy', $local->id) }}" 
                      class="btn btn-fill btn-danger btn-delete" 
                      data-confirm-text="@lang('app.are_you_sure_delete_branch')"
                      data-confirm-delete="@lang('app.yes_delete_him')"
                      title="@lang('app.delete_branch')" data-toggle="tooltip" data-placement="top">
                        <i class="fa fa-trash-o"></i>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="col-md-12 col-xs-12">
    {{ $locales->links() }}
</div>
</div>
 