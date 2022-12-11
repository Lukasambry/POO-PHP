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
            affinity:0
        );
    }

    public function parade()
    {
        $this->defense += 10;
        $this->mana -= 25;
        echo "Parade !\n";
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
        echo($this->physicalDamages);
        $this->mana -= 40;
        echo "Slice !\n";
    }
}
