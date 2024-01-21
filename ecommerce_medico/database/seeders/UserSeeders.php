<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Carbon\Carbon;
class UserSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            array('name' => 'Hassan Murad' , 'email' => 'admin@gmail.com' ,'password' => bcrypt(123456789) , 'email_verified_at' => Carbon::now() , 'role' => 1)
        ]);
    }
}
