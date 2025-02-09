<?php

namespace Cubecoding\Dates;

use Carbon\Carbon;

readonly class WeekOfPeriod
{
    public static function from(string $date, int $periodWeeks = 3, ?string $customStartDate = null): int
    {
        return (new self)->makeFrom($date, $periodWeeks, $customStartDate);
    }

    public function makeFrom(string $string, $periodWeeks, ?string $customStartDate): int
    {
        $currentDate = Carbon::createFromFormat('Y-m-d H:i', "$string 12:00", 'UTC');

        return $this->weekOfPeriod($currentDate, $periodWeeks, $customStartDate);
    }

    public function weekOfPeriod(Carbon $currentDate, $periodWeeks, ?string $customStartDate): int
    {
        $periodStartDate = $this->getPeriodStartDate($customStartDate);
        $currentDate->isoWeekday(1);

        $weeksSinceStart = $periodStartDate->floatDiffInWeeks($currentDate);

        return (round(abs($weeksSinceStart)) % $periodWeeks) + 1;
    }

    private function getPeriodStartDate(?string $customStartDate = null): Carbon
    {
        $dateString = $customStartDate ?? config('dates.settings.period_start_date');
        $start = $dateString
            ? Carbon::createFromFormat('Y-m-d H:i:s', "$dateString 12:00:00", 'UTC')
            : Carbon::create(null, 1, 1, 12);

        return $start->dayOfWeekIso === 1
            ? $start
            : $start->addWeek()->isoWeekday(1);
    }
}
