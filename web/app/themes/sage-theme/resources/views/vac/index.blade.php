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
  <form method="POST" action="/vac/subject" class="mb-1">
    <input type="text" name="subject" placeholder="Zoek op onderwerp" class="placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow" >
    <button class="bg-emerald-600 px-4 py-2 text-white rounded" type="submit">Zoek</button>
  </form>  <table class="border-collapse border border-slate-400">
    <thead class="bg-slate-200">
      <tr>
        <th class="border border-slate-300">id</th>
        <th class="border border-slate-300">Vraag</th>
        <th class="border border-slate-300">Antwoord</th>
        <th class="border border-slate-300">Link</th>
      </tr>
    </thead>
    <tbody>
      @foreach($questions as $question)
        <tr>
          <td class="border p-2 border-slate-300">
            <a href="/questions/{{ $question['id'] }}">
              {{ $question['id'] }}
            </a>
          </td>
          <td class="border p-2 border-slate-300">{{ $question['question'] }}</td>
          <td class="border p-2 border-slate-300">Antwoord??</td>
          <td class="border p-2 border-slate-300">
            <a href="{{ $question['canonical'] }}" class="font-medium text-blue-600 hover:underline">
              Link naar Artikel
            </a>
          </td>

        </tr>
      @endforeach
    </tbody>
  </table>
{{--  <div class="flex gap-2 mt-2">--}}
{{--    <form method="GET">--}}
{{--      <input type="hidden" name="page" value="{{ $page > 0 ? $page -1 : 0 }}">--}}
{{--      <button type="submit" class="bg-emerald-600 p-2 text-white">Terug</button>--}}
{{--    </form>--}}
{{--    <form method="GET">--}}
{{--      <input type="hidden" name="page" value="{{ $page + 1 }}">--}}
{{--      <button type="submit" class="bg-emerald-600 p-2 text-white">Volgende</button>--}}
{{--    </form>--}}
{{--  </div>--}}
@endsection
