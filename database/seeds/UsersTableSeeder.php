<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('users')->insert([
            ['id' => 1, 'email' => 'admin@towfix.com', 'f_name' => 'noman', 'l_name' => 'tufail', 'role'=> '1', 'password' => bcrypt('123456')],
            ['id' => 2, 'email' => 'franchise@towfix.com', 'f_name' => 'jazz', 'l_name' => 'franchise', 'role'=> '2', 'password' => bcrypt('123456')],
            ['id' => 3, 'email' => 'customer@towfix.com', 'f_name' => 'honda', 'l_name' => 'franchise', 'role'=> '3', 'password' => bcrypt('123456')],
        ]);
    }
}
