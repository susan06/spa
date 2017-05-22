@extends('emails.layout')

@section('content')

<!-- BODY -->
<table class="body-wrap">
	<tr>
		<td></td>
		<td class="container" bgcolor="#FFFFFF">
			<div class="content">
			<table>
				<tr>
					<td>
						<h3>Tienes una nueva reservación para el local {{ $local->name }}</h3>
						<p class="lead">Resumen de la reserva.</p>
						<p class="callout">
							El usuario {{ $client->full_name() }} ha reservado para la fecha: {{ $reservation->date }}
							y a la siguiente hora: {{ $reservation->hour }}
						</p>						
					</td>
				</tr>
			</table>
			</div><!-- /content -->					
		</td>
		<td></td>
	</tr>
</table><!-- /BODY -->

@endsection