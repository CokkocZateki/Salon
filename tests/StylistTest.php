<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Stylist.php";
    require_once "src/Client.php";

    $server = 'mysql:host=localhost;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StylistTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
            Stylist::deleteAll();
            Client::deleteAll();
        }

        function testGetName()
        {
            //Arrange
            $name = "Bob";
            $test_stylist = new Stylist($name);

            //Act
            $result = $test_stylist->getName();

            //Assert
            $this->assertEquals($name, $result);
        }

        function testGetId()
        {
            //Arrange
            $name = "Bob";
            $id = 1;
            $test_stylist = new Stylist($name, $id);

            //Act
            $result = $test_stylist->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function testDeleteAll()
        {
            //Arrange
            $name = "Bob";
            $name2 = "Harry";
            $test_stylist = new Stylist($name);
            $test_stylist->save();
            $test_stylist2 = new Stylist($name2);
            $test_stylist2->save();

            //Act
            Stylist::deleteAll();
            $result = Stylist::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        function testGetAll()
        {
            //Arrange
            $name = "Bob";
            $name2 = "Harry";
            $test_stylist = new Stylist($name);
            $test_stylist->save();
            $test_stylist2 = new Stylist($name2);
            $test_stylist2->save();

            //Act
            $result = Stylist::getAll();

            //Assert
            $this->assertEquals([$test_stylist, $test_stylist2], $result);
        }

        function testSave()
        {
            //Arrange
            $name = "Bob";
            $test_stylist = new Stylist($name);
            $test_stylist->save();


            //Act
            $result = Stylist::getAll();

            //Assert
            $this->assertEquals($test_stylist, $result[0]);
        }

        function test_find()
        {
            //Arrange
            $name = "Bob";
            $name2 = "Harry";
            $test_stylist = new Stylist($name);
            $test_stylist->save();
            $test_stylist2 = new Stylist($name2);
            $test_stylist2->save();

            //Act
            $result = Stylist::find($test_stylist->getId());

            //Assert
            $this->assertEquals($test_stylist, $result);
        }

        function testUpdate()
        {
            //Arrange
            $name = "Bob";
            $id = null;
            $test_stylist = new Stylist($name, $id);
            $test_stylist->save();

            $new_name = "Harry";

            //Act
            $test_stylist->update($new_name);

            //Assert
            $this->assertEquals("Harry", $test_stylist->getName());
        }

        function testDelete()
        {
            //Arrange
            $name = "Bob";
            $id = null;
            $test_stylist = new Stylist($name, $id);
            $test_stylist->save();

            $name2= "Harry";
            $test_stylist2 = new Stylist($name2, $id);
            $test_stylist2->save();

            //Act
            $test_stylist->delete();

            //Assert
            $this->assertEquals([$test_stylist2], Stylist::getAll());
        }

        // function testGetClients()
        // {
        //
        //     //Arrange
        //     $name = "Bob";
        //     $id = null;
        //     $test_stylist = new Stylist($name, $id);
        //     $test_stylist->save();
        //
        //     $test_stylist_id = $test_stylist->getId();
        //
        //     $client_name = "Gertrude";
        //     $test_client = new Client($client_name, $test_stylist_id, $id);
        //     $test_client->save();
        //     // var_dump($test_client);
        //
        //     $client_name2 = "Betty";
        //     $test_client2 = new Client($client_name2, $test_stylist_id, $id);
        //     $test_client2->save();
        //     // var_dump($test_client2);
        //
        //     //Act
        //     $result = $test_stylist->getClients();
        //     echo "The result is: ";
        //     var_dump($result);
        //
        //     //Assert
        //     $this->assertEquals([$test_client, $test_client2], $result);
        // }


    }

?>
