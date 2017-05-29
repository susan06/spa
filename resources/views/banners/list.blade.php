<div class="content table-responsive table-full-width">
  <table class="table table-hover table-striped">
    <thead>
        <th class="text-center">@lang('app.image')</th>
        <th class="text-center">@lang('app.order')</th>
        <th class="text-center">@lang('app.status')</th>
        <th class="text-center">@lang('app.actions')</th>
        </thead>
    <tbody>
        @foreach ($banners as $banner)
            <tr>
                <td class="text-center"><img class="thumb-img" src="{{ asset('uploads/banners/'.$banner->name) }}" alt="{{ $banner->name }}"></td>
                <td class="text-center">{{ $banner->priority }}</td>
                <td class="text-center">{!! $banner->getStatus() !!}</td>             
                <td class="text-center">
                    <a type="button" data-href="{{ route('banner.destroy', $banner->id) }}" 
                      class="btn btn-fill btn-danger btn-delete" 
                      data-confirm-text="@lang('app.are_you_sure_delete_banner')"
                      data-confirm-delete="@lang('app.yes_delete_him')"
                      title="@lang('app.delete_banner')" data-toggle="tooltip" data-placement="top">
                        <i class="fa fa-trash-o"></i>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="col-md-12 col-xs-12">
    {{ $banners->links() }}
</div>
</div>
 