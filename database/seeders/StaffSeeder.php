<?php

namespace Database\Seeders;

use App\Models\Staff;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
//        DB::table('staff')->insert([
//            'surname' => Str::random(10),
//            'other_name' => Str::random(10).'@example.com',
//            'date_of_birth' => date('Y-m-d'),
//            'id_photo' => base64_encode(Str::random(15)),
//            'user_id' => rand(1, 10),
//        ]);

        // Generate 10 users with random data using factory
        Staff::factory(25)->create();
    }
}
