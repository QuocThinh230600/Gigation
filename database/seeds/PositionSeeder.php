<?php

use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function run()
    {
        DB::table('positions')->insert([
            'uuid'       => (string)Str::uuid(),
            'name'       => '------------ ROOT ------------',
            'status'     => 'on',
            'position'   => 0,
            'user_id'    => 1,
            'created_at' => new \DateTime(),
            'updated_at' => new \DateTime(),
        ]);
    }
}
