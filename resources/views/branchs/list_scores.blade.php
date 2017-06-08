<div class="content table-responsive table-full-width">
  <table class="table table-hover table-striped">
    <thead>
        <th>Cliente</th>
        <th>Precio</th>
        <th>Servicio</th>
        <th>Ambiente</th>
        <th>Atención</th>
        <th>@lang('app.registration_date')</th>
        </thead>
    <tbody>
         @foreach ($scores as $score)
            <tr>
                <td> 
                    <a href="{{ route('user.show', $score->client_id) }}">
                        {{ $score->client->full_name() }}
                    </a>
                  </td>
                <td>{{ $score->price }}</td>
                <td>{{ $score->service }}</td>
                <td>{{ $score->environment }}</td>
                <td>{{ $score->attention }}</td>
                <td>{{ $score->created_at }}</td>          
            </tr>
        @endforeach
    </tbody>
</table>
<div class="col-md-12 col-xs-12">
    {{ $scores->links() }}
</div>
</div>
 