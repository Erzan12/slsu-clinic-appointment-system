<?php

namespace Database\Seeders;

use App\Models\Information;
use App\Models\Specialist;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class SpecialistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Specialist::truncate();

        $specialists = [
            [
                'employee_id' => '0001',
                'position' => 'University Doctor',
                'avatar' => Storage::url('specialists/doctor.jpg'),
                'first_name' => 'Edmundo',
                'last_name' => 'Villa',
                'email' => 'edmundovilla@slsu.com',
                'gender' => 1,
                'contact_number' => '912345678',
                'barangay' => 'SLSU',
                'municipality' => 'Sogod',
                'province' => 'Southern Leyte'
            ],
            [
                'employee_id' => '0002',
                'position' => 'Nurse II',
                'avatar' => Storage::url('specialists/nurse.jpg'),
                'first_name' => 'Maria Emelee',
                'last_name' => 'Bascug',
                'email' => 'mariaemeleebascug@slsu.com',
                'gender' => 2,
                'contact_number' => '912345678',
                'barangay' => 'SLSU',
                'municipality' => 'Sogod',
                'province' => 'Southern Leyte'
            ],
            [
                'employee_id' => '0003',
                'position' => 'Nursing Attendant',
                'avatar' => Storage::url('specialists/nurse_attendant.jpg'),
                'first_name' => 'Hadassah',
                'last_name' => 'Sablayan',
                'email' => 'hadassahsablayan@slsu.com',
                'gender' => 2,
                'contact_number' => '912345678',
                'barangay' => 'SLSU',
                'municipality' => 'Sogod',
                'province' => 'Southern Leyte'
            ],
        ];

        foreach($specialists as $specialist)
        {
            $user = Specialist::create([
                'employee_id' => $specialist['employee_id'],
                'position' => $specialist['position'],
            ]);

            Information::create([
                'user_id' => $user->id,
                'account_type' => 2,
                'avatar' => $specialist['avatar'],
                'first_name' => $specialist['first_name'],
                'last_name' => $specialist['last_name'],
                'email' => $specialist['email'],
                'gender' => $specialist['gender'],
                'contact_number' => $specialist['contact_number'],
                'barangay' => $specialist['barangay'],
                'municipality' => $specialist['municipality'],
                'province' => $specialist['province']
            ]);

            User::create([
                'username' => $user->employee_id,
                'password' => bcrypt('1234'),
                'user_id' => $user->id,
                'account_type' => 2
            ]);
        }

    }
}
