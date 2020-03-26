<?php
	

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
				$this->password = $password;

				return $this;
		}
	
		public function canLogin($email, $password)
		{
			$conn = new mysqli("localhost", "root", "","codezilla");
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
		
	}
	

?>
