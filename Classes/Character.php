<?php

namespace Classes;

use Interfaces\GlobalSkills;

abstract class Character implements GlobalSkills
{
    public function __construct(
        protected string $name,
        protected int $health,
        protected float $defense,
        protected int $physicalDamages,
        protected int $magicalDamages,
        protected int $mana,
        protected int $exp = 0,
        protected int $level = 1,
        protected int $affinity, // 0 = water, 1 = fire, 2 = wind, 3 = light, 4 = dark
        protected int $cooldown = 0
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

    public function getDefense(): float
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
        echo("You restored 10 mana\n");
    }

    
    public function sleep(): void
    {
        $this->mana -= 5; //Consume 5 mana
        $this->health += 10; //and restore 10 health
        echo("You lost 5 mana and restored 10 health\n");
    }

    public function levelUp(): void //Level up function
    {
        if($this->exp >= 100){
            $this->level++;
            $this->health += 10;
            $this->defense += 10;
            $this->mana += 10;
            $this->exp = 0;
            echo("You leveled up !\n");
        }// add 10 physic or magic damage depending on the child class
    }


   
    public function giveWeapon(?Weapon $weapon): void
    {
        if($weapon === null)
        {
            $this->physicalDamages = $this->physicalDamages;
        };

        if($weapon instanceof PhysicalWeapon) {
            $this->physicalDamages += $weapon->damage;
        }  else {
            $this->magicalDamages += $weapon->damage;
        }
    }  
}
