<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjetTacheUser extends Model
{
    use HasFactory;
    protected $table = 'projet_tache_user';

    protected $fillable = ['id_projet', 'id_tache', 'id_user', 'id_priorite'];

    public function projet()
    {
        return $this->belongsTo(Projet::class, 'id_projet');
    }

    public function tache()
    {
        return $this->belongsTo(Tache::class, 'id_tache');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function priorite()
    {
        return $this->belongsTo(Priorite::class, 'id_priorite');
    }
}
