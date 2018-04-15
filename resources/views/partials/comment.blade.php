@foreach ($comments as $comment)
<div style="display: block;" class="news_box card border-0 my-3 col-12">
  <div class="card-body p-0">
    <div class="d-flex">
      <div class="mr-2">
        <img src="{{ Storage::url('users/'.($comment->commentator_picture == null ? 'default.png' : $comment->commentator_picture)) }}"
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
          <a class="dropdown-item" href="#">You need to be registered in our website
            <br> to report this comment</a>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <p>{{ $comment->text }}</p>
        </p>
      </div>
    </div>
  </div>
</div>
@endforeach