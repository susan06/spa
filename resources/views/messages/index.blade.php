@extends('layouts.app')

@section('page-title', 'Mensajes')

@section('content')

<div class="container-fluid">
  <div class="row">
      <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="title">Mensajes</h4>
            </div>
            <div class="content">
              <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-12 mg-botom-15-movil">
                   <a href="{{ route('messages-panel.create') }}" class="btn btn-danger btn-fill">
                      Enviar Mensaje
                  </a>
                </div>
              </div>
                  
              <div class="row">
                <div class="col-md-12 col-xs-12">
                  <div id="tab-content" class="grid-local">
                      @include('frontend.messages.list')
                  </div>
                </div>
              </div> 
            </div>
        </div>
      </div>
  </div>
</div>

@endsection
