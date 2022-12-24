<?php

namespace Classes;

use Classes\Character;

require_once('functions.php');

class Mage extends Character
{
    //Mage = 95 hp, 9 def, 0 ad, 20 ap, 100 mana (10 mana regen / tours)
    public function __construct()
    {
        parent::__construct(
            'Kael\'thas Sunstrider',
            health: 95,
            defense: 8,
            physicalDamages: 0,
            magicalDamages: 20,
            mana: 100,
            exp: 0,
            level: 1,
            affinity: 1, //Fire
            cooldown: 0
        );
    }

    public function first($target)
    {
        if ($this->mana < 45) {
            echo $this->name . " n'a pas assez de mana pour effectuer cette action..." . PHP_EOL;
            echo $this->name . " utilise Rest et récupère 40 mana" . PHP_EOL;
            $this->rest();
        } else {
            $target->health -= (($this->magicalDamages + 11) - ($target->defense));
            $this->mana -= 45;
            echo $this->name . " utilise Meteor !" . PHP_EOL;
            echo $target->name . " a perdu " . (($this->magicalDamages + 11) - ($target->defense)) . " points de vies" . PHP_EOL;
        }
    }

    public function second($target)
    {
        if ($this->mana < 30) {
            echo $this->name . " n'a pas assez de mana pour effectuer cette action..." . PHP_EOL;
            echo $this->name . " utilise Rest et récupère 40 mana" . PHP_EOL;
            $this->rest();
        } else {
            $target->health -= (($this->magicalDamages + 13) - $target->defense);
            $this->mana -= 30;
            echo $this->name . " utilise Fire Tempest !" . PHP_EOL;
            echo $target->name . " a perdu " . (($this->magicalDamages + 13) - $target->defense) . " points de vies" . PHP_EOL;
        }
    }

    public function buff()
    {
        if ($this->cooldown === 0) {
            $this->defense += 20;
            $this->magicalDamages += 10;
            $this->health += 15;
            $this->mana -= 80;
            echo "Phoenix Flame !\n" . PHP_EOL;
            $this->cooldown++;
        } else if ($this->cooldown === 1) {
            $this->cooldown++;
            echo 'Phoenix Flame is still active' . PHP_EOL;
        } else if ($this->cooldown === 2) {
            echo 'Phoenix Flame is finished' . PHP_EOL;
            $this->cooldown = 0;
            $this->defense -= 25;
            $this->magicalDamages -= 10;
            $this->health -= 15;
        }
    }

    public function checkCooldown($target)
    {
        if ($target->cooldown != 0) {
            $target->phoenixFlame(); // if true, the cooldown is active and need incrementation
            return false;
        } else if ($target->cooldown == 0) {
            return true;
        }
    }
}
