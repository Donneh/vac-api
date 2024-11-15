@extends('layouts.app')

@section('content')

  <table>
    @foreach($ministries as $ministry)
      <tr>
        <td>{{ $ministry->name }}</td>
        <td>{{ $ministry->title }}</td>
      </tr>
    @endforeach
  </table>
@endsection
