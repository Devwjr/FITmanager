@extends('layouts.app')

@section('content')
<h1>Pagamento via Pix</h1>
<p>Valor: R$ {{ number_format($pagamento->valor, 2, ',', '.') }}</p>
{!! $qrCode !!}

<form method="POST" action="{{ route('pagamentos.confirmar', $pagamento->id) }}">
    @csrf
    <button type="submit" class="btn btn-success">Confirmar Pagamento (simulação)</button>
</form>
@endsection
