<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create Admin User
        $user = User::create([
            'name'    => 'Super Admin',
            'email'         =>  'admin@cypherox.com',
            'role'         =>  'admin',
            'mobile_no' =>  '9624049054',
            'password'      =>  Hash::make('Admin@123#')
        ]);
    }
}
