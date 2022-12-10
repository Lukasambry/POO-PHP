<?php 

function luck($number) 
{
  $result = mt_rand(1, 100);
  if ($result <= $number)
  {
    return true;
  } else 
  {
    return false;
  }
}

?>