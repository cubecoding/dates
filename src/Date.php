<?php

namespace Cubecoding\Dates;

use Carbon\Carbon;

class Date extends Carbon
{
    public string $key = '';

    public string $slug = '';

    public string $title = '';

    public string $shortTitle = '';

    public string $weekDay = '';

    public bool $isSpecial = false;

    public bool $isWeekend = false;

    public bool $isWorkingDay = false;

    public function __construct($time = null, $tz = 'UTC')
    {
        parent::__construct((new Carbon($time))->shiftTimezone('UTC'), 'UTC');
        $this->locale('de_DE');
        $this->key = $this->format('Y-m-d');
        $this->slug = $this->getSlug();
        $this->title = "{$this->isoFormat('dd')}, {$this->format('d.m.y')}";
        $this->shortTitle = "{$this->isoFormat('dd')}. {$this->format('d')}.";
        $this->weekDay = $this->isoFormat('dd');
        $this->isSpecial = $this->isSpecial();
        $this->isWeekend = $this->isWeekend();
        $this->isWorkingDay = $this->isWorkingDay();
    }

    private function getSlug(): string
    {
        return 'day'.$this->format('Ymd');
    }

    private function isSpecial(): bool
    {
        return (new SpecialDays)($this->year)->contains(function ($specialDay) {
            return $this->format('Y-m-d') == $specialDay;
        });
    }

    public function isWorkingDay(): bool
    {
        return ! $this->isSpecial() && $this->isWeekday();
    }

    public function toArray(): array
    {
        return [
            'key' => $this->key,
            'slug' => $this->slug,
            'title' => $this->title,
            'shortTitle' => $this->shortTitle,
            'weekDay' => $this->weekDay,
            'dayOfWeek' => $this->dayOfWeekIso,
            'isSpecial' => $this->isSpecial,
            'isWeekend' => $this->isWeekend,
            'isWorkingDay' => $this->isWorkingDay(),
        ];
    }
}
