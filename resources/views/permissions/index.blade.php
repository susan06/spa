@extends('layouts.app')

@section('page-title', trans('app.permissions'))

@section('content')

<div class="container-fluid">
  <div class="row">
      <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="title">{{ trans('app.permissions') }}</h4>
                <p class="category">{{trans('app.available_system_permissions')}}</p>
            </div>
            <div class="content">
                <div class="row">
                    <div class="col-md-3 col-sm-3 col-xs-12 mg-botom-15-movil">
                       <a href="javascript:void(0)" data-href="{{route('permission.create') }}" class="btn btn-danger btn-fill create-edit-show" data-model="modal" title="@lang('app.create_permission')">
                          @lang('app.add_permission')
                      </a>
                    </div>
                  </div>

                  <div class="row">
                    <div class="inner-spacer">
                    {!! Form::open(['route' => 'permission.save']) !!}
                      <div id="tab-content">
                         @include('permissions.list')
                      </div>
                       @if (count($permissions))
                         
                          <div class="col-md-12 col-sm-12 col-xs-12">
                             <button type="submit" class="btn btn-danger btn-fill pull-right">@lang('app.save_permissions')
                            </button>
                          </div>
                       
                        @endif
                    {!! Form::close() !!}
                    </div>
                  </div>
            </div>
        </div>
      </div>
  </div>
</div>

@endsection
