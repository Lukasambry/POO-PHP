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
            health:110,
            defense:25,
            physicalDamages:10,
            magicalDamages:10,
            mana:120,
            exp:0,
            level:1,
            affinity:3, //Light
            cooldown:0
        );

    }

    public function hammerofLight($target)
    {
        $this->physicalDamages = 25;
        $target->health -= $this->physicalDamages;
        $this->mana -= 40;
        echo "Hammer of Light !\n";
    }

    public function Judgement($target)
    {
        $this->physicalDamages = 10;
        $target->health -= $this->physicalDamages * 3;
        $this->mana -= 60;
        echo "Judgement !\n";
    }

    public function holyPrayer()
    {
        if($this->cooldown === 0){
            $this->defense += 15;
            $this->mana -= 50;
            echo "Holy Prayer !\n" . PHP_EOL;
            $this->cooldown++; 
        } else if($this->cooldown === 1){
            $this->cooldown++;
            echo 'Holy Prayer is still active' . PHP_EOL;
        } else if($this->cooldown === 2){
            echo 'Holy Prayer is finished' . PHP_EOL;
            $this->cooldown = 0;
            $this->defense -= 15;
        }
    }

    public function checkCooldown($target) {
        if($target->cooldown != 0){
            $target->holyPlayer(); // if true, the cooldown is active and need incrementation
            return false;
        } else if($target->cooldown == 0){
            return true;
        }
    }  
}
