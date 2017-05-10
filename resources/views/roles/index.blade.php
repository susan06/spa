@extends('layouts.app')

@section('page-title', trans('app.roles'))

@section('content')

<div class="container-fluid">
  <div class="row">
      <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="title">{{ trans('app.roles') }}</h4>
                <p class="category">{{trans('app.available_system_roles')}}</p>
            </div>
            <div class="content">
                <div class="row">
                    @include('partials.search') 

                    <div class="col-md-3 col-sm-3 col-xs-12">
                       <a href="javascript:void(0)" data-href="{{route('role.create') }}" class="btn btn-danger btn-fill  create-edit-show" data-model="modal" title="@lang('app.create_role')">
                          @lang('app.add_role')
                      </a>
                    </div>
                  </div>

                  <div class="row">
                    <div class="inner-spacer">
                      <div id="content-table">
                         @include('roles.list')
                      </div>
                    </div>
                  </div>
            </div>
        </div>
      </div>
  </div>
</div>

@endsection
