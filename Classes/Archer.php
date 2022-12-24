<?php

namespace Classes;

use Classes\Character;

require_once('functions.php');

class Archer extends Character
{
    //Archer = 100 hp, 17 def, 12 ad, 0 ap, 50 mana (7 mana regen / tours)
    public function __construct(
        public int $arrows = 10,
    ) {
        parent::__construct(
            'Sylvanas Windrunner',
            health: 100,
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

    public function first($target)
    {
        if ($this->arrows <= 0) {
            echo $this->name . " N'a plus de flèche !\n" . PHP_EOL;
            $this->buff();
            return $this->name . " utilise Focus !" . PHP_EOL;
        } else if ($this->mana < 25) {
            echo $this->name . " n'a pas assez de mana pour effectuer cette action..." . PHP_EOL;
            echo $this->name . " utilise Rest et récupère 40 mana" . PHP_EOL;
            $this->rest();
        } else {
            $target->health -= (($this->physicalDamages + 12) - $target->defense);
            $this->mana -= 25;
            $this->arrows -= 1;
            echo $this->name . " utilise Arcane Shot !" . PHP_EOL;
            echo $target->name . " a perdu " . (($this->physicalDamages + 12) - $target->defense) . " points de vies" . PHP_EOL;
        }
    }

    public function second($target)
    {
        if ($this->arrows <= 0) {
            echo $this->name . " don't have any arrows left !" . PHP_EOL;
            $this->buff();
            return $this->name . " utilise Focus !" . PHP_EOL;
        } else if ($this->mana < 60) {
            echo $this->name . " n'a pas assez de mana pour effectuer cette action..." . PHP_EOL;
            echo $this->name . " utilise Rest et récupère 40 mana" . PHP_EOL;
            $this->rest();
        } {
            $target->health -= (($this->physicalDamages + 25) - $target->defense);
            $this->mana -= 60;
            $this->arrows -= 1;
            echo $this->name . " utilise Triple Shot ! \n" . PHP_EOL;
            echo $target->name . " a perdu " . (($this->physicalDamages + 25) - $target->defense) . " points de vies" . PHP_EOL;
        }
    }

    public function buff()
    {
        if ($this->cooldown === 0) {
            $this->mana -= 40;
            $this->arrows += 5;

            if (luck(40)) {
                echo ("Dodge" . PHP_EOL); //cf Ticket Trello
                return 1;
            }
            return parent::getDefense();

            echo "Focus !\n" . PHP_EOL;
            $this->cooldown++;
        } else if ($this->cooldown === 1) {
            $this->cooldown++;
            echo 'Focus skill is still active.' . PHP_EOL;
        } else if ($this->cooldown === 2) {
            echo 'Focus skill is finished.' . PHP_EOL;
            $this->cooldown = 0;
            $this->defense -= 10;
        }
    }

    public function checkCooldown($target)
    {
        if ($target->cooldown != 0) {
            $target->focus(); // if true, the cooldown is active and need incrementation
            return false;
        } else if ($target->cooldown == 0) {
            return true;
        }
    }
}
