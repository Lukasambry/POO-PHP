<?php

namespace Classes;

require_once("PhysicalWeapon.php");

class Bow extends PhysicalWeapon
{
    public function __construct(
        public string $name = "Thori'dal, the Stars' Fury",
        public string $description = "Thori'dal, the Stars' Fury is a legendary bow of mysterious origins, infused with power from the Sunwell.",
        public int $type = 0,
        public int $damage = 20,
        public int $arrow = 10,
      ) {}

    
      public function shoot()
      {
        if ($this->arrow > 0) {
          $this->arrow -= 1;
          return $this->damage;
        } else {
          return 0;
        }
      }

}




?>