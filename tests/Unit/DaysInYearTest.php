<?php

it('can get all days of a year', function () {
    $days = \Cubecoding\Dates\DaysInYear::get(2023);

    expect($days)
        ->toBeInstanceOf(\Illuminate\Support\Collection::class)
        ->toHaveCount(365)
        ->and($days->first())
        ->toBeInstanceOf(\Cubecoding\Dates\Date::class)
        ->key->toEqual('2023-01-01')
        ->slug->toEqual('day20230101')
        ->and($days['2023-06-30'])
        ->key->toEqual('2023-06-30')
        ->slug->toEqual('day20230630');

});
