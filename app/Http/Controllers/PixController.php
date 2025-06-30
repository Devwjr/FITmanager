<?php

namespace App\Http\Controllers;

use App\Helpers\PixHelper;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;

class PixController extends Controller
{
    public function gerarPix()
    {
        $chave = '098.787.646-56'; //Substituir pela sua chave Pix
        $nome = 'FITMANAGER';
        $cidade = 'juiz de fora';
        $valor = 150.00; 
        $infoAdicional = 'Mensalidade';

        $payload = PixHelper::gerarPayloadPix($chave, $nome, $cidade, $valor, $infoAdicional);

        $options = new QROptions([
            'outputType' => QRCode::OUTPUT_IMAGE_PNG,
            'eccLevel' => QRCode::ECC_L,
            'scale' => 6,
        ]);

        $qrcode = (new QRCode($options))->render($payload);

   return view('pagamentos.pixmanual', compact('qrcode', 'payload'));
    }
}
