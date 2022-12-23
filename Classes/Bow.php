<?php

namespace Classes;

use Classes\PhysicalWeapon;

class Bow extends PhysicalWeapon
{
    public function __construct(
        public string $name = "Thori'dal, the Stars' Fury",
        public string $description = "Thori'dal, the Stars' Fury is a legendary bow of mysterious origins, infused with power from the Sunwell.",
        public int $type = 0,
        public int $damage = 20,
      ) {}
}




?>