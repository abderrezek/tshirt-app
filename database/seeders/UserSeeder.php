<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)
            ->create();

        $admin = new User;
        $admin->name = 'Admin';
        $admin->phone = '0560314280';
        $admin->role = 'administrateur';
        $admin->email = 'admin@gmail.com';
        $admin->password = Hash::make('123456789');
        $admin->email_verified_at = now();

        $admin->save();
    }
}
