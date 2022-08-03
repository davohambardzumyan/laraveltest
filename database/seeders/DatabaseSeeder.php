<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         User::factory(10)->create();

         /*\App\Models\User::factory()->create([
             'first_name' => 'Admin',
             'last_name' => 'Admin',
             'email' => 'admin@email.com',
             'email_verified_at'=>Carbon::now(),
             'password'=>Hash::make('Secret123#'),
             'role'=>UserRole::ADMIN
         ]);*/
    }
}
