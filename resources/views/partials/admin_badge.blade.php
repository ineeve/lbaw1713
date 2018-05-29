<!-- Input: Badge $badge -->

<div class="card mt-3 mr-3" style="width:16rem;">
  <h3 class="card-header d-flex justify-content-between align-items-center">{{$badge->name}} <i class="fa fa-edit fa-fw float-right" onclick="showBadgeEditForm(this.parentNode.parentNode, {{json_encode($badge)}})"></i></h3>
  <div class="card-body">
    <h5 class="card-title m-0">{{$badge->brief}}</h5>
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item">Votes <span class="float-right">{{$badge->votes}}</span></li>
    <li class="list-group-item">Comments <span class="float-right">{{$badge->comments}}</span></li>
    <li class="list-group-item">News <span class="float-right">{{$badge->articles}}</span></li>
  </ul>
</div>