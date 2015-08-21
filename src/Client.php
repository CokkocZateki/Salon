<?php
    class Client
    {
        private $id;
        private $client_name;
        private $stylist_id;
        private $description;


        function __construct($client_name, $stylist_id, $id = null)
        {
            $this->client_name = $client_name;
            $this->stylist_id = $stylist_id;
            $this->id = $id;
        }


        function getId()
        {
            return $this->id;
        }

        function getStylistId()
        {
            return $this->stylist_id;
        }

        function setName($new_client_name)
        {
            $this->description = (string) $new_client_name;
        }

        function getName()
        {
            return $this->client_name;
        }

        function save()
        {
            $statement = $GLOBALS['DB']->exec("INSERT INTO clients (client_name, stylist_id, id)
                VALUES ('{$this->getName()}', {$this->getStylistId()});");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }




        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM clients;");
        }


    }
?>
