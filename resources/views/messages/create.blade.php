@extends('layouts.app')

@section('page-title', 'Mensajes')

@section('content')

<div class="container-fluid">
  <div class="row">
      <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="title">
                Enviar Mensaje
                @if (Auth::user()->hasRole('owner'))
                  al Administrador
                @endif
                </h4>
            </div>
            <div class="content">
              <div class="row">
                <div class="col-md-12 col-xs-12">
                  <div id="tab-content" class="grid-local">
                          <div class="">
                          {!! Form::open(['route' => 'messages-panel.store', 'class' => '']) !!}

                          @if(Auth::user()->hasRole('admin'))
                          <div class="col-md-12 col-xs-12">
                            <div class="form-group">
                            <label class="control-label col-md-2 col-xs-12 mg-top-10">Destinatario</label>
                            <div class="col-md-8 col-xs-12">
                              {!! Form::select('user_to', $users_to, old('user_to'), ['class' => 'form-control select-autocomplete']) !!}
                              </div>
                            </div>
                          </div>
                          @endif

                          <div class="col-md-12 col-xs-12">
                            <div class="form-group">
                            <label class="control-label col-md-2 col-xs-12 mg-top-10">Asunto</label>
                            <div class="col-md-10 col-xs-12">
                              <input type="text" name="subject" value="{{ old('subject') }}" class="form-control"/>
                              </div>
                            </div>
                          </div>

                          <div id="alerts"></div>
                          @include('partials.toolbar_editor')
                          <div id="editor2" class="editor-wrapper editor-text"></div>
                          <textarea name="description" id="description" required="required" style="display: none;"></textarea>
                          <br>
                           <div class="pull-right">
                             <button type="submit" class="btn btn-danger menu-click">@lang('app.send')</button>
                          </div>
                          {!! Form::close() !!}
                        </div>
                  </div>
                </div>
              </div> 
            </div>
        </div>
      </div>
  </div>
</div>

@endsection

@section('styles')
{!! HTML::style("vendors/select2/dist/css/select2.min.css") !!}
@endsection

@section('scripts')

{!! HTML::script('vendors/select2/dist/js/select2.min.js') !!}
<!-- bootstrap-wysiwyg -->
{!! HTML::script('vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js') !!}
{!! HTML::script('vendors/jquery.hotkeys/jquery.hotkeys.js') !!}
{!! HTML::script('vendors/google-code-prettify/src/prettify.js') !!}
<!-- Editor-->
{!! HTML::script('assets/js/editor.js') !!}

<script type="text/javascript">
$(document).ready(function() {
  $(".select-autocomplete").select2();
});
</script>

@endsection