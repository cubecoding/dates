<?php

namespace Cubecoding\Dates;

use Carbon\Carbon;

class DaysInMonth
{
    private string $start;

    private string $end;

    public function __construct(?string $month = null)
    {
        $start = $month
            ? "$month-01"
            : now()->format('Y-m-').'01';

        $this->start = $start;

        $start = Carbon::parse($start);
        $this->end = $start->setDay($start->daysInMonth())->format('Y-m-d');
    }

    public static function get($month = null): \Illuminate\Support\Collection
    {
        return (new self($month))->getDays();
    }

    public function getDays(): \Illuminate\Support\Collection
    {
        return DaysInRange::get($this->start, $this->end);
    }
}
