<?php

use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orders = [];
        for($i = 1; $i < 6; $i++)
            $orders[] = ['product_id' => $i, 'user_id'=>3];
        \Illuminate\Support\Facades\DB::table('orders')->insert($orders);
    }
}
