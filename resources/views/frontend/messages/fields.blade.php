    <div class="">
      {!! Form::open(['route' => 'message.store', 'id' => 'form-generic', 'class' => '']) !!}

      <div class="col-md-12 col-xs-12">
        <div class="form-group">
        <label class="control-label col-md-1 col-xs-12 mg-top-10">Asunto</label>
        <div class="col-md-10 col-xs-12">
          <input type="text" name="subject" value="{{ old('subject') }}" class="form-control"/>
          </div>
        </div>
      </div>

      <div id="alerts"></div>
      @include('partials.toolbar_editor')
      <div id="editor2" class="editor-wrapper editor-text"></div>
      <textarea name="description" id="description" required="required" style="display: none;"></textarea>
      {!! Form::hidden('send_from', URL::previous(), []) !!}
       <div class="pull-right mg-top-10">
         <button type="submit" class="btn btn-danger">@lang('app.send')</button>
         <a href="{{ URL::previous() }}" class="btn btn-default menu-click">@lang('app.back')</a>
      </div>
      {!! Form::close() !!}
    </div>
