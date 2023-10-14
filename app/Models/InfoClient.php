<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoClient extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_client',
        'ifu',
        'rccm',
        'addresse',
        'telephone',
    ];

    public function factures()
    {
        return $this->hasMany(Facture::class, 'id_client');
    }
}
