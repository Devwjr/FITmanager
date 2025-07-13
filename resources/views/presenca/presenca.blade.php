@extends('layouts.app')

@section('content')
<h1>Histórico de Presença</h1>
<table class="table">
    <thead>
        <tr>
            <th>Data</th>
            <th>Entrada</th>
            <th>Saída</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($presencas as $p)
        <tr>
            <td>{{ \Carbon\Carbon::parse($p->data)->format('d/m/Y') }}</td>
            <td>{{ $p->hora_entrada }}</td>
            <td>{{ $p->hora_saida }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
