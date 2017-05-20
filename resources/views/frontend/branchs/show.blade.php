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
  
    	<div class="row">
			  <ul class="nav navbar-nav menu-local">
			    <li>
			        <a href="#" data-url="" data-auth="{{ (Auth::check()) ? 'true' : 'false' }}" class="{{ (Auth::check() && $local->isScore()) ? 'active check' : 'show-start' }}" data-msg="Ya ha calificado el local">
			            <i class="pe-7s-star"></i>
			            Calificar
			        </a>
			    </li>
			    <li>
			        <a href="#" data-url="{{ route('local.favorite.store', $local->id) }}" data-favorite="true" data-delete="{{ route('local.favorite.delete', $local->id) }}" class="{{ (Auth::check() && $local->isSave()) ? 'active check' : 'save-check' }}" data-msg="Ya ha guardado en favoritos el local">
			            <i class="pe-7s-safe"></i>
			            Guardar
			        </a>
			    </li>
			    <li>
			        <a href="#" data-url="{{ route('local.visit.store', $local->id) }}" class="{{ (Auth::check() && $local->isVisit()) ? 'active check' : 'save-check' }}"
			        data-msg="Ya ha marcado como visitado el local" >
			            <i class="pe-7s-check"></i>
			            Visitado
			        </a>
			    </li>
			    <li>
			        <a href="#" class="orange">
			            <i class="pe-7s-back orange"></i>
			            Recomendar
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

     	@if($local->reservation_web)
    	<div class="row">
    		<div class="box-reservation">
    			<div class="title">Reserva Online Gratis</div>
    			<div class="content">
    			{!! Form::open(['route' => ['local.reservation.store', $local->id], 'id' => 'form-generic']) !!}
    				<div class="row">
			            <div class="col-md-7 col-xs-12">
			                <div id="date_reservation"></div>
			                {!! Form::hidden('date',old('date'), ['id' => 'date-input-reservation']) !!}
			            </div>
			            <div class="col-md-5 col-xs-12">
			                <div id="time_reservation"></div>
			                {!! Form::hidden('hour',old('hour'), ['id' => 'time-input-reservation']) !!}
			            </div>
			            <div class="resumen">
			            	<span class="title">Resumen de su reserva</span>
			            	<span class="content">
			            		Día: <span class="date-span"></span> <br>
			            		Hora: <span class="time-span"></span>
			            	</span>
			            </div>
			            <div class="col-md-12 col-xs-12">
			            	<button type="button" disabled="disabled" id="btn-reservar" class="btn btn-fill btn-danger btn-reservar col-md-12 col-xs-12">Reservar</button>
			            </div>
			        </div>
			        {!! Form::close() !!}
    			</div>
    		</div>
    	</div>
    	@endif

  </div>
</div>

<div class="row">

	<div class="col-md-6 col-xs-12">

			@if(Auth::check() && Auth::user()->hasRole('client') && $local->isScore())
			  <div class="col-md-12 col-xs-12">
			  	<div class="card">
				  	<div class="header">
				        <h4 class="title">Mi calificación del local</h4>
				    </div>
				    <div class="content">	    
						<div class="row">
						  <div class="col-md-12 col-xs-12">
							   {!! $local->scoreByClient() !!}
						  </div>
						</div>
					</div>
				</div>
			  </div>
			 @endif


			  <div class="col-md-12 col-xs-12">
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

			<div class="col-md-12 col-xs-12">
			  	<div class="card">
				  	<div class="header">
				        <h4 class="title">Dirección</h4>
				    </div>
				    <div class="content">	    
						<div class="row">
						  <div class="col-md-12 col-xs-12">
						  	<p>{{ $local->address.'. '.$local->province->name }}</p>
						  	<p>{{ $local->address_description }}</p>
							<div id="map-form"></div>
						  </div>
						</div>
					</div>
				</div>
		  	</div>

	</div>

	<div class="col-md-6 col-xs-12">
		@if($comments->count() > 0)
		  <div class="col-md-12 col-xs-12">
		  	<div class="card">
			  	<div class="header">
			        <h4 class="title">Comentarios</h4>
			    </div>
			    <div class="content">	    
					<div class="row">
					  <div class="col-md-12 col-xs-12">
						   <div id="load-comments">
						   	@include('frontend.branchs.comments')
						   </div>
					  </div>
					</div>
				</div>
			</div>
		  </div>
		@endif

	</div>

</div>

<div class="modal fade modal-general" id="start-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="modal-title">Calificar</h3>
            </div>
            <div class="modal-body">
             	{!! Form::open(['route' => ['local.vote.store', $local->id], 'id' => 'form-generic-modal']) !!}

	             <div class="star-rating-comment">
	            	<span class="start-title">Servicio</span>
	                <div class="starrr stars-existing-1" data-rating='0'></div>
	                {!! Form::hidden('service', 0, ['id' => 'quantify_start_1']) !!}
	            </div>
	            <div class="star-rating-comment">
	                <span class="start-title">Ambiente</span>
	                <div class="starrr stars-existing-2" data-rating='0'></div>
	                {!! Form::hidden('environment', 0, ['id' => 'quantify_start_2']) !!}
	             </div>
	            <div class="star-rating-comment">
	                <span class="start-title">Servicio</span>
	                <div class="starrr stars-existing-3" data-rating='0'></div>
	                {!! Form::hidden('attention', 0, ['id' => 'quantify_start_3']) !!}
	             </div>
	            <div class="star-rating-comment">
	                <span class="start-title">Precio</span>
	                <div class="starrr stars-existing-4" data-rating='0'></div>
	                {!! Form::hidden('price', 0, ['id' => 'quantify_start_4']) !!}
	            </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger btn-submit-modal">Calificar</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

@endsection

@section('styles')
    {!! HTML::style("vendors/starrr/dist/starrr.css") !!}

    @if($local->reservation_web)
		{!! HTML::style("assets/css/datetimepicker/bootstrap-datetimepicker.css") !!}
	@endif
@endsection


@section('scripts_head')
@parent
  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?&key={{ env('API_KEY_GOOGLE')}}&libraries=places&language=ES"></script>
@endsection


@section('scripts')

 <!-- starrr -->
 {!! HTML::script('vendors/starrr/dist/starrr.js') !!}

<script type="text/javascript">


    $('.stars-existing-1').starrr({
      rating: 0
    });

    $('.stars-existing-1').on('starrr:change', function (e, value) {
      $('#quantify_start_1').val(value);
    });

    $('.stars-existing-2').starrr({
      rating: 0
    });

    $('.stars-existing-2').on('starrr:change', function (e, value) {
      $('#quantify_start_2').val(value);
    });


    $('.stars-existing-3').starrr({
      rating: 0
    });

    $('.stars-existing-3').on('starrr:change', function (e, value) {
      $('#quantify_start_3').val(value);
    });


    $('.stars-existing-4').starrr({
      rating: 0
    });

    $('.stars-existing-4').on('starrr:change', function (e, value) {
      $('#quantify_start_4').val(value);
    });


  var map = null;
  var infowindow = null;
  var marker = null;
  var map_center = {lat: {{$local->lat}}, lng: {{$local->lng}} };  
  var url_login = "{{ route('login') }}";

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

  var day_disabled = [{!! $local->week !!}];
  var hour_min = moment({h:{!! $local->min_time !!}});
  var hour_max = moment({h:{!! $local->max_time !!}});
  today =  moment(new Date()).add(1, 'day');

  $('#date_reservation').datetimepicker({
    format: 'DD-MM-YYYY',
    minDate: today,
    maxDate: moment(today).add(7, 'day'),
    inline: true,
    daysOfWeekDisabled: day_disabled,
    sideBySide: true,
    defaultDate: false
  });

   $('#time_reservation').datetimepicker({
    format: 'LT',
    minDate: hour_min,
    maxDate: hour_max,
    inline: true,
    defaultDate: false
  });

$("#date_reservation").on("dp.change", function(e) {
   $('#date-input-reservation').val(e.date.format('YYYY-MM-DD'));
   $('.date-span').html(e.date.format('DD/MM/YYYY'));
   $('.resumen').show();
});

$("#time_reservation").on("dp.change", function(e) {
   $('#time-input-reservation').val(e.date.format('hh:mm A'));
   $('.time-span').html(e.date.format('hh:mm A'));
   $('.resumen').show();
   document.getElementById('btn-reservar').disabled = false;
});
  
</script>

@endsection