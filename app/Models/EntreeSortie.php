<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntreeSortie extends Model
{
    use HasFactory;
    protected $table = 'depenses';

    protected $fillable = [
        'nom',
        'description',
        'montant',
        'status',
        'id_projet',
        'file',
    ];

    // Relation avec la table "projets"
    public function projet()
    {
        return $this->belongsTo(Projet::class, 'id_projet');
    }
}
