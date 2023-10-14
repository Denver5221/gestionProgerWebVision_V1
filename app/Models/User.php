<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Role;
use App\Models\Poste;
use App\Models\Projet;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;



class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'telephone',
        'id_poste',
        'id_role',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function poste()
    {
        return $this->belongsTo(Poste::class, 'id_poste');
    }


    public function roles() {

        return $this->belongsToMany(Role::class, 'role_user', 'id_user', 'id_role');

     }

     public function projets()
     {
         return $this->belongsToMany(Projet::class, 'projet_user', 'id_user', 'id_projet');
     }

     public function taches()
    {
        return $this->belongsToMany(Tache::class, 'projet_tache_user', 'id_user', 'id_tache')->withPivot('id_priorite');
    }

    public function sousTaches()
    {
        return $this->belongsToMany(User::class, 'sous_tache_user', 'id_soustache', 'id_user');
    }
}
