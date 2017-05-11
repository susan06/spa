@extends('layouts.frontend')

@section('page-title', trans('app.news'))

@section('content')

<div class="row">
  <div class="col-md-12 col-xs-12">
  	<div class="card">
	  	<div class="header">
	        <h4 class="title"><i class="pe-7s-star"></i> 10 locales registrados recientemente</h4>
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