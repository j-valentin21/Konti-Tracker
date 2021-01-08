<?php

use Illuminate\Database\Seeder;
use Illuminate\Notifications\DatabaseNotification;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(DatabaseNotification::class, 100)->create();
    }
}
