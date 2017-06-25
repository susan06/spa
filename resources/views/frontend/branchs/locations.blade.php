@extends('layouts.frontend')

@section('page-title', 'Locales cerca')

@section('content')

<div class="row">
  <div class="col-md-12 col-xs-12">
  	<div class="card">
	  	<div class="header">
	        <h4 class="title"><i class="pe-7s-star"></i> Locales cerca ({{Settings::get('distance')}} km)</h4>
	    </div>
	    <div class="content">	    
			<div class="row">
			  <div class="col-md-12 col-xs-12">
			    <div id="tab-content" class="grid-local">
			    @if(count($locales) > 0)
			    	<p>Los 5 locales más cerca a su ubicación</p>
			    	 <table class="table table-hover table-striped">
					    <thead>
					    	<th>#</th>
					        <th>@lang('app.name')</th>
					        <th>Dirección</th>
					        <th>Acción</th>
					        </thead>
					    <tbody>
					        @foreach ($locales as $key => $local)
					            <tr>
					            	<td>{!! ($key+1) !!}</td>
					                <td>{!! $local->name !!}</td>
					                <td>{{ $local->address.'. '.$local->province->name }}</td>
					                <td>
					                	<a href="{{ route('local.show', $local->id) }}" class="btn btn-fill btn-danger menu-click" 
                      					 title="@lang('app.show_branch')" data-toggle="tooltip" data-placement="top">
                        				<i class="fa fa-eye"></i>
                    					</a>
                    				</td>               
					            </tr>
					        @endforeach
					    </tbody>
					</table>
					<br>
					<br>
				@else
					<p>No se encontraron resultados</p>
					<br>
				@endif
			       <div id="map-form" style="height: 400px;"></div>
			    </div>
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
  var myInfowindow = null;
  var marker = null;
  var my_location = {lat: {{$lat}}, lng: {{$lng}} };  


	function openInfoWindowBranch(localMarker) {
		infowindow.close();
	    infowindow = new google.maps.InfoWindow();
	    var markerLatLng = localMarker.getPosition();
	    infowindow.setContent('<div class="lat-lng"><strong>'+ localMarker.customInfo +'</strong></div>');
	    infowindow.open(map, localMarker);
	    google.maps.event.addListener(localMarker, 'click', function(){ openInfoWindowBranch(localMarker); })
	 }

  	function initMapBranch() {
	    map = new google.maps.Map(document.getElementById('map-form'), {
	      center: my_location,
	      zoom: 14
	    });

	    infowindow = new google.maps.InfoWindow({map: map});

	    marker = new google.maps.Marker({
	      position: new google.maps.LatLng({{$lat}}, {{$lng}}),
	      map: map,
	      title: 'Mi ubicación',
	      customInfo: 'Mi ubicación',
	      icon: "{{ asset('images/googlepin.png') }}"
	    });

	    marker.setAnimation(google.maps.Animation.BOUNCE);
	    openInfoWindowBranch(marker);
        infowindow.close();

	    //myInfowindow.setPosition(my_location);
        //myInfowindow.setContent('Mi ubicación');
        //infowindow.close();

	    map.setCenter(my_location);
      	map.setZoom(14); 

      	@foreach ($locales as $key => $local)  		
      		var count = {!! $key+1 !!};
	      	marker = new google.maps.Marker({
	          position: new google.maps.LatLng({{$local->lat}}, {{$local->lng}}),
	          map: map,
	          customInfo: '{{ $local->name }}. Dirección: {{ $local->address }}',
	          title: count+' - {{ $local->name }}',
	          icon: "{{ asset('images/googlepin1.png') }}"
	        });
	        openInfoWindowBranch(marker);
        	infowindow.close();
      	@endforeach

      	google.maps.event.addListener(marker, 'click', function(){ openInfoWindowBranch(marker); });
	}

  $(document).ready(function() {
    initMapBranch();
  });
</script>
@endsection