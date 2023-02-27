<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $salt = env('SALT_CODE');
        $uuid = Hash::make($salt . Uuid::uuid4()->toString() . $salt);
        User::create([
            'username' => 'admin',
            'password' => bcrypt('12345678'),
            'role' => 'Admin',
            'foto' => 'assets/uploads/users/default.png',
            'uuid' => preg_replace('/[\/\\\\]/', '', $uuid)
        ]);
    }
}
