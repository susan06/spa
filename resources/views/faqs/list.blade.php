<div class="content table-responsive table-full-width">
  <table id="datatable-responsive" class="table table-hover table-striped" cellspacing="0" width="100%">
      <thead>
      <th>#</th>
      <th>@lang('app.question')</th>
      <th>@lang('app.registration_date')</th>
      <th>@lang('app.status')</th>
      <th class="text-center">@lang('app.actions')</th>
      </thead>
    <tbody>
        @foreach ($faqs as $key => $faq)
            <tr>
                <td>{{ ($faqs->currentpage()-1) * $faqs->perpage() + $key + 1 }}</td>
                <td>{{ str_limit($faq->question, 15) }}...</td>
                <td>{{ $faq->created_at }}</td>
                <td>
                  <span class="label label-{{ $faq->labelClass() }}">{{ trans("app.{$faq->status}") }}</span>
                </td>
                <td class="text-center">
                <button type="button" data-href="{{ route('faq.show', $faq->id) }}" class="btn btn-fill btn-info create-edit-show" data-model="modal" data-title="@lang('app.show_faq')"
                     title="@lang('app.show_faq')" data-toggle="tooltip" data-placement="top">
                      <i class="fa fa-eye"></i>
                  </button>
                  <button type="button" data-href="{{ route('faq.edit', $faq->id) }}" class="btn btn-fill btn-info create-edit-show" data-model="modal" data-title="@lang('app.edit_faq')"
                     title="@lang('app.edit_faq')" data-toggle="tooltip" data-placement="top">
                      <i class="fa fa-edit"></i>
                  </button>
                @if($faq->status == 'No Published')
                    <button type="button" data-href="{{ route('faq.destroy', $faq->id) }}" 
                      class="btn btn-fill btn-danger btn-delete" 
                      data-confirm-text="@lang('app.are_you_sure_delete_faq')"
                      data-confirm-delete="@lang('app.yes_delete_him')"
                      title="@lang('app.delete_faq')" data-toggle="tooltip" data-placement="top">
                        <i class="fa fa-trash"></i>
                    </button>
                 @endif
                </td>
            </tr>
        @endforeach
  </tbody>
  </table>
  <div class="col-md-12 col-xs-12">
  {{ $faqs->links() }}
  </div> 
</div>