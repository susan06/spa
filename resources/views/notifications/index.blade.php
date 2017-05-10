@extends('layouts.app')

@section('page-title', trans('app.notifications'))

@section('content')

<div class="col-md-12 col-sm-12 col-xs-12 bootstrap-grid margin-top">
    <div class="powerwidget dark-blue">
        <header>
            <h2>{{ trans('app.notifications') }}
            <small>{{trans('app.list_of_registered_notifications')}}</small></h2>
        </header>
        <div class="inner-spacer">

          <div class="row">
            <div class="inner-spacer">
              <div id="content-table">
                @include('notifications.list')
              </div>
            </div>
          </div>

        </div>
    </div>
</div>

@endsection
