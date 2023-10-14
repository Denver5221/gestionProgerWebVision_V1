<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;
    protected $table = 'categories';

    protected $fillable = [
        'nom',
        'description',
    ];

    // Relation avec les entrées/sorties liées à cette catégorie
    public function entreesSorties()
    {
        return $this->hasMany(EntreeSortieCategorie::class, 'id_categorie');
    }


    public function projets()
    {
        return $this->hasMany(Projet::class, 'id_categorie');
    }

    public function facture()
    {
        return $this->hasMany(Facture::class, 'id_category');
    }
}
