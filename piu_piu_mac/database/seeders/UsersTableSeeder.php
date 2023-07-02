<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User;
        $user->name = "Dari";
        $user->email = "wowddm.developer@gmail.com";
        $user->password = bcrypt('Dari18353110');
        $user->is_admin = true;
        $user->save();

        $user2 = new User;
        $user2->name = "Steefy";
        $user2->email = "bun.stefania@gmail.com";
        $user2->password = bcrypt('Steefy_The_Steef');
        $user2->is_admin = true;
        $user2->save();
    }
}
