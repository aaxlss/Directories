<?php
  $asciiArray = [];
  $minValue = 12; //min ascii value (,)
  $maxValue = 92; //max ascii value (|)
  $delteNumbers = 15; //mount of numbers to delete randomly
  
  $asciiArray = range($minValue, $maxValue); //Creating array from ascii 12 to ascii 92
 
  shuffle($asciiArray);//shuffling array
  
  do {
    $positionToDelete = rand(0, count($asciiArray)-1);//getting random number
    if(array_key_exists($positionToDelete, $asciiArray)){//validating if the position exists
      print "Deleting number". $asciiArray[$positionToDelete] ."\n";
      unset($asciiArray[$positionToDelete]);//removing value by key
      $delteNumbers--;//decreasion variable to finish the do while loop
    }
    
  }while ($delteNumbers > 0);
  
  $asciiArray = array_values($asciiArray);//reindexing values, keeping the random numbers
  
  /***
   * Function to search a value in a random array values
   * @param array  $asciiArray array with random values
   * @param integer $number value to search
   * @return boolean 
   ***/
  function findNumber($asciiArray,$number){
    $start = 0;
    $end = count($asciiArray) - 1;
    
    while($start <= $end){
    
      if( $asciiArray[$start] === $number || $asciiArray[$end] === $number){
        return true;
      }
      
      $start ++;
      $end --;
    }
    return false;
  }
  
  //searchin values from min value to max value
  for ($i = $minValue; $i <= $maxValue; $i++){
    $found = findNumber($asciiArray, $i);//calling function to know if the number is missinsg
    if(!$found){
      print "missing number $i --- ASCII value = ".chr($i)."\n";
    }
  }
  
?>