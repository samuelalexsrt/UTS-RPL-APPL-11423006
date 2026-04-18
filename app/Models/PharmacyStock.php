<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PharmacyStock extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'quantity',
        'price',
    ];

    public function orders()
    {
        return $this->hasMany(PrescriptionOrder::class, 'pharmacy_stock_id');
    }
}
