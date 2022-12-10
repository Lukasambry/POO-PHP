<?php

namespace Classes;

abstract class Weapon
{

    public function __construct(
    
    protected string $name,
    protected string $description,
    protected int $type, // 1 = Physical, 0 = Magical
    protected int $damage)
    {}

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getType(): int
    {
        return $this->type;
    }

    public function getDamage(): int
    {
        return $this->damage;
    }

}

?>