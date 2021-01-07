<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factory;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 50)->create();
    }
}