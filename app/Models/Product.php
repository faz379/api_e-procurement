<?php

namespace App\Models;

use App\Models\Vendor;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";
    protected $primaryKey = "id";
    protected $keyType = "int";
    public $timestamp = true;
    public $incrementing = true;

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock'
    ];

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class, "vendor_id", "id");
    }
}
