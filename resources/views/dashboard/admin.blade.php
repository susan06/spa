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
              
                <!-- Widget Row Start grid -->
                <div class="row">

                    <div class="col-md-6 col-sm-6">
                      <div class="card card-stats">
                        <div class="card-header" data-background-color="green">
                          <i class="material-icons"><i class="fa fa-user"></i></i>
                        </div>
                        <div class="card-content">
                          <p class="category">@lang('app.new_users_this_month')</p>
                          <h3 class="title">{{ $stats['new'] }}</h3>
                        </div>
      
                      </div>
                    </div>

                    <div class="col-md-6 col-sm-6">
                      <div class="card card-stats">
                        <div class="card-header" data-background-color="blue">
                          <i class="material-icons"><i class="fa fa-group"></i></i>
                        </div>
                        <div class="card-content">
                          <p class="category">@lang('app.total_users')</p>
                          <h3 class="title">{{ $stats['total'] }}</h3>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6 col-sm-6">
                      <div class="card card-stats">
                        <div class="card-header" data-background-color="red">
                          <i class="material-icons"><i class="fa fa-times"></i></i>
                        </div>
                        <div class="card-content">
                          <p class="category">@lang('app.banned_users')</p>
                          <h3 class="title">{{ $stats['banned'] }}</h3>
                        </div>
                      </div>
                    </div>
                          
                    <div class="col-md-6 col-sm-6">
                      <div class="card card-stats">
                        <div class="card-header" data-background-color="orange">
                          <i class="material-icons"><i class="fa fa-check"></i></i>
                        </div>
                        <div class="card-content">
                          <p class="category">@lang('app.unconfirmed_users')</p>
                          <h3 class="title">{{ $stats['unconfirmed'] }}</h3>
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
