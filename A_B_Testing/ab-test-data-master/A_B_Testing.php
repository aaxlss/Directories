<?php 

require 'vendor/autoload.php';;

use Exads\ABTestData;
use Model\Design;

$abTest = new ABTestData(1);// Creating Object using number promotion id as aparameter
$promotion = $abTest->getPromotionName(); //Getting Promotion's name
$designs = $abTest->getAllDesigns(); //Getting all the existing designs from the promotion

$arrayDesignObjects = [];

//Iterating every disign from $designs variable
foreach($designs as $design){
  
  $designObj = new Design($design['designId'], $design['designName'], $design['splitPercent']);//Creating new Design Object to malipulate its information
  
  //this loop will help to store every design with the percentage that must be showed to the final user
  for ( $i = 0 ; $i < $designObj->getSplitPercent() ; $i ++ ){
    array_push($arrayDesignObjects,$designObj);
  }
  
}


  $disgnToShow = rand(0,100); // Creating a random number between 0 and 100
  $disgnSelected = $arrayDesignObjects[$disgnToShow]; //Using the random number, it will get the object from the previous array

  echo $disgnSelected->getName();//Showing the selected object from the array;
?>