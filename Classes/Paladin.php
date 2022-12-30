<?php

namespace Classes;

use Classes\Character;

require_once('functions.php');

class Paladin extends Character
{
    //Paladin = 110 hp, 25 def, 10 ad, 10 ap, 120 mana (5 mana regen / tour)
    public function __construct()
    {
        parent::__construct(
            'Uther the Lightbringer',
            health: 110,
            defense: 17,
            physicalDamages: 10,
            magicalDamages: 10,
            mana: 120,
            exp: 0,
            level: 1,
            affinity: 3, //Light
            cooldown: 0
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
        return 60;
    }

    public function manaCostBuff(): int {
        return 50;
    }

    public function first($target)
    {
        $target->health -= ($this->physicalDamages + 12) - $target->defense;
        $this->mana -= 40;
        echo $this->name . " utilise Hammer of Light !" . PHP_EOL;
        echo $target->name . " a perdu " .  ($this->physicalDamages + 12) - $target->defense . " points de vies" . PHP_EOL;
    }

    public function second($target)
    {
        $target->health -= ($this->physicalDamages + 10) - $target->defense;
        $this->mana -= 60;
        echo $this->name . " utilise Judgement !" . PHP_EOL;
        echo $target->name . " a perdu " .  ($this->physicalDamages + 10) - $target->defense . " points de vies" . PHP_EOL;
    }

    public function buff()
    {
        if ($this->cooldown === 0) {
            $this->defense += 50;
            $this->physicalDamages -= 25;
            echo "Holy Prayer !\n" . PHP_EOL;
            echo $this->name . " stats increased and decreased for 2 turns!" . PHP_EOL;
            echo "\n";
            echo "Defense : " . $this->defense . "(+" . "50)" . PHP_EOL;
            echo "Physical Damage : " . $this->physicalDamages . "(-" . "25)" . PHP_EOL;
            $this->mana -= 50;
            $this->cooldown++;
        } else if ($this->cooldown === 1) {
            $this->cooldown++;
            echo 'Holy Prayer is still active' . PHP_EOL;
        } else if ($this->cooldown === 2) {
            echo 'Holy Prayer is finished' . PHP_EOL;
            $this->cooldown = 0;
            $this->defense -= 50;
            $this->physicalDamages += 25;
        }
    }

}
