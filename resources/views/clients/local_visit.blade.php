@extends('layouts.app')

@section('page-title', trans('app.clients'))

@section('content')

<div class="container-fluid">
  <div class="row">
      <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="title">Locales visitados por: {{ $user->full_name() }}</h4>
            </div>
            <div class="content">
                  <div class="row">
                    <div class="inner-spacer">
                      <div id="tab-content">
                        @include('frontend.branchs.score')
                      </div>
                    </div>
                  </div>
            </div>
        </div>
      </div>
  </div>
</div>


@endsection
