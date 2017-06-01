    <div class="">
      {!! Form::open(['route' => 'setting.update', 'class' => '']) !!}
      <div id="alerts"></div>
      @include('partials.toolbar_editor')
      <div id="editor" class="editor-wrapper editor-text" style="min-height: 250px;">{!! Settings::get('terms_service') !!}</div>
      <textarea name="terms_service" id="terms_service" style="display: none;" required="required">{!! Settings::get('terms_service') !!}</textarea>
       <div class="col-md-12 col-sm-12 col-xs-12 mg-top-10">
         <button type="submit" class="btn btn-fill btn-danger pull-right">@lang('app.update')
        </button>
      </div>
      {!! Form::close() !!}
    </div>

