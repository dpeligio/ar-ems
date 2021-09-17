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
            'email' => 'hououinkyouma.000001@gmail.com',
            'password' => bcrypt('admin')
        ]);

        $system_admin->assignRole(1);
    }
}
