<?php

namespace Classes;

use Classes\Character;

require_once('functions.php');

class Paladin extends Character
{
    //Paladin = 110 hp, 25 def, 10 ad, 10 ap
    public function __construct()
    {
        parent::__construct(
            'Uther the Lightbringer',
            health:110,
            defense:15,
            physicalDamages:10,
            magicalDamages:10,
            mana:100,
            exp:0,
            level:1,
            affinity:3, //Light
            cooldown:0
        );
    }

    public function getFirstSkillName():string {
        return "Hammer of Light";
    }
    public function getSecondSkillName():string {
        return "Judgement";
    }
    public function getBuffName():string {
        return "Holy Prayer";
    }

    public function manaCostFirstSkill(): int {
        return 40;
    }

    public function manaCostSecondSkill(): int {
        return 50;
    }

    public function manaCostBuff(): int {
        return 50;
    }

    public function first($target)
    {
        if((($this->physicalDamages + 12) - $target->defense) > 0){
            $target->health -= ($this->physicalDamages + 12 + $this->magicalDamages) - $target->defense;
            echo $this->name . " use Hammer of Light !" . PHP_EOL;
            $this->mana -= 40;
            echo $target->name . " lost " .  ($this->physicalDamages + 12 + $this->magicalDamages) - $target->defense . " life points" . PHP_EOL;
        }else {
            echo $target->name . ' lost ' . "0 life points" . PHP_EOL;
        }
    }

    public function second($target)
    {
        if((($this->physicalDamages + 16 + ($this->magicalDamages + 4)) - $target->defense) > 0){
            $target->health -= ($this->physicalDamages + 16 + ($this->magicalDamages + 4)) - $target->defense;
            $this->mana -= 50;
            echo $this->name . " use Judgement !" . PHP_EOL;
            echo $target->name . " lost " .  ($this->physicalDamages + 16 + ($this->magicalDamages + 4)) - $target->defense . " life points" . PHP_EOL;
        }else {
            echo $target->name . ' lost ' . "0 life points" . PHP_EOL;
        } 
    }

    public function buff()
    {
        if ($this->cooldown === 0) {
            $this->defense += 35;
            echo "Holy Prayer !\n" . PHP_EOL;
            echo $this->name . " stats increased for 2 turns!" . PHP_EOL;
            echo "\n";
            echo "Defense : " . $this->defense . "(+" . "35)" . PHP_EOL;
            $this->mana -= 50;
            $this->cooldown++;
        }
    }

    public function cancelBuff() {
        $this->cooldown = 0;
        $this->defense -= 35;
    }

}
