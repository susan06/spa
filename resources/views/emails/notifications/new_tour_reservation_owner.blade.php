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
						<h3>Tienes una nueva reservación para el tour {{ $tour->title }}, asociado al local {{ $local->name }}</h3>
						<p class="lead">Resumen de la reservación del tour.</p>
						<p class="callout">
							El usuario {{ $client->full_name() }} ha reservado el tour con la fecha: {{ $tour->rangeDate() }}
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