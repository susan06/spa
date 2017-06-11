<div class="content table-responsive table-full-width">
  <table class="table table-hover table-striped" cellspacing="0" width="100%">
  <tbody>
      @foreach ($messages as $message)
        @if(!$message->isDelete())
          <tr class="pointer">
              <td class="create-edit-show" data-message="{{$message->id}}"  data-title="Mensaje" data-model="modal" data-href="{{ route('message.show', $message->id) }}">
                <div class="message-time">
                <a href="javascript:void(0)" class="message-user pull-left {{ ($message->read_on) ? 'text-gray' : '' }}" id="title-message-{{$message->id}}"> 
                {!! $message->title() !!}
                </a>
                <span class="pull-right">
                {{ $message->created_at }}
                </span>
                </div>
                <div class="message-description">{!! str_limit($message->subject, 50).'...' !!}</div>
              </td>
              <td>
                <span class="pull-right">
                  <a type="button" data-href="{{ route('messages-panel.destroy', $message->id) }}" 
                    class="btn-delete" 
                    data-confirm-text="@lang('app.are_you_sure_delete_message')"
                    data-confirm-delete="@lang('app.yes_delete_him')"
                    title="@lang('app.delete_message')" data-toggle="tooltip" data-placement="top">
                      <i class="fa fa-trash-o"></i>
                  </a>
                </span>
              </td>
          </tr>
          @endif
      @endforeach
  </tbody>
  </table>
  <div class="">
  {{ $messages->links() }}
  </div> 
</div>
