<?php

use Illuminate\Database\Seeder;

class VehicleTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('vehicle_types')->insert([
            ['id' => 1, 'vehicle_type' => 'Honda'],
            ['id' => 2, 'vehicle_type' => 'BMW'],
            ['id' => 3, 'vehicle_type' => 'Ferrari'],
        ]);
    }
}
