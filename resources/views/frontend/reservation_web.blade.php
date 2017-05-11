@extends('layouts.frontend')

@section('page-title', trans('app.reservations'))

@section('content')

<div class="row">
  <div class="col-md-12 col-xs-12">
  	<div class="card">
	  	<div class="header">
	        <h4 class="title"><i class="pe-7s-alarm"></i>Locales con reservas online</h4>
	    </div>
	    <div class="content">	    
			<div class="row">
			  <div class="col-md-12 col-xs-12">
			    <div id="tab-content" class="grid-local">
			        @include('frontend.branchs.list')
			    </div>
			  </div>
			</div>
		</div>
	</div>
  </div>
</div>

@endsection