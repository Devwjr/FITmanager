@extends('layouts.app')

@section('content')
    <h2 class="text-xl font-semibold mb-4">➕ Novo Treino</h2>

    <form action="{{ route('treinos.store') }}" method="POST" class="bg-white p-6 rounded shadow-md space-y-4">
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
            <label class="block text-sm font-medium">Tipo de Treino:</label>
            <input type="text" name="tipo_treino" class="w-full border p-2 rounded" required>
        </div>

        <div>
            <label class="block text-sm font-medium">Séries:</label>
            <input type="text" name="series" class="w-full border p-2 rounded">
        </div>

        <div>
            <label class="block text-sm font-medium">Repetições:</label>
            <input type="text" name="repeticoes" class="w-full border p-2 rounded">
        </div>

        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
            Salvar Treino
        </button>
    </form>
@endsection
