<?php
  include_once(__DIR__."/Db.php");

  class LoginAttempt
  {
      private $ipAddress;
      private $email;
      private $timestamp;
      private $isSucceed;

      /**
       * Get the value of ipAddress
       */
      public function getIpAddress()
      {
          return $this->ipAddress;
      }

      /**
       * Set the value of ipAddress
       *
       * @return  self
       */
      public function setIpAddress($ipAddress)
      {
          $this->ipAddress = $ipAddress;

          return $this;
      }

      /**
       * Get the value of email
       */
      public function getEmail()
      {
          return $this->email;
      }

      /**
       * Set the value of email
       *
       * @return  self
       */
      public function setEmail($email)
      {
          $this->email = $email;

          return $this;
      }

      /**
       * Get the value of timestamp
       */
      public function getTimestamp()
      {
          return $this->timestamp;
      }

      /**
       * Set the value of timestamp
       *
       * @return  self
       */
      public function setTimestamp($timestamp)
      {
          $this->timestamp = $timestamp;

          return $this;
      }

      /**
       * Get the value of isSucceed
       */ 
      public function getIsSucceed()
      {
            return $this->isSucceed;
      }

      /**
       * Set the value of isSucceed
       *
       * @return  self
       */ 
      public function setIsSucceed($isSucceed)
      {
            $this->isSucceed = $isSucceed;

            return $this;
      }

      public function save()
      {
          $conn = Db::getConnection();
          $statement = $conn->prepare("insert into login_attempts (ipAddress, email, isSucceed) values (:ipAddress, :email, :isSucceed)");

          $ipAddress = $this->getIpAddress();
          $email = $this->getEmail();
          $isSucceed = $this->getIsSucceed();

          $statement->bindValue(":ipAddress", $ipAddress);
          $statement->bindValue(":email", $email);
          $statement->bindValue(":isSucceed", $isSucceed);

          $result = $statement->execute();

          return $result;
      }

      public function getNumberAttemptsWithIp($ip, $startTime)
      {
          $endTime = date("Y-m-d H:i:s", $startTime + 1800);
          $startTime = date("Y-m-d H:i:s", $startTime);
          $conn = Db::getConnection();
          $statement = $conn->prepare("select count(ipAddress) from login_attempts where ipAddress = :ip and isSucceed = 0 and timestamp between :startTime and :endTime");
          $statement->bindValue(":ip", $ip);
          $statement->bindValue(":startTime", $startTime);
          $statement->bindValue(":endTime", $endTime);

          $statement->execute();

          $attempts = $statement->fetch(PDO::FETCH_ASSOC);
          return $attempts;
      }

      public function getNumberAttemptsWithEmail($email, $ip, $startTime)
      {
          $endTime = date("Y-m-d H:i:s", $startTime + 1800);
          $startTime = date("Y-m-d H:i:s", $startTime);
          $conn = Db::getConnection();
          $statement = $conn->prepare("select count(email) from login_attempts where email = :email and isSucceed = 0 and ipAddress = :ip and timestamp between :startTime and :endTime");
          $statement->bindValue(":ip", $ip);
          $statement->bindValue(":email", $email);
          $statement->bindValue(":startTime", $startTime);
          $statement->bindValue(":endTime", $endTime);

          $statement->execute();

          $attempts = $statement->fetch(PDO::FETCH_ASSOC);
          return $attempts;
      }

  }
