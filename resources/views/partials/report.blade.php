<div class="row text-center m-5">
  <div class="col">
    <h2>
      <strong>News' title</strong>
    </h2>
  </div>
  @if($isReportedComment)
  <div class="col">
      <h2>
        <strong>Reported comment</strong>
      </h2>
    </div>
    @endif
  <div class="col">
    <h2>
      <strong>Author's name</strong>
    </h2>
  </div>
  <div class="col">
    <h2>
      <strong>Publication date</strong>
    </h2>
  </div>
</div>

<div class="row text-center m-5">
  <div title="{{$info->title_link}}" class="col" style="width: 20%">
    <a class="nounderline" style="color:inherit;" href="{{ url('news/'.$info->news_id) }}">
      <h4 style="width: 90%; text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">
        {{$info->title_link}}</h4>
    </a>
  </div>
  @if($isReportedComment)
  <div title="{{$info->text}}" class="col" style="width: 20%">
      <h4 style="width: 90%; text-overflow: ellipsis; white-space: nowrap; overflow: hidden;"
      >{{$info->text}}</h4>
  </div>
  @endif
  <div class="col" style="width: 20%">
    <a class="nounderline" style="color:inherit;" href="{{ url('users/'.$info->username) }}">
      <h4>{{$info->username}}</h4>
    </a>
  </div>
  <div class="col" style="width: 20%">
    <h4>{{ date("F jS, Y \a\\t H:i", strtotime($info->date)) }}</h4>
  </div>
</div>

<div class="row m-5">
  <div class="col">
    <div class="row">
      <div class="col">
        <h4 class="mb-3">
          <strong>Reasons:</strong>
        </h4>
        <ul class="list-group mb-3">
          @foreach ($reasons as $reason)
          <li class="ml-3 w-50 d-flex justify-content-between align-items-center">
            <h5>{{$reason->reason}}</h5>
            <h5>
              <span class="badge">{{$reason->number}}</span>
            </h5>
          </li>
          @endforeach
        </ul>
      </div>
    </div>
    <div class="row">

      <div class="col">
        <h4 class="mb-3">
          <strong>Descriptions:</strong>
        </h4>
        <ul>
          @foreach ($descriptions as $description)
          <li>
            <h5>{{$description->description}}</h5>
          </li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
  <div class="col">
    @include('partials.comment_mod', ['comments'=>$comments,'route_mod_comment'=>$route_mod_comment])
  </div>
</div>