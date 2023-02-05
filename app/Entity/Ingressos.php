<?php

namespace App\Entity;


class Ingressos{

    /**
     * Informa o ID do evento
     * @var string id
     */
    public $id;

    /**
     * Informa o ID dos ingressos
     * @var string ingresso_id
     */
    public $ingresso_id;

    /**
     * Informa o nome do Ingresso
     * @var string nome
     */
     public $nome;

     /**
      * Informa a quantidade de ingressos disponíveis no banco
      * @var string quantidade
      */
      public $quantidade;

      /**
       * Informa o valor unitário dos ingresso
       * @var string valor
       */
      public $valor;

      static public function buscaIngressos($id){
        
        $ch = 'http://localhost/EmissorIngressos/api/eventos/ingressos/';
        $apiKey = $id;
        $curl = curl_init($ch.$apiKey);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, True);
        $return = curl_exec($curl);
        curl_close($curl);
        $resposta = json_decode($return, true); 

        
        return $resposta;
      }

      
}

?>