<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Priorite extends Model
{
    use HasFactory;
    protected $fillable = ['nom', 'degre'];

    public function taches()
    {
        return $this->hasMany(Tache::class, 'id_priorite');
    }
}
