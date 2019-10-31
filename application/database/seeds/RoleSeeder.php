<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'admin'
            ],
            [
                'name' => 'petugas'
            ],
            [
                'name' => 'user'
            ]
        ];
        DB::table('roles')->insert($data);
    }
}
