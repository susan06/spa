@extends('layouts.app')

@section('page-title', trans('app.clients'))

@section('content')

<div class="container-fluid">
  <div class="row">
      <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="title">{{ trans('app.clients') }}</h4>
            </div>
            <div class="content">
                <div class="row">

                <div class="col-md-2 col-sm-2 col-xs-4 mg-botom-15-movil">
                  <span class="label label-warning">TOTAL: {{ $total['totales'] }}</span>
                </div>
                <div class="col-md-2 col-sm-2 col-xs-4 mg-botom-15-movil">
                  <span class="label label-success">ACTIVOS: {{ $total['3meses'] }}</span>
                </div>


                    @include('partials.search') 

                  </div>

                  <div class="row">
                    <div class="inner-spacer">
                      <div id="tab-content">
                        @include('clients.list')
                      </div>
                    </div>
                  </div>
            </div>
        </div>
      </div>
  </div>
</div>


@endsection
