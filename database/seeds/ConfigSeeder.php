<?php

use Illuminate\Database\Seeder;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function run()
    {
        DB::table('configs')->insert([
            ['attribute' => 'website_name', 'value' => config('app.name'), 'created_at' => new \DateTime(), 'updated_at' => new \DateTime()],
            ['attribute' => 'title', 'value' => config('app.name'), 'created_at' => new \DateTime(), 'updated_at' => new \DateTime()],
            ['attribute' => 'meta_robots', 'value' => 'index,follow', 'created_at' => new \DateTime(), 'updated_at' => new \DateTime()],
            ['attribute' => 'meta_google_bot', 'value' => 'index,follow', 'created_at' => new \DateTime(), 'updated_at' => new \DateTime()],
            ['attribute' => 'meta_keywords', 'value' => 'quoctuan.info', 'created_at' => new \DateTime(), 'updated_at' => new \DateTime()],
            ['attribute' => 'meta_description', 'value' => config('app.name'), 'created_at' => new \DateTime(), 'updated_at' => new \DateTime()],
            ['attribute' => 'copyright', 'value' => 'quoctuan.info', 'created_at' => new \DateTime(), 'updated_at' => new \DateTime()],
            ['attribute' => 'author', 'value' => 'KingFox', 'created_at' => new \DateTime(), 'updated_at' => new \DateTime()],
            ['attribute' => 'placename', 'value' => 'Ho Chi Minh, Viet Nam', 'created_at' => new \DateTime(), 'updated_at' => new \DateTime()],
            ['attribute' => 'region', 'value' => 'VN-HN', 'created_at' => new \DateTime(), 'updated_at' => new \DateTime()],
            ['attribute' => 'position', 'value' => '21.030624;105.782431', 'created_at' => new \DateTime(), 'updated_at' => new \DateTime()],
            ['attribute' => 'icbm', 'value' => '21.030624;105.782431', 'created_at' => new \DateTime(), 'updated_at' => new \DateTime()],
            ['attribute' => 'revisit_after', 'value' => 'days', 'created_at' => new \DateTime(), 'updated_at' => new \DateTime()],
            ['attribute' => 'facebook', 'value' => 'https://facebook.com/', 'created_at' => new \DateTime(), 'updated_at' => new \DateTime()],
            ['attribute' => 'youtube', 'value' => 'https://youtube.com/', 'created_at' => new \DateTime(), 'updated_at' => new \DateTime()],
            ['attribute' => 'twitter', 'value' => 'https://twitter.com/', 'created_at' => new \DateTime(), 'updated_at' => new \DateTime()],
            ['attribute' => 'linkedin', 'value' => 'https://linkedin.com/', 'created_at' => new \DateTime(), 'updated_at' => new \DateTime()],
            ['attribute' => 'google_plus', 'value' => 'https://myaccount.google.com/profile', 'created_at' => new \DateTime(), 'updated_at' => new \DateTime()],
            ['attribute' => 'google_analytics', 'value' => '', 'created_at' => new \DateTime(), 'updated_at' => new \DateTime()],
            ['attribute' => 'google_ads', 'value' => '', 'created_at' => new \DateTime(), 'updated_at' => new \DateTime()],
            ['attribute' => 'facebook_script', 'value' => '', 'created_at' => new \DateTime(), 'updated_at' => new \DateTime()],
            ['attribute' => 'chat', 'value' => '', 'created_at' => new \DateTime(), 'updated_at' => new \DateTime()],
            ['attribute' => 'logo', 'value' => '', 'created_at' => new \DateTime(), 'updated_at' => new \DateTime()],
            ['attribute' => 'favicon', 'value' => '', 'created_at' => new \DateTime(), 'updated_at' => new \DateTime()],
            ['attribute' => 'contrast_logo', 'value' => '', 'created_at' => new \DateTime(), 'updated_at' => new \DateTime()],
            ['attribute' => 'error_image', 'value' => '', 'created_at' => new \DateTime(), 'updated_at' => new \DateTime()],
            ['attribute' => 'css', 'value' => '', 'created_at' => new \DateTime(), 'updated_at' => new \DateTime()],
            ['attribute' => 'js', 'value' => '', 'created_at' => new \DateTime(), 'updated_at' => new \DateTime()],
        ]);
    }
}
