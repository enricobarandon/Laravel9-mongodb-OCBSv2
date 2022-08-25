<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserType;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {  
        UserType::create([
            'id'    =>  1,
            'role'  =>  'Administrator'
        ]);

        UserType::create([
            'id'    =>  2,
            'role'  =>  'Teller'
        ]);

        UserType::create([
            'id'    =>  3,
            'role'  =>  'Cashier'
        ]);

        UserType::create([
            'id'    =>  4,
            'role'  =>  'Teller and Cashier'
        ]);
        
        UserType::create([
            'id'    =>  5,
            'role'  =>  'Mobile Player'
        ]);

        UserType::create([
            'id'    =>  6,
            'role'  =>  'Supervisor'
        ]);

        UserType::create([
            'id'    =>  7,
            'role'  =>  'Cashier Report'
        ]);

        UserType::create([
            'id'    =>  8,
            'role'  =>  'Declarator'
        ]);

        UserType::create([
            'id'    =>  9,
            'role'  =>  'Boss'
        ]);

        UserType::create([
            'id'    =>  10,
            'role'  =>  'Board Administrator'
        ]);

        UserType::create([
            'id'    =>  11,
            'role'  =>  'Operator'
        ]);

        UserType::create([
            'id'    =>  12,
            'role'  =>  'Users Monitor'
        ]);

        UserType::create([
            'id'    =>  13,
            'role'  =>  'Guarantor'
        ]);
    }
}
