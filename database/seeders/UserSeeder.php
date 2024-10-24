<?php

namespace Database\Seeders;

use App\Models\Roles;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRoleId = Roles::where('role_name', 'admin')->first()->id;
        $memberRoleId = Roles::where('role_name', 'member')->first()->id;
        DB::table('users')->insert([
            [
                'name' => 'Gilang Harsya Fadillah',
                'username' => 'harsyagilfa',
                'password' => Hash::make('admin123'),
                'no_telepon' => '08123456788',
                'status' => 'active',
                'role_id' => $adminRoleId, // role_id 1 untuk admin
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Asep Subejo',
                'username' => 'asep123',
                'password' => Hash::make('123456'),
                'no_telepon' => '08123456788',
                'role_id' => $memberRoleId,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Udin sedunia',
                'username' => 'udin123',
                'password' => Hash::make('123456'),
                'no_telepon' => '08123456788',
                'role_id' => $memberRoleId,
                'status' => 'inactive',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
