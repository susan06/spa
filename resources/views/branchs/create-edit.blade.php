@extends('layouts.app')

@section('page-title', trans('app.locales'))

@section('content')

<div class="container-fluid">
  <div class="row">
      <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="title">{{ trans('app.create_branch') }}</h4>
            </div>
            <div class="content">
                    @if($edit)
                    {!! Form::model($branch, ['route' => ['branch.update', $branch->id], 'method' => 'PUT', 'id' => 'form-generic', 'class' => '', 'files' => 'true', 'novalidate' => 'novalidate']) !!}
                    @else
                     {!! Form::open(['route' => 'branch.store', 'id' => 'form-generic', 'class' => '', 'files' => 'true', 'novalidate' => 'novalidate']) !!}
                    @endif

                    <div class="col-md-12 col-sm-12 col-xs-12">

                      <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <div class="form-group">
                          <label>@lang('app.company') <span class="required">*</span></label>
                            {!! Form::select('company_id', $companies, old('company_id'), ['class' => 'form-control']) !!}
                          </div>
                        </div>
                        
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="form-group">
                          <label>@lang('app.provincia') <span class="required">*</span>
                          </label>
                          {!! Form::select('province_id', $provinces, old('province_id'), ['class' => 'form-control']) !!}
                          </div>
                        </div>
                      </div>

                       <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <div class="form-group">
                          <label>@lang('app.name') <span class="required">*</span></label>
                            {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
                          </div>
                        </div>
                        
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="form-group">
                          <label>@lang('app.status') <span class="required">*</span>
                          </label>
                          {!! Form::select('status', $status, old('status'), ['class' => 'form-control']) !!}
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <div class="form-group">
                            <label>@lang('app.email') <span class="required">*</span>
                            </label>
                            {!! Form::text('email', old('email'), ['class' => 'form-control']) !!}
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <div class="form-group">
                            <label>@lang('app.address') <span class="required">*</span>
                            </label>
                            {!! Form::text('address', old('address'), ['class' => 'form-control', 'id' => 'address']) !!}
                            </div>
                          </div>
                      </div>

                      <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <div class="form-group">
                            <label>@lang('app.address_description') <span class="required">*</span></label>
                            {!! Form::text('address_description', old('address_description'), ['class' => 'form-control', 'id' => 'address_description']) !!}
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <div class="form-group">
                            <label>@lang('app.address_add_autocomplete')</label>
                            {!! Form::text('address_search', old('address_search'), ['class' => 'form-control', 'id' => 'address_search']) !!}
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <div class="form-group">
                          <label>Latitud<span class="required">*</span></label>
                             {!! Form::text('lat', old('lat'), ['class' => 'form-control', 'id' => 'lat', 'readOnly' => 'readOnly']) !!}
                          </div>
                        </div>
                      
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="form-group">
                          <label>Longitud<span class="required">*</span>
                          </label>
                          {!! Form::text('lng', old('lng'), ['class' => 'form-control', 'id' => 'lng', 'readOnly' => 'readOnly']) !!}
                          </div>
                        </div>
                      </div>

                      <div id="map-form" style="min-height: 300px;"></div>

                      <div class="row mg-top-10">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <div class="form-group">
                          <label>@lang('app.phone') 1 <span class="required">*</span></label>
                             {!! Form::text('phone_one', old('phone_one'), ['class' => 'form-control phones', 'data-inputmask' => "'mask' : '9999999999'"]) !!}
                          </div>
                        </div>
                      
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="form-group">
                          <label>@lang('app.phone') 2 </label>
                          {!! Form::text('phone_second', old('phone_second'), ['class' => 'form-control phones', 'data-inputmask' => "'mask' : '9999999999'"]) !!}
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <label>@lang('app.week')</label>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <div class="form-group mg-right-checkbox">
                              <label>
                                <input type="checkbox" class="" name="week[]" value="1"
                                {!! ($edit && in_array(1,$week)) ? '' : 'checked="checked"' !!}> Lunes 
                              </label>
                              <label>
                                <input type="checkbox" class="" name="week[]" value="2" 
                                {!! ($edit && in_array(2,$week)) ? '' : 'checked="checked"' !!}> Martes 
                              </label>
                              <label>
                                <input type="checkbox" class="" name="week[]" value="3" 
                                {!! ($edit && in_array(3,$week)) ? '' : 'checked="checked"' !!}> Miércoles
                              </label>
                              <label>
                                <input type="checkbox" class="" name="week[]" value="4" 
                                {!! ($edit && in_array(4,$week)) ? '' : 'checked="checked"' !!}> Jueves 
                              </label>
                              <label>
                                <input type="checkbox" class="" name="week[]" value="5" 
                                {!! ($edit && in_array(5,$week)) ? '' : 'checked="checked"' !!}> Viernes 
                              </label>
                              <label>
                                <input type="checkbox" class="" name="week[]" value="6" 
                                {!! ($edit && in_array(6,$week)) ? '' : 'checked="checked"' !!}> Sábado 
                              </label>
                              <label>
                                <input type="checkbox" class="" name="week[]" value="0" 
                                {!! ($edit && in_array(0,$week)) ? '' : 'checked="checked"' !!}> Domingo
                              </label>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                        <label>Turno para reservas</label>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <div class="form-group">
                             {!! Form::select('min_time', $min_time, old('min_time'), ['class' => 'form-control']) !!}
                          </div>
                        </div>
                      
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="form-group">
                          {!! Form::select('max_time', $max_time, old('max_time'), ['class' => 'form-control']) !!}
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                         <div class="form-group">
                            <label>Reserva Online</label>
                            <input type="hidden" name="reservation_web" value="0">
                            {!! Form::checkbox('reservation_web', 1, old('reservation_web'), ['class' => 'js-switch']) !!}
                          </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                         <div class="form-group">
                            <div class="col-md-3 col-sm-3 col-xs-6">
                            <label>Descuento</label>
                            <input type="hidden" name="reservation_discount" value="0">
                            {!! Form::checkbox('reservation_discount', 1, old('reservation_discount'), ['class' => 'js-switch']) !!}
                            </div>
                            <div class="col-md-2 col-sm-2 col-xs-4 mg-top-10">
                            {!! Form::text('percent_discount', old('percent_discount'), ['class' => 'form-control percent', 'data-inputmask' => "'mask' : '99%'"]) !!}
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row mg-top-10">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <div class="form-group">
                            <label>Servicios de valor agregado</label>
                            {!! Form::text('services_description', old('services_description'), ['class' => 'form-control', 'id' => 'services_description']) !!}
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-3 col-sm-4 col-xs-12">
                          <button type="button" onClick="add_services()" class="btn btn-default col-xs-12">@lang('app.add_services')</button>
                        </div>
                      </div>

                      <div class="row" id="load_services">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <div id="content-table">
                            <div id="load_services"> 
                              <table class="table-responsive table table-striped table-bordered dt-responsive nowrap form-horizontal" id="services_table" style="display: none;">
                              <thead>
                              <tr>
                                <th>@lang('app.name')</th>
                                <th>@lang('app.price')</th>
                                <th>@lang('app.status')</th>
                                <th width="10%">@lang('app.actions')</th>
                              </tr>
                              </thead>
                              <tbody id="services_list">
                              @if($edit)
                                  @foreach($branch->services as $key => $service)
                                    <tr>
                                      <td><input type="text" name="services_name[]" class="form-control" value="{{ $service->name }}" required="required"><input type="hidden" name="service_id[]" value="{{ $service->id }}"></td>
                                      <td><input type="text" name="services_prices[]" class="form-control" value="{{ $service->price }}"></td>
                                      <td>
                                      {!! Form::select('services_status[]', $status_services, $service->status, ['class' => 'form-control']) !!}
                                      </td>
                                      <td>
                                      @if($key != 0)
                                        <button type="button" class="btn btn-round btn-danger delete-service"> 
                                          <i class="fa fa-trash"></i>
                                        </button>
                                      @endif
                                      </td>
                                    </tr>
                                    @endforeach
                              @endif
                                <!-- load content services -->
                              </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>

                      <!--
                      <div class="row">
                        <div class="col-md-3 col-sm-3 col-xs-12">
                         <div class="form-group">
                            <label>Precio total</label>
                          {!! Form::text('price', old('price'), ['class' => 'form-control', 'id' => 'price', 'readOnly' => 'readOnly']) !!}
                          </div>
                        </div>
                      </div>
                      -->

                       <div class="row mg-top-10">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <label>Métodos de pago</label>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <div class="form-group mg-right-checkbox">
                            @foreach($payments as $payment)
                              <label>
                                <input type="checkbox" name="payments[]" value="{{ $payment->id }}"
                                {{ ($edit) ? $branch->checkPayment($payment->id) : '' }}
                                >
                                <img class="icon_payment" src="{{ asset('uploads/methodPayments/'.$payment->icon) }}"> 
                              </label>
                            @endforeach
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-11 col-sm-11 col-xs-12">                  
                          <div id="alerts"></div>
                          <label>Horario de trabajo<span class="required">*</span></label>
                          @include('partials.toolbar_editor')
                          <div id="editor4" class="editor-wrapper editor-text" style="min-height: 200px;">{!! isset($branch) ? $branch->working_hours : old('working_hours') !!}</div>
                          <textarea name="working_hours" id="working_hours" style="display: none;" required="required">{!! isset($branch) ? $branch->working_hours : old('working_hours') !!}</textarea>
                        </div>
                      </div>

                      <div class="row mg-top-10">
                        <h4 class="title">Fotos</h4>
                        <div class="col-md-5 col-sm-5 col-xs-12">
                         <div class="form-group">
                            <input type="file" name="photos[]" class="form-control" value=""/>
                          </div>
                        </div>
                      </div>

                      <div id="load_photos">
                        
                      </div>

                      <div class="row">
                        <div class="form-group col-md-3 col-sm-4 col-xs-12">
                          <button type="button" onClick="add_photos()" class="btn btn-default col-xs-12">Agregar más fotos</button>
                        </div>
                      </div>

                      <div class="col-md-12 col-sm-12 col-xs-12">
                      @if($edit)
                      <button type="buttom" class="btn btn-fill btn-danger pull-right menu-click">Actualizar Local</button>
                      @else
                        <button type="submit" class="btn btn-fill btn-danger pull-right menu-click">Agregar Local</button>
                      @endif
                      </div> 

                    </div>
              
                    {!! Form::close() !!}

            </div>
        </div>
      </div>
  </div>
</div>

@endsection

@section('scripts_head')
@parent
  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?&key={{ env('API_KEY_GOOGLE')}}&libraries=places&language=ES"></script>
@endsection

@section('styles')
    <!-- Switchery -->
    {!! HTML::style("vendors/switchery/dist/switchery.min.css") !!}
@endsection

@section('scripts')

<!-- Switchery -->
{!! HTML::script('vendors/switchery/dist/switchery.min.js') !!}
<!-- jquery.inputmask -->
 {!! HTML::script('vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js') !!}
<!-- bootstrap-wysiwyg -->
{!! HTML::script('vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js') !!}
{!! HTML::script('vendors/jquery.hotkeys/jquery.hotkeys.js') !!}
{!! HTML::script('vendors/google-code-prettify/src/prettify.js') !!}
<!-- Editor-->
{!! HTML::script('assets/js/editor.js') !!}

<script type="text/javascript">
  $(".phones").inputmask();
  $(".percent").inputmask();

  var map = null;
  var infowindow = null;
  var marker = null;
  @if($edit)
  $('#services_table').show();
  var edit = true;
  var local_lat = {{ $branch->lat }};
  var local_lng = {{ $branch->lng }};
  @else
  var edit = false;
  @endif
  var count = 1;
  var select_option_service = {1:'Público', 0:'No Público'};
  @if(old('lat') && old('lng'))
    var map_center = {lat: {{old('lat')}}, lng: {{old('lng')}} };
  @else
    var map_center = {lat: 8.537981, lng: -80.782127 };
  @endif
</script>

{!! HTML::script('assets/js/maps_services.js') !!}

@endsection
