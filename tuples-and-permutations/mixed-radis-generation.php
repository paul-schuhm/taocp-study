<?php
/*
   Algorithm M : Mixed radis generation. Visit all tuples of a mixed radis numeral system
   TAOCP, D. Knuth, Volume 4 : Generating All Tuples and Permutations, fascicle 2, page 2.
*/

/*Print each permutation visited*/
function visit(array $a, string $separator = " ", bool $reverse_representation = false): void{
  $tuple = [];

  //Discard first element (dummy)
  for($i = 1 ; $i < count($a) ; $i++)
    $tuple[] = $a[$i];

  if($reverse_representation)
    $tuple = array_reverse($tuple);

  printf("%s\n", implode($separator, $tuple));
}

/*
Exemples : 

// Hour:minut:second
$a = [ 0 , 0 , 0];
$m = [ 24, 60, 60] ;
$separator=":";
$reverse_representation = false;

// Day:Month
$a = [ 1 , 1];
$m = [ 13, 32] ;
$separator="/";
$reverse_representation = true;
*/

//1. Initialisation
$a = [ 1 , 1];
$m = [ 13, 32] ;
$separator="/";
$reverse_representation = true;

if(count($a) != count($m)){
  trigger_error("Representation and base vectors should be same length (one base by position)\n");
}

//Dummy digit and base for convienance (add index 0 and allows to end the algorithm)
array_unshift($a, 0);
array_unshift($m, 2);

$n = count($a) - 1;

while(true){
  //2. Visit
  visit($a, $separator, $reverse_representation);

  //3. Prepare to add
  $j = $n;

  //4. Carry if necessary
  while($a[$j] == $m[$j]-1){
    $a[$j] = 0 ;
    $j--;
  }
  //5. Increase, unless done
  if($j == 0)
    //End the algorithm. All tuples have been visisted.
    exit;
  else{
    $a[$j]++;
    //Go to 2.
  }
}
