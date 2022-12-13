<?php

use Classes\Mage;
use Classes\Archer;
use Classes\Assassin;
use Classes\Knight;
use Classes\Paladin;

use Classes\Bow;
use Classes\Dagger;
use Classes\Hammer;
use Classes\Staff;
use Classes\Sword;

require_once('autoload.php');

$knight = new Knight();
$archer = new Archer();
$mage = new Mage();
$rogue = new Assassin();
$paladin = new Paladin();

$sword = new Sword();
$bow = new Bow();
$dagger = new Dagger();
$hammer = new Hammer();
$staff = new Staff();

// echo('Mage :' . $mage->getPhysicalDamages() . " " . $mage->getMagicalDamages() . PHP_EOL);
// echo('Paladin :'.$paladin->getPhysicalDamages() . " " . $paladin->getMagicalDamages() . PHP_EOL);
// echo('Knight :'.$knight->getPhysicalDamages() . " " . $knight->getMagicalDamages() . PHP_EOL);
// echo('Archer :'.$archer->getPhysicalDamages() . " " . $archer->getMagicalDamages() . PHP_EOL);
// echo('Rogue :'.$rogue->getPhysicalDamages() . " " . $rogue->getMagicalDamages() . PHP_EOL);

$characters = [$mage,$paladin,$knight,$archer,$rogue];

for($i = 0; $i < sizeof($characters); $i ++){
    $characters[$i]->setExp(0);
    $characters[$i]->setLevel(1);
}

    echo(" ". $characters[4]->affinityCheck($characters[4]->getAffinity(), $characters[0]->getAffinity()));
    echo($characters[3]->getLevel() . " a " . $characters[3]->getExp());


?>