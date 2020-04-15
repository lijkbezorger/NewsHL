<?php

/**
 * @var $faker Faker\Generator
 * @var $index integer
 */

$id = ($index + 1);
$content = $faker->text(1000);
$preview = $faker->text(255);
$categoryId = (int)(ceil($id / 100));

$officeId = ($index + 1);
$isPublished = $faker->boolean(80);
$time = $faker->dateTimeBetween('-3 years', 'now')->getTimestamp();

return [
    'id'          => $id,
    'content'     => $content,
    'preview'     => $preview,
    'isPublished' => $isPublished,
    'publishedAt' => ($isPublished) ? $time : null,
    'categoryId'  => $categoryId,
    'createdAt'   => $time,
    'updatedAt'   => $time,
];
