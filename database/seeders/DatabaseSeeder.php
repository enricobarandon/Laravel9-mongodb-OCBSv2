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
            'first_name'        =>      'Foo',
            'middle_name'       =>      'D',
            'last_name'         =>      'Bar',
            'username'          =>      'kikoadmin',
            'email'             =>      'kiko@lucky8',
            'user_type_id'      =>      1
        ]);

        \App\Models\User::factory()->create([
            'first_name'        =>      'Cashier',
            'middle_name'       =>      'And',
            'last_name'         =>      'Teller',
            'username'          =>      'cashier',
            'email'             =>      'cashierteller@lucky8',
            'user_type_id'      =>      4
        ]);

        $this->call(UserTypeSeeder::class);
    }
}
