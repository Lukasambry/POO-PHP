<?php

namespace Classes;

use Classes\PhysicalWeapon;

class Hammer extends PhysicalWeapon
{
    public function __construct(
        public string $name = "Val'anyr, the Hammer of the Ancient Kings",
        public string $description = "Val'anyr was created by the Titans. It was given to the first king of the Terrestrials, Urel Stoneheart, to bring life to his people. Val'anyr was broken during the first war between the Terrestrials and the Iron Dwarves. It was whispered that the shards of the weapon were lost in the conflict.",
        public int $type = 0,
        public int $damage = 20,
      ) {}

}




?>