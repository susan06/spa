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
						<h3>Se ha {{ $status }} una reservación para el tour {{ $reservation->title }}.</h3>
						<p class="lead">Resumen de la reservación del tour.</p>
						<p class="callout">
							Reservación a nombre de {{ $client->full_name() }}, se ha {{ $status }} la reservación del tour para los días: {{ $reservation->rangeDate() }}, asociado al local {{ $local->name }}.
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