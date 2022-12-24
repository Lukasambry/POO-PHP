<?php

use Classes\Character;

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


echo $you->getName() . " vs " . $enemy->getName() . PHP_EOL;
sleep(1);
echo "\n";
echo "Le combat va commencer dans ..." . PHP_EOL;
sleep(1);
echo "3" . PHP_EOL;
sleep(1);
echo "2" . PHP_EOL;
sleep(1);
echo "1" . PHP_EOL;
sleep(1);
echo "\n";

$alive = true;
$i = 1;
do {

    echo "---------- Round " . $i . "----------" . PHP_EOL;
    echo "\n";
    $i++;

    sleep(1);

    if ($you->getHealth() <= 30) {
        $you->sleep();
        echo "Vos points de vies sont faible, vous utiliser Sleep" . PHP_EOL;
        sleep(1);
    } else {
        if (rand(1, 2) == 1) {
            $you->first($enemy);
            sleep(1);
            $you->levelUp();
            echo "\n";
        } else {
            $you->second($enemy);
            sleep(1);
            $you->levelUp();
            echo "\n";
        }
    }

    echo "\n";

    sleep(1);

    if ($enemy->getHealth() <= 30) {
        $enemy->sleep();
        echo "Les points de vies de " . $enemy->getName() .  " sont failbe, il utilise Sleep" . PHP_EOL;
        sleep(1);
    } else {
        if (rand(1, 2) == 1) {
            $enemy->first($you);
            sleep(1);
            $enemy->levelUp();
            sleep(1);
            echo "\n";
        } else {
            $enemy->second($you);
            sleep(1);
            $enemy->levelUp();
            sleep(1);
            echo "\n";
        }
    }

    sleep(1);


    echo "Vous (" . $you->getName() . ")" . " : " . $you->getHealth() . " Hp" . PHP_EOL;
    echo "Enemy (" . $enemy->getName() . ")" . " : " . $enemy->getHealth() . " Hp" . PHP_EOL;

    echo "\n";

    if ($enemy->getHealth() <= 0) {
        echo $enemy->getName() . " est mort..." . PHP_EOL;
        $alive = false;
    } else if ($you->getHealth() <= 0) {
        $alive = false;
        echo "Vous avez succombé de vos blessures..." . PHP_EOL;
    }

    sleep(1);
} while ($alive);



    // echo('Mage :' . $mage->getPhysicalDamages() . " " . $mage->getMagicalDamages() . PHP_EOL);
    // echo('Paladin :'.$paladin->getPhysicalDamages() . " " . $paladin->getMagicalDamages() . PHP_EOL);
    // echo('Knight :'.$knight->getPhysicalDamages() . " " . $knight->getMagicalDamages() . PHP_EOL);
    // echo('Archer :'.$archer->getPhysicalDamages() . " " . $archer->getMagicalDamages() . PHP_EOL);
    // echo('Rogue :'.$rogue->getPhysicalDamages() . " " . $rogue->getMagicalDamages() . PHP_EOL);


    //echo(" ". $characters[4]->affinityCheck($characters[4]->getAffinity(), $characters[0]->getAffinity())); Affinity
    //echo($characters[3]->getLevel() . " a " . $characters[3]->getExp()); Check lvl and exp
