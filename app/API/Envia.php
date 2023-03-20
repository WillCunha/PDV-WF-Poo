<?php

namespace App\API;

class Envia
{


    public function enviaCentral($values)
    {
        $url = "http://localhost/EmissorIngressos/api/eventos/informaEvento/";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $values);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $executa = curl_exec($ch);
        curl_close($ch);
        $resposta = json_decode($executa);
        return $resposta;
    }
}
