@extends('layouts.app')

@section('page-title', trans('app.home'))

@section('content')

<div class="container-fluid">
  <div class="row">
      <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="title">@lang('app.welcome') {{ Auth::user()->username ?: Auth::user()->full_name() }}</h4>
                <p class="category"></p>
            </div>
            <div class="content">
              
                <!-- Widget Row Start grid -->
                <div class="row">

                <br>

                  <div class="col-md-12 col-xs-12">

                   <div class="col-md-6 col-sm-6">
                      <div class="card card-stats">
                        <div class="card-header" data-background-color="red">
                          <i class="material-icons"><i class="fa fa-building-o"></i></i>
                        </div>
                        <div class="card-content">
                          <p class="category">Compañias</p>
                          <h3 class="title">{{ $stats['company'] }}</h3>
                        </div>
      
                      </div>
                    </div>

                    <div class="col-md-6 col-sm-6">
                      <div class="card card-stats">
                        <div class="card-header" data-background-color="orange">
                          <i class="material-icons"><i class="fa fa-building-o"></i></i>
                        </div>
                        <div class="card-content">
                          <p class="category">Locales</p>
                          <h3 class="title">{{ $stats['branchs'] }}</h3>
                        </div>
                      </div>
                    </div>

                  </div>
                  
                </div>
                <!-- /Widgets Row End Grid-->  

            </div>
        </div>
      </div>
  </div>
</div>


@stop
