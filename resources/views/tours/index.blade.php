@extends('layouts.app')

@section('page-title', trans('app.tours'))

@section('content')

<div class="container-fluid">
  <div class="row">
      <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="title">{{ trans('app.tours') }}</h4>
            </div>
            <div class="content">
                <div class="row">

                  @if (Auth::user()->hasRole('owner'))
                  <div class="col-md-3 col-sm-3 col-xs-12">
                    <label class="select">
                    {!! Form::select('branch', $branch_list, old('branch'), ['class' => 'form-control', 'id' => 'branch_list']) !!}
                    <i></i> </label>
                  </div>
                  @endif

                    @include('partials.search') 

                    @if (Auth::user()->hasRole('owner'))
                    <div class="col-md-3 col-sm-3 col-xs-12 mg-botom-15-movil">
                      <a href="javascript:void(0)" data-href="{{route('tour.create') }}" class="btn btn-danger btn-fill create-edit-show" data-model="modal" title="@lang('app.create_tour')">
                          @lang('app.add_tour')
                      </a>
                    </div>
                    @endif
                  </div>

                  <div class="row">
                    <div class="inner-spacer">
                      <div id="tab-content">
                         @include('tours.list')
                      </div>
                    </div>
                  </div>
            </div>
        </div>
      </div>
  </div>
</div>

@endsection
