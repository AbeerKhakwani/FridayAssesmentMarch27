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


      static function deleteAll()
   {
       $GLOBALS['DB']->exec("DELETE FROM brands *;");
   }

}


?>
