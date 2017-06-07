<?php
    class database
    {
        function __construct($pdo)
        {
            $this->pdo = $pdo;
        }

        function get($query) {
            $query = $this->pdo->prepare($query);
            $query->execute();
            return $query->fetchAll();
        }

        function update($query)
        {
            $query = $this->pdo->prepare($query);
            $query->execute();
        }


    }
?>