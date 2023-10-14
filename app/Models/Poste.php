<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poste extends Model
{
    use HasFactory;
    protected $fillable = ['nom'];


    public function users() {
     
        return $this->belongsToMany(User::class, 'role_user', 'id_poste', 'id_user');
            
     }

}
