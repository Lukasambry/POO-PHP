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

    cls();

    echo "\e[31m\e[1mWelcome to Bloodpath\e[0m\e[39m" . PHP_EOL;

    echo "\n";

    echo "\e[1mHere is a list of characters, make your choice !\e[0m" . PHP_EOL;

    echo "\n";

    echo "\e[1m1:\e[0m \e[0m\e[32mIllidan Stormrage (Assassin)\e[39m" . PHP_EOL;
    echo "\e[1m2:\e[0m \e[0m\e[32mSylvanas Windrunner (Archer)\e[39m" . PHP_EOL;
    echo "\e[1m3:\e[0m \e[0m\e[32mAnduin Lothar (Knight)\e[39m" . PHP_EOL;
    echo "\e[1m4:\e[0m \e[0m\e[32mKael'thas Sunstrider (Mage)\e[39m" . PHP_EOL;
    echo "\e[1m5:\e[0m \e[0m\e[32mUther the Lightbringer (Paladin)\e[39m" . PHP_EOL;

    echo "\n";

    echo "\e[1m6:\e[0m \e[31mExit\e[39m" . PHP_EOL;

    echo "\n";

    $characterChoice = readline("Chose your hero: ") . PHP_EOL;

    echo "\n";

switch ($characterChoice) {
    case 1:
        $you = $rogue;
        echo "\e[1m\e[35mHumm... So you chose " . $you->getName() . ". Be careful, it cuts !" . PHP_EOL;
        $choice = true;
        echo "\n";
        break;
    case 2:
        $you = $archer;
        echo "\e[1m\e[35mAll in finesse ! " . $you->getName() . " won't disappoint you." . PHP_EOL;
        $choice = true;
        echo "\n";
        break;
    case 3:
        $you = $knight;
        echo "\e[1m\e[35mYou chose " . $you->getName() . " ! He won't fall so easily !" . PHP_EOL;
        $choice = true;
        echo "\n";
        break;
    case 4:
        $you = $mage;
        echo "\e[1m\e[35mAs " . $you->getName() .  " often says, a fire is extinguished as quickly as life." . PHP_EOL;
        $choice = true;
        echo "\n";
        break;
    case 5:
        $you = $paladin;
        echo $you->getName() . " \e[1m\e[35mwill always be on the side of justice!" . PHP_EOL;
        $choice = true;
        echo "\n";
        break;
    case 6:
        echo "\e[1m\e[35mSo ? Are we scared ?" . PHP_EOL;
        $choice = true;
        echo "\n";
        die();
        break;
    default:
        echo "\e[1m\e[35mI don't understand your choice..." . PHP_EOL;
        echo "\n";
        echo "\e[1m\e[35mPlease Chose a hero" . PHP_EOL;
        echo "\n";
}
} while(!$choice);

echo "\e[0m\e[39m";

//Get a random character for enemy
do {
    $enemy = $characters[array_rand($characters)];
} while ($you->getName() == $enemy->getName());


$you->affinityCheck($you, $enemy);

sleep(2);

echo "\n";

echo "\e[1m" . $you->getName() . " vs " . $enemy->getName() . "\e[0m" . PHP_EOL;
sleep(2);

echo "\n";
echo "The war between hell and heaven is about to begin in..." . PHP_EOL;


for($i = 3; $i >= 1; $i--){
    sleep(1);
    echo $i . PHP_EOL;
}

echo "\n";

//Clear console
cls();

$alive = true;
$i = 0;
$youCd = 0;
$enemyCd = 0;

do {
    $i++;

    $haveMana = true;

    $yourTurn = true;

    if($you->getCooldown() == 1 || $you->getCooldown() == 2 || $you->getCooldown() == 3) {
        $youCd++;
    }
    if($youCd > 0){
        $you->setCooldown($youCd);
    }
    if($youCd == 4){
        $you->cancelBuff();
        $you->setCooldown(0);
        $youCd = 0;
    }

    if($enemy->getCooldown() == 1 || $enemy->getCooldown() == 2 || $enemy->getCooldown() == 3) {
        $enemyCd++;
    }
    if($enemyCd > 0){
        $enemy->setCooldown($enemyCd);
    }
    if($enemyCd == 4){
        $enemy->cancelBuff();
        $enemy->setCooldown(0);
        $enemyCd = 0;

    }

    echo "\n";

    


    do{
        cls();
        echo "---------- Round " . $i . "----------" . PHP_EOL;
        echo "\n";

        if($i > 1){
            echo "\e[7m  Buff information :  \e[0m " . PHP_EOL;
            echo "\n";
            echo "\e[31mEnemy \e[39m: ";
            if($enemy->getCooldown() == 0){
                echo "Nothing is active at the moment." . PHP_EOL;
            }else if ($enemy->getCooldown() == 1){
                echo $enemy->getBuffName() . " is still active" . PHP_EOL;
            }else if ($enemy->getCooldown() == 2){
                echo $enemy->getBuffName() . " is soon over" . PHP_EOL;
            }else if ($enemy->getCooldown() == 3){
                echo $enemy->getBuffName() . " will end next turn" . PHP_EOL;
            }
    
            echo "\e[92mYou \e[39m  : ";
            if($you->getCooldown() == 0){
                echo "Nothing is active at the moment." . PHP_EOL;
            }else if ($you->getCooldown() == 1){
                echo $you->getBuffName() . " is still active" . PHP_EOL;
            }else if ($you->getCooldown() == 2){
                echo $you->getBuffName() . " is soon over" . PHP_EOL;
            }else if ($you->getCooldown() == 3){
                echo $you->getBuffName() . " will end next turn" . PHP_EOL;
            }
    
            echo "\n";
        }
        
        echo "\e[1m(1)  " . "\e[0m" . "\e[33m" . $you->getFirstSkillName() . "  \e[39m(\e[34m-" . $you->manaCostFirstSkill() . " mana\e[39m)" .PHP_EOL;
        echo "\e[1m(2)  " . "\e[0m" . "\e[33m" . $you->getSecondSkillName() . "  \e[39m(\e[34m-" . $you->manaCostSecondSkill() . " mana\e[39m)" . PHP_EOL;
        echo "\e[1m(3)  " . "\e[0m" . "\e[33m" . $you->getBuffName(). "  \e[39m(\e[34m-" . $you->manaCostBuff() . " mana\e[39m)" . PHP_EOL;
        echo "\n";
        echo "\e[1m(4)  " . "\e[35mRest \e[39m(\e[34m+40 mana)" . PHP_EOL;
        echo "\e[1m\e[39m(5)  " . "\e[35mSleep \e[39m(\e[31m+30 hp\e[39m)" . PHP_EOL;
        echo "\n";
        echo "\e[39mYou     =>   Hp : " . "\e[31m" . $you->getHealth() . "   \e[39m  " . "Mana : " . "\e[34m" . $you->getMana() . "\e[39m" . PHP_EOL;
        echo "\e[39mEnemy   =>   Hp : " . "\e[31m" . $enemy->getHealth() . "  \e[39m   " . "Mana : " . "\e[34m" . $enemy->getMana() . "\e[39m" . PHP_EOL;

        echo "\n";

        if(!$haveMana){
            echo "\e[31mWARNING : You don't have enought mana for this...\e[39m" . PHP_EOL;
        }

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
                    $haveMana = false;
                    $yourTurn = true;
                }
                break;
            case 2:
                if($you->checkIfManaIsAvailable($you->manaCostSecondSkill(), $you->getMana())){
                    $you->second($enemy);
                    sleep(1);
                    $yourTurn = false;
                }else {
                    $haveMana = false;
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
                        echo "\n";
                        $yourTurn = true;
                    }
                }else {
                    $haveMana = false;
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
                    $haveMana = false;
                    $yourTurn = true;
                }
                break;
        }
    } while($yourTurn);

    $haveMana = true;

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
        echo "You : " . "The dead don't speak." . PHP_EOL;
        readline("(Enter a key to finish)") . PHP_EOL;
        die();
    }

    readline("Press enter to continue...") . PHP_EOL;

    echo "\n";

    echo "Your enemy's turn !" . PHP_EOL;

    sleep(1);

    echo "\n";

    $enemyTurn = true;
    
    //Enemy turn

    if($enemy->getHealth() < 30){
        if(rand(1, 2) == 1){
            echo $enemy->getName() . " : Arrrgh, i won't fall now !".PHP_EOL;
            echo $enemy->getName() . " use Sleep" . PHP_EOL;
            echo "\n";
            $enemy->sleep();
            $enemyTurn = false;
            sleep(1);
        }
    }

    if($enemyTurn){
        if(!$enemy->buffInProgress()){
            if($enemy->checkIfManaIsAvailable($enemy->manaCostBuff(), $enemy->getMana())){
                if(rand(1, 2) == 2){
                    $enemy->buff();
                    $enemyTurn = false;
                    sleep(1);
                }
            }
        }
    }

    if($enemyTurn){
        if (rand(1, 2) == 1) {
            if($enemy->checkIfManaIsAvailable($enemy->manaCostFirstSkill(), $enemy->getMana())){
                $enemy->first($you);
                $enemyTurn = false;
                sleep(1);
                echo "\n";
            }
        } else {
            if($enemy->checkIfManaIsAvailable($enemy->manaCostSecondSkill(), $enemy->getMana())){
                $enemy->second($you);
                $enemyTurn = false;
                sleep(1);
                echo "\n";
            }
        }
    }

    if($enemyTurn){
        echo $enemy->getName() . " don't have enough mana to perform this action..." . PHP_EOL;
        $enemy->rest() . PHP_EOL;
        echo "\n";
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
    //cls();

    
} while($alive);