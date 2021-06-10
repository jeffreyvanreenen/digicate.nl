<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factuurregel extends Model
{
    use HasFactory;

    public function invoices()
    {
        return $this->belongsTo(Invoice::class);
    }
}
