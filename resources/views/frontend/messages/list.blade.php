<div class="content table-responsive table-full-width">
  <table id="datatable-responsive" class="table table-hover table-striped" cellspacing="0" width="100%">
  <tbody>
      @foreach ($messages as $message)
          <tr>
              <td>
                <div class="message-time">
                <a href="javascript:void(0)" data-href="{{ route('message.show', $message->id) }}" class="create-edit-show-modal message-user pull-left"> 
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
