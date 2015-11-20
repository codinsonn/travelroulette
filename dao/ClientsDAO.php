<?php

require_once WWW_ROOT . 'classes' . DIRECTORY_SEPARATOR . 'DatabasePDO.php';

class ClientsDAO
{
    public $pdo;

    public function __construct()
    {
        $this->pdo = DatabasePDO::getInstance();
    }

    public function getClientById($client_id){
        $sql = "SELECT * FROM `tr_clients`
                WHERE id = :client_id";
        $qry = $this->pdo->prepare($sql);
        $qry -> bindValue(':client_id', $client_id);

        if($qry -> execute()){
            $client = $qry -> fetch(PDO::FETCH_ASSOC);
            if(!empty($client)){
                return $client;
            }
        }
        return array();
    }

    public function insertClient($fullname, $email, $subscribed){
        $sql = "INSERT INTO tr_clients(fullname, email, subscribed, join_date)
                VALUES(:fullname, :email, :subscribed, :join_date)";
        $qry = $this->pdo->prepare($sql);
        $qry -> bindValue(':fullname', htmlentities(strip_tags($fullname)));
        $qry -> bindValue(':email', htmlentities(strip_tags($email)));
        $qry -> bindValue(':subscribed', $subscribed);
        $qry -> bindValue(':join_date', date("Y-m-d"));

        if($qry->execute()){
            return $this -> getClientById($this->pdo->lastInsertId());
        }
        return array();
    }

}