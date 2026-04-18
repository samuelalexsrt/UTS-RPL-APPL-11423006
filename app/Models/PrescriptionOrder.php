<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrescriptionOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'pharmacist_id',
        'pharmacy_stock_id',
        'quantity',
        'status',
        'instructions',
    ];

    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function pharmacist()
    {
        return $this->belongsTo(User::class, 'pharmacist_id');
    }

    public function stock()
    {
        return $this->belongsTo(PharmacyStock::class, 'pharmacy_stock_id');
    }
}
