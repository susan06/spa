@extends('layouts.frontend')

@section('page-title', trans('app.local'))

@section('content')

<div class="carousel-header">
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
        @foreach($local->photos as $key => $photos)
          <li data-target="#myCarousel" data-slide-to="{{ $key }}" class="{{ ($key == 0) ? 'active' : '' }}"></li>
        @endforeach
        </ol>
        <div class="carousel-inner" role="listbox">
        @foreach($local->photos as $key => $photos)
          <div class="item {{ ($key == 0) ? 'active' : '' }}">
            <img class="first-slide" src="{{ asset('uploads/photos/'.$photos->name) }}" alt="{{ $photos->name }}">
          </div>
        @endforeach
        </div>
        <div class="container">
          <div class="carousel-caption">
            <p class="title-local"> {{ $local->name }}</p>
          </div>
        </div>
        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
  </div>
</div>

<div class="row">
  <div class="col-md-12 col-xs-12">
    <div>

    	<div class="row">
			  <ul class="nav navbar-nav menu-local">
			    <li>
			        <a href="#" class="">
			            <i class="pe-7s-star"></i>
			            Calificar
			        </a>
			    </li>
			    <li>
			        <a href="#" class="">
			            <i class="pe-7s-safe"></i>
			            Guardar
			        </a>
			    </li>
			    <li>
			        <a href="#" class="active">
			            <i class="pe-7s-check"></i>
			            Visitado
			        </a>
			    </li>
			    <li>
			        <a href="#" class="">
			            <i class="pe-7s-alarm"></i>
			            Reservar
			        </a>
			    </li>
			</ul>   		
    	</div>

    	<div class="row title-local-bottom">
    		<h4><strong>{{ $local->name }}</strong></h4>
    		<p><i class="pe-7s-call"></i>
    		{{ $local->phone_one }}
    		{{ ($local->phone_second) ?  ' / '.$local->phone_second: '' }}
    		</p>
    		<p><i class="pe-7s-mail"></i>
    		{{ $local->email }}
    		</p>
    	</div>

        <div class="row">
	        <div class="boxed_details clearfix">
	            <div class="area first promedio">Precio</strong><br><strong>{{ number_format($local->score->avg('price'), 1, '.', '') }}</strong> /5</div>
	            <div class="area first promedio">Servicio<br><strong>{{ number_format($local->score->avg('service'), 1, '.', '') }}</strong> /5</div>
	            <div class="area first promedio">Ambiente<br><strong>{{ number_format($local->score->avg('environment'), 1, '.', '') }}</strong> /5</div>
	            <div class="area first promedio">Atención<br><strong>{{ number_format($local->score->avg('attention'), 1, '.', '') }}</strong> /5</div>
	            <div class="area last promedio">Precio<br><strong>{{ Settings::get('coin').' '.$local->sumPrice() }}</strong></div>
	        </div>
     	</div>

    </div>
  </div>
</div>

<div class="row">


  <div class="col-md-6 col-xs-12">
  	<div class="card">
	  	<div class="header">
	        <h4 class="title">Horario</h4>
	    </div>
	    <div class="content">	    
			<div class="row">
			  <div class="col-md-12 col-xs-12">
				   {!! $local->working_hours !!} 
			  </div>
			</div>
		</div>
	</div>
  </div>

  <div class="col-md-6 col-xs-12">
  	<div class="card">
	  	<div class="header">
	        <h4 class="title">Métodos de pago</h4>
	    </div>
	    <div class="content">	    
			<div class="row">
			  <div class="col-md-12 col-xs-12">
				    @foreach($local->payment as $key => $payment)
				    	<img class="icon_payment" src="{{ asset('uploads/methodPayments/'.$payment->methodPayment->icon) }}">
				    @endforeach
			  </div>
			</div>
		</div>
	</div>
  </div>

  <div class="col-md-6 col-xs-12">
  	<div class="card">
	  	<div class="header">
	        <h4 class="title">Servicios</h4>
	    </div>
	    <div class="content">	    
			<div class="row">
			  <div class="col-md-12 col-xs-12">
			  	<table class="table table-hover table-striped">
				    @foreach($local->services as $key => $services)
				    <tr>
				    	<td>{{ $services->name }}</td>
				    	<td>{{ Settings::get('coin').' '.$services->price }}</td>
				    </tr>
				    @endforeach
				</table>
			  </div>
			</div>
		</div>
	</div>
  </div>

  <div class="col-md-6 col-xs-12">
  	<div class="card">
	  	<div class="header">
	        <h4 class="title">Dirección</h4>
	    </div>
	    <div class="content">	    
			<div class="row">
			  <div class="col-md-12 col-xs-12">
			  	<p>{{ $local->address }}</p>
			  	<p>{{ $local->address_description }}</p>
				<div id="map-form"></div>
			  </div>
			</div>
		</div>
	</div>
  </div>

</div>

@endsection

@section('scripts_head')
@parent
  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?&key={{ env('API_KEY_GOOGLE')}}&libraries=places&language=ES"></script>
@endsection


@section('scripts')

<script type="text/javascript">

  var map = null;
  var infowindow = null;
  var marker = null;
  var map_center = {lat: {{$local->lat}}, lng: {{$local->lng}} };  

  function initMapBranch() {
	    map = new google.maps.Map(document.getElementById('map-form'), {
	      center: map_center,
	      zoom: 16
	    });

	    infowindow = new google.maps.InfoWindow({map: map});

	    marker = new google.maps.Marker({
	      position: new google.maps.LatLng('{{$local->lat}}', '{{$local->lng}}'),
	      map: map,
	      customInfo: '{{ $local->address }}',
	      title: '{{ $local->name }}',
	      //icon: icon_map
	    });

	    infowindow.close();

	    map.setCenter(marker.getPosition());

}

  $(document).ready(function() {
    initMapBranch();
  });

</script>

@endsection