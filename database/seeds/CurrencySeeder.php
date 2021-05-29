<?php

use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('currencies')->insert([
            "name"=>"usd",
            "sign"=>"$",
            "rate"=>1,
            "is_default"=>1
        ]);
    }
}
