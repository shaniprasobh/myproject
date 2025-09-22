<?php

namespace Database\Seeders;

use App\Models\Company;

use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    public function run()
    {
        Company::create([
            'company_name' => 'Admin Company',
            'address' => '123 Main Street',
            'email' => 'info@admincompany.com',
            'mobile_number' => '9999999999',
            'country_id' => 1,
            'state_id' => 1,
            'gst_number' => 'GST123456'
        ]);
    }
}
