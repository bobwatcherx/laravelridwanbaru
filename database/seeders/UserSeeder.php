<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       User::create([
            'name' => 'pocarisweet',
            'email' => 'pocari@mais.com',
            'password' => 'pocari',
            'role' => 'admin',
            'updated_at' => now() ,
            'created_at' => now(),
            'last_login'=> now()
        ]);

        User::factory()->count(50)->create();
    }
}
