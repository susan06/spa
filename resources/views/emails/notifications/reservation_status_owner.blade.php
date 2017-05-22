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
						<h3>Se ha cancelado una reservación para el local {{ $local->name }}</h3>
						<p class="lead">Resumen de la reserva.</p>
						<p class="callout">
							El usuario {{ $client->full_name() }} ha CANCELADO la reserva del día: {{ $reservation->date }}
							y a hora: {{ $reservation->hour }} del local {{ $local->name }}
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