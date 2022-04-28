<?php 

require 'vendor/autoload.php';;

use Exads\ABTestData;
use Model\Design;

$abTest = new ABTestData(1);
$promotion = $abTest->getPromotionName();
$designs = $abTest->getAllDesigns();



$arrayDesignObjects = [];



foreach($designs as $design){
  
  $designObj = new Design($design['designId'], $design['designName'], $design['splitPercent']);
  
  for ( $i = 0 ; $i < $designObj->getSplitPercent() ; $i ++ ){
    array_push($arrayDesignObjects,$designObj);
  }
  
  
  
}


  $disgnToShow = rand(0,100);
  $disgnSelected = $arrayDesignObjects[$disgnToShow];

  echo $disgnSelected->getName();
?>