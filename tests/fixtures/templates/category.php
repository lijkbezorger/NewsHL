<?php

/**
 * @var $faker Faker\Generator
 * @var $index integer
 */

$id = ($index + 1);
$name = $faker->company;
$isActive = $faker->boolean(80);
$time = $faker->dateTimeBetween('-3 years', 'now')->getTimestamp();

return [
    'id'        => $id,
    'name'      => $name,
    'isActive'  => $isActive,
    'createdAt' => $time,
    'updatedAt' => $time,
];
