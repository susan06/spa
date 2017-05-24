@extends('layouts.frontend')

@section('page-title', trans('app.messages'))

@section('content')

<div class="row">
  <div class="col-md-12 col-xs-12">
  	<div class="card">
	  	<div class="header">
	        <h4 class="title"><i class="pe-7s-mail"></i>Queja o sugerencia</h4>
	    </div>
	    <div class="content">	    
			<div class="row">
			  <div class="col-md-12 col-xs-12">
			    <div id="tab-content" class="grid-local">
			        @include('frontend.messages.fields')
			    </div>
			  </div>
			</div>
		</div>
	</div>
  </div>
</div>

@endsection

@section('scripts')

<!-- bootstrap-wysiwyg -->
{!! HTML::script('vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js') !!}
{!! HTML::script('vendors/jquery.hotkeys/jquery.hotkeys.js') !!}
{!! HTML::script('vendors/google-code-prettify/src/prettify.js') !!}
<!-- Editor-->
{!! HTML::script('assets/js/editor.js') !!}

@endsection