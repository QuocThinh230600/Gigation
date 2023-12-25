<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function run()
    {
        DB::table('users')->insert(
            [
                [
                    'uuid'       => (string)Str::uuid(),
                    'email'      => 'admin@quoctuan.info',
                    'password'   => Hash::make('password'),
                    'full_name'  => 'Vũ Quốc Tuấn',
                    'phone'      => '0933649647',
                    'status'     => 'on',
                    'level'      => 1,
                    'created_at' => new \DateTime(),
                    'updated_at' => new \DateTime(),
                ],
                [
                    'uuid'       => (string)Str::uuid(),
                    'email'      => 'support@quoctuan.info',
                    'password'   => Hash::make('password'),
                    'full_name'  => 'Trần Thị Kim Thanh',
                    'phone'      => '0933649647',
                    'status'     => 'on',
                    'level'      => 1,
                    'created_at' => new \DateTime(),
                    'updated_at' => new \DateTime(),
                ]
            ]
        );
    }
}
