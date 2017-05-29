@extends('layouts.app')

@section('page-title', trans('app.locales'))

@section('content')

<div class="container-fluid">
  <div class="row">
      <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="title">{{ trans('app.locales') }}</h4>
            </div>
            <div class="content">
                <div class="row">
                    @include('partials.search') 

                    <div class="col-md-3 col-sm-3 col-xs-12 mg-botom-15-movil">
                       <a href="javascript:void(0)" data-href="{{route('branch.create') }}" class="btn btn-danger btn-fill  create-edit-show" data-model="modal" title="@lang('app.create_branch')">
                          @lang('app.add_branch')
                      </a>
                    </div>
                  </div>

                  <div class="row">
                    <div class="inner-spacer">
                      <div id="tab-content">
                         @include('branchs.list')
                      </div>
                    </div>
                  </div>
            </div>
        </div>
      </div>
  </div>
</div>

@endsection
