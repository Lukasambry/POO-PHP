<?php
namespace Classes;

use Classes\Weapon;

class MagicalWeapon extends Weapon
{
    public function __construct(
      public int $type = 0,
    ) {}
}
?>