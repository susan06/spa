<div class="content table-responsive table-full-width">
  <table class="table table-hover table-striped">
    <thead>
        <th class="hide-front">@lang('app.name')</th>
        <th>@lang('app.display_name')</th>
        <th class="hide-front">@lang('app.description')</th>
        <th class="text-center">@lang('app.actions')</th>
        </thead>
    <tbody>
        @foreach ($roles as $role)
            <tr>
                <td class="hide-front">{{ $role->name }}</td>
                <td>{{ $role->display_name }}</td>
                <td class="hide-front">{{ $role->description }}</td>
                <td class="text-center">
                    <a type="button" data-href="{{ route('role.edit', $role->id) }}" class="btn btn-fill btn-info create-edit-show" data-model="modal" data-title="@lang('app.edit_role')"
                       title="@lang('app.edit_role')" data-toggle="tooltip" data-placement="top">
                        <i class="fa fa-pencil"></i>
                    </a>
                    <a type="button" data-href="{{ route('role.destroy', $role->id) }}" 
                      class="btn btn-fill btn-danger btn-delete" 
                      data-confirm-text="@lang('app.are_you_sure_delete_role')"
                      data-confirm-delete="@lang('app.yes_delete_him')"
                      title="@lang('app.delete_role')" data-toggle="tooltip" data-placement="top">
                        <i class="fa fa-trash-o"></i>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="col-md-12 col-xs-12">
    {{ $roles->links() }}
</div>
</div>
 