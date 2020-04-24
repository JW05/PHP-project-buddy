<?php
  include_once(__DIR__."/Db.php");

  class Buddy{
    private $userId;
    private $buddyId;
    private $requestAccepted;
    private $requestDenied;
    private $reasonDenied;

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
    public function getReasonDenied()
    {
        return $this->reasonDenied;
    }

    /**
     * Set the value of reasonDenied
     *
     * @return  self
     */ 
    public function setReasonDenied($reasonDenied)
    {
        $this->reasonDenied = $reasonDenied;

        return $this;
    }

    public function getAllBuddies($userId){
      $conn = Db::getConnection();
      $statement = $conn->prepare("select * from buddys where userId = '$userId' or buddyId = '$userId'");
      $statement->execute();
      
      $buddys = $statement->fetchAll(PDO::FETCH_OBJ);
      return $buddys;
    }

    public function buddyExist($userId, $buddyId){
      $conn = Db::getConnection();
      $result = $conn->query("select userId, buddyId from buddys where (userId = '$userId' and buddyId='$buddyId') or (userId = '$buddyId' and buddyId='$userId')");
      if($result->fetchColumn() > 0){
        return true;
      }else{
        return false;
      }
    }

    public function save(){
      $conn = Db::getConnection();
      $statement = $conn->prepare("insert into buddys (userId, buddyId) values (:userId, :buddyId)");
      $userId = $this->getUserId();
      $buddyId = $this->getBuddyId();

      $statement->bindValue(":userId", $userId);
      $statement->bindValue(":buddyId", $buddyId);

      $result = $statement->execute();

      return $result;
    }

  }