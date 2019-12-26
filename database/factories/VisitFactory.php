<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Visit;
use Faker\Generator as Faker;

$factory->define(Visit::class, function (Faker $faker) {
    $startDate = $faker->dateTimeThisYear("-30 days");
    $randomDigit = rand(1,2);
    $endDate = (clone $startDate)->modify("+{$randomDigit} hours");
    return [
        'coming' => $startDate,
        'leaving' => $endDate
    ];
});
