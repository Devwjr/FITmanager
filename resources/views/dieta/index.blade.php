@extends('layouts.app')

@section('content')
    <div class="flex justify-between mb-6">
        <h2 class="text-xl font-bold">🥗 Dietas</h2>
        <a href="{{ route('dietas.create') }}" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">+ Nova Dieta</a>
    </div>

    <table class="w-full bg-white shadow-md rounded">
        <thead class="bg-red-600 text-white">
            <tr>
                <th class="p-3 text-left">Aluno</th>
                <th class="p-3 text-left">Tipo</th>
                <th class="p-3 text-left">Calorias</th>
                <th class="p-3 text-left">Refeições</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dietas as $dieta)
            <tr class="border-b hover:bg-gray-50">
                <td class="p-3">{{ $dieta->aluno->nome }}</td>
                <td class="p-3">{{ $dieta->tipo_dieta }}</td>
                <td class="p-3">{{ $dieta->calorias ?? '-' }}</td>
                <td class="p-3">{{ $dieta->refeicoes ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
