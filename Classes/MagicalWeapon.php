<?php
namespace Classes;

require_once("Weapon.php");

class MagicalWeapon extends Weapon
{
    public function __construct(
      public int $type = 0,
    ) {}
}
?>