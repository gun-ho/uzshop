<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 * @package App\Models
 * @property int $id
 * @property string $name
 * @property string $detail
 * @property float $price
 * @property int $stock
 * @property float $discount
 * @property string $created_at
 */
class Product extends Model
{
    use HasFactory;

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
