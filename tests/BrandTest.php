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
            Brand::deleteAll();
            Store::deleteAll();
         }
        //Initialize a Store with a brand and be able to get it back out of the object using getBrand().
        function testGetBrand()
        {
            //Arrange
            $brand = "HIST100";
            $test_brand = new Brand($brand);
            //No need to save here because we are communicating with the object only and not the database.
            //Act
            $result = $test_brand->getBrand();
            //Assert
            $this->assertEquals($brand, $result);
        }
        function testSetBrand()
        { //can I change the brand in the object with setBrand() after initializing it?
            //Arrange
            $brand = "HIST100";
            $test_brand = new Brand($brand);
            //No need to save here because we are communicating with the object only and not the database.
            //Act
            $test_brand->setBrand("Famous Footware");
            $result = $test_brand->getBrand();
            //Assert
            $this->assertEquals("Famous Footware", $result);
        }
        //Next, let's add the Id property to our Brand brand. Like any other property it needs a getter and setter.
        //Create a Brand with the id in the constructor and be able to get the id back out.
        function testGetId()
        {
            //Arrange

            $brand = "Famous Footware";
            $id=1;
            $test_brand = new Brand($brand,$id);
            //Act
            $result = $test_brand->getId();
            //Assert
            $this->assertEquals(1, $result);
        }
        //Create a Brand with the id in the constructor and be able to change its value, and then get the new id out.
        function testSetId()
        {
            //Arrange

            $brand = "Famous Footware";
            $test_brand = new Brand($brand);
            //Act
            $test_brand->setId(2);
            //Assert
            $result = $test_brand->getId();
            $this->assertEquals(2, $result);
        }
        //
        function testSave()
        {
            //Arrange
            $brand = "Prada";
            $test_brand = new Brand($brand);
            $test_brand->save();
            //Act
            $result = Brand::getAll();

            //Assert
            $this->assertEquals($test_brand, $result[0]);
        }
        //
        function testSaveSetsId()
        {
            //Arrange
            $brand = "Famous Footware";
            $test_brand = new Brand($brand);
            //Act
            //save it. Id should be assigned in database, then brandd in object.
            $test_brand->save();
            //Assert
            //That id in the object should be numeric (not null)
            $this->assertEquals(true, is_numeric($test_brand->getId()));
        }
        //READ - All categories
        //This method should return an array of all Brand objects from the categories table.
        // //Since it isn't specifically for only one Brand, it is for all, it should be a static method.
        function testGetAll()
        {
            //Arrange
            $brand = "Famous Footware";

            $test_brand = new Brand($brand);
            $test_brand->save();
            $name2 = "Epicodus PHP";

            $test_brand2 = new Brand($name2);
            $test_brand2->save();
            //Act
            $result = Brand::getAll();
            //Assert
            $this->assertEquals([$test_brand, $test_brand2], $result);
        }
        // //DELETE - All categories
        // //Since this also deals with more than one Brand it should be a static method.
        function testDeleteAll()
        {
            //Arrange
            //We need some categories saved into the database so that we can make sure our deleteAll method removes them all.
            $brand = "sHOE sTORE";
            $test_brand = new Brand($brand);
            $test_brand->save();
            $name2 = "Epicodus Ruby";

            $test_brand2 = new Brand($name2);
            $test_brand2->save();
            //Act
            //Delete categories.
            Brand::deleteAll();
            //Assert
            //Now when we call getAll, we should get an empty array because we deleted all categories.
            $result = Brand::getAll();
            $this->assertEquals([], $result);
        }
        function testFind()
        {
            //Arrange
            //Create and save 2 categories.
            $brand = "sHOE sTORE";

            $test_brand = new Brand($brand);
            $test_brand->save();
            $name2 = "Home Economics";

            $test_brand2 = new Brand($name2);
            $test_brand2->save();
            $result = Brand::find($test_brand->getId());
            $this->assertEquals($test_brand, $result);
        }
        function testUpdate()
        {
            //Arrange
            $brand = "sHOE sTORE";


            $test_brand = new Brand($brand);
            $test_brand->save();
            $new_name = "Home Economics";
            //Act
            $test_brand->update($new_name);
            //Assert
            $this->assertEquals("Home Economics", $test_brand->getBrand());
        }
        function testDeleteBrand()
        {
            //Arrange
            $brand = "sHOE sTORE";
            $test_brand = new Brand($brand);
            $test_brand->save();

            $name2 = "Home Economics";
            $test_brand2 = new Brand($name2);
            $test_brand2->save();
            //Act
            $test_brand->delete();
            //Assert
            $this->assertEquals([$test_brand2], Brand::getAll());
        }
        function testAddBrand()
        {
            //Arrange
            //We need a brand and a brand saved
            $brand = "sHOE sTORE";
            $test_brand = new Brand($brand);
            $test_brand->save();

            $name= "Drupal";
            $test_store = new Store($name);
            $test_store->save();

            $test_brand->addStore($test_store);
            $this->assertEquals($test_brand->getStores(), [$test_store]);
        }
        //Now we write a test for the getStores method since we need it to be able to test the Add Brand method.
        function testGetStores()
        {
            //Arrange
            //start with a brand
            $brand = "sHOE sTORE";
            $test_brand = new Brand($brand);
            $test_brand->save();

            $name= "Drupal";
            $test_store = new Store($name);
            $test_store->save();

            $name2= "Drupal";
            $test_store2 = new Store($name2);
            $test_store2->save();

            $test_brand->addStore($test_store);
            $test_brand->addStore($test_store2);
            //Assert
            //we should get both of them back when we call getStores on the test store.
            $this->assertEquals($test_brand->getStores(), [$test_store, $test_store2]);
        }
        //Deletes the ASSOCIATION between the brand and the course in the join table
            function testDeleteStores() {
              //Arrange
              $title = "Maths";
              $test_book = new Brand($title);
              $test_book->save();

              $author_name = "Dennis Lumberg";
              $test_author = new Store($author_name);
              $test_author->save();
              //Act
              $test_book->addStore($test_author);
              $test_book->delete();

              //Assert
              $this->assertEquals([], $test_author->getBrands());
            }
    }
?>
