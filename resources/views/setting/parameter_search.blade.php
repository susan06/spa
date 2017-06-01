@extends('layouts.app')

@section('page-title', trans('app.setting'))

@section('content')

<div class="container-fluid">
    <div class="card">
        <div class="header">
            <h4 class="title">{{ trans('app.setting') }}</h4>
            <p class="category">{{trans('app.setting_search')}}</p>
        </div>
        <div class="content">

              <div class="row">

              {!! Form::open(['route' => 'setting.update']) !!}

                <div class="col-md-12 col-sm-12 col-xs-12">
                 <div class="form-group">
                    <label class="col-md-6 col-sm-6 col-xs-12" for="">Reserva online</label>
                       <input type="hidden" name="reservation_web" value="0">
                       {!! Form::checkbox('reservation_web', 1, Settings::get('reservation_web'), ['class' => 'js-switch']) !!}
                    </div>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                 <div class="form-group">
                    <label class="col-md-6 col-sm-6 col-xs-12" for="">Más recomendado</label>
                       <input type="hidden" name=recommendation"" value="0">
                       {!! Form::checkbox('recommendation', 1, Settings::get('recommendation'), ['class' => 'js-switch']) !!}
                    </div>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                 <div class="form-group">
                    <label class="col-md-6 col-sm-6 col-xs-12" for="">Servicio</label>
                       <input type="hidden" name="service" value="0">
                       {!! Form::checkbox('service', 1, Settings::get('service'), ['class' => 'js-switch']) !!}
                    </div>
                </div>
                
                <div class="col-md-12 col-sm-12 col-xs-12">
                 <div class="form-group">
                    <label class="col-md-6 col-sm-6 col-xs-12" for="">Ambiente</label>
                       <input type="hidden" name="environment" value="0">
                       {!! Form::checkbox('environment', 1, Settings::get('environment'), ['class' => 'js-switch']) !!}
                    </div>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                 <div class="form-group">
                    <label class="col-md-6 col-sm-6 col-xs-12" for="">Atención</label>
                       <input type="hidden" name="attention" value="0">
                       {!! Form::checkbox('attention', 1, Settings::get('attention'), ['class' => 'js-switch']) !!}
                    </div>
                </div>
                
                <div class="col-md-12 col-sm-12 col-xs-12">
                 <div class="form-group">
                    <label class="col-md-6 col-sm-6 col-xs-12" for="">Precio</label>
                       <input type="hidden" name="price" value="0">
                       {!! Form::checkbox('price', 1, Settings::get('price'), ['class' => 'js-switch']) !!}
                    </div>
                </div>     


                <div class="col-md-12 col-sm-12 col-xs-12">
                 <div class="form-group">
                    <label class="col-md-6 col-sm-6 col-xs-12" for="">Provincias</label>
                       <input type="hidden" name="province_id" value="0">
                       {!! Form::checkbox('province_id', 1, Settings::get('province_id'), ['class' => 'js-switch']) !!}
                    </div>
                </div>                                           

                <div class="col-md-12 col-sm-12 col-xs-12">
                  <button type="submit" class="btn btn-fill btn-danger pull-right">@lang('app.update')</button>
                </div> 

                {!! Form::close() !!}
              </div>
        </div>
    </div>
</div>

@endsection

@section('styles')
    <!-- Switchery -->
    {!! HTML::style("vendors/switchery/dist/switchery.min.css") !!}
@endsection

@section('scripts')
    <!-- Switchery -->
    {!! HTML::script('vendors/switchery/dist/switchery.min.js') !!}
@endsection