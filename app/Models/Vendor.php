<?php

namespace App\Models;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vendor extends Model
{
    protected $primaryKey = "id";
    protected $keyType = "int";
    protected $table = "vendors";
    public $incrementing = true;
    public $timestamp = true;

    protected $fillable = [
        'company_name',
        'address',
        'company_email',
    ];

    public function user(): BelongsTo 
    {
        return $this->belongsTo(User::class, "user_id", "id");
    }

    public function product(): HasMany 
    {
        return $this->hasMany(Product::class, "vendor_id", "id");
    }

}
