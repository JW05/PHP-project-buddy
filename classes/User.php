<?php
	include_once(__DIR__."/Db.php");

	class User {
		private $email;
		private $password;
                private $avatar;
                private $description;
                private $firstName;
                private $lastName;
                
                //From profilePage
                private $locatie;
                private $jaar;
                private $voorkeur;
                private $genre;
                private $feesten;
                private $user_id;

                /**
                 * Get the value of firstname
                 */ 
                public function getFirstName()
                {
                                return $this->firstName;
                }

                /**
                 * Set the value of firstname
                 *
                 * @return  self
                 */ 
                public function setFirstName($firstName)
                {
                        if(empty($firstName)){
                                throw new Exception("Firstname cannot be empty");
                        }
                        $this->firstName = $firstName;

                        return $this;
                }

                /**
                 * Get the value of lastname
                 */ 
                public function getLastName()
                {
                        return $this->lastName;
                }

                /**
                 * Set the value of lastname
                 *
                 * @return  self
                 */ 
                public function setLastName($lastName)
                {
                        if(empty($lastName)){
                                throw new Exception("Last name cannot be empty");
                        }
                        $this->lastName = $lastName;

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
                        if(empty($email)){
                                throw new Exception("Email cannot be empty");
                        }
                        $this->email = $email;
            
                        return $this;
		}

		/**
		 * Get the value of password
		 */ 
		public function getPassword()
		{
			return $this->password;
		}

		/**
		 * Set the value of password
		 *
		 * @return  self
		 */ 
		public function setPassword($password)
		{
                        if(empty($password)){
                                throw new Exception("Password cannot be empty");
                        }
                        $this->password = password_hash($password, PASSWORD_DEFAULT, ["cost" => 14]);

                        return $this;
                }
                
                //Written by Bryan
                public function save()
                {
                        //con
                        //$conn = new PDO('mysql:host=localhost;dbname=phpals', "root", "");
                        $conn = Db::getConnection();
                        //insert query
                        $statement = $conn->prepare("insert into users (firstname, lastname, email, password) values (:firstName, :lastName, :email, :password)"); 
                        // sql injectie tegengaan
                        $firstName = $this->getFirstName();
                        $lastName = $this->getLastName();
                        $email = $this->getEmail();
                        /*password (veilig bewaard via bcrypt!)*/
                        $password = $this->getPassword();
                        $password = password_hash($password, PASSWORD_DEFAULT, ["cost" => 14]);
                        $statement->bindValue(":firstName", $firstName);
                        $statement->bindValue(":lastName", $lastName);
                        $statement->bindValue(":email", $email);
                        $statement->bindValue(":password", $password);
            
                        $result = $statement->execute();

                        return $result;

                }

                public static function getEmails(){
                        //$conn = new PDO('mysql:host=localhost;dbname=phpals', "root", "");
                        $conn = Db::getConnection();
            
                        $statement = $conn->prepare("select email from users");
                        $result = $statement->execute();
                        $adressen = $statement->fetchAll(PDO::FETCH_ASSOC);
            
                        return $adressen;
                }
                
                //Written by Maury
		public function canLogin($email, $password)
		{
			$conn = new mysqli("localhost", "root", "","phpals");
			$email = $conn->real_escape_string($email);
			$query="select * from users where email = '$email'";
			$result = $conn->query($query);
			if(mysqli_num_rows($result)!=0)
			{
				$user = $result->fetch_assoc();
				if(password_verify($password,$user['password'])){
					return true;
			
				}else
				{
					return false;
				}
			}
			
		}


		public function canLogout()
		{
			session_start();
			session_destroy();
                }
                
                public static function getCurrentUser($email){
                        $conn = Db::getConnection();
                        $statement = $conn->prepare("select * from users where email = '$email'");
                        $statement->execute();
                        $user = $statement->fetch(PDO::FETCH_ASSOC);

                        return $user;
                }

                public function updateProfile($id){
                        $conn = Db::getConnection();
                        $statement = $conn->prepare("update users set firstname = :firstName, lastname = :lastName, email = :email, password = :password, description = :description, avatar = :avatar where id = '$id'");
                        
                        $firstName = $this->getFirstName();
                        $lastName = $this->getLastName();
                        $email = $this->getEmail();
                        $password = $this->getPassword();
                        $avatar = $this->getAvatar();
                        $description = $this->getDescription();

                        $statement->bindValue(":firstName", $firstName);
                        $statement->bindValue(":lastName", $lastName);
                        $statement->bindValue(":email", $email);
                        $statement->bindValue(":avatar", $avatar);
                        $statement->bindValue(":description", $description);
                        $statement->bindValue(":password", $password);

                        $result = $statement->execute();

                        return true;
                }

                public function checkEmail($email){
                        $conn = Db::getConnection();
                        $result = $conn->query("select * from users where email = '$email'");
                        if($result->fetchColumn() > 0 && $this->email != $email){
                                return false;
                        }else{
                                return true;
                        }
                }
		

                /**
                 * Get the value of avatar
                 */ 
                public function getAvatar()
                {
                                return $this->avatar;
                }

                /**
                 * Set the value of avatar
                 *
                 * @return  self
                 */ 
                public function setAvatar($avatar)
                {
                                $this->avatar = $avatar;

                                return $this;
                }

                /**
                 * Get the value of description
                 */ 
                public function getDescription()
                {
                                return $this->description;
                }

                /**
                 * Set the value of description
                 *
                 * @return  self
                 */ 
                public function setDescription($description)
                {
                                $this->description = $description;

                                return $this;
                }




        /* Jens W*/
            public function saveKenmerken(){

            $conn = Db::getConnection();
            /*$conn = new PDO('mysql:host=localhost;dbname=phpals',"root","");*/
            $statement = $conn->prepare("insert into profile (locatie, jaar, voorkeur, genre, feesten, userId) values (:locatie, :jaar, :voorkeur, :genre, :feesten, :userId)");
            
           
            $locatie = $this->getLocatie();
            $jaar = $this->getJaar();
            $voorkeur = $this->getVoorkeur();
            $genre = $this->getGenre();
            $feesten = $this->getFeesten(); 
            $userId = $this->getUserId(); 
            
           
            
             
            $statement->bindValue(":locatie", $locatie);
            $statement->bindValue(":jaar", $jaar);
            $statement->bindValue(":voorkeur", $voorkeur);
            $statement->bindValue(":genre", $genre);
            $statement->bindValue(":feesten", $feesten);
            $statement->bindValue(":userId", $userId);
            /* check value before save */
           /* echo $locatie;
            echo $feesten;
           /*----------------------*/
            $result = $statement->execute() ;
                /*test result-------------
                       var_dump($result);
                 ------------------------*/     
                return  $result ;
                
    }

    public static function getCurrentKenmerk(){
        $conn = Db::getConnection();
       /* $conn = new PDO('mysql:host=localhost;dbname=phpals',"root","");*/
       
        $statement = $conn->prepare("select * from profile");
        $statement->execute();
        $kenmerken = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $kenmerken;
}

   /* public function updateUserId($id){
        $conn = Db::getConnection();
       
       $statement = $conn->prepare("insert into user (id) values (:id)"); 

        
        $id = $this->getId();
        
        $statement->bindValue(":id", $id);

        $result = $statement->execute();

            return true;
             $_SESSION['locatie'] = "phpals.profile";
}*/

 /**
                 * Get the value of id
                 */ 
           /*     public function getId()
                {
                                return $this->id;
                }

                /**
                 * Set the value of id
                 *
                 * @return  self
                 */ 
          /*      public function setId($id)
                {
                                $this->id = $id;

                                return $this;
                }



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
                 * Get the value of locatie
                 */ 
                public function getLocatie()
                {
                       
                                return $this->locatie;
                }

                /**
                 * Set the value of locatie
                 *
                 * @return  self
                 */ 
                public function setLocatie($locatie)
                {
                         
                                $this->locatie = $locatie;

                                return $this;
                }

                /**
                 * Get the value of jaar
                 */ 
                public function getJaar()
                {
                                return $this->jaar;
                }

                /**
                 * Set the value of jaar
                 *
                 * @return  self
                 */ 
                public function setJaar($jaar)
                {
                                $this->jaar = $jaar;

                                return $this;
                }

                /**
                 * Get the value of voorkeur
                 */ 
                public function getVoorkeur()
                {
                                return $this->voorkeur;
                }

                /**
                 * Set the value of voorkeur
                 *
                 * @return  self
                 */ 
                public function setVoorkeur($voorkeur)
                {
                                $this->voorkeur = $voorkeur;

                                return $this;
                }

                /**
                 * Get the value of genre
                 */ 
                public function getGenre()
                {
                                return $this->genre;
                }

                /**
                 * Set the value of genre
                 *
                 * @return  self
                 */ 
                public function setGenre($genre)
                {
                                $this->genre = $genre;

                                return $this;
                }

                /**
                 * Get the value of feesten
                 */ 
                public function getFeesten()
                {
                                return $this->feesten;
                }

                /**
                 * Set the value of feesten
                 *
                 * @return  self
                 */ 
                public function setFeesten($feesten)
                {
                                $this->feesten = $feesten;

                                return $this;
                }
	}
	

?>
