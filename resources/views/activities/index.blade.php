@extends('layouts.app')

@section('page-title', trans('app.activity_log'))

@section('content')

<div class="container-fluid">
  <div class="row">
      <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="title">{{ trans('app.activity_log') }}</h4>
                <p class="category">
                  @if($user)
                    {{ $user->full_name() }}
                  @else
                  {{trans('app.activity_log_all_users')}}
                  @endif
                </p>
            </div>
            <div class="content">
                <div class="row">
                    @include('partials.status')
                  </div>

                  <div class="row">
                    <div class="inner-spacer">
                      <div id="content-table">
                         @include('activities.list')
                      </div>
                    </div>
                  </div>
            </div>
        </div>
      </div>
  </div>
</div>

@endsection
