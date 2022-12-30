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
        protected int $exp,
        protected int $level,
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

    public function getAffinity(): int
    {
        return $this->affinity;
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

        if ($damagesTaken > $this->health) {
            $this->health = 0;
        } else {
            $this->health -= $damagesTaken;
        }
    }

    public function attack(Character $target): void
    {
        $target->takesDamages($this->getPhysicalDamages(), $this->getMagicalDamages()); //Target takes damages
    }

    public function isAlive($me, $enemy): bool
    {
        if ($me->health <= 0) {
            echo $me->name . " est mort..." . PHP_EOL;
            echo $enemy->name . " est donc le grand vainqueur !" . PHP_EOL;
            return false;
        } else {
            return true;
        }
        if ($enemy->health <= 0) {
            echo $enemy->name . " est mort..." . PHP_EOL;
            echo $me->name . " est donc le grand vainqueur !" . PHP_EOL;
            return false;
        } else {
            return true;
        }
    }

    public function rest(): void
    {
        $this->mana += 40; //Restores 10 mana
        echo "You have recovered 40 mana points." . PHP_EOL;
        echo "\n";
    }


    public function sleep(): void
    {
        $this->mana -= 15; //Consume 5 mana
        $this->health += 35; //and restore 30 health
        echo $this->name . " recovered 35 hp" . PHP_EOL;
        echo "\n";

    }

    public function levelUp(): void //Level up function
    {
        $expGain = rand(50, 99);
        echo ($this->name . ' a gagner ' . $expGain . " exp") . PHP_EOL;
        $this->exp = $this->exp + $expGain;
        echo "\n";
        if ($this->exp >= 100) {
            $this->level++;
            $this->health += 10;
            $this->defense += 10;
            $this->mana += 10;
            $this->physicalDamages += 3;
            $this->magicalDamages += 5;
            $this->exp = 0;
            echo ($this->name . " has level up !\n") . PHP_EOL;
            sleep(1);
            echo "\n";
            echo $this->name . " is now level " .  $this->level  . PHP_EOL;
            sleep(1);
            echo "\n";
            echo "Health : " . $this->health . "(+10)". PHP_EOL;
            echo "Defense : " . $this->defense . "(+10)". PHP_EOL;
            echo "Mana : " . $this->mana . "(+10)". PHP_EOL;
            echo "Physical damage : " . $this->physicalDamages . "(+3)". PHP_EOL;
            echo "Magical damage : " . $this->magicalDamages . "(+5)". PHP_EOL;
            echo "\n";
            
        }
    }

    public function checkIfManaIsAvailable($cost, $current) {
        if($cost > $current){
            echo "You didn't have enough mana to perform this action." . PHP_EOL;
            echo "\n";
            return false;
        } else if($cost <= $current){
            return true;
        }
    }

    public function giveWeapon(?Weapon $weapon): void
    {
        if ($weapon === null) {
            $this->physicalDamages = $this->physicalDamages;
        };

        if ($weapon instanceof PhysicalWeapon) {
            $this->physicalDamages += $weapon->damage;
        } else {
            $this->magicalDamages += $weapon->damage;
        }
    }

    public function buffInProgress() {
        if($this->cooldown == 0){
            return false;
        }
        if($this->cooldown > 0){
            return true;
        }
    }

    public function addMana($value){
        $this->mana += $value;
    }

    public function incCooldown(): void
    {
        if ($this->cooldown != 0){
            $this->buff();
            echo "\n";
        } else {
            echo "Nothing is active at the moment";
        }
    }

    // 0 > 2 > 1
    // 3 > 0,1,2
    // 4 > 0,1,2

    public function affinityCheck($me, $enemy)
    {
        if (($me->getAffinity() == 3 || $me->getAffinity() == 4) && ($enemy->getAffinity() == 0 || $enemy->getAffinity() == 1 || $enemy->getAffinity() == 2)) {
            $me->setMagicalDamages($me->getMagicalDamages() * 1.2);
            $me->setPhysicalDamages($me->getPhysicalDamages() * 1.2);
        }


        switch ($me->getAffinity()) {
            case 0:
                // Wind > Water > Fire
                echo "Water is strong against Fire, weak against Wind" . PHP_EOL;
                if ($enemy->getAffinity() == 1) {
                    $me->setMagicalDamages($me->getMagicalDamages() * 1.2);
                    $me->setPhysicalDamages($me->getPhysicalDamages() * 1.2);
                } else if ($enemy == 2) {
                    $me->setMagicalDamages($me->getMagicalDamages() * 0.8);
                    $me->setPhysicalDamages($me->getPhysicalDamages() * 0.8);
                } else {
                }
                break;

            case 1:
                // Water > Fire > Wind
                echo "Fire is strong against Wind, weak against Water" . PHP_EOL;
                if ($enemy->getAffinity() == 2) {
                    $me->setMagicalDamages($me->getMagicalDamages() * 1.2);
                    $me->setPhysicalDamages($me->getPhysicalDamages() * 1.2);
                } else if ($enemy->getAffinity() == 0) {
                    $me->setMagicalDamages($me->getMagicalDamages() * 0.8);
                    $me->setPhysicalDamages($me->getPhysicalDamages() * 0.8);
                } else {
                }
                break;

            case 2:
                echo "Wind is strong against Water, weak against Fire" . PHP_EOL;
                if ($enemy->getAffinity() == 0) {
                    $me->setMagicalDamages($me->getMagicalDamages() * 1.2);
                    $me->setPhysicalDamages($me->getPhysicalDamages() * 1.2);
                } else if ($enemy->getAffinity() == 1) {
                    $me->setMagicalDamages($me->getMagicalDamages() * 0.8);
                    $me->setPhysicalDamages($me->getPhysicalDamages() * 0.8);
                } else {
                }
                break;
        }
    }

          
    public function checkMana($needMana) {
        if($this->mana < $needMana) {
            echo("You lack ". ($needMana-$this->mana)  ." mana to perform this action\n");
            return false;
        } else return true;
    } 
}

