<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Article;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/**
 * Since we are faking article data instead of having a database
 * setup, we will set the 'seed' here so that we always generate
 * the same set of fake articles
 */
$factory->faker->seed(1234);

$factory->define(Article::class, function (Faker $faker) {
    $title = $faker->sentence(3);
    $content = $faker->realText($faker->numberBetween(500,4000));
    return [
        'title' => $title,
        'slug' => Str::slug($title),
        'excerpt' => Str::limit($content, 250),
        'content' => $content,
        'created_at' => $faker->dateTimeBetween('-2 years', 'now')
    ];
});
