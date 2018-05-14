@foreach ($comments as $comment)
<div id="commentNo{{$comment->id}}" style="display: block;" class="news_box card border-0 my-3 col-12">
  <div class="card-body p-0">
    <div class="d-flex">
      <div class="mr-2">
        <img src="{{ Storage::url('users/'.($comment->commentator_picture == null ? 'default' : $comment->commentator_picture)) }}"
          style="max-height: 70px; max-width: 70px;" alt="{{ $comment->commentator }}'s picture">
      </div>
      <div>
        <div class="owner"> {{ $comment->commentator }}</div>
        <time class="date"> {{ date("F jS, Y \a\\t H:i", strtotime($comment->date)) }}</time>
      </div>
      <div class="ml-auto">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="true">
          <!-- <i class="fa fa-angle-down" ></i> -->
        </a>
        <div class="dropdown-menu" x-placement="bottom-start">
        @if(Auth::user()->username == $comment->commentator)
              <!-- Edit -->
              <a class="dropdown-item editCommentForm" name="{{$comment->id}}" href="/api/news/{{$comment->news_id}}/comments/{{$comment->id}}">Edit</a>
              <!-- Delete -->
              <a class="dropdown-item deleteComment" href="/api/news/{{$comment->news_id}}/comments/{{$comment->id}}">Delete</a>
          @endif
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="commentBody" news-id="{{$comment->news_id}}" comm-id="{{$comment->id}}">{{ $comment->text }}</div>
      </div>
    </div>
  </div>
</div>
@endforeach