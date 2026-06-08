<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        for ($i=0; $i < 50; $i++) {
            User::create([
                'nombre' => "usuario$i",
                'email' => "email$i@test.com",
                'password' => bcrypt("pass$i"),
            ]);
        }
    }
}