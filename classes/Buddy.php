<?php
  include_once(__DIR__."/Db.php");

  class Buddy{
    private $userId;
    private $buddyId;
    private $requestAccepted;
    private $reasonDenial;

    /**
     * Get the value of userId
     */ 
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set the value of userId
     *
     * @return  self
     */ 
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get the value of buddyId
     */ 
    public function getBuddyId()
    {
        return $this->buddyId;
    }

    /**
     * Set the value of buddyId
     *
     * @return  self
     */ 
    public function setBuddyId($buddyId)
    {
        $this->buddyId = $buddyId;

        return $this;
    }

    /**
     * Get the value of requestAccepted
     */ 
    public function getRequestAccepted()
    {
        return $this->requestAccepted;
    }

    /**
     * Set the value of requestAccepted
     *
     * @return  self
     */ 
    public function setRequestAccepted($requestAccepted)
    {
        $this->requestAccepted = $requestAccepted;

        return $this;
    }

    /**
     * Get the value of requestDenied
     */ 
    public function getRequestDenied()
    {
        return $this->requestDenied;
    }

    /**
     * Set the value of requestDenied
     *
     * @return  self
     */ 
    public function setRequestDenied($requestDenied)
    {
        $this->requestDenied = $requestDenied;

        return $this;
    }

    /**
     * Get the value of reasonDenied
     */ 
    public function getReasonDenial()
    {
        return $this->reasonDenial;
    }

    /**
     * Set the value of reasonDenied
     *
     * @return  self
     */ 
    public function setReasonDenial($reasonDenial)
    {
        $this->reasonDenied = $reasonDenial;

        return $this;
    }

    public function getAllBuddies($userId){
      $conn = Db::getConnection();
      $statement = $conn->prepare("select * from buddys where userId = :userId or buddyId = :userId and activeMatch=1");
      $statement->bindValue(":userId", $userId);
      $statement->execute();
      
      $buddys = $statement->fetchAll(PDO::FETCH_OBJ);
      return $buddys;
    }

    public function buddyExist($userId, $buddyId){
      $conn = Db::getConnection();
      $result = $conn->query("select userId, buddyId from buddys where activeMatch=1 and ((userId = :userId and buddyId = :buddyId) or (userId = :buddyId and buddyId = :userId))");
      $result->bindValue(":userId", $userId);
      $result->bindValue(":buddyId", $buddyId);

      if($result->fetchColumn() > 0){
        return true;
      }else{
        return false;
      }
    }

    public function cancelRequest($userId, $buddyId){
      $conn = Db::getConnection();
      $statement = $conn->prepare("update buddys set activeMatch = 0 where userId = :userId and buddyId = :buddyId");
      
      $statement->bindValue(":userId", $userId);
      $statement->bindValue(":buddyId", $buddyId);
      
      $result = $statement->execute();
      return $result;
    }

    public function save(){
      $conn = Db::getConnection();
      $statement = $conn->prepare("insert into buddys (userId, buddyId, activeMatch) values (:userId, :buddyId, 1)");
      $userId = $this->getUserId();
      $buddyId = $this->getBuddyId();

      $statement->bindValue(":userId", $userId);
      $statement->bindValue(":buddyId", $buddyId);

      $result = $statement->execute();

      return $result;
    }

    /* Replaced by Madina */

    //function 11 - MAURY MASSA     

    public function requestAccepted()
    {
      //connectie maken met Tabel buddys
      $conn = Db::getConnection();
      //update tbl met incoming requests
      //query upate uitvoeren in de tabel buddy
      $statement = $conn->prepare("update buddys SET requestAccepted = :requestAccepted, reasonDenied = :reasonDenial, activeMatch = :requestAccepted where (userId = :buddyId AND buddyId = :userId) AND activeMatch = 1"); 
      $requestAccepted = $this->getRequestAccepted();               
      $reasonDenial = $this->getReasonDenial();
      $buddyId = $this->getBuddyId();
      $userId = $this->getUserId();  
      //waardes toekennen
      $statement->bindValue(":requestAccepted", $requestAccepted);
      $statement->bindValue(":reasonDenial", $reasonDenial);
      $statement->bindValue(":buddyId", $buddyId);
      $statement->bindValue(":userId", $userId);

      $result = $statement->execute();

      return $result;
    }

    public static function showcaseMatches($userId){
      $conn = Db::getConnection();
      $statement = $conn->prepare("select * from buddys where (requestAccepted = 0 AND buddyId = :userId AND activeMatch = 1 )");
      $statement->bindValue(":userId", $userId);
      $statement->execute();

      $allMatches = $statement->fetchAll(PDO::FETCH_ASSOC);

      return $allMatches;
    }


    //function 12 - Maury Massa
    public function activeMatches($userId){
      $conn = Db::getConnection();
      $statement = $conn->prepare("select * from buddys where (requestAccepted = 1 AND buddyId = '$userId' AND activeMatch = 1 )");
      $statement->execute();

      $allMatches = $statement->fetchAll(PDO::FETCH_ASSOC);

      return $allMatches;
    } 

    /* End replaced by Madina */
  }