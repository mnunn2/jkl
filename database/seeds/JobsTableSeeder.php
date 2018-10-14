<?php

use Illuminate\Database\Seeder;

class JobsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('jobs')->delete();
        DB::table('jobs')->insert([
            ['project_id' => '1', 'name' => 'plot 9', 'description' => '2nd fix', 'type' => 'contract', 'active' => true, 'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s') ],
            ['project_id' => '1', 'name' => 'plot 9', 'description' => '1st fix', 'type' => 'contract', 'active' => true, 'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s') ],
            ['project_id' => '2', 'name' => 'vicarage', 'description' => 'vicarage stuff', 'type' => 'contract', 'active' => true, 'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s') ],
            ['project_id' => '2', 'name' => 'benfleet', 'description' => 'benfleet stuff', 'type' => 'contract', 'active' => true, 'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s') ],
            ['project_id' => '3', 'name' => 'day work', 'description' => 'day work stuff', 'type' => 'contract', 'active' => true, 'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s') ],
            ['project_id' => '3', 'name' => '2nd fix', 'description' => '2nd fix stuff', 'type' => 'contract', 'active' => true, 'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s') ],
        ]);
    }
}
