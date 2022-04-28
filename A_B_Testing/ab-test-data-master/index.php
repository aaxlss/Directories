<?php

require 'vendor/autoload.php';
use Exads\ABTestData;


class Test {

    private $abTest;
    private $promotion;
    private $designs;

    public function __construct()
    {
        $this->abTest = new ABTestData(1);
        $this->promotion = $this->abTest->getPromotionName();
        $this->designs = $this->abTest->getAllDesigns();    

        echo print_r($this->designs);
    
    }
}


$obj =  new Test();

?>