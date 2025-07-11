<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('username', 'soto')->first();
        if ($user) {
            Vendor::create([
                'company_name' => 'PT.SEGAR',
                'address' => 'wkwkwkwkwk',
                'company_email' => 'surabaya77@gmail.com',
                'user_id' => $user->id
            ]);
        }
    }
}
