<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Address;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            ['name' => 'Kak Rina', 'phone' => '081234567890', 'email' => 'rina@email.com', 'password' => Hash::make('123456')],
            ['name' => 'Kak Doni', 'phone' => '082345678901', 'email' => 'doni@email.com', 'password' => Hash::make('123456')],
            ['name' => 'Kak Sari', 'phone' => '083456789012', 'email' => 'sari@email.com', 'password' => Hash::make('123456')],
            ['name' => 'Admin Titipin', 'phone' => '089999999999', 'email' => 'admin@titipin.com', 'password' => Hash::make('654321')],
        ];

        foreach ($users as $u) {
            $user = User::create($u);

            Address::create([
                'user_id' => $user->id,
                'label' => 'Rumah',
                'name' => $u['name'],
                'phone' => $u['phone'],
                'address' => 'Jl. Contoh No. ' . $user->id,
                'city' => ['Surabaya', 'Makassar', 'Medan', 'Jakarta'][$user->id - 1],
                'province' => ['Jawa Timur', 'Sulawesi Selatan', 'Sumatera Utara', 'DKI Jakarta'][$user->id - 1],
                'postal_code' => '6' . str_pad($user->id, 4, '0', STR_PAD_LEFT) . '0',
                'is_default' => true,
            ]);
        }
    }
}
