<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailFacture extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_facture',
        'designation',
        'details',
        'prix_unitaire',
        'quantite',
        'total',
    ];

    public function facture()
    {
        return $this->belongsTo(Facture::class, 'id_facture');
    }
}
