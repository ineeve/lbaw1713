<div class="row text-center m-5">
<div class="col">
<h3>{{$info->title}}</h3>
</div>
<div class="col">
<h4>{{$info->username}}</h4>
</div>
<div class="col"><h5>{{ date("F jS, Y \a\\t H:i", strtotime($info->date)) }}</h5>
</div>
</div>

<div class="row m-5">
<div class="col">
<div class="row"><div class="col">
<p class="font-weight-bold" >Reasons:</p>
<ul class="list-group">
@foreach ($reasons as $reason)    
  <li class="list-group-item d-flex justify-content-between align-items-center">
  {{$reason->reason}}
    <span class="badge ">{{$reason->number}}</span>
  </li>
  @endforeach
</ul>
</div>
</div>
<div class="row">

<div class="col">
    <p class="font-weight-bold" >Descriptions:</p>
    <ul>
    @foreach ($descriptions as $description)
    <li>{{$description->description}}</li>
    @endforeach
    </ul>
</div></div>
</div>
<div class="col">
    @include('partials.comment_mod', ['comments'=>$comments,'route_mod_comment'=>$route_mod_comment])
</div>
</div>