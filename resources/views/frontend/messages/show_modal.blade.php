<div class="modal-body">
  <p>{!! $message->title() !!}</p>
  <span class="pull-right">{{ $message->created_at }}</span>
  <p class="excerpt">{{ 'Asunto: '.$message->subject }}</p>
  <div class="modal-message-content">
    {!! $message->description !!}
  </div>
    @if (Auth::user()->hasRole('admin') && $message->send_from)
    <a href="{{ $message->send_from }}" target="_blank">Ver el local donde se envio el mensaje</a>
	  <br>
	  <div></div>
    @endif
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal" onclick="messages();">@lang('app.close')</button>
</div>

