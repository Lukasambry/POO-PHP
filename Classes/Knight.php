<?php

namespace Classes;

use Classes\Character;

require_once('functions.php');

class Knight extends Character
{
    //Knight = 105 hp, 13 def, 10 ad, 0 ap
    public function __construct()
    {
        parent::__construct(
            'Anduin Lothar',
            health: 105,
            defense: 13,
            physicalDamages: 10,
            magicalDamages: 0,
            mana: 100,
            exp: 0,
            level: 1,
            affinity: 0,
            cooldown: 0
        );
    }


    public function getFirstSkillName():string {
        return "Water Slash";
    }
    public function getSecondSkillName():string {
        return "Slice";
    }
    public function getBuffName():string {
        return "Parade";
    }

    public function manaCostFirstSkill(): int {
        return 60;
    }

    public function manaCostSecondSkill(): int {
        return 40;
    }

    public function manaCostBuff(): int {
        return 25;
    }

    public function first($target)
    {
        if((($this->physicalDamages + 15) - $target->defense) > 0){
            echo "\e[32m" . $this->name . "\e[39m" . " use \e[35mWater Slash \e[39m!" . PHP_EOL;
            $target->health -= ($this->physicalDamages + 15) - $target->defense;
            $this->mana -= 60;
            echo "\e[31m" . $target->name .  "\e[39m" . " lost " .  "\e[31m" . (($this->physicalDamages + 15) - $target->defense) . " life points\e[39m" . PHP_EOL;
        } else {
            echo "\e[31m" . $target->name . "\e[39m"  . ' lost ' . "\e[31m0 life points\e[39m" . PHP_EOL;
        } 
    }

    public function second($target)
    {
        $random = rand(20, 30);
        if((($this->physicalDamages + $random) - $target->defense) > 0){
            echo "\e[32m" . $this->name . "\e[39m" . " use \e[35mSlice \e[39m!" . PHP_EOL;
            $this->mana -= 40;
            $target->health -= (($this->physicalDamages + $random) - $target->defense);
            echo "\e[32m" . $target->name .  "\e[39m" . " lost " .  "\e[31m" . (($this->physicalDamages + $random) - $target->defense) . " life points\e[39m" . PHP_EOL;
        }else {
            echo "\e[31m" . $target->name . "\e[39m" . ' lost ' . "\e[31m0 life points" . PHP_EOL;
        }     
    }

    public function buff()
    {
        if ($this->cooldown === 0) {
            $this->defense += 15;
            $this->mana -= 25;
            echo "\e[35m" . "Parade !\n" . PHP_EOL;
            echo "\e[32m" . $this->name .  "\e[39m" . " defense increased for \e[35m3 \e[39mturns!" . PHP_EOL;
            echo "\n";
            echo "\e[32m↑  \e[39mDef : " . $this->defense . "(\e[32m+" . "15\e[39m)" . PHP_EOL;
            $this->cooldown++;
        }
    }

    public function cancelBuff() {
        $this->cooldown = 0;
        $this->setDefense($this->defense - 15);
    }
}
