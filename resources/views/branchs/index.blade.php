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

                  @if (Auth::user()->hasRole('owner'))
                  <div class="col-md-3 col-sm-3 col-xs-12">
                    <label class="select">
                    {!! Form::select('branch', $branch_list, old('branch'), ['class' => 'form-control', 'id' => 'branch_list']) !!}
                    <i></i> </label>
                  </div>
                  @endif

                    @include('partials.search') 

                    @if (Auth::user()->hasRole('admin'))
                    <div class="col-md-3 col-sm-3 col-xs-12 mg-botom-15-movil">
                       <a href="{{route('branch.create') }}" class="btn btn-danger btn-fill menu-click" title="@lang('app.create_branch')">
                          @lang('app.add_branch')
                      </a>
                    </div>
                    @endif
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
