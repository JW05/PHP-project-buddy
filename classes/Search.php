<?php
    // Bryan
    include_once(__DIR__."/Db.php");

    class Search{
        private $name;
        private $genre;
        private $preference;

        

        /**
         * Get the value of name
         */ 
        public function getName()
        {
                return $this->name;
        }

        /**
         * Set the value of name
         *
         * @return  self
         */ 
        public function setName($name)
        {
                $this->name = $name;

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

        
        public function getData(){
            $conn = Db::getConnection();
            $query = "SELECT * FROM users u INNER JOIN profile p ON p.userId = u.id WHERE firstname LIKE :firstname OR lastname LIKE :lastname OR genre LIKE :genre OR preference LIKE :preference OR ";
            $query = substr($query, 0, -4);
            $statement = $conn->prepare($query);

            $name = $this->getName();
            

            $preference = $this->getPreference();
            $genre = $this->getGenre();
            $statement->bindValue(':firstname', $name);
            $statement->bindValue(':lastname', $name);
            $statement->bindValue(':genre', $genre);
            $statement->bindValue(':preference', $preference); 
            
            //var_dump($statement);
            //die();
            $statement->execute();

            $searchData = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $searchData;
        }
    }
?>