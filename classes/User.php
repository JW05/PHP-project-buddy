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
                private $lookingForBuddy;
                private $vKey;
                private $isVerified = false;

                //from registerpage
                private $emailId;

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
                        $this->password = $password;

                        return $this;
                }

                /* Replaced by MADINA */

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

                /**
                 * Get the value of buddy
                 */ 
                public function getBuddy()
                {
                        return $this->buddy;
                }

                /**
                 * Set the value of buddy
                 *
                 * @return  self
                 */ 
                public function setBuddy($buddy)
                {
                        $this->buddy = $buddy;

                        return $this;
                }

                /**
                 * Get the value of lookingForBuddy
                 */ 
                public function getLookingForBuddy()
                {
                        return $this->lookingForBuddy;
                }

                /**
                 * Set the value of lookingForBuddy
                 *
                 * @return  self
                 */ 
                public function setLookingForBuddy($lookingForBuddy)
                {
                        $this->lookingForBuddy = $lookingForBuddy;

                        return $this;
                }

                /**
                 * Get the value of emailId
                 */ 
                public function getEmailId()
                {
                        return $this->emailId;
                }

                /**
                 * Set the value of emailId
                 *
                 * @return  self
                 */ 
                public function setEmailId($emailId)
                {
                        $this->emailId = $emailId;

                        return $this;
                }

                /* End replaced by MADINA */
                
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

                //feature 17 -- Maury Massag
               public function verifyAccount($email,$vKey)
                {
                        $to = $email;
                        $subject = "Email Verification";
                        $message = "We need you to confirm your existence:<a href='http://localhost/PHPals/php-project-buddy/verify.php?vKey=$vKey'> Confirm your account</a>";
                        $headers = "from: Maury Massa <mauryd1q@maurydigital.be>";
                        
                        mail($to,$subject,$message,$headers);   
                
                        header("login.php");         
                }
             
                public function updateVerification($email){
                        $conn = Db::getConnection();
                        $statement = $conn->prepare("UPDATE users SET isVerified = 1 WHERE email = $email"); 

                        $result = $statement->execute();

                        //written by maury
                
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
			$conn = Db::getConnection();
			
			$statement = $conn->prepare("select * from users where email = :email AND isVerified = false");
                        $statement->bindValue(":email", $email);

                        $statement->execute();
                        
			if($statement->rowCount() > 0)
			{
				$user = $statement->fetch(PDO::FETCH_ASSOC);
				if(password_verify($password,$user['password'])){
					return true;
			
				}else
				{
					return false;
				}
			}
			
                }
                //written by maury
                public function checkRole($id)
                {
                        $conn = Db::getConnection();
                        $statement = $conn->prepare("select role from users where id = :id ");
                        $statement->bindValue(":id", $id);
                        
                        $statement->execute();
                        $roles = $statement->fetch(PDO::FETCH_ASSOC);
                        

                        return $roles;
                }


		public function canLogout()
		{
			session_start();
			session_destroy();
                }
                
                //Get current active user
                public static function getCurrentUser($email){
                        $conn = Db::getConnection();
                        $statement = $conn->prepare("select * from users where email = :email");
                        $statement->bindValue(":email", $email);
                        $statement->execute();
                        $user = $statement->fetch(PDO::FETCH_ASSOC);
                        if(empty($user)){
                                throw new Exception("Sorry records with this user were not found.");
                        }
                        return $user;
                }

                public function updateProfile($id){
                        $conn = Db::getConnection();
                        
                        $firstName = $this->getFirstName();
                        $lastName = $this->getLastName();
                        $email = $this->getEmail();
                        $password = $this->getPassword();
                        $avatar = $this->getAvatar();
                        $description = $this->getDescription();
                        
                        //if user as for new password execute first statement where password will be updated, else execute the second one
                        if(!empty($password)){
                                $statement = $conn->prepare("update users set firstname = :firstName, lastname = :lastName, email = :email, password = :password, description = :description, avatar = :avatar where id = :id");
                                $password = password_hash($password, PASSWORD_DEFAULT, ["cost" => 14]);
                                $statement->bindValue(":password", $password);
                        }else{
                                $statement = $conn->prepare("update users set firstname = :firstName, lastname = :lastName, email = :email, description = :description, avatar = :avatar where id = :id");
                        }

                        $statement->bindValue(":firstName", $firstName);
                        $statement->bindValue(":lastName", $lastName);
                        $statement->bindValue(":email", $email);
                        $statement->bindValue(":avatar", $avatar);
                        $statement->bindValue(":description", $description);
                        $statement->bindValue(":id", $id);

                        $result = $statement->execute();

                        return true;
                }

                public function checkEmail($email){
                        $conn = Db::getConnection();
                        $userEmail = $this->getEmail();
                        $statement = $conn->prepare("select * from users where email = :email");
                        $statement->bindValue(":email", $email);
                        $statement->execute();
                        if($statement->rowCount() > 0 && $userEmail != htmlspecialchars($email)){
                                return false;
                        }else{
                                return true;
                        }
                }

                // JENS - (feature 5 toegevoegd MAURY)

                public function saveInfo(){

                        $conn = Db::getConnection();
                        //$statement = $conn->prepare("insert into profile (location, year, preference, genre, likesToParty, userId) values (:location, :year, :preference, :genre, :likestoparty, :userId)");
                        $statement = $conn->prepare("insert into profile (location, year, preference, genre, likesToParty, userId, lookingForBuddy) values (:location, :year, :preference, :genre, :likesToParty, :userId, :lookingForBuddy)");
                
                        $location = $this->getLocation();
                        $year = $this->getYear();
                        $preference = $this->getPreference();
                        $genre = $this->getGenre();
                        $party = $this->getLikesToParty(); 
                        $userId = $this->getUserId(); 
                        $lookingForBuddy = $this->getLookingForBuddy();
                                
                        $statement->bindValue(":location", $location);
                        $statement->bindValue(":year", $year);
                        $statement->bindValue(":preference", $preference);
                        $statement->bindValue(":genre", $genre);
                        $statement->bindValue(":likesToParty", $party);
                        $statement->bindValue(":userId", $userId);
                        $statement->bindValue(":lookingForBuddy", $lookingForBuddy);
                
                        $result = $statement->execute();
                        return  $result;
                
                }

                // END JENS
                // Maury feature 5 toegevoegd
                // JENS 

                public function updateInfo($userId){

                        $conn = Db::getConnection();
                        $statement = $conn->prepare("update profile set location = :location, year = :year, preference = :preference, genre = :genre, likesToParty = :likesToParty, lookingForBuddy = :lookingForBuddy where userId = :userId");
        
       
                        $location = $this->getLocation();
                        $year = $this->getYear();
                        $preference = $this->getPreference();
                        $genre = $this->getGenre();
                        $party = $this->getLikesToParty(); 
                        $lookingForBuddy = $this->getLookingForBuddy();
                    
                        $statement->bindValue(":userId", $userId);
                        $statement->bindValue(":location", $location);
                        $statement->bindValue(":year", $year);
                        $statement->bindValue(":preference", $preference);
                        $statement->bindValue(":genre", $genre);
                        $statement->bindValue(":likesToParty", $party);
                        $statement->bindValue(":lookingForBuddy", $lookingForBuddy);
        
                        $result = $statement->execute() ;
        
                        return $result;
            
                }

                // END JENS

                // Written by Jens, fixed by others -- get profile preferences linked with own account
                public static function getCurrentPreference($userId){
       
                        $conn = Db::getConnection();
            
                        $statement = $conn->prepare("select * from profile where userId = :userId");
                        $statement->bindValue(":userId", $userId); //added by Madina
                        $statement->execute();
                        $preference = $statement->fetch(PDO::FETCH_OBJ);
                        if(empty($preference)){
                                throw new Exception("Sorry records were not found.");
                        }

                        return $preference;
                }
                //end Jens

                //Maury 


                //Madina feature7
                public function getMatchingProfiles($currentUserProfile){
                        $conn = Db::getConnection();
                        $statement = $conn->prepare("select * from profile where not exists (select 1 from buddys where (buddys.userId = profile.userId or buddys.buddyId = profile.userId) and requestAccepted = 1) and userId != :userId and lookingForBuddy = :lookingForBuddy and (location = :location or preference = :preference or genre = :genre or likesToParty = :likesToParty)");
                        $statement->bindValue(":userId", $currentUserProfile->userId);
                        $statement->bindValue(":lookingForBuddy", !$currentUserProfile->lookingForBuddy);
                        $statement->bindValue(":location", $currentUserProfile->location);
                        $statement->bindValue(":preference", $currentUserProfile->preference);
                        $statement->bindValue(":genre", $currentUserProfile->genre);
                        $statement->bindValue(":likesToParty", $currentUserProfile->likesToParty);

                        $statement->execute();
                        $match = $statement->fetchAll(PDO::FETCH_ASSOC);
                        if(empty($match)){
                                throw new Exception("No suggestions found.");
                        }
                        
                        return $match;
                }

                public static function getUserInfo($userId){
                        $conn = Db::getConnection();
                        $statement = $conn->prepare("select firstname, lastname, avatar, description, location, year, userId, genre, preference, lookingForBuddy, likesToParty from users left join profile p on p.userId = users.id where users.id = :userId");
                        $statement->bindValue(":userId", $userId);
                        $statement->execute();

                        $user = $statement->fetch(PDO::FETCH_OBJ);
                        
                        return $user;
                }

                public function printReasonMatch($user, $match){
                        $reason = "This person ";
                        $i = 1;
                  
                        if($user->genre == $match->genre){
                          $reason .= "also likes to listen to ".$match->genre;
                          $i++;
                        }
                  
                        if($i > 1 && $user->preference == $match->preference){
                          $reason .= ", also does ".$match->preference;
                        }else if($user->preference == $match->preference){
                          $reason .= "also does ".$match->preference;
                          $i++;
                        }
                  
                        if($i > 1 && $user->location == $match->location){
                          $reason .= ", also lives in ".$match->location;
                        }else if($user->location == $match->location){
                          $reason .= "also lives in ".$match->location;
                          $i++;
                        }
                  
                        if($user->likesToParty == $match->likesToParty && $match->likesToParty == 1){
                          $reason .= " and also goes to party";
                        }else if($user->likesToParty == $match->likesToParty && $match->likesToParty == 0){
                          $reason .= " and also doesn't like to party";
                        }
                  
                        return $reason;
                }

                //End feature 7
                
                // JENS
                public function getUserId2($email)
                {
                        //fixed by Madina
                        $conn = Db::getConnection();
                        $statement = $conn->prepare("select id from users where email = :email");
                        $statement->bindValue(":email", $email);
                        $statement->execute();
                        
                        if($statement->rowCount()!=0)
                        {
                                $user = $statement->fetch(PDO::FETCH_ASSOC);
                                return $user;
                        
                        }else
                        {
                                return false;
                        }
                } 

                // END JENS  
	
                // JENS

                public function getBuddys($userId) {	
                        //fixed by Madina				
                        $conn = Db::getConnection(); 
                        $statement = $conn->prepare("select u.firstname, u.lastname, u.avatar, u.email from users u left join buddys b on u.id = b.buddyid where b.userid = :userId");
                        $statement->bindValue(":userId", $userId);
                        $statement->execute();

                        if($statement->rowCount()!=0) {
                                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                return $result;   
                        }else {
                                return false;
                        }
                } 

                //getAllStudents

                public static function getAllStudents(){

                        $conn = Db::getConnection();
                        $statement = $conn->prepare("select count(*) from users");
                        $statement->execute() ;
                        $AllStudents = $statement->fetch(PDO::FETCH_ASSOC);

                        return $AllStudents;

                }
                public static function getAllBuddys(){

                        $conn = Db::getConnection();
                        $statement = $conn->prepare("select count(*) from buddys where buddyId=buddyId");
                        $statement->execute() ;
                        $AllBuddys = $statement->fetch(PDO::FETCH_ASSOC);

                        return $AllBuddys;

                }



                 //user saven
                 public function saveUser(){
                        $conn = Db::getConnection();
                        $statement = $conn->prepare("insert into email (email, emailId, userId) values (:email, :emailId, :userId)");

                        $email =$this->getEmail();
                        $emailId =$this->getEmailId();
                        $userId =$this->getUserId();


                        $statement->bindValue(":email", $email);
                        $statement->bindValue(":emailId", $emailId);
                        $statement->bindValue(":userId", $userId);

                        $result = $statement->execute();
                        return $result;
                    }

                public static function getAll($emailId){
                        $conn = Db::getConnection();
                        $statement = $conn->prepare('select * from email where emailId = :emailId');

                        $statement->bindValue(":emailId", $emailId);

                        $result = $statement->execute();
                        return $statement->fetchAll(PDO::FETCH_ASSOC);
                    }

                // END JENS  

        }
?>
