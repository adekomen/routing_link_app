<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lien extends Model
{
    use HasFactory;

    protected $fillable = ['routeur1_id', 'routeur2_id', 'cout', 'reseau'];

    public function routeur1()
    {
        return $this->belongsTo(Routeur::class, 'routeur1_id');
    }

    public function routeur2()
    {
        return $this->belongsTo(Routeur::class, 'routeur2_id');
    }
}
