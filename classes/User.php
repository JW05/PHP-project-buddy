<?php
    class User {
        //From login and signup || for profile
        private $email;
        private $password;
        private $avatar;
        private $description;
        
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


        //Written by Maury
        public function canLogin($email, $password)
        {
            $conn = new mysqli("localhost", "root", "","codezilla");
            $email = $conn->real_escape_string($email);
            $query="select * from users where email = '$email'";
            $result = $conn->query($query);
            if(mysqli_num_rows($result) != 0){
                $user = $result->fetch_assoc();
                if(password_verify($password,$user['password'])){
                    return true;
        
                }else
                {
                    return false;
                }
            }else{
                return false;
            }
            
        }
    }