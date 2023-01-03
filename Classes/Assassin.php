<?php

namespace Classes;

use Classes\Character;

require_once('functions.php');

class Assassin extends Character
{
    //Assassin = 90 hp, 10 def, 17 ad, 0 ap
    public function __construct()
    {
        parent::__construct(
            'Illidan Stormrage',
            health: 90,
            defense: 10,
            physicalDamages: 17,
            magicalDamages: 0,
            mana: 90,
            exp: 0,
            level: 1,
            affinity: 4, //Dark
            cooldown: 0
        );
    }

    public function getFirstSkillName():string {
        return "Ambush";
    }

    public function getSecondSkillName():string {
        return "Eviserate";
    }

    public function getBuffName():string {
        return "Stealth";
    }

    public function manaCostFirstSkill(): int {
        return 40;
    }

    public function manaCostSecondSkill(): int {
        return 50;
    }

    public function manaCostBuff(): int {
        return 20;
    }

    public function first($target)
    {
            $this->mana -= 45;
            echo $this->name . " use Ambush !" . PHP_EOL;
            if((($this->physicalDamages + 14) - $target->defense) > 0){
                echo $target->name . ' lost ' . ($this->physicalDamages + 14) - $target->defense . " life points" . PHP_EOL;
                $target->health -= ($this->physicalDamages + 14) - $target->defense;
            } else {
                echo $target->name . ' lost ' . "0 life points" . PHP_EOL;
            }
            
    }

    public function second($target)
    {
        $this->mana -= 30;
        echo $this->name . " use Eviserate !" . PHP_EOL;
        if((($this->physicalDamages + 20) - $target->defense) > 0){
            $target->health -= (($this->physicalDamages + 20) - $target->defense);
            echo $target->name . ' lost ' . (($this->physicalDamages + 20) - $target->defense) . " life points" . PHP_EOL;
        } else {
            echo $target->name . ' lost ' . "0 life points" . PHP_EOL;
        }      
    }

    public function buff()
    {
        if ($this->cooldown === 0) {
            $this->physicalDamages += 10;
            $this->defense += 8;
            $this->health += 10;
            $this->mana -= 20;
            echo "Stealth !\n" . PHP_EOL;
            echo $this->name . " stats increased for 3 turns!" . PHP_EOL;
            echo "\n";
            echo "Defense : " . $this->defense . "(\e[33m+" . "8\e[39m)" . PHP_EOL;
            echo "Health : " . $this->health . "(\e[31m+" . "10\e[39m)" . PHP_EOL;
            echo "Physical Damage : " . $this->physicalDamages . "(+" . "10)" . PHP_EOL;
            $this->cooldown++;
        }
    }

    public function cancelBuff() {
        $this->cooldown = 0;
        $this->setPhysicalDamages($this->physicalDamages - 10);
        $this->setDefense($this->defense - 8);
        $this->setHealth($this->health - 10);
    }
}
