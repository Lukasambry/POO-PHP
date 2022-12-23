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


$characters = [$mage, $paladin, $knight, $archer, $rogue];

//Get a random character for you & enemy
do {
    $you = $characters[array_rand($characters)];
    $enemy = $characters[array_rand($characters)];
} while ($you->getName() == $enemy->getName());

//Set level 1 
for ($i = 0; $i < sizeof($characters); $i++) {
    $characters[$i]->setExp(0);
    $characters[$i]->setLevel(1);
}

//Give Weapon
$knight->giveWeapon($sword);
$archer->giveWeapon($bow);
$mage->giveWeapon($staff);
$rogue->giveWeapon($dagger);
$paladin->giveWeapon($hammer);


// echo $you->getName() . " vs " . $enemy->getName() . PHP_EOL;
// echo "Le combat va commencer !" . PHP_EOL;

$yourSkills = get_class_methods($you);
$enemySkill =  get_class_methods($enemy);

echo "Vous êtes " . $you->getName() . PHP_EOL;
echo $yourSkills[1] . PHP_EOL;
echo $yourSkills[2] . PHP_EOL;
echo $yourSkills[3] . PHP_EOL;

//$you->first($target);

do {
} while (!$you->isAlive() || !$enemy->isAlive());



    // echo('Mage :' . $mage->getPhysicalDamages() . " " . $mage->getMagicalDamages() . PHP_EOL);
    // echo('Paladin :'.$paladin->getPhysicalDamages() . " " . $paladin->getMagicalDamages() . PHP_EOL);
    // echo('Knight :'.$knight->getPhysicalDamages() . " " . $knight->getMagicalDamages() . PHP_EOL);
    // echo('Archer :'.$archer->getPhysicalDamages() . " " . $archer->getMagicalDamages() . PHP_EOL);
    // echo('Rogue :'.$rogue->getPhysicalDamages() . " " . $rogue->getMagicalDamages() . PHP_EOL);


    //echo(" ". $characters[4]->affinityCheck($characters[4]->getAffinity(), $characters[0]->getAffinity())); Affinity
    //echo($characters[3]->getLevel() . " a " . $characters[3]->getExp()); Check lvl and exp
