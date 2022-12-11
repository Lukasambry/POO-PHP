<?php
namespace Classes;

use Classes\Character;
require_once('functions.php');

class Knight extends Character
{
    //Knight = 125 hp, 29 def, 10 ad, 0 ap, 30 mana, 0 exp, lvl 1, affinité eau
    public function __construct()
    {
        parent::__construct(
            'Anduin Lothar',
            health:125,
            defense:29,
            physicalDamages:10,
            magicalDamages:0,
            mana:30,
            exp:0,
            level:1,
            affinity:0,
            cooldown:0
        );
    }

    public function parade()
    {
        if($this->cooldown === 0){
            $this->defense += 10;
            $this->mana -= 25;
            echo "Parade !\n" . PHP_EOL;
            $this->cooldown++; 
        } else if($this->cooldown === 1){
            $this->cooldown++;
            echo 'Parade est encore actif' . PHP_EOL;
        } else if($this->cooldown === 2){
            echo 'Parade est terminé' . PHP_EOL;
            $this->cooldown = 0;
            $this->defense -= 10;
        }
    }

    //Faudra mettre cet condition dans la boucle on la mettre dans une function,
    //en tout cas, faut que ça, soit call a chaque tours de boucle dans tout les cas

    //En gros, si le cooldown est différent de 0, ça veut dire que Parade a était lancer dans tout les cas
    //$knight->checkCooldown
    public function checkCooldown($target) {
        if($target->cooldown != 0){
            $target->parade(); // et si c'est le cas on incrémente le cooldown
            return false;
        } else if($target->cooldown == 0){
            return true;
        }
    }  

    public function waterSlash($target)
    {
        $this->physicalDamages = 7;
        $target->health -= $this->physicalDamages * 5;
        $this->mana -= 60;
        echo "Water Slash !\n";
    }

    public function slice($target)
    {
        $this->physicalDamages = rand(20, 30);
        $target->health -= $this->physicalDamages;
        $this->mana -= 40;
        echo "Slice !\n";
    }
}
