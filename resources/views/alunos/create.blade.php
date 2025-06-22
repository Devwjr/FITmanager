@extends('layouts.app')

@section('content')
    <h2 class="text-xl font-semibold mb-4"> Novo Aluno</h2>

    <form action="{{ route('alunos.store') }}" method="POST" class="bg-white p-6 rounded shadow-md space-y-4">
        @csrf

        <div>
            <label class="block text-sm font-medium">Nome:</label>
            <input type="text" name="nome" class="w-full border p-2 rounded" required>
        </div>

        <div>
            <label class="block text-sm font-medium">Email:</label>
            <input type="email" name="email" class="w-full border p-2 rounded" required>
        </div>

        <div>
            <label class="block text-sm font-medium">Peso (kg):</label>
            <input type="number" step="0.1" name="peso" class="w-full border p-2 rounded">
        </div>

        <div>
            <label class="block text-sm font-medium">Altura (m):</label>
            <input type="number" step="0.01" name="altura" class="w-full border p-2 rounded">
        </div>

        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
            Salvar Aluno
        </button>
    </form>
@endsection
