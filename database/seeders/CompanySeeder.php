<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = [
            [
                'name' => 'TechCorp',
                'logo' => 'logos/techcorp.png',
                'status' => 'Active',
            ],
            [
                'name' => 'HealthPlus',
                'logo' => 'logos/healthplus.png',
                'status' => 'Active',
            ],
            [
                'name' => 'EduWorld',
                'logo' => 'logos/eduworld.png',
                'status' => 'Inactive',
            ],
            [
                'name' => 'EcoFriendly Solutions',
                'logo' => 'logos/ecofriendly.png',
                'status' => 'Active',
            ],
            [
                'name' => 'Global Industries',
                'logo' => 'logos/global.png',
                'status' => 'Active',
            ],
        ];

        foreach ($companies as $company) {
            Company::create($company);
        }
    }
}