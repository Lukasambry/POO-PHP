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

    public function first($target)
    {

        if ($this->mana < 40) {
            echo $this->name . " n'a pas assez de mana pour effectuer cette action..." . PHP_EOL;
            echo $this->name . " utilise Rest et récupère 40 mana" . PHP_EOL;
            $this->rest();
        } else {
            $target->health -= ($this->physicalDamages + 12) - $target->defense;
            $this->mana -= 40;
            echo $this->name . " utilise Hammer of Light !" . PHP_EOL;
            echo $target->name . " a perdu " .  ($this->physicalDamages + 12) - $target->defense . " points de vies" . PHP_EOL;
        }
    }

    public function second($target)
    {
        if ($this->mana < 60) {
            echo $this->name . " n'a pas assez de mana pour effectuer cette action..." . PHP_EOL;
            echo $this->name . " utilise Rest et récupère 40 mana" . PHP_EOL;
            $this->rest();
        } else {
            $target->health -= ($this->physicalDamages * 3 + 10) - $target->defense;
            $this->mana -= 60;
            echo $this->name . " utilise Judgement !" . PHP_EOL;
            echo $target->name . " a perdu " .  ($this->physicalDamages + 10) - $target->defense . " points de vies" . PHP_EOL;
        }
    }

    public function buff()
    {
        if ($this->cooldown === 0) {
            $this->defense += 15;
            $this->mana -= 50;
            echo "Holy Prayer !\n" . PHP_EOL;
            $this->cooldown++;
        } else if ($this->cooldown === 1) {
            $this->cooldown++;
            echo 'Holy Prayer is still active' . PHP_EOL;
        } else if ($this->cooldown === 2) {
            echo 'Holy Prayer is finished' . PHP_EOL;
            $this->cooldown = 0;
            $this->defense -= 15;
        }
    }

    public function checkCooldown($target)
    {
        if ($target->cooldown != 0) {
            $target->holyPlayer(); // if true, the cooldown is active and need incrementation
            return false;
        } else if ($target->cooldown == 0) {
            return true;
        }
    }
}
