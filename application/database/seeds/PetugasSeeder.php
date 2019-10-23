<?php

use Illuminate\Database\Seeder;

class PetugasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('petugas')->insert([
            'name' => 'admin',
            'jabatan' => 'manager',
            'file' => 'default.jpg'
        ]);
    }
}
