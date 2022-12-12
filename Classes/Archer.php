<?php
namespace Classes;

use Classes\Character;
require_once('functions.php');

class Archer extends Character
{
    //Archer = 100 hp, 17 def, 12 ad, 0 ap, 50 mana (7 mana regen / tours)
    public function __construct(
        public int $arrows = 10,
    )
    {
        parent::__construct(
            'Sylvanas Windrunner',
            health:100,
            defense:17,
            physicalDamages:12,
            magicalDamages:0,
            mana:50,
            exp:0,
            level:1,
            affinity:2, //Wind
            cooldown:0
        );

    }

    public function arcaneShot($target)
    {
        if($this->arrow <= 0){
            echo "You don't have any arrows left ! Use Focus !\n";
            $this->focus();
            return;
        }else{
        $arcaneShot = $this->magicalDamages = 7 + $this->physicalDamages;
        $target->health -= $arcaneShot;
        $this->mana -= 25;
        $this->arrows -= 1;
        echo "Arcane Shot !\n";
        }
    }

    public function tripleShot($target)
    {
        if($this->arrow <= 0){
            echo "You don't have any arrows left ! Use Focus !\n";
            $this->focus();
            return;
        }else{
        $tripleShoot = $this->physicalDamages = 10 * 3;
        $target->health -= $tripleShoot;
        $this->mana -= 60;
        $this->arrows -= 1;
        echo "Triple Shot ! \n";
            }
    }

    public function focus()
    {
        if($this->cooldown === 0){
            $this->mana -= 40;
            $this->arrows += 5;

            if(luck(40)){
                echo("Dodge" . PHP_EOL); //cf Ticket Trello
                return 1;
            } return parent::getDefense();

            echo "Focus !\n" . PHP_EOL;
            $this->cooldown++;

        } else if($this->cooldown === 1){
            $this->cooldown++;
            echo 'Focus skill is still active.' . PHP_EOL;
            
        } else if($this->cooldown === 2){
            echo 'Focus skill is finished.' . PHP_EOL;
            $this->cooldown = 0;
            $this->defense -= 10;
        }
    }

    public function checkCooldown($target) {
        if($target->cooldown != 0){
            $target->focus(); // if true, the cooldown is active and need incrementation
            return false;
        } else if($target->cooldown == 0){
            return true;
        }
    }  
}
