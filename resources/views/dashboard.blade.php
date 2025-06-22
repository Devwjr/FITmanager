@extends('layouts.app')

@section('content')
<div class="p-6 bg-white rounded-lg shadow dark:bg-gray-800">
    <h2 class="text-xl font-bold text-gray-800 dark:text-white mb-4">Resumo Financeiro</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-red-100 text-red-800 dark:bg-red-200 p-4 rounded">
            <p class="font-semibold">Pendentes:</p>
            <p class="text-2xl">{{ $pendentes }} R$</p>
        </div>
        <div class="bg-green-100 text-green-800 dark:bg-green-200 p-4 rounded">
            <p class="font-semibold">Pagos:</p>
            <p class="text-2xl">{{ $pagos }} R$</p>
        </div>
        <div class="bg-yellow-100 text-yellow-800 dark:bg-yellow-200 p-4 rounded">
            <p class="font-semibold">Atrasados:</p>
            <p class="text-2xl">{{ $atrasados }} R$</p>
        </div>
    </div>
</div>
@endsection
