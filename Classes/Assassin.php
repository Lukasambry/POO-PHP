<?php
namespace Classes;

use Classes\Character;
require_once('functions.php');

class Paladin extends Character
{
    //Assassin = 90 hp, 15 def, 20 ad, 0 ap, 90 mana (5 mana regen / tours)
    public function __construct()
    {
        parent::__construct(
            'Illidan Stormrage',
            health:90,
            defense:15,
            physicalDamages:20,
            magicalDamages:0,
            mana:90,
            exp:0,
            level:1,
            affinity:4, //Light
            cooldown:0
        );

    }

    public function ambush($target)
    {
        $this->physicalDamages ? 35 : 30;
        $target->health -= $this->physicalDamages;
        $this->mana -= 45;
        echo "Ambush !\n";  
    }

    public function eviserate($target)
    {
        $this->physicalDamages = 25;
        $target->health -= $this->physicalDamages;
        $this->mana -= 30;
        echo "Eviserate !\n";   
    }

    public function stealth()
    {
        if($this->cooldown === 0){
            $this->physicalDamages += 10;
            if(luck(10)){
                $this->physicalDamages *= 2;
                echo("Dodge" . PHP_EOL); //cf Ticket Trello
                return 1;
            } return parent::getDefense();
            $this->mana -= 20;
            echo "Stealth !\n" . PHP_EOL;
            $this->cooldown++;
        } else if($this->cooldown === 1){
            $this->cooldown++;
            echo 'Stealth is still active' . PHP_EOL;
        } else if($this->cooldown === 2){
            echo 'Stealth is finished' . PHP_EOL;
            $this->cooldown = 0;
            $this->physicalDamages -= 10;
        }
    }

    public function checkCooldown($target) {
        if($target->cooldown != 0){
            $target->stealth(); // if true, the cooldown is active and need incrementation
            return false;
        } else if($target->cooldown == 0){
            return true;
        }
    }  
}
