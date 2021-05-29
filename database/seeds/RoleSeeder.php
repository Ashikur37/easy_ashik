<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            "name"=>"admin",
            "label"=>"Admin"
        ]);
        for($i=1;$i<=185;$i++){
            DB::table('permission_role')->insert([
                "role_id"=>1,
                "permission_id"=>$i
            ]);
        }
        // DB::table('role_user')->insert([
        //     "role_id"=>1,
        //     "user_id"=>1
        // ]);
            
    }
}
