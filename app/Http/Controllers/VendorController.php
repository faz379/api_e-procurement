<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\VendorResource;
use App\Http\Requests\VendorRegisterRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class VendorController extends Controller
{
    public function register(VendorRegisterRequest $request): JsonResponse
    {
        $data = $request->validated();
        $user = Auth::user();

        $vendor = new Vendor($data);
        $vendor->user_id = $user->id;
        $vendor->save();

        return (new VendorResource($vendor))->response()->setStatusCode(201);
    }

}
