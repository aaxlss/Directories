<?php

namespace Model;

class Design {
  
    private $id;
    private $name;
    private $splitPercent;
    
    public function __construct($id, $name, $splitPercent){
      $this->id = $id;
      $this->name = $name;
      $this->splitPercent = $splitPercent;
    }
    
    
    public function getId(){
          return $this->id;
      }
  
      public function setId($id){
          $this->id = $id;
      }
  
      public function getName(){
          return $this->name;
      }
  
      public function setName($name){
          $this->name = $name;
      }
  
      public function getSplitPercent(){
          return $this->splitPercent;
      }
  
    
  }
  
?>