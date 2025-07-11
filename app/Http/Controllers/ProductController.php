<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vendor;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ProductResource;
use App\Http\Requests\ProductCreateRequest;
use App\Http\Requests\ProductUpdateRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProductController extends Controller
{
    private function getVendor(User $user, int $idVendor): Vendor
    {
        $vendor = Vendor::where('user_id', $user->id)->where('id', $idVendor)->first();
        if (!$vendor) {
            throw new HttpResponseException(response()->json([
                'errors' => [
                    'message' =>[
                        'vendor not found'
                    ]
                ]
            ])->setStatusCode(404));
        }

        return $vendor;
    }

    private function getProduct(Vendor $vendor, int $idProduct): Product
    {
        $product = Product::where('vendor_id', $vendor->id)->where('id', $idProduct)->first();
        if (!$product) {
            throw new HttpResponseException(response()->json([
                'errors' => [
                    'message' =>[
                        'product not found'
                    ]
                ]
            ])->setStatusCode(404));
        }

        return $product;

    }
    public function create(int $idVendor, ProductCreateRequest $request): JsonResponse
    {
        $user = Auth::user();
        $vendor = $this->getVendor($user, $idVendor);

        $data = $request->validated();
        $product = new Product($data);
        $product->vendor_id = $vendor->id;
        $product->save();

        return (new ProductResource($product))->response()->setStatusCode(201);
    }

    public function get(int $idVendor,  int $idProduct ): ProductResource 
    {
        $user = Auth::user();
        $vendor = $this->getVendor($user, $idVendor);
        $product = $this->getProduct($vendor, $idProduct);

        return new ProductResource($product);
    }

    public function update(int $idVendor, int $idProduct, ProductUpdateRequest $request):  ProductResource
    {
        $user = Auth::user();
        $vendor = $this->getVendor($user, $idVendor);
        $product = $this->getProduct($vendor, $idProduct);

        $data = $request->validated();
        $product->fill($data);
        $product->save();

        return new ProductResource($product);
    }

    public function delete(int $idVendor, int $idProduct):  JsonResponse
    {
        $user = Auth::user();
        $vendor = $this->getVendor($user, $idVendor);
        $product = $this->getProduct($vendor, $idProduct);
        $product->delete();

        return response()->json([
            "data" => true
        ])->setStatuscode(200);
    }

}