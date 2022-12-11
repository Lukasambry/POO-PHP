<?php

use Classes\Knight;

require_once('autoload.php');

$knight = new Knight();

for($i = 0; $i < 2; $i++){
    $knight->parade();
 //   $knight->checkCooldown($knight);
}

?>