<?php

use Illuminate\Database\Seeder;

class WorkTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('work_types')->insert([
            ['work_type' => 'filter change'],
            ['work_type' => 'tunning'],
            ['work_type' => 'oil change'],
        ]);
    }
}
