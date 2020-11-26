<?php

use App\User;
use Illuminate\Database\Seeder;

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
            'rut' => '10000000-0',
            'name' => 'Administrador',
            'email' => 'admin@agrosyscare.com',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'), // password
            'role_id' => '1',
        ]);
        
        factory(User::class, 5)->create();
    }
}
