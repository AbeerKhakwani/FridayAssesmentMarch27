<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    require_once "src/Store.php";
    require_once "src/Brand.php";
    $DB = new PDO('pgsql:host=localhost;dbname=shoes_test');
  Class BrandTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
         {
             //Brand::deleteAll();
             Store::deleteAll();
         }
        //Initialize a Store with a brand and be able to get it back out of the object using getName().
        function testGetName()
        {
            //Arrange
            $brand = "HIST100";
            $test_store = new Brand($brand);
            //No need to save here because we are communicating with the object only and not the database.
            //Act
            $result = $test_store->getName();
            //Assert
            $this->assertEquals($brand, $result);
        }
        function testSetName()
        { //can I change the brand in the object with setName() after initializing it?
            //Arrange
            $brand = "HIST100";
            $test_store = new Brand($brand);
            //No need to save here because we are communicating with the object only and not the database.
            //Act
            $test_store->setName("Famous Footware");
            $result = $test_store->getName();
            //Assert
            $this->assertEquals("Famous Footware", $result);
        }
        //Next, let's add the Id property to our Brand store. Like any other property it needs a getter and setter.
        //Create a Brand with the id in the constructor and be able to get the id back out.
        function testGetId()
        {
            //Arrange

            $brand = "Famous Footware";
            $id=1;
            $test_store = new Brand($brand,$id);
            //Act
            $result = $test_store->getId();
            //Assert
            $this->assertEquals(1, $result);
        }
        //Create a Brand with the id in the constructor and be able to change its value, and then get the new id out.
        function testSetId()
        {
            //Arrange

            $brand = "Famous Footware";
            $test_store = new Brand($brand);
            //Act
            $test_store->setId(2);
            //Assert
            $result = $test_store->getId();
            $this->assertEquals(2, $result);
        }
       CREATE - save method stores all object data in brands table.
        function testSave()
        {
            //Arrange
            $brand = "Famous Footware";
            $test_store = new Brand($brand);
            $test_store->save();
            //Act
            $result = Brand::getAll();
            //Assert
            $this->assertEquals($test_store, $result[0]);
        }
        // //This test makes sure that after saving not only are the id's equal, they are not null.
        // function testSaveSetsId()
        // {
        //     //Arrange
        //     $brand = "Famous Footware";
        //     $test_store = new Brand($brand);
        //     //Act
        //     //save it. Id should be assigned in database, then stored in object.
        //     $test_store->save();
        //     //Assert
        //     //That id in the object should be numeric (not null)
        //     $this->assertEquals(true, is_numeric($test_store->getId()));
        // }
        // //READ - All categories
        // //This method should return an array of all Brand objects from the categories table.
        // // //Since it isn't specifically for only one Brand, it is for all, it should be a static method.
        // function testGetAll()
        // {
        //     //Arrange
        //     $brand = "Famous Footware";
        //
        //     $test_store = new Brand($brand);
        //     $test_store->save();
        //     $name2 = "Epicodus PHP";
        //
        //     $test_store2 = new Brand($name2);
        //     $test_store2->save();
        //     //Act
        //     $result = Brand::getAll();
        //     //Assert
        //     $this->assertEquals([$test_store, $test_store2], $result);
        // }
        // // //DELETE - All categories
        // // //Since this also deals with more than one Brand it should be a static method.
        // function testDeleteAll()
        // {
        //     //Arrange
        //     //We need some categories saved into the database so that we can make sure our deleteAll method removes them all.
        //     $brand = "sHOE sTORE";
        //     $test_store = new Brand($brand);
        //     $test_store->save();
        //     $name2 = "Epicodus Ruby";
        //
        //     $test_store2 = new Brand($name2);
        //     $test_store2->save();
        //     //Act
        //     //Delete categories.
        //     Brand::deleteAll();
        //     //Assert
        //     //Now when we call getAll, we should get an empty array because we deleted all categories.
        //     $result = Brand::getAll();
        //     $this->assertEquals([], $result);
        // }
        // function testFind()
        // {
        //     //Arrange
        //     //Create and save 2 categories.
        //     $brand = "sHOE sTORE";
        //
        //     $test_store = new Brand($brand);
        //     $test_store->save();
        //     $name2 = "Home Economics";
        //
        //     $test_store2 = new Brand($name2);
        //     $test_store2->save();
        //     $result = Brand::find($test_store->getId());
        //     $this->assertEquals($test_store, $result);
        // }
        // function testUpdate()
        // {
        //     //Arrange
        //     $brand = "sHOE sTORE";
        //
        //
        //     $test_store = new Brand($brand);
        //     $test_store->save();
        //     $new_name = "Home Economics";
        //     //Act
        //     $test_store->update($new_name);
        //     //Assert
        //     $this->assertEquals("Home Economics", $test_store->getName());
        // }
        // function testDeleteStore()
        // {
        //     //Arrange
        //     $brand = "sHOE sTORE";
        //
        //
        //     $test_store = new Brand($brand);
        //     $test_store->save();
        //     $name2 = "Home Economics";
        //
        //
        //     $test_store2 = new Brand($name2);
        //     $test_store2->save();
        //     //Act
        //     $test_store->delete();
        //     //Assert
        //     $this->assertEquals([$test_store2], Brand::getAll());
        // }
        // function testAddStudent()
        // {
        //     //Arrange
        //     //We need a store and a brand saved
        //     $brand = "sHOE sTORE";
        //
        //
        //     $test_store = new Brand($brand);
        //     $test_store->save();
        //     $brand= "Drupal";
        //
        //     $test_brand = new Brand($br);
        //     $test_brand->save();
        //     $test_store->addStudent($test_brand);
        //     $this->assertEquals($test_store->getStudents(), [$test_brand]);
        // }
    //     //Now we write a test for the getStudents method since we need it to be able to test the Add Brand method.
    //     function testGetStudents()
    //     {
    //         //Arrange
    //         //start with a store
    //         $brand = "Home Economics";
    //
    //
    //         $test_store = new Brand($brand);
    //         $test_store->save();
    //         //create 2 brands to assign to it.
    //
    //         $brand= "Dave";
    //
    //         $test_brand = new Brand($brand);
    //         $test_brand->save();
    //         $brand2 = "Sally";
    //
    //         $test_brand2 = new Brand($brand2);
    //         $test_brand2->save();
    //         //Act
    //         //add both brands to the store
    //         $test_store->addStudent($test_brand);
    //         $test_store->addStudent($test_brand2);
    //         //Assert
    //         //we should get both of them back when we call getStudents on the test store.
    //         $this->assertEquals($test_store->getStudents(), [$test_brand, $test_brand2]);
    //     }
    //     //Deletes the ASSOCIATION between the brand and the course in the join table
    //     function testDelete()
    //     {
    //         //Arrange
    //         $brand = "sHOE sTORE";
    //
    //         $test_course = new Brand($brand);
    //         $test_course->save();
    //         $brand2="Bojana";
    //
    //         $test_brand = new Brand($brand);
    //         $test_brand->save();
    //         //Act
    //         $test_course->addStudent($test_brand);
    //         $test_course->delete();
    //         var_dump($test_brand->getCourses());
    //         //Assert
    //         $this->assertEquals([], $test_brand->getCourses());
    //     }
    }
?>
