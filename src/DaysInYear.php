<?php

namespace Cubecoding\Dates;
use Cubecoding\Dates\DaysInRange;

class DaysInYear
{
    public string $year;

    public function __construct(?string $year = null)
    {
        $this->year = $year ?: now()->year;
    }

    public static function get(?string $year = null): \Illuminate\Support\Collection
    {
        return (new self($year))->getDays();
    }

    public function getDays(): \Illuminate\Support\Collection
    {
        return DaysInRange::get("{$this->year}-01-01", "{$this->year}-12-31");
    }
}
