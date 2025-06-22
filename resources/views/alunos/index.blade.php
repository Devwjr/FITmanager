@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-semibold">Lista de Alunos</h2>
        <a href="{{ route('alunos.create') }}" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">+ Novo Aluno</a>
    </div>

    <table class="w-full bg-white shadow-md rounded">
        <thead class="bg-red-600 text-white">
            <tr>
                <th class="p-3 text-left">Nome</th>
                <th class="p-3 text-left">Email</th>
                <th class="p-3 text-left">Peso</th>
                <th class="p-3 text-left">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($alunos as $aluno)
            <tr class="border-b hover:bg-gray-50">
                <td class="p-3">{{ $aluno->nome }}</td>
                <td class="p-3">{{ $aluno->email }}</td>
                <td class="p-3">{{ $aluno->peso ?? '-' }} kg</td>
                <td class="p-3 space-x-2">
                    <a href="#" class="text-blue-600 hover:underline">Ver</a>
                    <a href="#" class="text-yellow-600 hover:underline">Editar</a>
                    <a href="#" class="text-red-600 hover:underline">Excluir</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
