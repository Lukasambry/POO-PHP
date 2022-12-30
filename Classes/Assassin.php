<?php

namespace Classes;

use Classes\Character;

require_once('functions.php');

class Assassin extends Character
{
    //Assassin = 90 hp, 15 def, 20 ad, 0 ap, 90 mana (5 mana regen / tours)
    public function __construct()
    {
        parent::__construct(
            'Illidan Stormrage',
            health: 90,
            defense: 9,
            physicalDamages: 14,
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
            $target->health -= ($this->physicalDamages + 14) - $target->defense;
            $this->mana -= 45;
            echo $this->name . " utilise Ambush !" . PHP_EOL;
            echo $target->name . ' a perdu ' . ($this->physicalDamages + 14) - $target->defense . " points de vies" . PHP_EOL;
    }

    public function second($target)
    {
            $target->health -= (($this->physicalDamages + 15) - $target->defense);
            $this->mana -= 30;
            echo $this->name . " utilise Eviserate !" . PHP_EOL;
            echo $target->name . ' a perdu ' . (($this->physicalDamages + 15) - $target->defense) . " points de vies" . PHP_EOL;
    }

    public function buff()
    {
        if ($this->cooldown === 0) {
            $this->physicalDamages += 10;
            $this->defense +=10;
            $this->health +=10;
            $this->mana -= 20;
            echo "Stealth !\n" . PHP_EOL;
            echo $this->name . " stats increased for 2 turns!" . PHP_EOL;
            echo "\n";
            echo "Defense : " . $this->defense . "(+" . "10)" . PHP_EOL;
            echo "Health : " . $this->health . "(+" . "10)" . PHP_EOL;
            echo "Physical Damage : " . $this->physicalDamages . "(+" . "10)" . PHP_EOL;
            $this->cooldown++;
        } else if ($this->cooldown === 1) {
            $this->cooldown++;
            echo 'Stealth is still active' . PHP_EOL;
        } else if ($this->cooldown === 2) {
            echo 'Stealth is finished' . PHP_EOL;
            $this->cooldown = 0;
            $this->physicalDamages -= 10;
            $this->defense -=10;
            $this->health -=10;
        }
    }
}
