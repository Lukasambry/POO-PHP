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
            mana: 50,
            exp: 0,
            level: 1,
            affinity: 2, //Wind
            cooldown: 0,
        );
    }

    public function first($target)
    {
        if ($this->arrows <= 0) {
            echo $this->name . " don't have any arrows left !\n";
            $this->buff();
            return $this->name . " use Focus !";
        } else {
            $target->health -= (($this->physicalDamages + 12) - $target->defense);
            $this->mana -= 25;
            $this->arrows -= 1;
            echo "Arcane Shot !\n";
            echo $target->name . " a perdu " . (($this->physicalDamages + 12) - $target->defense) . " points de vies" . PHP_EOL;
        }
    }

    public function second($target)
    {
        if ($this->arrows <= 0) {
            echo $this->name . " don't have any arrows left !\n";
            $this->buff();
            return $this->name . " use Focus !";
        } else {
            $target->health -= (($this->physicalDamages + 25) - $target->defense);
            $this->mana -= 60;
            $this->arrows -= 1;
            echo "Triple Shot ! \n";
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
