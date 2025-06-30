<?php

namespace App\Helpers;

class PixHelper
{
    public static function gerarPayloadPix($chave, $nome, $cidade, $valor, $infoAdicional = '')
    {
        $merchantAccountInfo = "0014br.gov.bcb.pix01" . strlen($chave) . $chave;
        $merchantCategoryCode = "52040000";
        $transactionCurrency = "5303986";
        $transactionAmount = $valor ? "540" . strlen(number_format($valor, 2, '.', '')) . number_format($valor, 2, '.', '') : '';
        $countryCode = "5802BR";
        $merchantName = "59" . strlen($nome) . $nome;
        $merchantCity = "60" . strlen($cidade) . $cidade;
        $additionalDataField = $infoAdicional ? "62" . strlen($infoAdicional) . $infoAdicional : '';

        $payloadSemCRC = "000201"
            . $merchantAccountInfo
            . $merchantCategoryCode
            . $transactionCurrency
            . $transactionAmount
            . $countryCode
            . $merchantName
            . $merchantCity
            . $additionalDataField
            . "6304";

        $crc16 = self::crcChecksum($payloadSemCRC);
        return $payloadSemCRC . $crc16;
    }

    private static function crcChecksum($str)
    {
        $polynomial = 0x1021;
        $crc = 0xFFFF;

        for ($i = 0; $i < strlen($str); $i++) {
            $crc ^= ord($str[$i]) << 8;
            for ($j = 0; $j < 8; $j++) {
                if (($crc & 0x8000) != 0) {
                    $crc = ($crc << 1) ^ $polynomial;
                } else {
                    $crc = ($crc << 1);
                }
            }
        }

        return strtoupper(substr("0000" . dechex($crc & 0xFFFF), -4));
    }
}
