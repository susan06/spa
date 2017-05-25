<div class="modal-body">
  <span class="pull-right">Para: {{ $message->created_at }}</span>
  <p class="excerpt">{{ 'Asunto: '.$message->subject }}</p>
  <div class="modal-message-content">
    {!! $message->description !!}
  </div>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">@lang('app.close')</button>
</div>

