<?php

namespace Classes;

abstract class Character
{
    public function __construct(
        protected string $name,
        protected int $health,
        protected int $defense,
        protected int $physicalDamages,
        protected int $magicalDamages,
        protected int $mana,
        protected int $exp = 0,
        protected int $level = 1,
        protected int $affinity, // 0 = eau, 1 = feu, 2 = vent, 3 = lumière, 4 = ténèbres
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getHealth(): int
    {
        return $this->health;
    }
    
    public function getPhysicalDamages(): int
    {
        return $this->physicalDamages;
    }
    
    public function getMagicalDamages(): int
    {
        return $this->magicalDamages;
    }

    public function getDefense(): int
    {
        if ($this->defense > 100) return 1;

        return $this->defense / 100; //Percentage for defense
    }

    public function getMana(): int
    {
        return $this->mana;
    }

    public function getExp(): int
    {
        return $this->exp;
    }

    public function getLevel(): int
    {
        return $this->level;
    }

    public function getType(): int
    {
        return $this->type;
    }

    public function setName($name)
    {
        $this->name = $name;
    }    
    public function setHealth($health)
    {
        $this->health = $health;

    }
    public function setDefense($defense)
    {
        $this->defense = $defense;

    }
    public function setPhysicalDamages($physicalDamages)
    {
        $this->physicalDamages = $physicalDamages;

    }
    public function setMagicalDamages($magicalDamages)
    {
        $this->magicalDamages = $magicalDamages;

    }
    public function setMana($mana)
    {
        $this->mana = $mana;

    }
    public function setExp($exp)
    {
        $this->exp = $exp;

    }
    public function setLevel($level)
    {
        $this->level = $level;

    }
    public function setType($type)
    {
        $this->type = $type;

    }
    
    public function takesDamages(int $physicalDamages, int $magicalDamages): void
    {
        $damages = $physicalDamages + $magicalDamages;
        $damagesTaken = $damages - $damages * $this->getDefense();
    
        if ($damagesTaken > $this->health) 
        {
            $this->health = 0;
        } else 
        {
            $this->health -= $damagesTaken;
        }
    }

    public function attack(Character $target): void
    {
        $target->takesDamages($this->getPhysicalDamages(), $this->getMagicalDamages()); //Target takes damages
    }

    public function isAlive(): bool
    {
        return $this->health > 0; //Check if alive
    }

   
    public function rest(): void
    {
        $this->mana += 10; //Restores 10 mana
    }

    
    public function sleep(): void
    {
        $this->mana -= 5; //Consume 10 mana
        $this->health += 10; //and restore 10 health
    }

    public function levelUp(): void //Level up function
    {
        $this->level++;
        $this->expToLvlUp *= 1.5;
    }


    //Comment while Weapon isn't yet created

    // public function giveWeapon(?Weapon $weapon): void
    // {
    //     if($weapon === null){
    //         $this->physicalDamages = $this->physicalDamages;
    //     };

    //     if($weapon instanceof PhysicalWeapon) {
    //         $this->physicalDamages += $weapon->damage;
    //     } else {
    //         $this->magicalDamages += $weapon->damage;
    //     }
    // }
}
