<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Shipment;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            \App\Models\User::create([
                'name' => 'Administrator',
                'email' => 'sae.express.wanguk@gmail.com',
                'password' => Hash::make('saeexpress@123#'),
                'email_verified_at' => Carbon::now()
            ]);

            \App\Models\Role::create([
                'name' => 'administrator'
            ]);
        });

        $this->call(PermissionSeeder::class);
    }
}
