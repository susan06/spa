@extends('layouts.frontend')

@section('page-title', 'Locales cerca')

@section('content')

<div class="row">
  <div class="col-md-12 col-xs-12">
  	<div class="card">
	  	<div class="header">
	        <h4 class="title"><i class="pe-7s-star"></i> Locales cerca</h4>
	    </div>
	    <div class="content">	    
			<div class="row">
			  <div class="col-md-12 col-xs-12">
			    <div id="tab-content" class="grid-local">
			       {{ var_dump($gps) }}
			    </div>
			  </div>
			</div>
		</div>
	</div>
  </div>
</div>

@endsection