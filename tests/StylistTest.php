<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    //Dependencies
    require_once "src/Stylist.php";
    require_once "src/Client.php";

    //Tells the app how to access the database
    $server = 'mysql:host=localhost;=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StylistTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        }
            Stylist::deleteAll();
        }

    //Tests stylist to get the name
    function test_getStylistName()
    {
        //Arrange
        $stylist_name = "Ed Scissorhands";
        $test_stylist = Stylist(stylist_name);

        //Act
        $result = $test_Stylist->getStylistName();

        //Assert
        $this->assertEquals($stylist_name, $result);

    }

    //Tests stylist can get ID
    function test_getId()
    {
        //Arrange
        $stylist_name = "Ed Scissorhands";
        $id = 1;
        $test_Stylist = new Stylist($stylist_name, $id);

        //Act
        $result = $test_Stylist->getId();

        //Assert
        $this->assertEquals(true, is_numeric($result));
    }

    //Tests that stylist is saving to the database
    function test_save()
    {
        //Arrange
        $stylist_name = "Ed Scissorhands";
        $test_stylist = new Stylist($stylist_name);
        $test_stylist->save();

        //Act
        $result = Stylist::getAll();

        //Assert
        $this->assertEquals($test_stylist, $result[0]);

    }

    //Tests that stylist can getAll from database
    function test_getAll()
    {
        //Arrange
        $stylist_name = "Ed Scissorhands";
        $test_stylist = new Stylist($stylist_name);
        $test_stylist-> save();

        $stylist_name2 = "Flowbee";
        $test_stylist2 = new Stylist($stylist_name2);
        $test_stylist2-> save();

        //Act
        $result = Stylist::getAll();

        //Assert
        $this->assertEquals([$test_stylist, $test_stylist2], $result);
    }

    //Tests that stylist deletesAll from the database
    function test_deleteAll()
    {
        //Arrange
        $stylist_name = "Ed Scissorhands";
        $test_stylist = new Stylist($stylist_name);
        $test_stylist-> save();

        $stylist_name2 = "Flowbee";
        $test_stylist2 = new Stylist($stylist_name2);
        $test_stylist2-> save();

        //Act
        $result = Stylist::deleteAll();
        $result = Stylist::getAll();

        //Assert
        $this->assertEquals([], $result);
    }

    //Test that stylist can find id in the database
    function test_find()
    {
        //Arrange
        $stylist_name = "Ed Scissorhands";
        $test_stylist = new Stylist($stylist_name);
        $test_stylist-> save();
        $stylist_name2 = "Flowbee";
        $test_stylist2 = new Stylist($stylist_name2);
        $test_stylist2-> save();
        //Act
        $result = Stylist::find($test_stylist->getId());
        //Assert
        $this->assertEquals($test_stylist, $result);
    }

    //Tests that stylist can update entries in the database
    function test_update()
    {
        //Arrange
        $stylist_name = "Ed Scissorhands";
        $id = null;
        $test_stylist = new Stylist($stylist_name, $id);
        $test_stylist->save();
        $new_name = "Flowbee";
        //Act
        $test_stylist->update($new_name);
        //Assert
        $this->assertEquals("Flowbee", $test_stylist->getStylistName());
    }

    //Tests that stylist can delete entries from the database
    function test_delete()
    {
         //Arrange
         $stylist_name = "Ed Scissorhands";
         $id = null;
         $test_stylist = new Stylist($stylist_name);
         $test_stylist-> save();
         $stylist_name2 = "Flowbee";
         $test_stylist2 = new Stylist($stylist_name2);
         $test_stylist2-> save();
         //Act
         $test_stylist->delete();
         //Assert
         $this->assertEquals([$test_stylist2], Stylist::getAll());
    }

  }
?>
