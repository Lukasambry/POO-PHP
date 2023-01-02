<?php

namespace Classes;

use Classes\Character;

require_once('functions.php');

class Archer extends Character
{
    //Archer = 100 hp, 17 def, 12 ad, 0 ap
    public function __construct(
        public int $arrows = 10,
    ) {
        parent::__construct(
            'Sylvanas Windrunner',
            health: 98,
            defense: 9,
            physicalDamages: 12,
            magicalDamages: 0,
            mana: 100,
            exp: 0,
            level: 1,
            affinity: 2, //Wind
            cooldown: 0,
        );
    }

    public function getFirstSkillName():string {
        return "Arcane Shot";
    }
    public function getSecondSkillName():string {
        return "Triple Shot";
    }
    public function getBuffName():string {
        return "Focus";
    }

    public function manaCostFirstSkill(): int {
        return 25;
    }

    public function manaCostSecondSkill(): int {
        return 60;
    }

    public function manaCostBuff(): int {
        return 40;
    }

    public function first($target)
    {
        if ($this->arrows <= 0) {
            echo $this->name . " N'a plus de flèche !\n" . PHP_EOL;
            $this->buff();
            return $this->name . " use Focus !" . PHP_EOL;
        }else {
            echo $this->name . " use Arcane Shot !" . PHP_EOL;
            $this->mana -= 25;
            $this->arrows -= 1;
            if((($this->physicalDamages + 12) - $target->defense) > 0){
                echo $target->name . " lost " . (($this->physicalDamages + 12) - $target->defense) . " life points" . PHP_EOL;
                $target->health -= (($this->physicalDamages + 12) - $target->defense);
            } else {
                echo $target->name . ' lost ' . "0 life points" . PHP_EOL;
            } 
        }
    }

    public function second($target)
    {
        if ($this->arrows <= 0) {
            echo $this->name . " don't have any arrows left !" . PHP_EOL;
            $this->buff();
            return $this->name . " use Focus !" . PHP_EOL;
        } else {
            $this->mana -= 60;
            $this->arrows -= 1;
            echo $this->name . " use Triple Shot ! \n" . PHP_EOL;
            if((($this->physicalDamages + 25) - $target->defense) > 0){
                $target->health -= (($this->physicalDamages + 25) - $target->defense);
                echo $target->name . " lost " . (($this->physicalDamages + 25) - $target->defense) . " life points" . PHP_EOL;
            }else {
                echo $target->name . ' lost ' . "0 life points" . PHP_EOL;
            } 
        }
    }

    public function buff()
    {
        if ($this->cooldown === 0) {
            $this->mana -= 40;
            $this->arrows += 5;
            $this->physicalDamages += 10;
            $this->defense += 8;
            echo "Focus !\n" . PHP_EOL;
            echo $this->name . " stats increased for 2 turns!" . PHP_EOL;
            echo "\n";
            echo "Defense : " . $this->defense . "(+" . "8)" . PHP_EOL;
            echo "Arrow : " . $this->arrows . "(+" . "5)" . PHP_EOL;
            echo "Physical Damage : " . $this->physicalDamages . "(+" . "10)" . PHP_EOL;
            $this->cooldown++;
        }
    }

    public function cancelBuff() {
        $this->cooldown = 0;
        $this->defense -= 8;
        $this->physicalDamages -= 10;
    }
}
