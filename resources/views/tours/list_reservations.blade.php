<div class="content table-responsive table-full-width">
  <table class="table table-hover table-striped">
    <thead>
        <th>Cliente</th>
        @if(isset($showLocal))
        <th>Local</th>
        @endif
        <th>@lang('app.registration_date')</th>
        <th>@lang('app.status')</th>
        @if (Auth::user()->hasRole('owner')) 
        <th>@lang('app.actions')</th>
        @endif
        </thead>
    <tbody>
         @foreach ($reservations as $reservation)
            <tr>
                <td> 
                    <a href="{{ route('user.show', $reservation->client_id) }}">
                        {{ $reservation->client->full_name() }}
                    </a>
                  </td>
                @if(isset($showLocal))
                <td>{{ $reservation->tour->branchOffice->name }}</td>
                @endif
                <td>{{ $reservation->created_at }}</td>
                <td>
                {!! $reservation->getStatus() !!}
                </td>   
                @if (Auth::user()->hasRole('owner')) 
                <td>
                    @if($reservation->status == 'rejected')
                        <span class="label label-info">Cancelada por el: {{ ($reservation->rejected_by == 'client') ? 'Cliente' : 'Propietario'}}</span>
                    @endif
                    @if($reservation->status == 'pendient')
                    <a type="button" data-href="{{ route('reservation.tour.approved', $reservation->id) }}"
                      class="btn btn-success btn-fill btn-approved-status" 
                      title="Aprobar reservación">
                        <i class="fa fa fa-thumbs-o-up"></i>
                    </a>
                    <a type="button" data-href="{{ route('reservation.tour.cancel', $reservation->id) }}?rejected_by=owner" 
                      class="btn btn-danger btn-fill btn-cancel-status" 
                      data-confirm-text="Seguro que desea cancelar la reservación del Tour?"
                      data-confirm-delete="Si"
                      title="Cancelar reservación">
                        <i class="fa fa-trash-o"></i>
                    </a>
                  @endif
                </td>   
                @endif        
            </tr>
        @endforeach
    </tbody>
</table>
<div class="col-md-12 col-xs-12">
    {{ $reservations->links() }}
</div>
</div>
 