<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pagamento;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;

class PagamentoController extends Controller
{
    public function gerarPix($id)
    {
        $pagamento = Pagamento::findOrFail($id);
        $payload = "chavepix|{$pagamento->valor}|FITManagerAcademia";

        $options = new QROptions(['outputType' => QRCode::OUTPUT_MARKUP_SVG]);
        $qrCode = (new QRCode($options))->render($payload);

        return view('pagamentos.pix', compact('pagamento', 'qrCode'));
    }

    public function confirmar(Request $request, $id)
    {
        $pagamento = Pagamento::findOrFail($id);
        $pagamento->status = 'pago';
        $pagamento->data_pagamento = now();
        $pagamento->save();

        return redirect()->back()->with('success', 'Pagamento confirmado!');
    }
}
