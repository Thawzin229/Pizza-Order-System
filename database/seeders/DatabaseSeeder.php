<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
    User::create([
        "name" => "thawzin",
        "email" =>"thawzin842019@gmail.com",
        "password"=> Hash::make("thawzin123"),
        "phone"=>"0944802737",
        "address"=>"yangon",
        "role" => "admin",
        "gender" => "male"
    ]);
    }
}
