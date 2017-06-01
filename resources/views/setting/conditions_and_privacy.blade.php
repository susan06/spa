@extends('layouts.app')

@section('page-title', trans('app.terms_service'))

@section('content')

<div class="container-fluid">
    <div class="card">
        <div class="header">
            <h4 class="title">{{ trans('app.terms_service') }}</h4>
        </div>
        <div class="content">
            <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
            @include('setting.conditions_privacy_field')
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