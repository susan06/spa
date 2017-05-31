@extends('layouts.app')

@section('page-title', trans('app.reservations'))

@section('content')

<div class="container-fluid">
  <div class="row">
      <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="title">{{ trans('app.reservations') }} del local: {{ $local->name }}</h4>
            </div>
            <div class="content">
                <div class="row">

                    <div class="inner-spacer">
                      <div id="tab-content">
                         @include('branchs.list_reservations')
                      </div>
                    </div>
        
            </div>
        </div>
      </div>
  </div>
</div>

@endsection
