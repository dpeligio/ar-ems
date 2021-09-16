<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $system_admin = User::create([
            'username' => 'admin',
            'first_name' => 'Apple Rose',
            'middle_name' => 'D',
            'last_name' => 'Corpuz',
            'email' => 'hououinkyouma.000001@gmail.com',
            'contact_number' => '09123456789',
            'password' => bcrypt('admin')
        ]);

        $system_admin->assignRole(1);
    }
}
