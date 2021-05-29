<?php

use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('languages')->insert([
            "name"=>"English",
            "is_active"=>1,
            "is_default"=>1,
            "file"=>"english.json"
        ]);
    }
}
