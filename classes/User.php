<?php
	include_once(__DIR__."/Db.php");

	class Security {
		
		public static function hash($password) {
			$options = [
				'cost' => 15
			];
			$hash = password_hash($password, PASSWORD_DEFAULT, $options);

			return $hash;
		}
    }


	class User {
		private $email;
		private $password;
                private $avatar;
                private $description;
                private $firstname;
                private $lastname;
                
                //From profilePage
                private $locatie;
                private $jaar;
                private $voorkeur;
                private $genre;
                private $feesten;

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
                                $options = [
                                        'cost' => 15
                                ];
				$this->password = password_hash($password, PASSWORD_DEFAULT, $options);

				return $this;
		}
	
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
                        $statement = $conn->prepare("update users set firstname = :firstname, lastname = :lastname, email = :email, password = :password, description = :description, avatar = :avatar where id = '$id'");
                        
                        $firstname = $this->getFirstname();
                        $lastname = $this->getLastname();
                        $email = $this->getEmail();
                        $password = $this->getPassword();
                        $avatar = $this->getAvatar();
                        $description = $this->getDescription();

                        $statement->bindValue(":firstname", $firstname);
                        $statement->bindValue(":lastname", $lastname);
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

                /**
                 * Get the value of firstname
                 */ 
                public function getFirstname()
                {
                                return $this->firstname;
                }

                /**
                 * Set the value of firstname
                 *
                 * @return  self
                 */ 
                public function setFirstname($firstname)
                {
                                $this->firstname = $firstname;

                                return $this;
                }

                /**
                 * Get the value of lastname
                 */ 
                public function getLastname()
                {
                                return $this->lastname;
                }

                /**
                 * Set the value of lastname
                 *
                 * @return  self
                 */ 
                public function setLastname($lastname)
                {
                                $this->lastname = $lastname;

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
