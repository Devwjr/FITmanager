@extends('layouts.app')

@section('content')
    <div class="flex justify-between mb-6">
        <h2 class="text-xl font-bold">📈 Evoluções</h2>
        <a href="{{ route('evolucoes.create') }}" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">+ Nova Evolução</a>
    </div>

    <table class="w-full bg-white shadow-md rounded">
        <thead class="bg-red-600 text-white">
            <tr>
                <th class="p-3 text-left">Aluno</th>
                <th class="p-3 text-left">Peso (kg)</th>
                <th class="p-3 text-left">Medidas</th>
            </tr>
        </thead>
        <tbody>
            @foreach($evolucoes as $evo)
            <tr class="border-b hover:bg-gray-50">
                <td class="p-3">{{ $evo->aluno->nome }}</td>
                <td class="p-3">{{ $evo->peso ?? '-' }}</td>
                <td class="p-3">{{ $evo->medidas ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
