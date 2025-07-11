<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Vendor;
use Database\Seeders\UserSeeder;
use Database\Seeders\VendorSeeder;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VendorTest extends TestCase
{
    public function testRegisterVendorSuccess()
    {
        
        $this->seed([UserSeeder::class]);
        
        $this->post('api/vendor', [
            'company_name' => 'PT.JAYABAYU',
            'address' => 'JL. TIPAR BAYU NO 12',
            'company_email' => 'jayabayu12@gmail.com'
        ], [
            'Authorization' => 'jangkrik'
        ])->assertStatus(201)
            ->assertJson([
                "data" => [
                    'company_name' => 'PT.JAYABAYU',
                    'address' => 'JL. TIPAR BAYU NO 12',
                    'company_email' => 'jayabayu12@gmail.com'
                ]
            ]);
    }

    // public function testGetVendorSuccess()
    // {
    //     //$this->seed(UserSeeder::class, VendorSeeder::class);
    //     $vendor = Vendor::where('company_name', 'PT.BAYA')->first();

    //     $this->get('/api/vendor/{$vendor->id}', [
    //         'Authorization' => 'jung'
    //     ])->assertStatus(200)
    //         ->assertJson([
    //             'data' => [
    //                 'company_name' => 'PT.BAYA',
    //                 'address' => 'wkwkwkwkwk',
    //                 'company_email' => 'surabaya77@gmail.com'
    //             ]
    //         ]);
    // }
}
