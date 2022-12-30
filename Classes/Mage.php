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

    public function getFirstSkillName():string {
        return "Meteor";
    }
    public function getSecondSkillName():string {
        return "Fire Tempest";
    }
    public function getBuffName():string {
        return "Phoenix Flame";
    }


    public function manaCostFirstSkill(): int {
        return 45;
    }

    public function manaCostSecondSkill(): int {
        return 30;
    }

    public function manaCostBuff(): int {
        return 80;
    }

    public function first($target)
    {
        if((($this->magicalDamages + 11) - ($target->defense)) > 0){
            $target->health -= (($this->magicalDamages + 11) - ($target->defense));
            $this->mana -= 45;
            echo $this->name . " utilise Meteor !" . PHP_EOL;
            echo $target->name . " a perdu " . (($this->magicalDamages + 11) - ($target->defense)) . " points de vies" . PHP_EOL;
        }else {
            echo $target->name . ' a perdu ' . "0 points de vies" . PHP_EOL;
        }   
    }

    public function second($target)
    {
        if((($this->magicalDamages + 13) - $target->defense) > 0){
            $target->health -= (($this->magicalDamages + 13) - $target->defense);
            echo $this->name . " utilise Fire Tempest !" . PHP_EOL;
            $this->mana -= 30;
            echo $target->name . " a perdu " . (($this->magicalDamages + 13) - $target->defense) . " points de vies" . PHP_EOL;
        }else {
            echo $target->name . ' a perdu ' . "0 points de vies" . PHP_EOL;
        }  
    }

    public function buff()
    {
        if ($this->cooldown === 0) {
            $this->defense += 12;
            $this->magicalDamages += 10;
            $this->health += 15;
            $this->mana -= 80;
            echo "Phoenix Flame !\n" . PHP_EOL;
            echo $this->name . " stats increased for 2 turns!" . PHP_EOL;
            echo "\n";
            echo "Defense : " . $this->defense . "(+" . "12)" . PHP_EOL;
            echo "Health : " . $this->health . "(+" . "15)" . PHP_EOL;
            echo "Magical Damage : " . $this->physicalDamages . "(+" . "10)" . PHP_EOL;
            $this->cooldown++;
        } else if ($this->cooldown === 1) {
            $this->cooldown++;
            echo 'Phoenix Flame is still active' . PHP_EOL;
        } else if ($this->cooldown === 2) {
            echo 'Phoenix Flame is finished' . PHP_EOL;
            $this->cooldown = 0;
            $this->defense -= 12;
            $this->magicalDamages -= 10;
            $this->health -= 15;
        }
    }
}
