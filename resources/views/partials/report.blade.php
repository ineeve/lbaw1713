<div class="row text-center">
<div class="col">{{$info->title}}
</div>
<div class="col">{{$info->username}}
</div>
<div class="col">{{$info->date}}
</div>
</div>

<div class="row">
<div class="col">
<div class="row"><div class="col">
<p>Reasons:</p>
    <ul>
    @foreach ($reasons as $reason)
    <li>{{$reason->reason}} {{$reason->number}}</li>
    @endforeach
    </ul>
</div>
</div>
<div class="row">

<div class="col">
    <p>Descriptions:</p>
    <ul>
    @foreach ($descriptions as $description)
    <li>{{$description->description}}</li>
    @endforeach
    </ul>
</div></div>
</div>
<div class="col">
    @include('partials.comment_mod', $comments)
</div>
</div>