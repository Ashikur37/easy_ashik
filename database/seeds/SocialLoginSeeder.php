<?php

use Illuminate\Database\Seeder;

class SocialLoginSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('social_login_settings')->insert([
            'is_facebook'=>0,
            'is_google'=>0,
            'facebook_client_id'=>'',
            'facebook_client_secret'=>'',
            'google_client_id'=>'',
            'google_client_secret'=>'',
        ]);
    }
}
