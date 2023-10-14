<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    use HasFactory;
    protected $fillable = [
        'NumeroFacture',
        'Objet',
        'date_echeant',
        'date_facture',
        'type',
        'tax_nom',
        'tax_percent',
        'id_client',
        'id_user',
        'id_category',
        'file',
        'id_facture',
    ];

    public function client()
    {
        return $this->belongsTo(InfoClient::class, 'id_client');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function category()
    {
        return $this->belongsTo(Categorie::class, 'id_category');
    }

    public function details()
    {
        return $this->hasMany(DetailFacture::class, 'id_facture');
    }
}
