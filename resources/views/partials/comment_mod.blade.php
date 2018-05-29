<form class="mt-3 mb-4" method="POST" 
action="{{$route_mod_comment}}">
            {{ csrf_field() }}
            <div class="form-group">
              <textarea class="form-control" name="text" id="text" rows="3" placeholder="Comment"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Post</button>
          </form>
@foreach ($comments as $comment)
<div id="commentNo{{$comment->id}}" style="display: block;" class="news_box card border-0 my-3 col-12">
  <div class="card-body p-0">
    <div class="d-flex">
      <div class="mr-2">
        <img src="{{ Storage::url('users/'.($comment->commentator_picture == null ? 'default' : $comment->commentator_picture)) }}"
          style="max-height: 70px; max-width: 70px;" alt="{{ $comment->commentator }}'s picture">
      </div>
      <div>
        <a class="owner" style="color:inherit;" href="{{ url('users/'.$comment->commentator) }}">
          <span class="font-weight-bold">{{ $comment->commentator }} </span>
        </a>
        <time class="date"> {{ date("F jS, Y \a\\t H:i", strtotime($comment->date)) }}</time>
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