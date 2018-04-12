<div class="news_box card border-0 my-3">
  <div class="card-body p-0">
    <div class="d-flex">
      <div class="mr-2">
        <img src="images/user1.jpg" style="max-height: 70px; max-width: 70px;" alt="pPic">
      </div>
      <div>
        <div class="owner">LN Moore</div>
        <time class="date">February 28, 2018, at 8:05 p.m</time>
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
        <p>ah yes, no matter your qualification, it will be assumed your race was the cause. #blackandproud #lawdegreewithhonors.</p>
        </p>
      </div>
    </div>
  </div>
</div>

@foreach ($comments as $comment)
<div class="news_box card border-0 my-3">
  <div class="card-body p-0">
    <div class="d-flex">
      <div class="mr-2">
        <img src="images/user1.jpg" style="max-height: 70px; max-width: 70px;" alt="pPic">
        <!-- TODO: put image -->
      </div>
      <div>
        <div class="owner"> {{ $comment->commentator }}</div>
        <time class="date"> {{ $comment->date }}</time>
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