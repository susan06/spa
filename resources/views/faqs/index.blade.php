@extends('layouts.app')

@section('page-title', trans('app.faqs'))

@section('content')

<div class="container-fluid">
  <div class="row">
      <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="title">{{ trans('app.faqs') }}</h4>
            </div>
            <div class="content">
                <div class="row">
                    
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <button type="button" data-href="{{ route('faq.create') }}" class="btn btn-danger btn-fill  create-edit-show" data-model="modal" title="@lang('app.create_faq')">@lang('app.create_faq')</button>
                    </div>

                    @include('partials.search') 
                  </div>

                  <div class="row">
                    <div class="inner-spacer">
                      <div id="tab-content">
                        @include('faqs.list')
                      </div>
                    </div>
                  </div>
            </div>
        </div>
      </div>
  </div>
</div>


@endsection
