@extends('layouts.frontend')

@section('page-title', trans('app.search'))

@section('content')

<div class="row">
  <div class="col-md-12 col-xs-12">
  	<div class="card">

	    <div class="content">	    
			<div class="row">
			  <div class="col-md-12 col-xs-12">

			  	<div class="col-md-2 col-xs-12 col-search mg-buttom-10">
			  	<h5 class="visible-pc"> Busqueda avanzada </h5>

			  	<div class="custom-collapse">
				  <button class="collapse-toggle visible-mobile btn btn-danger" type="button" id="btn-search-toggle" data-toggle="collapse" data-parent="custom-collapse" data-target="#side-menu-collapse" style="width: 100%;">
				      <span>Busqueda avanzada</span>
				  </button> 
		  			<ul class="list-group collapse item-search" id="side-menu-collapse">
		  			@if(Settings::get('reservation_web'))
					  <li class="list-group-item tab-ext pointer" 
					  	data-url="{{ route('local.search', 'reservation_web=true&search=true') }}">Reserva Online</li>
					@endif
					@if(Settings::get('recommendation'))
					  <li class="list-group-item tab-ext pointer" data-url="{{ route('local.search', 'recommendation=service&search=true') }}">Más recomendado</li>
					@endif
					@if(Settings::get('service'))
					  <li class="list-group-item tab-ext pointer" 
					  	data-url="{{ route('local.search', 'score=service&search=true') }}">Servicio</li>
					 @endif
					@if(Settings::get('environment'))
					  <li class="list-group-item tab-ext pointer" 
					  	data-url="{{ route('local.search', 'score=environment&search=true') }}">Ambiente</li>
					 @endif
					@if(Settings::get('attention'))
					  <li class="list-group-item tab-ext pointer" 
					  	data-url="{{ route('local.search', 'score=attention&search=true') }}">Atención</li>
					 @endif
					@if(Settings::get('price'))
					  <li class="list-group-item tab-ext pointer" 
					  	data-url="{{ route('local.search', 'score=price&search=true') }}">Precio</li>
					</ul>
					@endif
				</div>

			  	</div>

			    <div id="tab-content" class="grid-local col-md-10 col-xs-12">
			        <!-- load result -->
			    </div>
			  </div>
			</div>
		</div>
	</div>
  </div>
</div>

@endsection

@section('scripts')
<script type="text/javascript">
	if($('html,body').width() < 768) {
        $('#btn-search-toggle').trigger('click');
    }
</script>

@endsection