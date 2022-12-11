<?php

namespace Classes;

use Classes\MagicalWeapon;

class Staff extends MagicalWeapon
{
    public function __construct(
        public string $name = "Atiesh, Greatstaff of the Guardian",
        public string $description = "Atiesh, Greatstaff of the Guardian is a powerful staff passed down through the line of the Guardians of Tirisfal up until and including Medivh, the Last Guardian",
        public int $type = 0,
        public int $damage = 24,
      ) {}

}




?>