<?php
    // Bryan
    include_once(__DIR__."/Db.php");

    class Search{
        private $search;

        

        /**
         * Get the value of search
         */ 
        public function getSearch()
        {
                return $this->search;
        }

        /**
         * Set the value of search
         *
         * @return  self
         */ 
        public function setSearch($search)
        {
                $this->search = $search;

                return $this;
        }

        public function getData(){
            $conn = Db::getConnection();
            $statement = $conn->prepare("SELECT * FROM users WHERE firstname LIKE :search OR lastname LIKE :search");
            $search = $this->getSearch();
            $statement->bindValue(":search", "%" . $search . "%");
            $statement->execute();

            $searchData = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $searchData;
        }
    }
?>