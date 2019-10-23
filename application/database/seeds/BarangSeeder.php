<?php

use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('barang')->insert([
            'id' => 1,
            'nama_barang' => 'sampo',
            'jumlah' => 10,
            'harga' => 5500
        ]);

    }
}
