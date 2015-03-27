<?php
Class Brand
{
    private $brand;
    private $id;
    function __construct($initial_brand, $initial_id = null)
    {
        $this->brand          = $initial_brand;
        $this->id            = $initial_id;

    }
    function getBrand()
    {
        return $this->brand;
    }
    function setBrand($new_brand)
    {
        $this->brand = (string) $new_brand;
    }
    function getId()
    {
        return $this->id;
    }
    function setId($new_id)
    {
        $this->id = (int) $new_id;
    }


    function save(){

        $statement = $GLOBALS['DB']->query("INSERT INTO brands (brand) VALUES ('{$this->getBrand()}') RETURNING id ;");
        $result= $statement->fetch(PDO::FETCH_ASSOC);
        $this->setId($result['id']);
    }

    static function getAll()
    {
    $returned_brands  = $GLOBALS['DB']->query("SELECT * FROM brands;");
    $brands=array();
        foreach($returned_brands as $brand){
            $brand_name= $brand['brand'];
            $id=  $brand['id'];
            $new_brand=new Brand($brand_name,$id);
            array_push($brands,$new_brand);
        }

    return $brands;
   }


   static function find($search_id){
        $found_brand= null;
        $all_brands=Brand::getAll();
        foreach($all_brands as $brand){
            $brand_id=$brand->getId();
            if($brand_id==$search_id){
                $found_brand= $brand;}
    }
        return $found_brand;
    }
    function update($new_brand_name){
        $GLOBALS['DB']->exec("UPDATE brands SET brand={$new_brand_name} WHERE id={$this->getId()};");
        $this->setBrand($new_brand_name);

    }

    function delete(){
        $GLOBALS['DB']->exec("DELETE FROM brands * WHERE id={$this->getId()};");
        $GLOBALS['DB']->exec("DELETE FROM stores_brands * WHERE brand_id={$this->getId()};");


    }

    function addStore($store){

        $GLOBALS['DB']->exec("INSERT INTO stores_brands (brand_id , store_id) VALUES ({$this->getId()}, {$store->getId()});");

    }


    function getStores(){

          $returned_stores=$GLOBALS['DB']->query("SELECT stores.* FROM
           brands JOIN stores_brands ON (brands.id = stores_brands.brand_id)
           JOIN stores ON (stores_brands.store_id = stores.id)
           WHERE brands.id = {$this->getId()};");

           $stores=array();

           foreach($returned_stores as $store){
               $store_name=$store['name'];

               $store_id=$store['id'];
               $new_store=new Store($store_name,$store_id);
               array_push($stores, $new_store);
           }

           return $stores;
       }


      static function deleteAll()
   {
       $GLOBALS['DB']->exec("DELETE FROM brands *;");
   }

}


?>
