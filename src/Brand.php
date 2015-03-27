<?php
Class   Brand
{
    private $brand;
    private $id;
    function __construct($initial_brand, $initial_id = null)
    {
        $this->brand          = $initial_brand;
        $this->id            = $initial_id;

    }
    function getName()
    {
        return $this->brand;
    }
    function setName($new_brand)
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

}


?>
