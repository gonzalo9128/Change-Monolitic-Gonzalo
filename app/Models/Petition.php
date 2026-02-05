<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\File;

class Petition extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'destinatary',
        'signers',
        'status',
        'user_id',
        'category_id',
    ];

    public function files()
    {
        // Antes tenías algo como: return $this->hasMany(\change_Monolitic...\File::class);
        // Ahora debe ser así:
        return $this->hasMany(File::class);
    }

    // Si tienes relación con usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Si tienes relación con categoría
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function firmantes()
    {
        return $this->belongsToMany(User::class, 'petition_user');
    }
}
