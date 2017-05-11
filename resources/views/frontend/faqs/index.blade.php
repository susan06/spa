@extends('layouts.frontend')

@section('page-title', trans('app.faqs'))

@section('content')

<div class="row">
  <div class="col-md-12 col-xs-12">
  	<div class="card">
	  	<div class="header">
	        <h4 class="title"><i class="pe-7s-bookmarks"></i> @lang('app.faqs')</h4>
	    </div>
	    <div class="content">
		    <div id="tab-content">
		        @include('frontend.faqs.list')
		    </div>
		</div>
	</div>
  </div>
</div>

@endsection