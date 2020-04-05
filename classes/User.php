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
                private $location;
                private $year;
                private $preference;
                private $genre;
                private $likesToParty;
                private $userId;
                private $buddy;

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





// JENS

            public function saveInfo(){

            $conn = Db::getConnection();
            $statement = $conn->prepare("insert into profile (location, year, preference, genre, likesToParty, userId) values (:location, :year, :preference, :genre, :likesToParty, :userId)");
            
           
            $location = $this->getLocation();
            $year = $this->getYear();
            $preference = $this->getPreference();
            $genre = $this->getGenre();
            $party = $this->getLikesToParty(); 
            $userId = $this->getUserId(); 
            
                        
            $statement->bindValue(":location", $location);
            $statement->bindValue(":year", $year);
            $statement->bindValue(":preference", $preference);
            $statement->bindValue(":genre", $genre);
            $statement->bindValue(":likesToParty", $party);
            $statement->bindValue(":userId", $userId);
            
            $result = $statement->execute() ;
            return  $result ;
                
    }

// END JENS

// No use  by JENS
    public static function getCurrentPreference($userId){
       
        $conn = Db::getConnection();
            
        $statement = $conn->prepare("select * from profile where userId = '$userId'");
        $statement->execute();
        $preference = $statement->fetch(PDO::FETCH_OBJ);
        if(empty($preference)){
                throw new Exception("Sorry records were not found.");
        }

        return $preference;
}
// No use by Jens End


public function saveBuddy()
{
        $conn = Db::getConnection();

        $statement = $conn->prepare("insert into profile (LookingForBuddy) values (:buddy)");
        $statement->execute();
}

// JENS
/* check if id exists in profile table to execute insert Updateprofile data */

public function UserIdExists($id)
{
        $conn = new mysqli("localhost", "root", "","phpals");
        $query="select * from profile where userId ='$id'";
        $result = $conn->query($query);
        if(mysqli_num_rows($result)!=0)
       
         {      
                echo "true user id exists";
                return true;}
           else	{
                echo "false user id doesnt exist";
                return false;
                }
}
// END JENS

// JENS
public function getUserId2($email)
{
        $conn = new mysqli("localhost", "root", "","phpals");
        $email = $conn->real_escape_string($email);
        $query="select id from users where email = '$email'";
        $result = $conn->query($query);
        
        if(mysqli_num_rows($result)!=0)
        {
                        $user = $result->fetch_assoc();
                        return $user;
        
               }else
                {
                        return false;
                }
        } 

// END JENS
        
// JENS Getters & setters     
               
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
                public function getLocation()
                {
                       
                                return $this->location;
                }

                /**
                 * Set the value of locatie
                 *
                 * @return  self
                 */ 
                public function setLocation($location)
                {
                         
                                $this->location = $location;

                                return $this;
                }

                /**
                 * Get the value of jaar
                 */ 
                public function getYear()
                {
                                return $this->year;
                }

                
                /**
                 * Set the value of jaar
                 *
                 * @return  self
                 */ 
                public function setYear($year)
                {
                                $this->year = $year;

                                return $this;
                }

                /**
                 * Get the value of preference
                 */ 
                public function getPreference()
                {
                                return $this->preference;
                }

                /**
                 * Set the value of preference
                 *
                 * @return  self
                 */ 
                public function setPreference($preference)
                {
                                $this->preference = $preference;

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
                 * Get the value of LikesToParty
                 */ 
                public function getLikesToParty()
                {
                                return $this->likesToParty;
                }

                /**
                 * Set the value of LikesToParty
                 *
                 * @return  self
                 */ 
                public function setLikesToParty($likesToParty)
                {
                                $this->likesToParty = $likesToParty;

                                return $this;
                }
                
// JENS end getters and setters  
        
	
// JENS

public function getBuddys($userId) {					
        $conn = new mysqli("localhost", "root", "","phpals");
        $userId = $conn->real_escape_string($userId);
        $query="select u.firstname, u.lastname, u.avatar, u.email from users u left join buddys b on u.id = b.buddyid where b.userid = '$userId'";
        $result = $conn->query($query);
        if(mysqli_num_rows($result)!=0) {
                        //place all data in the array row to be able to use 
                        while($row = $result->fetch_assoc()) {
                                $rows[] = $row;
                        }
                        return $rows;   
                }else {
                        return false;
                }
} 
 
// END JENS


   }

?>
