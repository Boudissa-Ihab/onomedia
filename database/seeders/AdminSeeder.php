<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name' => "admin",
            'email' => "admin@gmail.com",
            'phone' => "0550102030",
            'password' => Hash::make("123456789")
        ]);
    }
}
