<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'omschrijving',
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function factuurregels()
    {
        return $this->hasMany(Factuurregel::class);
    }

    public function factuurlog()
    {
        return $this->hasMany(InvoiceLog::class)->orderBy('id', 'desc');
    }

}
