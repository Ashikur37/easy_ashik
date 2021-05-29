<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(EmailSettingSeeder::class);
        $this->call(NotificationSettingSeeder::class);
        $this->call(PaymentSettingSeeder::class);
        $this->call(SettingSeeder::class);
        $this->call(SocialLoginSeeder::class);
        $this->call(LanguageSeeder::class);
        $this->call(CurrencySeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
    }
}
