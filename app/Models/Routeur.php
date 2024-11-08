<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Routeur extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'reseau'];

    public function liens()
    {
        return $this->hasMany(Lien::class, 'routeur1_id')
                    ->orWhere('routeur2_id', $this->id);
    }
}
