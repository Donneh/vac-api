@extends('layouts.app')

@section('content')

  <table>
    @foreach($subjects as $subject)
      <tr>
        <td>{{ $subject->name }}</td>
        <td>{{ $subject->title }}</td>
      </tr>
    @endforeach
  </table>
@endsection
