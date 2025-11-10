<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    protected $fillable = [
        'producer_id',
        'name',
        'description',
        'price',
        'commission_percentage',
    ];

    public function producer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'producer_id');
    }

    public function affiliates(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'affiliate_links', 'product_id', 'affiliate_id')
            ->withPivot('unique_code')
            ->withPivot('clicks');
    }

}