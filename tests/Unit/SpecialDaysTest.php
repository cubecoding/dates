<?php

it('can get a list of special days for the given year', function () {
    $specialDaysClass = new \Cubecoding\Dates\SpecialDays;

    $specialDays = $specialDaysClass(2024);

    expect($specialDays)
        ->toBeInstanceOf(\Illuminate\Support\Collection::class)
        ->toContain('2024-01-01')
        ->toContain('2024-01-06')
        ->toContain('2024-05-01')
        ->toContain('2024-08-15')
        ->toContain('2024-10-03')
        ->toContain('2024-11-01')
        ->toContain('2024-12-24')
        ->toContain('2024-12-25')
        ->toContain('2024-12-26')
        ->toContain('2024-12-31')
        ->toContain('2024-03-29')
        ->toContain('2024-03-31')
        ->toContain('2024-04-01')
        ->toContain('2024-05-09')
        ->toContain('2024-05-20')
        ->toContain('2024-05-30')
        ->toArray()->toEqual([
            'neujahr' => '2024-01-01',
            'heilige-drei-koenige' => '2024-01-06',
            'tag-der-arbeit' => '2024-05-01',
            'maria-himmelfahrt' => '2024-08-15',
            'tag-der-deutschen-einheit' => '2024-10-03',
            'allerheiligen' => '2024-11-01',
            'heiliger-abend' => '2024-12-24',
            'erster-weihnachtstag' => '2024-12-25',
            'zweiter-weihnachtstag' => '2024-12-26',
            'silvester' => '2024-12-31',
            'karfreitag' => '2024-03-29',
            'ostersonntag' => '2024-03-31',
            'ostermontag' => '2024-04-01',
            'christi-himmelfahrt' => '2024-05-09',
            'pfingstmontag' => '2024-05-20',
            'fronleichnam' => '2024-05-30',
        ]);
});
