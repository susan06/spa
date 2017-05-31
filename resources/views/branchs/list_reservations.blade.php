<div class="content table-responsive table-full-width">
  <table class="table table-hover table-striped">
    <thead>
        <th>Cliente</th>
        <th>@lang('app.date')</th>
        <th>@lang('app.registration_date')</th>
        <th>@lang('app.status')</th>
        </thead>
    <tbody>
         @foreach ($reservations as $reservation)
            <tr>
                <td> 
                    <a href="{{ route('user.show', $reservation->client_id) }}">
                        {{ $reservation->client->full_name() }}
                    </a>
                  </td>
                <td>{{ $reservation->date.' - '.$reservation->hour }}</td>
                <td>{{ $reservation->created_at }}</td>
                <td>{!! $reservation->getStatus() !!}</td>              
            </tr>
        @endforeach
    </tbody>
</table>
<div class="col-md-12 col-xs-12">
    {{ $reservations->links() }}
</div>
</div>
 