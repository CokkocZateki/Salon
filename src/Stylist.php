<?php
    class Stylist
    {
        private $id;
        private $name;

        function __construct($name, $id = null)
        {
            $this->name = $name;
            $this->id = $id;
        }

        function setId($new_id)
        {
            $this->id = $new_id;
        }

        function getId()
        {
            return $this->id;
        }

        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }

        function getName()
        {
            return $this->name;
        }

        function save()
        {
          $GLOBALS['DB']->exec("INSERT INTO stylists (name) VALUES ('{$this->getName()}')");
          $result_id = $GLOBALS['DB']->lastInsertId();
          $this->setId($result_id);
        }

        static function getAll()
        {
          $returned_stylists = $GLOBALS['DB']->query("SELECT * FROM stylists;");
          $stylists = array();
          foreach ($returned_stylists as $stylist) {
              $name = $stylist['name'];
              $id = $stylist['id'];
              $new_stylist = new Stylist($name, $id);
              array_push($stylists, $new_stylist);
          }

          return $stylists;
        }

        function getClients()
        {
            $clients = array();
            $returned_clients = $GLOBALS['DB']->query("SELECT * FROM clients WHERE stylist_id = {$this->getId()} ORDER BY client_name;");
            foreach($returned_clients as $client) {
                $client_name = $client['client_name'];
                $stylist_id = $client['stylist_id'];
                $id = $client['id'];
                $new_client = new Client($client_name, $stylist_id, $id);
                array_push($clients, $new_client);
            }
            return $clients;
        }

        // function getClient()
        // {
        //     // $clients = array();
        //     $returned_clients = $GLOBALS['DB']->query("SELECT * FROM clients WHERE id = {$this->getId()};");
        //     foreach($returned_clients as $client) {
        //         $client_name = $client['client_name'];
        //         $stylist_id = $client['stylist_id'];
        //         $id = $client['id'];
        //         $new_client = new Client($client_name, $stylist_id, $id);
        //         // array_push($clients, $new_client);
        //     }
        //     return $new_client;
        // }



        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM stylists;");
        }

        static function find($search_id)
        {
            $found_stylist = null;
            $stylists = Stylist::getAll();
            foreach($stylists as $stylist){
                $stylist_id = $stylist->getId();
                if ($stylist_id == $search_id){
                    $found_stylist = $stylist;
                }
            }
            return $found_stylist;
        }

        function update($new_name)
        {
            $GLOBALS['DB']->exec("UPDATE stylists SET name = '{$new_name}' WHERE id = {$this->getId()};");
            $this->setName($new_name);
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM stylists WHERE id = {$this->getId()};");
            // $GLOBALS['DB']->exec("DELETE FROM clients WHERE stylist_id = {$this->getId()};");
        }



    }
?>
