<?php

namespace Cubecoding\Dates;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

readonly class SpecialDays
{
    private int $year;

    private int $easterDays;

    public function __invoke($year = null)
    {
        $this->year = $year ?: now()->year;
        $this->easterDays = easter_days($this->year);

        return Cache::rememberForever("cubecoding::dates.{$this->year}.special", function () {
            return collect([
                // fixed days
                'neujahr' => "{$this->year}-01-01",
                'heilige-drei-koenige' => "{$this->year}-01-06",
                'tag-der-arbeit' => "{$this->year}-05-01",
                'maria-himmelfahrt' => "{$this->year}-08-15",
                'tag-der-deutschen-einheit' => "{$this->year}-10-03",
                'allerheiligen' => "{$this->year}-11-01",
                'heiliger-abend' => "{$this->year}-12-24",
                'erster-weihnachtstag' => "{$this->year}-12-25",
                'zweiter-weihnachtstag' => "{$this->year}-12-26",
                'silvester' => "{$this->year}-12-31",

                // variable days
                'karfreitag' => $this->getDay(-2),
                'ostersonntag' => $this->getDay(),
                'ostermontag' => $this->getDay(1),
                'christi-himmelfahrt' => $this->getDay(39),
                'pfingstmontag' => $this->getDay(50),
                'fronleichnam' => $this->getDay(60),
            ]);
        });
    }

    private function getDay(int $addDays = 0): string
    {
        return Carbon::create($this->year, 3, 21, 12, 0, 0, 'UTC')
            ->addDays($this->easterDays + $addDays)
            ->format('Y-m-d');
    }
}
