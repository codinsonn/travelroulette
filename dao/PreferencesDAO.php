<?php

require_once WWW_ROOT . 'classes' . DIRECTORY_SEPARATOR . 'DatabasePDO.php';

class PreferencesDAO
{
    public $pdo;

    public function __construct()
    {
        $this->pdo = DatabasePDO::getInstance();
    }

    public function getTravelStyles(){
    	$sql = "SELECT * 
                FROM `tr_travelstyles`";
    	$qry = $this->pdo->prepare($sql);

    	if($qry -> execute()){
    		$travelstyles = $qry -> fetchAll(PDO::FETCH_ASSOC);
    		if(!empty($travelstyles)){
    			return $travelstyles;
    		}
    	}
    	return array();
    }

    public function getInterests(){
        $sql = "SELECT * 
                FROM `tr_interests`";
        $qry = $this->pdo->prepare($sql);

        if($qry -> execute()){
            $interests = $qry -> fetchAll(PDO::FETCH_ASSOC);
            if(!empty($interests)){
                return $interests;
            }
        }
        return array();
    }

    public function getLocales(){
        $sql = "SELECT * 
                FROM `tr_locales`";
        $qry = $this->pdo->prepare($sql);

        if($qry -> execute()){
            $locales = $qry -> fetchAll(PDO::FETCH_ASSOC);
            if(!empty($locales)){
                return $locales;
            }
        }
        return array();
    }

    public function insertClientTravelstyles($client_id, $travelstyles){

        foreach($travelstyles as $travelstyle_id){
            $this->insertClientTravelstyle($client_id, $travelstyle_id);
        }

    }

    public function insertClientTravelstyle($client_id, $travelstyle_id){
        $sql = "INSERT INTO tr_client_travelstyles(client_id, travelstyle_id)
                VALUES(:client_id, :travelstyle_id)";
        $qry = $this->pdo->prepare($sql);
        $qry -> bindValue(':client_id', $client_id);
        $qry -> bindValue(':travelstyle_id', $travelstyle_id);

        if($qry->execute()){
            return $this->pdo->lastInsertId();
        }
        return array();
    }

    public function insertClientInterests($client_id, $interests){

        foreach($interests as $interest_id){
            $this->insertClientInterest($client_id, $interest_id);
        }

    }

    public function insertClientInterest($client_id, $interest_id){
        $sql = "INSERT INTO tr_client_interests(client_id, interest_id)
                VALUES(:client_id, :interest_id)";
        $qry = $this->pdo->prepare($sql);
        $qry -> bindValue(':client_id', $client_id);
        $qry -> bindValue(':interest_id', $interest_id);

        if($qry->execute()){
            return $this->pdo->lastInsertId();
        }
        return array();
    }

    public function insertClientLocales($client_id, $locales){

        foreach($locales as $locale_id){
            $this->insertClientLocale($client_id, $locale_id);
        }

    }

    public function insertClientLocale($client_id, $locale_id){
        $sql = "INSERT INTO tr_client_locales(client_id, locale_id)
                VALUES(:client_id, :locale_id)";
        $qry = $this->pdo->prepare($sql);
        $qry -> bindValue(':client_id', $client_id);
        $qry -> bindValue(':locale_id', $locale_id);

        if($qry->execute()){
            return $this->pdo->lastInsertId();
        }
        return array();
    }

}