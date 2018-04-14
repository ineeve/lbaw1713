@extends('layouts.app')

@section('content')
  @include('partials.card', ['card' => $card])
@endsection
