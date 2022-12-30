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


//Set level 1 
for ($i = 0; $i < sizeof($characters); $i++) {
    $characters[$i]->setExp(0);
    $characters[$i]->setLevel(1);
}

//Clear console function
function cls()                                                                                                             
{
    print("\033[2J\033[;H");
}

//Give Weapon
$knight->giveWeapon($sword);
$archer->giveWeapon($bow);
$mage->giveWeapon($staff);
$rogue->giveWeapon($dagger);
$paladin->giveWeapon($hammer);

$choice = false;


do {

echo "1: Illidan Stormrage (Assassin)" . PHP_EOL;
echo "2: Sylvanas Windrunner (Archer)" . PHP_EOL;
echo "3: Anduin Lothar (Knight)" . PHP_EOL;
echo "4: Kael\'thas Sunstrider (Mage)" . PHP_EOL;
echo "5: Uther the Lightbringer (Paladin)" . PHP_EOL;

echo "\n";

echo "6: Exit" . PHP_EOL;

echo "\n";

$characterChoice = readline('Chose your hero: ') . PHP_EOL;

echo "\n";

switch ($characterChoice) {
    case 1:
        $you = $rogue;
        echo "Humm... So you chose " . $you->getName() . ". Be careful, it cuts !" . PHP_EOL;
        $choice = true;
        echo "\n";
        break;
    case 2:
        $you = $archer;
        echo "All in finesse ! " . $you->getName() . " won't disappoint you." . PHP_EOL;
        $choice = true;
        echo "\n";
        break;
    case 3:
        $you = $knight;
        echo "You chose " . $you->getName() . " ! He won't fall so easily !" . PHP_EOL;
        $choice = true;
        echo "\n";
        break;
    case 4:
        $you = $mage;
        echo "As " . $you->getName() .  " often says, a fire is extinguished as quickly as life." . PHP_EOL;
        $choice = true;
        echo "\n";
        break;
    case 5:
        $you = $paladin;
        echo $you->getName() . " will always be on the side of justice!" . PHP_EOL;
        $choice = true;
        echo "\n";
        break;
    case 6:
        echo "So ? Are we scared ?" . PHP_EOL;
        $choice = true;
        echo "\n";
        die();
        break;
    default:
        echo "I don't understand your choice..." . PHP_EOL;
        echo "\n";
        echo "Please Chose a hero" . PHP_EOL;
        echo "\n";
}
} while(!$choice);

//Get a random character for enemy
do {
    $enemy = $characters[array_rand($characters)];
} while ($you->getName() == $enemy->getName());

$you->affinityCheck($you, $enemy);

sleep(1);

echo "\n";

echo $you->getName() . " vs " . $enemy->getName() . PHP_EOL;
sleep(1);
echo "\n";
echo "The war between hell and heaven is about to begin in..." . PHP_EOL;


// for($i = 3; $i >= 1; $i--){
//     sleep(1);
//     echo $i . PHP_EOL;
// }

echo "\n";

//Clear console
cls();

$alive = true;
$i = 1;

do {
    echo "---------- Round " . $i . "----------" . PHP_EOL;
    echo "\n";

    if($i > 1){
        echo "\e[7mBuff information :\e[0m " . PHP_EOL;
        echo "\n";
        echo "\e[31mEnemy \e[39m: ";
        $enemy->incCooldown();
        echo "\n";
        echo "\e[92mYou \e[39m: ";
        $you->incCooldown() . PHP_EOL;

        echo "\n";
    }
    
    $i++;
    
    $yourTurn = true;
    do{
        
        echo "\e[1m(1)  " . "\e[0m" . "\e[35m" . $you->getFirstSkillName() . "  \e[39m(\e[34m-" . $you->manaCostFirstSkill() . " mana\e[39m)" .PHP_EOL;
        echo "\e[1m(2)  " . "\e[0m" . "\e[35m" . $you->getSecondSkillName() . "  \e[39m(\e[34m-" . $you->manaCostSecondSkill() . " mana\e[39m)" . PHP_EOL;
        echo "\e[1m(3)  " . "\e[0m" . "\e[36m" . $you->getBuffName(). "  \e[39m(\e[34m-" . $you->manaCostBuff() . " mana\e[39m)" . PHP_EOL;
        echo "\n";
        echo "\e[1m(4)  " . "Rest (+40 mana)" . PHP_EOL;
        echo "\e[1m(5)  " . "Sleep (+30 hp, -5 mana)" . PHP_EOL;
        echo "\n";
        echo "You     =>   Hp : " . $you->getHealth() . "     " . "Mana : " . $you->getMana() . PHP_EOL;
        echo "Enemy   =>   Hp : " . $enemy->getHealth() . "     " . "Mana : " . $enemy->getMana() . PHP_EOL;

        echo "\n";

        $action = readline('It\'s your turn, what do you want to do ?  ') . PHP_EOL;

        echo "\n";

        switch($action){
            case 1:
                if($you->checkIfManaIsAvailable($you->manaCostFirstSkill(), $you->getMana())){
                    $you->first($enemy);
                    sleep(1);
                    $yourTurn = false;
                }else {
                    $yourTurn = true;
                }
                break;
            case 2:
                if($you->checkIfManaIsAvailable($you->manaCostSecondSkill(), $you->getMana())){
                    $you->second($enemy);
                    sleep(1);
                    $yourTurn = false;
                }else {
                    $yourTurn = true;
                }
                break;
            case 3:
                if($you->checkIfManaIsAvailable($you->manaCostBuff(), $you->getMana())){
                    if(!$you->buffInProgress()){
                        $you->buff();
                        sleep(1);
                        $yourTurn = false;
                    } else if($you->buffInProgress()){
                        cls();
                        echo $you->getBuffName() . " is still active" . PHP_EOL;
                        sleep(1);
                        echo "\n";
                        $yourTurn = true;
                    }
                }else {
                    $yourTurn = true;
                }
                break;
            case 4:
                $you->rest();
                sleep(1);
                $yourTurn = false;
                break;
            case 5:
                if($you->checkIfManaIsAvailable(5, $you->getMana())){
                    $you->sleep();
                    sleep(1);
                    $yourTurn = false;
                }else {
                    $yourTurn = true;
                }
                break;
        }
    } while($yourTurn);

    echo "\n";

    $you->levelUp();

    $next = false;

    if($enemy->getHealth() <= 0){
        "Congratulation warrior ! You won against " . $enemy->getName() . PHP_EOL;
        sleep(2);
        echo "\n";
        echo $enemy->getName() . " : " . " Arrrghhhh... Ho.. hav.. y.., what powe.." . PHP_EOL;
        sleep(2);
        echo "\n";
        echo "You : " . "The dead don't speak.";
        readline("(Enter a key to finish)") . PHP_EOL;
        die();
    }

    readline("Press enter to continue...") . PHP_EOL;

    echo "\n";

    echo "Your enemy's turn !" . PHP_EOL;

    sleep(1);

    echo "\n";

    //If the enemy hp is below 30, recover hp
    if ($enemy->getHealth() <= 30) {
        echo $enemy->getName() . " use Sleep" . PHP_EOL;
        echo "\n";
        $enemy->sleep();
        sleep(1);
    } else { // We check if there no buff in
        if(!$enemy->buffInProgress()){
            if($enemy->checkIfManaIsAvailable($enemy->manaCostBuff(), $enemy->getMana())){
                $enemy->buff();
                sleep(1);
            }
        } else {
            if (rand(1, 2) == 1) {
                if($enemy->checkIfManaIsAvailable($enemy->manaCostFirstSkill(), $enemy->getMana())){
                    $enemy->first($you);
                    sleep(1);
                    echo "\n";
                }
            } else if($enemy->checkIfManaIsAvailable($enemy->manaCostSecondSkill(), $enemy->getMana())) {
                $enemy->second($you);
                sleep(1);
                echo "\n";
            } else {
                $enemy->rest();
            }
        }

    }

    if($you->getHealth() <= 0){
        echo "You succumbed to your injuries...";
        sleep(2);
        echo "\n";
        echo "You : Don't think it's all over now....." . PHP_EOL;
        sleep(2);
        echo "\n";
        echo $enemy->getName() . " : " . "Hum... I thought I heard someone talking to me" . PHP_EOL;
        echo "\n";
        sleep(2);
        echo $enemy->getName() . " : Oh, is that you? Are you still not dead?" . PHP_EOL;
        echo "\n";
        readline("Press enter to continue...") . PHP_EOL;
        die();
    }

    //Give exp to enemy at end of his turn
    $enemy->levelUp();

    echo "\n";

    sleep(1);

    //Add mana each turn
    $enemy->addMana(10);
    $you->addMana(10);

    readline("Press enter to continue...") . PHP_EOL;

    //Clear console
    cls();

    
} while($alive);





//     sleep(1);


//     echo "Vous (" . $you->getName() . ")" . " : " . $you->getHealth() . " Hp" . PHP_EOL;
//     echo "Enemy (" . $enemy->getName() . ")" . " : " . $enemy->getHealth() . " Hp" . PHP_EOL;

//     echo "\n";

//     if ($enemy->getHealth() <= 0) {
//         echo $enemy->getName() . " est mort..." . PHP_EOL;
//         $alive = false;
//     } else if ($you->getHealth() <= 0) {
//         $alive = false;
//         echo "Vous avez succombé de vos blessures..." . PHP_EOL;
//     }

//     sleep(1);
// } while ($alive);



    // echo('Mage :' . $mage->getPhysicalDamages() . " " . $mage->getMagicalDamages() . PHP_EOL);
    // echo('Paladin :'.$paladin->getPhysicalDamages() . " " . $paladin->getMagicalDamages() . PHP_EOL);
    // echo('Knight :'.$knight->getPhysicalDamages() . " " . $knight->getMagicalDamages() . PHP_EOL);
    // echo('Archer :'.$archer->getPhysicalDamages() . " " . $archer->getMagicalDamages() . PHP_EOL);
    // echo('Rogue :'.$rogue->getPhysicalDamages() . " " . $rogue->getMagicalDamages() . PHP_EOL);


    //echo(" ". $characters[4]->affinityCheck($characters[4]->getAffinity(), $characters[0]->getAffinity())); Affinity
    //echo($characters[3]->getLevel() . " a " . $characters[3]->getExp()); Check lvl and exp
