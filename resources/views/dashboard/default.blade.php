@extends('layouts.app')

@section('page-title', trans('app.home'))

@section('content')

<div class="container-fluid">
  <div class="row">
      <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="title">@lang('app.welcome')</h4>
                <p class="category">{{ Auth::user()->username ?: Auth::user()->full_name() }}</p>
            </div>
            <div class="content">
              
            </div>
        </div>
      </div>
  </div>
</div>


@endsection

@section('scripts')

@endsection