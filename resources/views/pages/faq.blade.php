@extends('layouts.app')
@section('content')
<div id="accordion" class="pb-3 col">
<h1>FAQs -  Frequently Asked Questions</h1>
@foreach ($faq as $f)
    <div class="card mb-1">
      <div class="card-header" id="heading{{$f->id}}">
        <h5 class="mb-0">
          <button class="btn btn-link" data-toggle="collapse" data-target="#collapse{{$f->id}}" aria-expanded="false" aria-controls="collapseOne">
            {{$f->question}}
          </button>
        </h5>
      </div>
      <div id="collapse{{$f->id}}" class="collapse" aria-labelledby="heading{{$f->id}}" data-parent="#accordion">
        <div class="card-body">
        {{$f->answer}}
        </div>
      </div>
    </div>
 
  @endforeach
  </div>
@endsection