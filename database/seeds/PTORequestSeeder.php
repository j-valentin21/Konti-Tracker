<?php

use Illuminate\Database\Seeder;

class PTORequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\PTORequest::class, 10000)->create();
    }
}
