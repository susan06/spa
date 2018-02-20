<div class="content table-responsive table-full-width">
  <table class="table table-hover table-striped">
    <thead>
        <th>@lang('app.name')</th>
        <th class="text-center">@lang('app.date')</th>
        <th class="text-center">@lang('app.reservations')</th>
        <th class="text-center">@lang('app.actions')</th>
        </thead>
    <tbody>
        @foreach ($tours as $tour)
            <tr>
                <td>{!! $tour->title.'   '.$tour->getStatus() !!}</td>
                <td class="text-center">{{ $tour->rangeDate() }}</td>  
                <td class="text-center">{{ $tour->reservations->count() }}</td>              
                <td class="text-center">
                    <a href="{{ route('tour.reservations', $tour->id) }}" class="btn btn-fill btn-info"
                    title="@lang('app.reservations')" data-toggle="tooltip" data-placement="top">
                      <i class="fa fa-calendar"></i>
                    </a>
                    <a type="button" data-href="{{ route('tour.edit', $tour->id) }}" class="btn btn-fill btn-info create-edit-show" data-model="modal" data-title="@lang('app.edit_tour')"
                       title="@lang('app.edit_tour')" data-toggle="tooltip" data-placement="top">
                        <i class="fa fa-pencil"></i>
                    </a>
                    <a type="button" data-href="{{ route('tour.destroy', $tour->id) }}" 
                      class="btn btn-fill btn-danger btn-delete" 
                      data-confirm-text="@lang('app.are_you_sure_delete_tour')"
                      data-confirm-delete="@lang('app.yes_delete_him')"
                      title="@lang('app.delete_tour')" data-toggle="tooltip" data-placement="top">
                        <i class="fa fa-trash-o"></i>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="col-md-12 col-xs-12">
    {{ $tours->links() }}
</div>
</div>
 