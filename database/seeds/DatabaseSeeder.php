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
        // $this->call(UsersTableSeeder::class);
        factory(App\Employee::class,10)->create()->each(function($employee) {
            $employee->visits()->saveMany(factory(App\Visit::class,5)->make());
        });
    }
}
