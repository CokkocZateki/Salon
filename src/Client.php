<?php
    class Client
    {
        private $client_name;
        private $stylist_id;
        private $id;


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
            $statement = $GLOBALS['DB']->exec("INSERT INTO clients (client_name, stylist_id)
                VALUES ('{$this->getName()}', {$this->getStylistId()});");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_clients = $GLOBALS['DB']->query("SELECT * FROM clients ORDER BY client_name;");
            $clients = array();
            foreach($returned_clients as $client){
                $client_name = $client['client_name'];
                $stylist_id = $client['stylist_id'];
                $id = $client['id'];

                //var_dump($id);
                $new_client = new Client($client_name, $stylist_id, $id);
                array_push($clients, $new_client);
            }
            return $clients;
        }




        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM clients;");
        }


    }
?>
