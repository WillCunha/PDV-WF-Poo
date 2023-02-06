<?php

namespace App\DB;

use PDO;
use PDOException;
use PDOStatement;

class Database
{

    /**
     * DEFINE O HOST DO BANCO
     * @var string
     */
    const HOST = 'localhost';

    /**
     * DEFINE O NOME DO BANCO
     * @var string
     */
    const NAME = 'wfpdv';

    /**
     * DEFINE O USER DO BANCO
     * @var string
     */
    const USER = 'root';

    /**
     * DEFINE A SENHA DO BANCO
     * @var string
     */
    const PASS = '';

    /**
     * DEFINE A TABELA DO BANCO
     * @var string
     */
    private $table;

    /**
     * INSTANCIA O PDO
     * @var PDO
     */
    private $connection;


    /**
     * Define a tabela para a conexão
     * @param string $table
     */
    public function __construct($table = null)
    {
        $this->table = $table;
        $this->setConnection();
    }

    /**
     * Seta a conexão com o banco de dados
     */
    public function setConnection(){
        try {
            $this->connection = new PDO('mysql:host='.self::HOST.';dbname='.self::NAME,self::USER,self::PASS);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('ERROR: ' + $e->getMessage());
        }
    }


    /**
     * Executa a query
     * @param string $query
     * @param array $params
     * @return PDOStatement
     */
    public function execute($query, $params = []){
        try {
            $statement = $this->connection->prepare($query);
            $statement->execute($params);

            return $statement;
        } catch (PDOException $e) {
            die('ERROR EXECUTE: ' + $e->getMessage());
        }

    }


    /**
     * Método que persiste as informações para o BD;
     * @param array $values[ field => value ];
     * @return int $id
     */
    public function insert($values){
        
        $campos = array_keys($values);
        $binds = array_pad([], count($campos), '?');

        $query = 'INSERT INTO '.$this->table.' ('.implode(',', $campos).') VALUES ('.implode(',', $binds).')';

        $this->execute($query, array_values($values));

        return $this->connection->lastInsertId();

    }

    /**
     * Metodo que faz a busca dos dados no banco
     * @param string $where
     * @param string $limit
     * @param string $order
     * @return PDOStatement
     */
    public function select($where = null, $limit = null, $order = null, $field = "*"){
        //Verifica se os condicionais estão preenchidos - caso estejam, insere na query
        $where = strlen($where) ? 'WHERE ' .$where : '';
        $limit = strlen($limit) ? 'LIMIT ' .$limit : '';
        $order = strlen($order) ? 'ORDER ' .$order : '';

        //Monta a query
        $query = 'SELECT * FROM '.$this->table. ' ' .$where. ' ' .$limit. ' ' .$order;

        //Executa a query
        return $this->execute($query);        
    }

    /**
     * Método que faz soma de colunas no banco de dados
     * @param string $where
     * @param string $column
     * @return PDOStatement
     */

     public function selectSum($where = null, $column = null){
        //Verifica se o condicional "where" está preenchido, caso esteja, insere na query
        $where = strlen($where) ? 'WHERE ' .$where : '';

        //Monta a query
        $query = 'SELECT SUM('.$column.') AS '.$column.' FROM '.$this->table. ' ' .$where;

        return $this->execute($query);
     }

    /**
     * Metodo responsável pelo atualização das informações de um evento no banco
     * @param string $where
     * @param array $values
     * @return boolean
     */
    public function update($where, $values){

        $fields = array_keys($values);
        
        $query = 'UPDATE '.$this->table.' SET ' .implode('=?, ', $fields). '=? WHERE '.$where;
        
        $this->execute($query, array_values($values));

        return true;

    }
}
