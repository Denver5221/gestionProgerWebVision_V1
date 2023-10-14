<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntreeSortieCategorie extends Model
{
    use HasFactory;

    protected $table = 'depenses_categorie';

    protected $fillable = [
        'nom',
        'description',
        'montant',
        'status',
        'id_categorie',
        'file',
    ];

    // Relation avec la catégorie à laquelle cette entrée/sortie est liée
    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'id_categorie');
    }


}
