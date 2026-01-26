<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = [
            [
                'image' => 'services/otc.jpg',
                'name' => 'Provision of OTC Medication',
                'description' => ''
            ],
            [
                'image' => 'services/physical_assessment.jpg',
                'name' => 'Physical Assessment',
                'description' => ''
            ],
            [
                'image' => 'services/consultations.jpg',
                'name' => 'Consultation',
                'description' => ''
            ],
            [
                'image' => 'services/wound.jpg',
                'name' => 'Wound Dressing',
                'description' => ''
            ],
            [
                'image' => 'services/medcert.jpg',
                'name' => 'Medical/Health Certificate',
                'description' => ''
            ],
            [
                'image' => 'services/bptaking.jpg',
                'name' => 'Blood Pressure Taking',
                'description' => ''
            ],
            [
                'image' => 'services/refer.jpg',
                'name' => 'Referral',
                'description' => ''
            ],
            [
                'image' => 'services/provosionofcare.jpg',
                'name' => 'Provision of Comfort',
                'description' => ''
            ],
        ];
        Service::truncate();
        Service::insert($services);
    }
}
