<div class="content table-responsive table-full-width">
  <table id="datatable-responsive" class="table table-hover table-striped" cellspacing="0" width="100%">
      <thead>
        <th>@lang('app.local')</th>
        <th>@lang('app.name')</th>
        <th>@lang('app.date')</th>
        <th class="hide-front">@lang('app.registration_date')</th>
        <th>@lang('app.status') / @lang('app.actions')</th>
      </thead>
  <tbody>
      @foreach ($reservations as $reservation)
          <tr>
              <td>
                {{ $reservation->tour->branchOffice->name }}
              </td>
              <td>
                {{ $reservation->tour->title }}
              </td>
              <td>{{ $reservation->tour->rangeDate() }}</td>
              <td class="hide-front">{{ $reservation->created_at }}</td>
              <td>{!! $reservation->getStatus() !!}
                 @if($reservation->status == 'pendient')
                   <a type="button" data-href="{{ route('reservation.tour.cancel', $reservation->id) }}?rejected_by=client" 
                      class="btn btn-danger margin-btn-delete btn-cancel-status" 
                      data-confirm-text="Seguro que desea cancelar la reservación del tour?"
                      data-confirm-delete="Si"
                      title="Cancelar reservación">
                        <i class="fa fa-trash-o show-movil"></i>
                        <span class="hide-front">Cancelar</span>
                    </a>
                  @endif
              </td>
          </tr>
      @endforeach
  </tbody>
  </table>
  <div class="">
  {{ $reservations->links() }}
  </div> 
</div>
