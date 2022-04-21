<?php

for ($i = 2; $i <= 100 ; $i++ ){
  
  $multiple = [];
  $textResult = '';
  
  for ($j = 2; $j <= 100; $j++){
    if($i % $j == 0){
      array_push($multiple, $j);
    }
  }
  
  if(count($multiple) <= 1 && $i != 2){
    $textResult = "[PRIME]\n";
  } else {
    $textResult = "multiple of [" . implode(",",$multiple) . "]\n";
  }
  echo "$i is $textResult";
} 
?>