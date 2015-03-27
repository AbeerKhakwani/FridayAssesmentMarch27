<?php
Class Store
{
    private $name;
    private $id;
    function __construct($initial_name, $initial_id = null)
    {
        $this->name          = $initial_name;
        $this->id            = $initial_id;

    }
    function getName()
    {
        return $this->name;
    }
    function setName($new_name)
    {
        $this->name = (string) $new_name;
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
        $statement = $GLOBALS['DB']->query("INSERT INTO stores (name) VALUES ('{$this->getName()}') RETURNING id ;");
        $result= $statement->fetch(PDO::FETCH_ASSOC);
        $this->setId($result['id']);
    }

    static function getAll()
    {
    $returned_stores  = $GLOBALS['DB']->query("SELECT * FROM stores;");
    $stores=array();
        foreach($returned_stores as $store){
            $name=  $store['name'];
            $id=  $store['id'];
            $new_store=new Store($name,$id);
            array_push($stores,$new_store);
        }

    return $stores;
   }
     static function find($search_id){
          $found_store= null;
          $all_stores=Store::getAll();
          foreach($all_stores as $store){
              $store_id=$store->getId();
              if($store_id==$search_id){
                  $found_store= $store;}
      }
          return $found_store;
      }
      function update($new_shoe_name){

          $GLOBALS['DB']->exec("UPDATE store SET name='{$new_shoe_name}' WHERE id={$this->getId()};");
          $this->setName($new_shoe_name);
      }

      function delete(){

          $GLOBALS['DB']->exec("DELETE FROM stores * WHERE id= {$this->getId()}");


      }

      function addBrand($brand){
          

      }







   static function deleteAll()
   {
       $GLOBALS['DB']->exec("DELETE FROM stores *;");
   }









}


?>
