<?php

use App\Activity;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Insert one entry to the Database
        DB::table('activities')->insert([
            'user_id' => 1,
            'date' => '2020-11-08',
            'time' => '09:35:47',
            'pto_used'=> 4,
            'points' =>1,
            'pending' =>1,
            'reason_for_request' =>'COVID',
            'supervisor_name' => 'Joey',
            'status' => 'accepted',
            'updated_at' => '2020-12-15 21:32:41',
            'created_at' => '2020-12-15 21:32:41'
        ]);
    }
}
