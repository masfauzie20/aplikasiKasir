<?php

use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'nama_pegawai' => $faker->name,
        'jabatan' => $faker->job,
        'file' => 'default.jpg'

    ];
});
