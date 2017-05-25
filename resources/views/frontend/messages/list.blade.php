<div class="content table-responsive table-full-width">
  <table class="table table-hover table-striped" cellspacing="0" width="100%">
  <tbody>
      @foreach ($messages as $message)
          <tr class="pointer create-edit-show" data-title="{{ 'Mensaje para: '.$message->remitente->roles->first()->display_name }}" data-model="modal" data-href="{{ route('message.show', $message->id) }}">
              <td>
                <div class="message-time">
                <a href="javascript:void(0)" class="message-user pull-left"> 
                {{ $message->remitente->roles->first()->display_name }}
                </a>
                <span class="pull-right">
                {{ $message->created_at }}
                </span>
                </div>
                <div class="message-description">{!! str_limit($message->subject, 50).'...' !!}</div>
              </td>
          </tr>
      @endforeach
  </tbody>
  </table>
  <div class="">
  {{ $messages->links() }}
  </div> 
</div>
