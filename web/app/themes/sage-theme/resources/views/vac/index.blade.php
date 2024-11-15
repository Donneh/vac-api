@extends('layouts.app')

@section('content')
  <h1 class="text-xl font-semibold mb-4">Veelgestelde vragen</h1>

  <form method="POST" action="/questions/ministry" class="mb-1">
    <select name="ministry" id="ministry">
      <option selected disabled>Maak keuze</option>
      @foreach($ministries as $ministry)
        <option value="{{ $ministry->name }}">{{ $ministry->title }}</option>
      @endforeach
    </select>
    <button class="bg-emerald-600 px-4 py-2 text-white rounded" type="submit">Zoek</button>
  </form>

  <form method="POST" action="/questions/subject" class="mb-1">
    <select name="subject" id="subject">
      <option selected disabled>Maak keuze</option>
      @foreach($subjects as $subject)
        <option value="{{ $subject->name }}">{{ $subject->title }}</option>
      @endforeach
    </select>
    <button class="bg-emerald-600 px-4 py-2 text-white rounded" type="submit">Zoek</button>
  </form>

  <table class="border-collapse border border-slate-400">
    <thead class="bg-slate-200">
      <tr>
        <th class="border border-slate-300">Vraag</th>
        <th class="border border-slate-300">Antwoord</th>
      </tr>
    </thead>
    <tbody>
      @if($questions)
        @foreach($questions as $question)
          <tr>
            <td class="border p-2 border-slate-300">
              <a href="/questions/{{ $question['id'] }}" class="font-medium text-blue-600 hover:underline">
              {{ $question['question'] }}
              </a>
            </td>
            <td class="border p-2 border-slate-300">
              <a href="{{ $question['canonical'] }}" class="font-medium text-blue-600 hover:underline">
                Link naar Artikel
              </a>
            </td>

          </tr>
        @endforeach
      @else
        <td colspan="2">Er zijn geen resultaten gevonden.</td>
      @endif
    </tbody>
  </table>

  <div class="mt-2">
    <form method="GET">
      <input type="hidden" value="{{ request('page') ? request('page') < 1 ? 0 : request('page') - 1 : 0}}" name="page">
      <button class="bg-emerald-600 p-2 text-white">Vorige</button>
    </form>
    <form method="GET">
      <input type="hidden" value="{{ request('page') ? request('page') + 1 : 1 }}" name="page">
      <button class="bg-emerald-600 p-2 text-white">Volgende</button>
    </form>
  </div>
@endsection
