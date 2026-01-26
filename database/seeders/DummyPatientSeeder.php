<?php

namespace Database\Seeders;

use App\Models\Information;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyPatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $patient = Patient::create([
            'id_number' => '1234'
        ]);

        Information::factory()->create([
            'user_id' => $patient->id,
            'account_type' => 3
        ]);

        User::create([
            'username' => $patient->id_number,
            'password' => bcrypt('1234'),
            'user_id' => $patient->id,
            'account_type' => 3
        ]);
    }
}
