<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CarBrandModel extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'car_brand_id'];

    public function brand(): BelongsTo
    {
        return $this->belongsTo(CarBrand::class);
    }

    public function hasModel(CarBrand $carBrand): bool
    {
        return $this->car_brand_id === $carBrand->id;
    }
}
