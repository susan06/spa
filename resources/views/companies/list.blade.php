<div class="content table-responsive table-full-width">
  <table class="table table-hover table-striped">
    <thead>
        <th class="hide-front">@lang('app.name')</th>
        <th>@lang('app.owner')</th>
        <th>@lang('app.locales')</th>
        <th class="text-center">@lang('app.actions')</th>
        </thead>
    <tbody>
        @foreach ($companies as $company)
            <tr>
                <td>{{ $company->name }}</td>
                <td>{{ $company->owner->full_name() }}</td>
                <td class="hide-front">{{ $company->branchs->count() }}</td>
                <td class="text-center">
                    <a type="button" data-href="{{ route('company.edit', $company->id) }}" class="btn btn-fill btn-info create-edit-show" data-model="modal" data-title="@lang('app.edit_company')"
                       title="@lang('app.edit_company')" data-toggle="tooltip" data-placement="top">
                        <i class="fa fa-pencil"></i>
                    </a>
                    <a type="button" data-href="{{ route('company.destroy', $company->id) }}" 
                      class="btn btn-fill btn-danger btn-delete" 
                      data-confirm-text="@lang('app.are_you_sure_delete_company')"
                      data-confirm-delete="@lang('app.yes_delete_him')"
                      title="@lang('app.delete_company')" data-toggle="tooltip" data-placement="top">
                        <i class="fa fa-trash-o"></i>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="col-md-12 col-xs-12">
    {{ $companies->links() }}
</div>
</div>
 