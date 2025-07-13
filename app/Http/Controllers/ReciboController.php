<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pagamento;
use PDF;
use Mail;

class ReciboController extends Controller
{
    public function gerar($id)
    {
        $pagamento = Pagamento::findOrFail($id);

        $pdf = PDF::loadView('recibos.pdf', compact('pagamento'));

        // Enviar por e-mail
        Mail::send([], [], function ($message) use ($pagamento, $pdf) {
            $message->to($pagamento->email)
                ->subject('Recibo de Pagamento')
                ->setBody('Segue em anexo seu recibo.', 'text/html')
                ->attachData($pdf->output(), 'recibo.pdf');
        });

        return $pdf->download('recibo.pdf');
    }
}
