@extends('layouts.app')

@section('page-title', trans('app.reservations'))

@section('content')

<div class="container-fluid">
  <div class="row">
      <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="title">{{ trans('app.reservations') }}</h4>
            </div>
            <div class="content">
                <div class="row">

                  @if (Auth::user()->hasRole('owner'))
                  <div class="col-md-3 col-sm-3 col-xs-12">
                    <label class="select">
                    {!! Form::select('branch', $branch_list, old('branch'), ['class' => 'form-control', 'id' => 'branch_list']) !!}
                    <i></i> </label>
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-12">
                    <input type="date" value="{{ old('date') }}" class="form-control" id="date_reservation">
                  </div>
                  @endif

                    @include('partials.search') 

                  </div>

                  <div class="row">
                    <div class="inner-spacer">
                      <div id="tab-content">
                         @include('branchs.list_reservations')
                      </div>
                    </div>
                  </div>
            </div>
        </div>
      </div>
  </div>
</div>

@endsection
