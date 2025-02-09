<?php

it('can get a date instance from string', function () {
    $date = new \Cubecoding\Dates\Date('2024-03-13');

    expect($date)
        ->toBeInstanceOf(\Cubecoding\Dates\Date::class)
        ->key->toBe('2024-03-13')
        ->slug->toBe('day20240313')
        ->title->toBe('Mi, 13.03.24')
        ->shortTitle->toBe('Mi. 13.')
        ->weekDay->toBe('Mi')
        ->dayOfWeek->toBe(3)
        ->weekDayOfMonth->toBe(2)
        ->isSpecial->toBeFalse
        ->isWeekend->toBeFalse
        ->isWorkingDay->toBeTrue;
});

it('can get a date instance as array', function () {
    $date = new \Cubecoding\Dates\Date('2024-03-13');

    $array = $date->toArray();

    expect($array)
        ->toBeArray()
        ->toHaveKey('key')
        ->toHaveKey('slug')
        ->toHaveKey('title')
        ->toHaveKey('shortTitle')
        ->toHaveKey('weekDay')
        ->toHaveKey('dayOfWeek')
        ->toHaveKey('isSpecial')
        ->toHaveKey('isWeekend')
        ->toHaveKey('isWorkingDay')
        ->toEqual([
            'key' => '2024-03-13',
            'slug' => 'day20240313',
            'title' => 'Mi, 13.03.24',
            'shortTitle' => 'Mi. 13.',
            'weekDay' => 'Mi',
            'weekDayOfMonth' => 2,
            'dayOfWeek' => 3,
            'isSpecial' => false,
            'isWeekend' => false,
            'isWorkingDay' => true,
        ]);
});

it('has weekDayOfMonth property', function () {
    $date = new \Cubecoding\Dates\Date('2023-01-10');
    // 10.01.2023 => Tag=10 => (10-1)/7+1 = 2 => 2. Dienstag
    expect($date->weekDayOfMonth)->toBe(2);
});

it('includes weekDayOfMonth in toArray', function () {
    $date = new \Cubecoding\Dates\Date('2023-01-03'); // (3-1)/7+1 = 1 => 1
    $arr = $date->toArray();
    expect($arr)->toHaveKey('weekDayOfMonth', 1);
});
