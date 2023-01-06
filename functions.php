<?php 

function luck($number) 
{
  $result = mt_rand(1, 100);
    return $result <= $number;
}

?>