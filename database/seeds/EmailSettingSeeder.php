<?php

use Illuminate\Database\Seeder;

class EmailSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('email_settings')->insert([
            'smtp_host'=>'',
            'smtp_port'=>'',
            'smtp_user'=>'',
            'smtp_pass'=>'',
            'from_email'=>'',
            'from_name'=>'',
            'is_active'=>0,
            'mail_encryption'=>'tls'
        ]);
    }
}
