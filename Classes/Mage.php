<?php

namespace Classes;

use Classes\Character;

require_once('functions.php');

class Mage extends Character
{
    //Mage = 95 hp, 8 def, 0 ad, 18 ap
    public function __construct()
    {
        parent::__construct(
            'Kael\'thas Sunstrider',
            health:95,
            defense:8,
            physicalDamages:0,
            magicalDamages:18,
            mana:100,
            exp:0,
            level:1,
            affinity:1, //Fire
            cooldown:0
        );
    }

    public function getFirstSkillName():string {
        return "Meteor";
    }
    public function getSecondSkillName():string {
        return "Fire Tempest";
    }
    public function getBuffName():string {
        return "Phoenix Flame";
    }


    public function manaCostFirstSkill(): int {
        return 45;
    }

    public function manaCostSecondSkill(): int {
        return 30;
    }

    public function manaCostBuff(): int {
        return 70;
    }

    public function first($target)
    {
        if((($this->magicalDamages + 11) - ($target->defense)) > 0){
            $target->health -= (($this->magicalDamages + 11) - ($target->defense));
            $this->mana -= 45;
            echo "\e[32m" . $this->name . "\e[39m" . " use \e[35mMeteor !\e[39m" . PHP_EOL;
            echo "\e[31m" . $target->name . "\e[39m" . " lost " . "\e[31m" .(($this->magicalDamages + 11) - ($target->defense)) . " life points\e[39m" . PHP_EOL;
        }else {
            echo $target->name . ' lost ' . "\e[31m0 \e[39mlife points" . PHP_EOL;
        }   
    }

    public function second($target)
    {
        if((($this->magicalDamages + 15) - $target->defense) > 0){
            $target->health -= (($this->magicalDamages + 15) - $target->defense);
            echo "\e[32m" . $this->name . "\e[39m" . " use \e[35mFire Tempest \e[39m!" . PHP_EOL;
            $this->mana -= 30;
            echo "\e[31m" . $target->name .  "\e[39m" . " lost " . "\e[31m" . (($this->magicalDamages + 15) - $target->defense) . " life points\e[39m" . PHP_EOL;
        }else {
            echo $target->name . ' lost ' . "\e[31m0 life points\e[39m" . PHP_EOL;
        }  
    }

    public function buff()
    {
        if ($this->cooldown === 0) {
            $this->defense += 12;
            $this->magicalDamages += 10;
            $this->health += 15;
            $this->mana -= 70;
            echo "\e[35mPhoenix Flame \e[39m!\n" . PHP_EOL;
            echo $this->name . " stats increased for 3 turns!" . PHP_EOL;
            echo "\n";
            echo "Defense : " . $this->defense . "(\e[32m+" . "12\e[39m)" . PHP_EOL;
            echo "Health : " . $this->health . "(\e[32m+" . "15\e[39m)" . PHP_EOL;
            echo "Magical Damage : " . $this->magicalDamages . "(\e[32m+" . "10\e[39m)" . PHP_EOL;
            $this->cooldown++;
        }
    }

    public function cancelBuff() {
        $this->cooldown = 0;
        $this->setDefense($this->defense - 12);
        $this->setMagicalDamages($this->magicalDamages - 10);
        $this->setHealth($this->health - 15);
    }
}
