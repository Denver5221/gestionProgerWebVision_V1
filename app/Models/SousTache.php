<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SousTache extends Model
{
    use HasFactory;
    protected $table = 'sous_taches';
    protected $fillable = ['nom', 'description', 'id_tache', 'delai', 'file'];

    public function taches()
    {
        return $this->belongsTo(Tache::class, 'id_tache');
    }

    public function participants()
    {
        return $this->belongsToMany(User::class, 'sous_tache_user', 'id_soustache', 'id_user');
    }
}
