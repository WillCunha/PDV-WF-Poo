<?php

namespace App\Entity;

class Eventos{

    /**
     * ID do evento
     * @var string id
     */
      public $id;

    /**
     * Nome do evento
     * @var string titulo
     */
      public $titulo;

     /**
      * Data do evento
      * @var string data
      */
      public $data;

      /**
       * Solicita à API da WF os eventos com data atual
       */
      static public function getEventoData(){
            date_default_timezone_set('America/Sao_Paulo');
            $data = date('d/m/Y', time());
            $ch = 'http://localhost/EmissorIngressos/api/eventos/evento-data/';
            $apiKey = $data;
            $curl = curl_init($ch.$apiKey);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, True);
            $return = curl_exec($curl);
            curl_close($curl);
            $resposta = json_decode($return, true); 
            return $resposta;
      }

}