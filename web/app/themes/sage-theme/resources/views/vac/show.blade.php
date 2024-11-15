@extends('layouts.app')

@section('content')

  <h1 class="text-xl font-bold">{{ $question->question }}</h1>

  @foreach($question->content as $paragraph)
    <h2 class="text-lg font-semibold">{{ $paragraph->paragraphtitle }}</h2>
    <p>{!! $paragraph->paragraph !!} </p>
  @endforeach
@endsection
