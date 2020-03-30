<?php
    include_once(__DIR__."/Db.php");
    class NewUser{
        private $firstName;
        private $lastName;
        private $email;
        private $password;
        

        /**
         * Get the value of firstName
         */ 
        public function getFirstName()
        {
                return $this->firstName;
        }

        /**
         * Set the value of firstName
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
         * Get the value of lastName
         */ 
        public function getLastName()
        {
                return $this->lastName;
        }

        /**
         * Set the value of lastName
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

        public function save()
        {
            //con
            $conn = new PDO('mysql:host=localhost;dbname=phpals', "root", "");
            //insert query
            $statement = $conn->prepare("insert into users (firstname, lastname, email, password) values (:firstName, :lastName, :email, :password)"); 
            // sql injectie tegengaan
            $firstName = $this->getFirstName();
            $lastName = $this->getLastName();
            $email = $this->getEmail();
            $password = $this->getPassword();
            $statement->bindValue(":firstName", $firstName);
            $statement->bindValue(":lastName", $lastName);
            $statement->bindValue(":email", $email);
            $statement->bindValue(":password", $password);
            
            $result = $statement->execute();

            return $result;

        }

    }
?>