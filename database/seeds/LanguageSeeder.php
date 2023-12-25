<?php

use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function run()
    {
        $data = array();

        $data[] = array(
                'uuid'          => (string)Str::uuid(),
                'name'          => 'Tiếng Việt',
                'locale'        => 'vi',
                'timezone'      => 'Asia/Ho_Chi_Minh',
                'currency'      => 'VND',
                'exchange_rate' => 23165,
                'flag'          => GLOBAL_ASSETS_IMG . 'lang/vn.svg',
                'format_date'   => 'dd/mm/yyyy',
                'status'        => 'on',
                'default'       => 'on',
                'user_id'       => 1,
                'created_at'    => new \DateTime,
        );

        if (config('app.multi_language')) {
            $data[] = array(
                'uuid'          => (string)Str::uuid(),
                'name'          => 'English',
                'locale'        => 'en',
                'timezone'      => 'Europe/London',
                'currency'      => 'USD',
                'exchange_rate' => 1,
                'flag'          => GLOBAL_ASSETS_IMG . 'lang/en.svg',
                'format_date'   => 'yyyy/mm/dd',
                'status'        => 'on',
                'default'       => 'off',
                'user_id'       => 1,
                'created_at'    => new \DateTime,
            );
        }


        DB::table('languages')->insert($data);
    }
}
