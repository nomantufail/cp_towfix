<?php

use Illuminate\Database\Seeder;

class VehiclesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('vehicles')->insert([
            ['id' => 1, 'make' => 'Honda','model'=>'2013','customer_id'=>2,'vehicle_type'=>'honda','details'=>''],
            ['id' => 2, 'make' => 'Honda','model'=>'2014','customer_id'=>2,'vehicle_type'=>'honda','details'=>''],
            ['id' => 3, 'make' => 'Honda','model'=>'2015','customer_id'=>2,'vehicle_type'=>'honda','details'=>''],
        ]);
    }
}
