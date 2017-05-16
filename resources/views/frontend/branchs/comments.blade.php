@foreach($comments as $key => $comment)
<div class="comment">
	<div class="row">
		<div class="col-md-3 col-xs-3">
			<div class="avatar-comment"><img src="{{ $comment->client->avatar() }}"></div>
			<div class="avatar-name">{{ $comment->client->full_name() }}</div>
		</div>
		<div class="col-md-9 col-xs-9">
			{!! $comment->scoreByClient($local->id) !!}
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 col-xs-12 comment-content">
			<span class="date-comment">{{ $comment->created_at }}</span>
			<div class="content"> 
			{!! $comment->content !!}
			</div>
		</div>
	</div>
</div>
@endforeach