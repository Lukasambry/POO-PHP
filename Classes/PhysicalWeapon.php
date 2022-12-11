<?php
namespace Classes;

use Classes\Weapon;

class PhysicalWeapon extends Weapon
{
    public function __construct(
      public int $type = 1,
    ) {}
}
?>