<?php

namespace Classes;

use Classes\Character;

require_once('functions.php');

class Knight extends Character
{
    //Knight = 125 hp, 29 def, 10 ad, 0 ap, 30 mana (5 mana regen / tour)
    public function __construct()
    {
        parent::__construct(
            'Anduin Lothar',
            health: 125,
            defense: 15,
            physicalDamages: 10,
            magicalDamages: 0,
            mana: 100,
            exp: 0,
            level: 1,
            affinity: 0,
            cooldown: 0
        );
    }

    public function first($target)
    {
        if ($this->mana < 60) {
            echo $this->name . " n'a pas assez de mana pour effectuer cette action..." . PHP_EOL;
            echo $this->name . " utilise Rest et récupère 40 mana" . PHP_EOL;
            $this->rest();
        } else {
            $target->health -= ($this->physicalDamages + 20) - $target->defense;
            $this->mana -= 60;
            echo $this->name . " utilise Water Slash !" . PHP_EOL;
            echo $target->name . " a perdu " . (($this->physicalDamages + 20) - $target->defense) . " points de vies" . PHP_EOL;
        }
    }

    public function second($target)
    {

        if ($this->mana < 40) {
            echo $this->name . " n'a pas assez de mana pour effectuer cette action..." . PHP_EOL;
            echo $this->name . " utilise Rest et récupère 40 mana" . PHP_EOL;
            $this->rest();
        } else {
            $random = rand(20, 30);
            $target->health -= (($this->physicalDamages + $random) - $target->defense);
            $this->mana -= 40;
            echo $this->name . " utilise Slice !" . PHP_EOL;
            echo $target->name . " a perdu " . (($this->physicalDamages + $random) - $target->defense) . " points de vies" . PHP_EOL;
        }
    }

    public function buff()
    {
        if ($this->cooldown === 0) {
            $this->defense += 10;
            $this->mana -= 25;
            echo "Parade !\n" . PHP_EOL;
            $this->cooldown++;
        } else if ($this->cooldown === 1) {
            $this->cooldown++;
            echo 'Parade is still active' . PHP_EOL;
        } else if ($this->cooldown === 2) {
            echo 'Parade is finished' . PHP_EOL;
            $this->cooldown = 0;
            $this->defense -= 10;
        }
    }

    //Faudra mettre cet condition dans la boucle on la mettre dans une function,
    //en tout cas, faut que ça, soit call a chaque tours de boucle dans tout les cas

    //En gros, si le cooldown est différent de 0, ça veut dire que Parade a était lancer dans tout les cas
    //$knight->checkCooldown
    public function checkCooldown($target)
    {
        if ($target->cooldown != 0) {
            $target->parade(); // if true, the cooldown is active and need incrementation
            return false;
        } else if ($target->cooldown == 0) {
            return true;
        }
    }
}
