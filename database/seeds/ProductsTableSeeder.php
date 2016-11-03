<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('products')->insert([
            ['name' => 'tyre', 'price' => 500, 'detail' => "Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit..."],
            ['name' => 'lights', 'price' => 100, 'detail' => "Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit..."],
            ['name' => 'roof', 'price' => 1000, 'detail' => "Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit..."],
            ['name' => 'bottom', 'price' => 500, 'detail' => "Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit..."],
            ['name' => 'side mirrors', 'price' => 300, 'detail' => "Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit..."],
            ['name' => 'bumpers', 'price' => 240, 'detail' => "Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit..."],
            ['name' => 'seats', 'price' => 700, 'detail' => "Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit..."],
        ]);
    }
}
