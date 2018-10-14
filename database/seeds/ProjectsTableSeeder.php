<?php

use Illuminate\Database\Seeder;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('projects')->delete();
        DB::table('projects')->insert([
            ['id' => 1, 'name' => 'stonehall', 'description' => 'D & B Stonehall', 'type' => 'contract', 'active' => true, 'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s') ],
            ['id' => 2, 'name' => 'chignal', 'description' => 'Chignal', 'type' => 'contract', 'active' => true, 'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s') ],
            ['id' => 3, 'name' => 'john ford', 'description' => 'John Ford', 'type' => 'contract', 'active' => true, 'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s') ]
        ]);
    }
}
