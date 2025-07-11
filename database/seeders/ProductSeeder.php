<?php

namespace Database\Seeders;

use App\Models\Vendor;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vendor = Vendor::where('company_name', 'PT.SEGAR')->first();
        Product::create([
            'name' => 'cocacola',
            'description' => 'sangat menyegarkan',
            'price' => '8000.00',
            'stock' => '500',
            'vendor_id' => $vendor->id
        ]);
        
    }
}
