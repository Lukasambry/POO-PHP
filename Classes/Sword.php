<?php

namespace Classes;

require_once("PhysicalWeapon.php");

class Sword extends PhysicalWeapon
{
    public function __construct(
        public string $name = "Thunderfury, Blessed Blade of the Windseeker",
        public string $description = "Thunderfury, Blessed Blade of the Windseeker is the legendary sword once wielded by Thunderaan, Prince of Air.",
        public int $type = 0,
        public int $damage = 20,
      ) {}

}




?>