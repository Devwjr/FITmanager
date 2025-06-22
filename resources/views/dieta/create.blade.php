@extends('layouts.app')

@section('content')
    <h2 class="text-xl font-semibold mb-4">➕ Nova Dieta</h2>

    <form action="{{ route('dietas.store') }}" method="POST" class="bg-white p-6 rounded shadow-md space-y-4">
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
            <label class="block text-sm font-medium">Tipo de Dieta:</label>
            <input type="text" name="tipo_dieta" class="w-full border p-2 rounded" required>
        </div>

        <div>
            <label class="block text-sm font-medium">Calorias:</label>
            <input type="number" name="calorias" class="w-full border p-2 rounded">
        </div>

        <div>
            <label class="block text-sm font-medium">Refeições:</label>
            <input type="text" name="refeicoes" class="w-full border p-2 rounded">
        </div>

        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
            Salvar Dieta
        </button>
    </form>
@endsection
