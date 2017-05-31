@extends('layouts.app')

@section('page-title', trans('app.banners'))

@section('content')

<div class="container-fluid">
  <div class="row">
      <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="title">{{ trans('app.banners') }}</h4>
            </div>
            <div class="content">
                <div class="row">
                    <div class="col-md-3 col-sm-3 col-xs-12 mg-botom-15-movil">
                       <a href="javascript:void(0)" data-href="{{route('banner.create') }}" class="btn btn-danger btn-fill create-edit-show" data-model="modal" title="@lang('app.add_banner')">
                          @lang('app.add_banner')
                      </a>
                    </div>
                  </div>

                  <div class="row">
                    <div class="inner-spacer">
                      <div id="tab-content">
                         @include('banners.list')
                      </div>
                    </div>
                  </div>
            </div>
        </div>
      </div>
  </div>
</div>

@endsection
