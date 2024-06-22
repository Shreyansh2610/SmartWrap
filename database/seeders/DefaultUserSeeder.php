<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DefaultUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::createOrFirst([
            'name' => 'SmartWrap Admin',
            'email' => 'smartwrap.admin@gmail.com'
        ],[
            'password' => bcrypt('smartwrap@admin2610'),
        ]);
    }
}
