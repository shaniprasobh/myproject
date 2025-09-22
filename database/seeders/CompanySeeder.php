<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;

class CompanySeeder extends Seeder
{
    public function run()
    {
        Company::firstOrCreate(
            ['company_name' => 'Admin Company'], // unique check
            [
                'address' => '123 Main Street',
                'email' => 'info@admincompany.com',
                'mobile_number' => '9999999999',
                'country_id' => 1,
                'state_id' => 1,
                'gst_number' => 'GST123456'
            ]
        );
    }
}
