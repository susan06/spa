@extends('layouts.frontend')

@section('page-title', trans('app.terms_service'))

@section('content')

<div class="row">
  <div class="col-md-12 col-xs-12">
  	<div class="card">
	  	<div class="header">
	        <h4 class="title"><i class="pe-7s-notebook"></i> @lang('app.terms_service')</h4>
	    </div>
	    <div class="content">
		    <div id="tab-content">
		        {!! Settings::get('terms_and_conditions') !!}
		    </div>
		</div>
	</div>
  </div>
</div>

@endsection