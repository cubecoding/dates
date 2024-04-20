<?php

namespace Cubecoding\Dates;

use Carbon\Carbon;
use Carbon\CarbonPeriod;

class DaysInRange
{
    public Carbon $start;

    public Carbon $end;

    public function __construct(string $start, string $end)
    {
        $this->start = Carbon::createFromFormat('Y-m-d', $start, 'UTC')->setTime(12,0,0);
        $this->end = Carbon::createFromFormat('Y-m-d', $end, 'UTC')->setTime(12,0,0);
    }

    public static function get(string $start, string $end): \Illuminate\Support\Collection
    {
        return (new self($start, $end))->getDays();
    }

    public static function workingDays($start, $end): \Illuminate\Support\Collection
    {
        return (new self($start, $end))->getWorkingDays();
    }

    public function getDays(): \Illuminate\Support\Collection
    {
        $period = new CarbonPeriod($this->start, $this->end);

        return collect($period)
            ->mapInto(Date::class)
            ->keyBy(function (Date $day) {
                return $day->format('Y-m-d');
            });
    }

    public function getWorkingDays(): \Illuminate\Support\Collection
    {
        return $this->getDays()->filter(function (Date $date) {
            return $date->isWorkingDay;
        });
    }
}
