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

}
