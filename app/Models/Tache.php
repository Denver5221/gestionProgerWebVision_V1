<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tache extends Model
{
    use HasFactory;

    protected $table = 'taches';

    protected $fillable = ['nom', 'description', 'delai','id_priorite'];

    public function projets()
    {
        return $this->belongsTo(Projet::class, 'id_projet');
    }

    public function priorite()
    {
        return $this->belongsTo(Priorite::class, 'id_priorite');
    }

    public function participants()
    {
        return $this->belongsToMany(User::class, 'projet_tache_user', 'id_tache', 'id_user')->withPivot('id_priorite');
    }

    public function sousTaches()
    {
        return $this->hasMany(SousTache::class, 'id_tache');
    }
}
