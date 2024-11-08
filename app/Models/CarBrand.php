<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class CarBrand extends Model
{
    use HasFactory;
    protected $fillable = ['title'];

    public function models(): HasMany
    {
        return $this->hasMany(CarBrandModel::class);
    }
}
