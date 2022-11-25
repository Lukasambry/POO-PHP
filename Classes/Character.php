bstract class Character
{
    public function __construct(
        private float $health = 100,
        private float $defense = 10,
        protected float $ad = 10,
        protected float $ap = 10,
    ) {
    }

    public function getHealth(): float
    {
        return $this->health;
    }

    public function getDefense(): float
    {
        if ($this->defense > 100) return 1;

        return $this->defense / 100;
    }

    public function isAlive(): bool
    {
        return $this->health > 0;
    }

    abstract public function __toString();
}
