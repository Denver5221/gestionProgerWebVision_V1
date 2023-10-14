<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Projet extends Model
{
    use HasFactory;
    protected $table = 'projets';

    protected $fillable = [
        'nom',
        'description',
        'delai',
        'id_categorie',
        'file',
    ];

    public function entreesSorties()
    {
        return $this->hasMany(EntreeSortie::class, 'id_projet');
    }


    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'id_categorie');
    }

    public function participants()
    {
        return $this->belongsToMany(User::class, 'projet_user', 'id_projet', 'id_user');
    }

    public function taches()
    {
        return $this->hasMany(Tache::class, 'id_projet');
    }
}
