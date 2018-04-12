@extends('layouts.app')

<!-- <h1>HELLO WORLD!! IS IT ME???</h1> -->
@section('title', "HELLO WORLD!!")
@section('text_editor')

<script src="{{asset('js/tinymce/js/tinymce/jquery.tinymce.min.js')}}"></script>
<script src="{{asset('js/tinymce/js/tinymce/tinymce.min.js')}}"></script>

@endsection
@section('content')
  @include('partials.create_news')
@endsection