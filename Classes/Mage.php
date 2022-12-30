<?php

namespace Classes;

use Classes\Character;

require_once('functions.php');

class Mage extends Character
{
    //Mage = 95 hp, 8 def, 0 ad, 18 ap
    public function __construct()
    {
        parent::__construct(
            'Kael\'thas Sunstrider',
            health:95,
            defense:8,
            physicalDamages:0,
            magicalDamages:18,
            mana:100,
            exp:0,
            level:1,
            affinity:1, //Fire
            cooldown:0
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
            echo $this->name . " use Meteor !" . PHP_EOL;
            echo $target->name . " lost " . (($this->magicalDamages + 11) - ($target->defense)) . " life points" . PHP_EOL;
        }else {
            echo $target->name . ' lost ' . "0 life points" . PHP_EOL;
        }   
    }

    public function second($target)
    {
        if((($this->magicalDamages + 15) - $target->defense) > 0){
            $target->health -= (($this->magicalDamages + 15) - $target->defense);
            echo $this->name . " use Fire Tempest !" . PHP_EOL;
            $this->mana -= 30;
            echo $target->name . " lost " . (($this->magicalDamages + 15) - $target->defense) . " life points" . PHP_EOL;
        }else {
            echo $target->name . ' lost ' . "0 life points" . PHP_EOL;
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
