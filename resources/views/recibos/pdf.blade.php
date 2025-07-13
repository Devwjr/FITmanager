<h1>Recibo de Pagamento</h1>
<p>Nome: {{ $pagamento->nome }}</p>
<p>Valor: R$ {{ number_format($pagamento->valor, 2, ',', '.') }}</p>
<p>Data: {{ \Carbon\Carbon::parse($pagamento->data_pagamento)->format('d/m/Y') }}</p>
