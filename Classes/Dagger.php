<?php

namespace Classes;

use Classes\PhysicalWeapon;

class Dagger extends PhysicalWeapon
{
    public function __construct(
        public string $name = "The Twin Blades of Azzinoth",
        public string $description = "The Twin Blades of Azzinoth are a pair of fel green warglaives wielded by Illidan Stormrage. Azzinoth was a doom guard commander whom Illidan slew 10,000 years ago.",
        public int $type = 0,
        public int $damage = 15,
      ) {}

}




?>