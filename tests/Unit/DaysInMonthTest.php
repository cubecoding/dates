<?php

it('can get all days of a month from string', function () {
    $days = \Cubecoding\Dates\DaysInMonth::get('2024-02');

    expect($days)
        ->toBeInstanceOf(\Illuminate\Support\Collection::class)
        ->toHaveCount(29);
});
