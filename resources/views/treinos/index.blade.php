@extends('layouts.app')

@section('content')
    <div class="flex justify-between mb-6">
        <h2 class="text-xl font-bold">🏋️ Treinos</h2>
        <a href="{{ route('treinos.create') }}" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">+ Novo Treino</a>
    </div>

    <table class="w-full bg-white shadow-md rounded">
        <thead class="bg-red-600 text-white">
            <tr>
                <th class="p-3 text-left">Aluno</th>
                <th class="p-3 text-left">Tipo</th>
                <th class="p-3 text-left">Séries</th>
                <th class="p-3 text-left">Repetições</th>
            </tr>
        </thead>
        <tbody>
            @foreach($treinos as $treino)
            <tr class="border-b hover:bg-gray-50">
                <td class="p-3">{{ $treino->aluno->nome }}</td>
                <td class="p-3">{{ $treino->tipo_treino }}</td>
                <td class="p-3">{{ $treino->series }}</td>
                <td class="p-3">{{ $treino->repeticoes }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
