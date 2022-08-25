<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserType;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory()->create([
            'firstName'     =>      'Foo',
            'middleName'    =>      'D',
            'lastName'      =>      'Bar',
            'username'      =>      'kikoadmin',
            'email'         =>      'kiko@lucky8',
            'userTypeId'    =>      1
        ]);

        $this->call(UserTypeSeeder::class);
    }
}
