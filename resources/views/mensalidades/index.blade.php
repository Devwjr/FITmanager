@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Mensalidades</h2>

    @foreach($mensalidades as $m)
        <div class="card mb-3 p-3">
            <p><strong>Aluno:</strong> {{ $m->user->name }}</p>
            <p><strong>Valor:</strong> R$ {{ number_format($m->valor, 2, ',', '.') }}</p>
            <p><strong>Vencimento:</strong> {{ \Carbon\Carbon::parse($m->vencimento)->format('d/m/Y') }}</p>
            <p><strong>Status:</strong> {{ ucfirst($m->status) }}</p>

            @if($m->status !== 'pago')
                <form method="POST" action="{{ route('mensalidades.pagar', $m) }}">
                    @csrf
                    <button class="btn btn-success">Marcar como Paga</button>
                </form>
            @endif
        </div>
    @endforeach
</div>
@endsection
