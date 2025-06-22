@extends('layouts.app')

@section('content')
    <h2 class="text-xl font-semibold mb-4">➕ Nova Evolução</h2>

    <form action="{{ route('evolucoes.store') }}" method="POST" class="bg-white p-6 rounded shadow-md space-y-4">
        @csrf

        <div>
            <label class="block text-sm font-medium">Aluno:</label>
            <select name="aluno_id" class="w-full border p-2 rounded" required>
                @foreach($alunos as $aluno)
                    <option value="{{ $aluno->id }}">{{ $aluno->nome }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium">Peso (kg):</label>
            <input type="number" step="0.01" name="peso" class="w-full border p-2 rounded">
        </div>

        <div>
            <label class="block text-sm font-medium">Medidas:</label>
            <input type="text" name="medidas" class="w-full border p-2 rounded">
        </div>

        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
            Salvar Evolução
        </button>
    </form>
@endsection
