<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Vendor;
use App\Models\Product;
use Database\Seeders\UserSeeder;
use Database\Seeders\VendorSeeder;
use Database\Seeders\ProductSeeder;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    use RefreshDatabase;
    public function testCreateProductSucces()
    {

        $this->seed(UserSeeder::class);
        $this->seed(VendorSeeder::class);
    
        $vendor = Vendor::whereHas('user', function ($query) {
            $query->where('username', 'jeng');
        })->first();
    
        $this->assertNotNull($vendor, 'Vendor not found. Pastikan VendorSeeder membuat data.');
    
        $this->post('/api/vendor/' . $vendor->id+1 . '/products', 
        [
            'name' => 'air',
            'description' => 'hahahaha',
            'price' => '1000',
            'stock' => '50'
        ],
        [
            'Authorization' => 'jeng'
        ])->assertStatus(201)
            ->assertJson([
                'data' => [
                    'name' => 'air',
                    'description' => 'hahahaha',
                    'price' => '1000',
                    'stock' => '50'
                ]
            ]);
    }

    public function testCreateProductFailed()
    {
        // $this->seed(UserSeeder::class); // seed user dulu
        // $this->seed(VendorSeeder::class);// lalu vendor (dengan user_id dari user 'jung')
    
        $vendor = Vendor::whereHas('user', function ($query) {
            $query->where('username', 'jeng');
        })->first();
    
        $this->assertNotNull($vendor, 'Vendor not found. Pastikan VendorSeeder membuat data.');
    
        $this->post('/api/vendor/' . $vendor->id+1 . '/products', 
        [
            'name' => 'air',
            'description' => 'hahahaha',
            'price' => '1000',
            'stock' => '50'
        ],
        [
            'Authorization' => 'jeng'
        ])->assertStatus(404)
            ->assertJson([
                'errors' =>   [
                    'message' =>[
                        'not found'
                    ]

                ]
            ]);
    }

    public function testGetProductSucces()
    {
        $this->seed([
            UserSeeder::class,
            VendorSeeder::class,
            ProductSeeder::class,
        ]);
        
        
        $product = Product::query()->limit(1)->first();

        $this->get('/api/vendor/' . $product->vendor_id . '/products/' . $product->id,[
            'Authorization' => 'soto'
        ])->assertStatus(200)
            ->assertJson([
                'data' => [
                    'name' => 'cocacola',
                    'description' => 'sangat menyegarkan',
                    'price' => '8000.00',
                    'stock' => '500'
                ]
                ]);
    }

    public function testUpdateProductSucces()
    {
        $this->seed([
            UserSeeder::class,
            VendorSeeder::class,
            ProductSeeder::class,
        ]);  
        $product = Product::query()->limit(1)->first();

        $this->put('/api/vendor/' . $product->vendor_id . '/products/' . $product->id, 
        [
            'name' => 'sprite',
            'description' => 'sangat menyegarkan',
            'price' => '9000.00',
            'stock' => '200'   
        ],
        [
            'Authorization' => 'soto'
        ]
        )->assertStatus(200)
            ->assertJson([
                'data' => [
                    'name' => 'sprite',
                    'description' => 'sangat menyegarkan',
                    'price' => '9000.00',
                    'stock' => '200' 
                ]
            ]);
    }

    public function testDeleteProductSucces()
    {
        $this->seed([
            UserSeeder::class,
            VendorSeeder::class,
            ProductSeeder::class,
        ]);  
        $product = Product::query()->limit(1)->first();

        $this->delete('/api/vendor/' . $product->vendor_id . '/products/' . $product->id, 
        [  
        ],
        [
            'Authorization' => 'soto'
        ]
        )->assertStatus(200)
            ->assertJson([
                'data' => true
            ]);
    }

}
