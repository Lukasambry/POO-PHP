<?php
namespace Classes;

require_once("Weapon.php");

class PhysicalWeapon extends Weapon
{
    public function __construct(
      public int $type = 1,
    ) {}
}
?>