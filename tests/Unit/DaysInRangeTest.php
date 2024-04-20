<?php

it('can get all days of a range from string', function () {
    $days = \Cubecoding\Dates\DaysInRange::get('2024-01-01', '2024-12-31');

    expect($days)
        ->toBeInstanceOf(\Illuminate\Support\Collection::class)
        ->toHaveCount(366);
});
