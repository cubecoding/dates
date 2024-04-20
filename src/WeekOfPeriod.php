<?php

namespace Cubecoding\Dates;

use Carbon\Carbon;

readonly class WeekOfPeriod
{
    public static function from(string $date, int $periodWeeks = 3): int
    {
        return (new self)->makeFrom($date, $periodWeeks);
    }

    public function makeFrom(string $string, $periodWeeks): int
    {
        $currentDate = Carbon::createFromFormat('Y-m-d H:i', "$string 12:00", 'UTC');

        return $this->weekOfPeriod($currentDate, $periodWeeks);
    }

    public function weekOfPeriod(Carbon $currentDate, $periodWeeks): int
    {
        $periodStartDate = $this->getPeriodStartDate();

        $currentDate->isoWeekday(1);

        $weeksSinceStart = $periodStartDate->floatDiffInWeeks($currentDate);

        return (round(abs($weeksSinceStart)) % $periodWeeks) + 1;
    }

    private function getPeriodStartDate(): Carbon
    {
        $start = config('dates.settings.period_start_date');

        if ($start) {
            return Carbon::createFromFormat('Y-m-d H:i', "$start 12:00", 'UTC')->isoWeekday(1);
        }

        $start = now()->setMonth(1)->setDay(1)->setHour(12)->startOfHour();

        return $start->dayOfWeekIso === 1
            ? $start
            : $start->addWeek()->isoWeekday(1);
    }
}
